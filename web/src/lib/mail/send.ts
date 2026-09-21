import "server-only";
import { Resend } from "resend";
import type { MailMessage } from "./contact-mail";

/**
 * メール送信（Resend）。
 *
 * - RESEND_API_KEY があれば Resend で送る
 * - 無い場合: 開発環境ではドライラン（本文をログに出して成功扱い）、本番では例外
 *
 * 送信元ドメイン obfall.co.jp は Resend 側でドメイン認証（SPF / DKIM / DMARC をムームードメインの DNS に設定）
 * が済んでいる必要がある。未設定のまま送ると Resend が 403 を返す。
 */
export type SendResult = { ok: true; id: string | null; dryRun: boolean } | { ok: false; error: string };

let client: Resend | null = null;

function getClient(apiKey: string): Resend {
  if (!client) client = new Resend(apiKey);
  return client;
}

export async function sendMail(message: MailMessage): Promise<SendResult> {
  const apiKey = process.env.RESEND_API_KEY;

  if (!apiKey) {
    if (process.env.NODE_ENV === "production") {
      return { ok: false, error: "RESEND_API_KEY が設定されていません" };
    }
    console.info(
      `[mail:dry-run] From: ${message.from}\n  To: ${message.to}\n  Reply-To: ${message.replyTo ?? "-"}\n  Subject: ${message.subject}\n---\n${message.text}\n---${message.html ? "\n(html あり)" : ""}`,
    );
    return { ok: true, id: null, dryRun: true };
  }

  try {
    const { data, error } = await getClient(apiKey).emails.send({
      from: message.from,
      to: message.to,
      replyTo: message.replyTo,
      subject: message.subject,
      text: message.text,
      ...(message.html ? { html: message.html } : {}),
    });
    if (error) {
      return { ok: false, error: `${error.name}: ${error.message}` };
    }
    return { ok: true, id: data?.id ?? null, dryRun: false };
  } catch (e) {
    return { ok: false, error: e instanceof Error ? e.message : String(e) };
  }
}
