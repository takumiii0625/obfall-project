import "server-only";
import { headers } from "next/headers";

/**
 * アプリの公開 URL（メール内リンクの生成用。現行 APP_URL / route() の絶対 URL 相当）。
 * APP_URL があればそれを使い、無ければリクエストのホストから組み立てる（ローカル用）。
 */
export async function getAppUrl(): Promise<string> {
  const fromEnv = process.env.APP_URL;
  if (fromEnv) return fromEnv.replace(/\/$/, "");
  const h = await headers();
  const host = h.get("x-forwarded-host") ?? h.get("host") ?? "localhost:3000";
  const proto = h.get("x-forwarded-proto") ?? (host.startsWith("localhost") ? "http" : "https");
  return `${proto}://${host}`;
}
