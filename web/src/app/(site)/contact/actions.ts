"use server";

import { headers } from "next/headers";
import { redirect } from "next/navigation";
import { validateContact, type ContactErrors } from "@/lib/contact-schema";
import { buildContactMailToCompany, buildContactMailToUser } from "@/lib/mail/contact-mail";
import { sendMail } from "@/lib/mail/send";
import { verifyTurnstile } from "@/lib/turnstile";

export type SubmitContactMeta = {
  /** Turnstile のトークン（ウィジェット非表示時は null） */
  turnstileToken: string | null;
  /** ハニーポット（人間には見えない入力欄。値が入っていれば bot 扱い） */
  honeypot: string;
};

export type SubmitContactResult =
  | { ok: false; errors?: ContactErrors; formError?: string }
  | { ok: true };

/** 入力ステップに戻さず、確認ステップ上に出す共通エラー文 */
const FORM_ERROR_VERIFY = "認証に失敗しました。もう一度お試しください。";
const FORM_ERROR_SEND = "送信に失敗しました。時間をおいて再度お試しください。";

/**
 * 送信処理（現行 ContactsController@process の action=submit 相当）。
 *
 * 1. Zod で再検証（クライアントと同じスキーマ）
 * 2. ハニーポット: 値があれば何も送らずに完了画面へ（bot に失敗を悟らせない）
 * 3. Turnstile 検証（鍵未設定時: 開発はスキップ、本番は失敗）
 * 4. メール2通（送信者向け → 会社向け。現行と同じ順序。1通目が失敗したら2通目は送らない）
 * 5. /complete へリダイレクト
 *
 * DB 保存は現行と同じく行わない（会社回答があれば変更。§7.1 の 15）。
 */
export async function submitContact(values: unknown, meta?: SubmitContactMeta): Promise<SubmitContactResult> {
  const result = validateContact(values);
  if (!result.ok) {
    return { ok: false, errors: result.errors };
  }
  const data = result.data;

  if (meta?.honeypot) {
    console.warn("[contact] honeypot に入力あり。送信せず完了画面へ");
    redirect("/complete");
  }

  const h = await headers();
  const remoteIp = h.get("x-forwarded-for")?.split(",")[0]?.trim() ?? h.get("x-real-ip");
  const verify = await verifyTurnstile(meta?.turnstileToken, remoteIp);
  if (!verify.ok) {
    console.warn("[contact] Turnstile 検証失敗", verify.codes);
    return { ok: false, formError: FORM_ERROR_VERIFY };
  }

  const from = process.env.CONTACT_MAIL_FROM;
  const to = process.env.CONTACT_MAIL_TO;
  if (!from || !to) {
    if (process.env.NODE_ENV === "production") {
      console.error("[contact] CONTACT_MAIL_FROM / CONTACT_MAIL_TO が未設定");
      return { ok: false, formError: FORM_ERROR_SEND };
    }
    console.warn("[contact] CONTACT_MAIL_FROM / CONTACT_MAIL_TO 未設定のためダミーアドレスで組み立てます（開発環境のみ）");
  }
  const fromAddress = from ?? "noreply@example.com";
  const toAddress = to ?? "contact@example.com";

  const sentToUser = await sendMail(buildContactMailToUser(data, fromAddress));
  if (!sentToUser.ok) {
    console.error("[contact] 送信者向けメール失敗", sentToUser.error);
    return { ok: false, formError: FORM_ERROR_SEND };
  }
  const sentToCompany = await sendMail(buildContactMailToCompany(data, fromAddress, toAddress));
  if (!sentToCompany.ok) {
    console.error("[contact] 会社向けメール失敗", sentToCompany.error);
    return { ok: false, formError: FORM_ERROR_SEND };
  }

  redirect("/complete");
}
