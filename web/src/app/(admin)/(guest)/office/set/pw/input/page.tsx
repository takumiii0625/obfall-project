import type { Metadata } from "next";
import { redirect } from "next/navigation";
import { findAdminByResetToken } from "@/lib/admins";
import { verifySignedParams } from "@/lib/signed-url";
import SetPwForm from "./SetPwForm";
import { SET_PW_PATH } from "./set-pw-state";

export const metadata: Metadata = {
  title: "パスワード設定 | OBFall株式会社",
};

/**
 * 新パスワード入力 GET /office/set/pw/input?token=&expires=&signature=（§2.2 #29）
 * 現行: office/auth/set/pw/input.blade.php + OfficeAuthController@setPwInput
 *   token 無し → 「無効なURLです。」/ 署名不正 → 同 / 期限切れ → 「期限切れURLです。」/ token 不一致 → 「無効なURLです。」
 * 現行はセッションに検証結果を保持していたが、移行後は毎回検証し、クエリをフォームで持ち回る。
 */
export default async function OfficeSetPwInputPage({ searchParams }: PageProps<"/office/set/pw/input">) {
  const params = await searchParams;
  const pick = (k: string) => (typeof params[k] === "string" ? (params[k] as string) : "");
  const signed = { token: pick("token"), expires: pick("expires"), signature: pick("signature") };

  if (!signed.token) {
    redirect("/office/forgot/pw/input?error=invalid");
  }
  const check = verifySignedParams(SET_PW_PATH, signed);
  if (check !== "valid") {
    redirect(`/office/forgot/pw/input?error=${check}`);
  }
  const admin = await findAdminByResetToken(signed.token);
  if (!admin) {
    redirect("/office/forgot/pw/input?error=invalid");
  }

  return <SetPwForm signed={signed} />;
}
