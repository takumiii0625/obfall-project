"use server";

import { AuthError, CredentialsSignin } from "next-auth";
import { cookies } from "next/headers";
import { signIn } from "@/auth";
import { validateLogin } from "@/lib/office-auth-schema";
import type { LoginState } from "./login-state";

/** 現行 loginExecute のメッセージ */
const MSG_BLOCKED = "ログインが制限されました。時間をおいて再度お試しください。";
const MSG_LOCKED =
  "ご利用のアカウントは、何度もログインに失敗したため一時的にロックされました。1時間経ってからもう一度ログインしてください。";
const MSG_FAILED = "ログインに失敗しました。メールアドレスとパスワードが正しいかご確認ください。";

/** 現行: 失敗後 5 秒間は再試行不可（セッション → Cookie に置換） */
const BLOCK_COOKIE = "office_login_block";
const BLOCK_SECONDS = 5;

/** ログイン後の遷移先（現行 route('officeNewsIndex')） */
const AFTER_LOGIN = "/admins/newses";

/**
 * ログイン（現行 OfficeAuthController@loginExecute）。
 * 照合・ロック判定は src/auth.ts の authorize() が行い、ここでは
 * 入力検証、5秒ブロック、Auth.js の結果をメッセージに変換する。
 * 成功時は redirect() せず遷移先を返す（フルページ遷移が必要。login-state.ts 参照）。
 */
export async function loginAction(_prev: LoginState, formData: FormData): Promise<LoginState> {
  const raw = {
    email: String(formData.get("email") ?? ""),
    password: String(formData.get("password") ?? ""),
  };
  const state: LoginState = { email: raw.email.trim() };

  const validated = validateLogin(raw);
  if (!validated.ok) {
    return { ...state, fieldErrors: validated.errors };
  }

  const jar = await cookies();
  const blockedUntil = Number(jar.get(BLOCK_COOKIE)?.value ?? 0);
  if (blockedUntil && Date.now() < blockedUntil) {
    return { ...state, error: MSG_BLOCKED };
  }

  // サーバー側 signIn（raw モード）は失敗時に CredentialsSignin を throw する（code に locked / failed）。
  // 念のため、URL に ?error= が付いて返るケースも同じ扱いにする
  let failureCode: string | null = null;
  try {
    const resultUrl = await signIn("credentials", {
      email: validated.data.email,
      password: validated.data.password,
      redirect: false,
      redirectTo: AFTER_LOGIN,
    });
    const url = new URL(resultUrl, "http://localhost");
    if (url.searchParams.get("error")) {
      failureCode = url.searchParams.get("code") ?? "failed";
    }
  } catch (e) {
    if (e instanceof CredentialsSignin) {
      failureCode = e.code || "failed";
    } else if (e instanceof AuthError) {
      failureCode = "failed";
    } else {
      throw e;
    }
  }

  if (failureCode === "locked") {
    return { ...state, error: MSG_LOCKED };
  }
  if (failureCode) {
    jar.set(BLOCK_COOKIE, String(Date.now() + BLOCK_SECONDS * 1000), {
      httpOnly: true,
      sameSite: "lax",
      path: "/office/login",
      maxAge: BLOCK_SECONDS,
    });
    return { ...state, error: MSG_FAILED };
  }

  // 成功: LoginForm がフルページ遷移する（理由は login-state.ts の redirectTo を参照）。
  // 初期管理者は遷移先で proxy が /init/input へ振り分ける
  return { ...state, redirectTo: AFTER_LOGIN };
}
