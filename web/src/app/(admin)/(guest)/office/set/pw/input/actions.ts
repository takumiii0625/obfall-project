"use server";

import { redirect } from "next/navigation";
import { dbWrite } from "@/db";
import { completePasswordReset, findAdminByResetToken } from "@/lib/admins";
import { getAppUrl } from "@/lib/app-url";
import { buildSetPwMail, officeMailFrom } from "@/lib/mail/office-mail";
import { sendMail } from "@/lib/mail/send";
import { setPwSchema, validateWith } from "@/lib/office-auth-schema";
import { MSG_UNEXPECTED_ERROR } from "@/lib/office-form-state";
import { hashPassword } from "@/lib/password";
import { verifySignedParams } from "@/lib/signed-url";
import { SET_PW_PATH, type SetPwState } from "./set-pw-state";

/**
 * PW 更新（現行 OfficeAuthController@setPwExecute、§2.2 #30）。
 * - 隠しフィールドの署名付きクエリを再検証（現行はセッションに保持していた token / 署名検証結果の代替）
 * - password / remember_token=null / activated_at を更新し、完了メールを送る。送信失敗ならロールバック
 */
export async function setPwAction(_prev: SetPwState, formData: FormData): Promise<SetPwState> {
  const values = {
    token: String(formData.get("token") ?? ""),
    expires: String(formData.get("expires") ?? ""),
    signature: String(formData.get("signature") ?? ""),
  };
  const state: SetPwState = { values };

  const check = verifySignedParams(SET_PW_PATH, values);
  if (check !== "valid") {
    redirect(`/office/forgot/pw/input?error=${check}`);
  }
  const admin = await findAdminByResetToken(values.token);
  if (!admin) {
    redirect("/office/forgot/pw/input?error=invalid");
  }

  const validated = validateWith(setPwSchema, { password: String(formData.get("password") ?? "") });
  if (!validated.ok) {
    return { ...state, fieldErrors: validated.errors };
  }

  const from = officeMailFrom();
  if (!from && process.env.NODE_ENV === "production") {
    console.error("[office:set-pw] OFFICE_MAIL_FROM / CONTACT_MAIL_FROM が未設定");
    return { ...state, error: MSG_UNEXPECTED_ERROR };
  }
  const appUrl = await getAppUrl();

  try {
    const passwordHash = await hashPassword(validated.data.password);
    await dbWrite().transaction(async (tx) => {
      await completePasswordReset(admin.id, values.token, passwordHash, tx);
      const sent = await sendMail(buildSetPwMail(admin, appUrl, from ?? "noreply@example.com"));
      if (!sent.ok) throw new Error(`メール送信失敗: ${sent.error}`);
    });
  } catch (e) {
    console.error("[office:set-pw] 失敗", e);
    return { ...state, error: MSG_UNEXPECTED_ERROR };
  }

  redirect("/office/set/pw/complete");
}
