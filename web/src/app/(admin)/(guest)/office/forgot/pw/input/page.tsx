import type { Metadata } from "next";
import ForgotForm from "./ForgotForm";

export const metadata: Metadata = {
  title: "パスワードを忘れたら | OBFall株式会社",
};

/** 現行 setPwInput が forgot 画面へ戻すときのフラッシュ（?error= で受ける。任意文字列は表示しない） */
const FLASH_ERRORS: Record<string, string> = {
  invalid: "無効なURLです。",
  expired: "期限切れURLです。",
};

/**
 * PW 再設定メール送信フォーム GET /office/forgot/pw/input（§2.2 #26）
 * 現行: office/auth/forgot/pw/input.blade.php + OfficeAuthController@forgotPwInput
 */
export default async function OfficeForgotPwInputPage({ searchParams }: PageProps<"/office/forgot/pw/input">) {
  const params = await searchParams;
  const key = typeof params.error === "string" ? params.error : "";
  return <ForgotForm flashError={FLASH_ERRORS[key] ?? null} />;
}
