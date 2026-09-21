import NextAuth, { CredentialsSignin } from "next-auth";
import Credentials from "next-auth/providers/credentials";
import { authConfig } from "./auth.config";
import {
  LOGIN_LOCK_MS,
  findActiveAdminByEmail,
  findInitialAdminByEmail,
  recordLoginFailure,
  resetLoginFailures,
  unlockAdmin,
} from "@/lib/admins";
import { verifyPassword } from "@/lib/password";

/** ログイン失敗の種類（現行 loginExecute の各分岐に対応。メッセージは actions.ts 側で付ける） */
export type LoginFailureCode = "locked" | "failed";

class LoginFailure extends CredentialsSignin {
  constructor(code: LoginFailureCode) {
    super();
    this.code = code;
  }
}

/**
 * Auth.js（Credentials）。認証ロジックは現行 OfficeAuthController@loginExecute を移植:
 *
 * 1. 初期管理者（activated_at NULL）でパスワード一致 → needsInit 付きでログイン（proxy が /init/input へ誘導）
 * 2. 有効中の管理者を検索
 * 3. ロック中なら: 1時間経過していれば解除して続行、そうでなければ「locked」
 * 4. パスワード一致 → 失敗回数をリセットしてログイン
 * 5. 不一致 → 失敗回数 +1（6回でロック）→「failed」
 *
 * ※ 5秒間の再試行ブロック（現行はセッション）は Cookie で actions.ts 側が行う
 */
export const { handlers, auth, signIn, signOut } = NextAuth({
  ...authConfig,
  providers: [
    Credentials({
      credentials: {
        email: {},
        password: {},
      },
      async authorize(credentials) {
        const email = typeof credentials?.email === "string" ? credentials.email.trim() : "";
        const password = typeof credentials?.password === "string" ? credentials.password : "";
        if (!email || !password) throw new LoginFailure("failed");

        // 1. システムリリース時の初期管理者
        const firstAdmin = await findInitialAdminByEmail(email);
        if (firstAdmin && (await verifyPassword(password, firstAdmin.password))) {
          return { id: String(firstAdmin.id), email: firstAdmin.email, name: firstAdmin.name, needsInit: true };
        }

        // 2. 通常の管理者
        const admin = await findActiveAdminByEmail(email);

        // 3. ロックチェック
        if (admin?.login_locked_at) {
          if (Date.now() >= admin.login_locked_at.getTime() + LOGIN_LOCK_MS) {
            await unlockAdmin(admin.id);
          } else {
            throw new LoginFailure("locked");
          }
        }

        // 4. 成功
        if (admin && (await verifyPassword(password, admin.password))) {
          await resetLoginFailures(admin.id);
          return { id: String(admin.id), email: admin.email, name: admin.name, needsInit: false };
        }

        // 5. 失敗（該当管理者がいる場合のみ回数を数える。現行と同じ）
        if (admin) {
          await recordLoginFailure(admin.id);
        }
        throw new LoginFailure("failed");
      },
    }),
  ],
});
