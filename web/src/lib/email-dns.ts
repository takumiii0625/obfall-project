import "server-only";
import { promises as dns } from "node:dns";

/**
 * 現行 InitRequest の `email:rfc,dns` の dns 部分（メールドメインに MX か A/AAAA があるか）。
 * 移行後も同等の検証を行うかは §7.1 の 19 で確認中。回答があるまで現行どおり行う。
 * DNS 問い合わせ自体に失敗した場合は判定できないため通す（ログインできなくなるより安全側）。
 */
export async function hasMailDns(email: string): Promise<boolean> {
  const at = email.lastIndexOf("@");
  if (at < 0) return false;
  const domain = email.slice(at + 1);
  if (!domain) return false;
  try {
    const mx = await dns.resolveMx(domain).catch(() => []);
    if (mx.length > 0) return true;
    const a = await dns.resolve4(domain).catch(() => []);
    if (a.length > 0) return true;
    const aaaa = await dns.resolve6(domain).catch(() => []);
    return aaaa.length > 0;
  } catch (e) {
    console.warn("[email-dns] DNS 照会に失敗したため検証をスキップ", e instanceof Error ? e.message : e);
    return true;
  }
}
