import type { Metadata } from "next";
import LoginForm from "./LoginForm";

/** 現行: 「ログイン | {{ config('app.name') }}」。本番の APP_NAME は未確認（§7.1 の 1）のため会社名を仮置き */
export const metadata: Metadata = {
  title: "ログイン | OBFall株式会社",
};

/**
 * 管理者ログイン GET /office/login（§2.2 #21）+ POST（#22 は Server Action）
 * 現行: office/auth/login/input.blade.php + OfficeAuthController@loginInput / loginExecute
 * ログイン済みの場合は proxy が /admins/newses へ飛ばす（RedirectIfAuthenticated）。
 */
export default async function OfficeLoginPage({ searchParams }: PageProps<"/office/login">) {
  const params = await searchParams;
  // 現行はセッションフラッシュ。移行後はログアウト時に ?logout=1 を付けて表示する
  const success = params.logout !== undefined ? "ログアウトしました。" : null;

  return <LoginForm success={success} />;
}
