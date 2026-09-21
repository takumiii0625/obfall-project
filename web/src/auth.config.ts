import type { NextAuthConfig } from "next-auth";
// JWT 型の module augmentation（下記 declare module）のために解決させる
import "next-auth/jwt";

/**
 * Auth.js の設定のうち、DB に依存しない部分（proxy.ts からも読み込む）。
 * Credentials プロバイダ本体（DB 照合）は src/auth.ts 側で追加する。
 *
 * - セッションは JWT（Cookie）。Vercel Functions はステートレスなのでファイルセッションは使えない（§3.1.3）
 * - 有効期限は現行 Laravel の SESSION_LIFETIME=120 分に合わせ、アクセスのたびに延長（updateAge）する
 */
export const SESSION_MAX_AGE_SECONDS = 120 * 60;

export const authConfig = {
  trustHost: true,
  session: {
    strategy: "jwt",
    maxAge: SESSION_MAX_AGE_SECONDS,
    updateAge: 5 * 60,
  },
  pages: {
    signIn: "/office/login",
    error: "/office/login",
  },
  providers: [],
  callbacks: {
    jwt({ token, user }) {
      if (user) {
        token.adminId = Number(user.id);
        token.needsInit = user.needsInit === true;
      }
      return token;
    },
    session({ session, token }) {
      session.user.id = String(token.adminId ?? "");
      session.user.needsInit = token.needsInit === true;
      return session;
    },
  },
} satisfies NextAuthConfig;

declare module "next-auth" {
  interface User {
    /** 初期管理者（activated_at 未設定）。/init/input で氏名・メール・PW を設定するまで管理画面に入れない */
    needsInit?: boolean;
  }
  interface Session {
    user: {
      id: string;
      needsInit: boolean;
      email?: string | null;
      name?: string | null;
    };
  }
}

declare module "next-auth/jwt" {
  interface JWT {
    adminId?: number;
    needsInit?: boolean;
  }
}
