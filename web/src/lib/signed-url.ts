import { createHmac, timingSafeEqual } from "node:crypto";

/**
 * 署名付き URL（現行 URL::temporarySignedRoute の代替）。
 * `path?params&expires=<unix秒>&signature=<HMAC-SHA256>` の形。鍵は AUTH_SECRET。
 * 現行はセッションに検証結果をキャッシュしていたが、移行後はステートレスに毎回検証する。
 */
function secret(): string {
  const s = process.env.AUTH_SECRET;
  if (!s) throw new Error("AUTH_SECRET が設定されていません");
  return s;
}

/** 署名対象文字列（キー順を固定して正規化） */
function canonical(path: string, params: Record<string, string>): string {
  const qs = new URLSearchParams(
    Object.keys(params)
      .sort()
      .map((k) => [k, params[k]] as [string, string]),
  );
  return `${path}?${qs.toString()}`;
}

function sign(payload: string): string {
  return createHmac("sha256", secret()).update(payload).digest("hex");
}

export function createSignedUrl(baseUrl: string, path: string, params: Record<string, string>, ttlMs: number): string {
  const expires = String(Math.floor((Date.now() + ttlMs) / 1000));
  const signedParams = { ...params, expires };
  const signature = sign(canonical(path, signedParams));
  const qs = new URLSearchParams({ ...signedParams, signature });
  return `${baseUrl.replace(/\/$/, "")}${path}?${qs.toString()}`;
}

export type SignatureCheck = "valid" | "expired" | "invalid";

/**
 * 検証。params には signature / expires を含む全クエリを渡す。
 * 署名が一致しなければ invalid、一致するが期限切れなら expired（現行の「無効なURLです。」「期限切れURLです。」に対応）
 */
export function verifySignedParams(path: string, params: Record<string, string | undefined>): SignatureCheck {
  const { signature, ...rest } = params;
  if (!signature || !rest.expires) return "invalid";
  const clean: Record<string, string> = {};
  for (const [k, v] of Object.entries(rest)) if (typeof v === "string") clean[k] = v;

  const expected = sign(canonical(path, clean));
  const a = Buffer.from(expected, "utf8");
  const b = Buffer.from(signature, "utf8");
  if (a.length !== b.length || !timingSafeEqual(a, b)) return "invalid";

  const expires = Number(clean.expires);
  if (!Number.isFinite(expires) || Date.now() / 1000 > expires) return "expired";
  return "valid";
}
