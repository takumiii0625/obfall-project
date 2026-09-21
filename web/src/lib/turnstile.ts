import "server-only";

/**
 * Cloudflare Turnstile のサーバー側検証。
 *
 * - TURNSTILE_SECRET_KEY があれば siteverify で検証
 * - 無い場合: 開発環境ではスキップ（警告ログ）、本番では失敗扱い（fail closed）
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
    if (process.env.NODE_ENV === "production") {
      return { ok: false, codes: ["not-configured"] };
    }
    console.warn("[turnstile] TURNSTILE_SECRET_KEY 未設定のため検証をスキップします（開発環境のみ）");
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
