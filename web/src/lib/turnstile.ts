import "server-only";

/**
 * Cloudflare Turnstile のサーバー側検証。
 *
 * - TURNSTILE_SECRET_KEY があれば siteverify で検証
 * - 無い場合: 環境を問わず検証をスキップする（警告ログのみ）。Turnstile は現行 Laravel に無い新規追加のため、
 *   キー未設定の間は現行どおり「ハニーポットのみ」で運用し、キーを設定すれば有効になる（2026-09-30 ユーザー指示）
 *   ※ サイトキーだけ設定してシークレットを入れ忘れると、ウィジェットは出るのに検証されない状態になるので必ず2つ揃えて設定する
 *
 * ローカル確認用のテストキー（Cloudflare 公式のダミー。常に成功）:
 *   NEXT_PUBLIC_TURNSTILE_SITE_KEY=1x00000000000000000000AA
 *   TURNSTILE_SECRET_KEY=1x0000000000000000000000000000000AA
 */
const SITEVERIFY_URL = "https://challenges.cloudflare.com/turnstile/v0/siteverify";

export type TurnstileResult = { ok: true; skipped: boolean } | { ok: false; codes: string[] };

/** サイトキーが設定されていれば、クライアントにウィジェットを出す（＝トークン必須） */
export function isTurnstileEnabled(): boolean {
  return !!process.env.NEXT_PUBLIC_TURNSTILE_SITE_KEY;
}

export async function verifyTurnstile(token: string | null | undefined, remoteIp?: string | null): Promise<TurnstileResult> {
  const secret = process.env.TURNSTILE_SECRET_KEY;

  if (!secret) {
    console.warn("[turnstile] TURNSTILE_SECRET_KEY 未設定のため検証をスキップします（ハニーポットのみで運用）");
    return { ok: true, skipped: true };
  }

  if (!token) {
    return { ok: false, codes: ["missing-input-response"] };
  }

  const body = new URLSearchParams({ secret, response: token });
  if (remoteIp) body.set("remoteip", remoteIp);

  try {
    const res = await fetch(SITEVERIFY_URL, {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body,
      cache: "no-store",
    });
    const json = (await res.json()) as { success: boolean; "error-codes"?: string[] };
    return json.success ? { ok: true, skipped: false } : { ok: false, codes: json["error-codes"] ?? ["unknown"] };
  } catch (e) {
    return { ok: false, codes: ["request-failed", e instanceof Error ? e.message : String(e)] };
  }
}
