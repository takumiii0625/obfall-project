"use server";

import { redirect } from "next/navigation";
import { dbWrite } from "@/db";
import { findActiveAdminByEmail, setPasswordResetToken } from "@/lib/admins";
import { getAppUrl } from "@/lib/app-url";
import { buildForgotPwMail, officeMailFrom } from "@/lib/mail/office-mail";
import { sendMail } from "@/lib/mail/send";
import { forgotPwSchema, validateWith } from "@/lib/office-auth-schema";
import { MSG_UNEXPECTED_ERROR } from "@/lib/office-form-state";
import { makeRandomStr } from "@/lib/random";
import { createSignedUrl } from "@/lib/signed-url";
import { SET_PW_PATH } from "../../../set/pw/input/set-pw-state";
import type { ForgotState } from "./forgot-state";

/** 現行: 署名付き URL の有効期限 72 時間 */
const TOKEN_TTL_MS = 72 * 60 * 60 * 1000;

/**
 * PW 再設定 URL の発行（現行 OfficeAuthController@forgotPwExecute、§2.2 #27）。
 * - 該当管理者が無ければ何もせず完了画面へ（メールアドレスの存否を知らせない。現行と同じ）
 * - トークン発行 → remember_token 保存 → メール送信をトランザクションで行い、送信失敗なら保存を戻す
 */
export async function forgotPwAction(_prev: ForgotState, formData: FormData): Promise<ForgotState> {
  const raw = { email: String(formData.get("email") ?? "") };
  const state: ForgotState = { values: { email: raw.email.trim() } };

  const validated = validateWith(forgotPwSchema, raw);
  if (!validated.ok) {
    return { ...state, fieldErrors: validated.errors };
  }

  const admin = await findActiveAdminByEmail(validated.data.email);
  if (!admin) {
    redirect("/office/forgot/pw/complete");
  }

  const from = officeMailFrom();
  if (!from && process.env.NODE_ENV === "production") {
    console.error("[office:forgot] OFFICE_MAIL_FROM / CONTACT_MAIL_FROM が未設定");
    return { ...state, error: MSG_UNEXPECTED_ERROR };
  }

  const token = makeRandomStr();
  const url = createSignedUrl(await getAppUrl(), SET_PW_PATH, { token }, TOKEN_TTL_MS);

  try {
    await dbWrite().transaction(async (tx) => {
      await setPasswordResetToken(admin.id, token, tx);
      const sent = await sendMail(buildForgotPwMail(admin, url, from ?? "noreply@example.com"));
      if (!sent.ok) throw new Error(`メール送信失敗: ${sent.error}`);
    });
  } catch (e) {
    console.error("[office:forgot] 失敗", e);
    return { ...state, error: MSG_UNEXPECTED_ERROR };
  }

  redirect("/office/forgot/pw/complete");
}
