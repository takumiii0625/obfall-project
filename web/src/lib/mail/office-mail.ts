import type { MailMessage } from "./contact-mail";
import { formatAddress } from "./contact-mail";

/**
 * 管理者向けメール（HTML）。現行 App\Mail\Office\ForgotPwMail / SetPwMail + office/auth/{forgot,set}/pw/notice.blade.php の移植。
 * 現行は Laravel の MAIL_FROM_ADDRESS / MAIL_FROM_NAME（本番値は未確認。§7.1 の 1）を差出人にする。
 * 移行後は OFFICE_MAIL_FROM（無ければ CONTACT_MAIL_FROM）と MAIL_FROM_NAME を使う。
 */

/** office/signature.blade.php */
const SIGNATURE_HTML = "【OBfall株式会社】自動送信メール\n<br>";

function escapeHtml(value: string | null | undefined): string {
  return String(value ?? "")
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

/** HTML メールのタグを落として text 版も付ける（メーラーのプレビュー用）。HTML 上は空白扱いの生改行は捨て、<br> だけを改行にする */
function htmlToText(html: string): string {
  return html
    .replace(/\n/g, "")
    .replace(/<br\s*\/?>/gi, "\n")
    .replace(/<a [^>]*href="([^"]*)"[^>]*>[^<]*<\/a>/gi, "$1")
    .replace(/<[^>]+>/g, "")
    .replace(/&amp;/g, "&")
    .replace(/&lt;/g, "<")
    .replace(/&gt;/g, ">")
    .replace(/&quot;/g, '"')
    .replace(/&#039;/g, "'");
}

export function officeMailFrom(): string | null {
  const address = process.env.OFFICE_MAIL_FROM ?? process.env.CONTACT_MAIL_FROM;
  if (!address) return null;
  return formatAddress(process.env.MAIL_FROM_NAME ?? "OBFall株式会社", address);
}

type AdminLike = { name: string | null; email: string | null };

/**
 * パスワード設定依頼受付（ForgotPwMail、office/auth/forgot/pw/notice.blade.php）
 * ※ 件名は現行どおり「OBfall」（小文字 f）
 */
export function buildForgotPwMail(admin: AdminLike, url: string, from: string): MailMessage {
  const html =
    `${escapeHtml(admin.name)} 様<br><br>\n\n` +
    `パスワードの設定依頼を受け付けました。<br>\n` +
    `※パスワードの設定はまだ完了しておりません。<br><br>\n\n` +
    `以下のURLより、新しいパスワードの設定へお進みください。<br>\n` +
    `URLは72時間をすぎると無効となりますのでご注意ください。<br>\n` +
    `→ <a href="${escapeHtml(url)}" target="_blank">${escapeHtml(url)}</a><br><br><br><br>\n\n\n\n` +
    SIGNATURE_HTML;
  return {
    from,
    to: admin.email ?? "",
    subject: "【OBfall】パスワードの設定依頼受付のお知らせ",
    text: htmlToText(html),
    html,
  };
}

/**
 * パスワード変更完了（SetPwMail、office/auth/set/pw/notice.blade.php）
 * ※ 現行の文面に他プロジェクト名「NoaChoice URL：」が残っている。作業ルールに従い現行どおり（確認事項として報告）
 * ※ 現行は存在しない 'user/signature' を include しており送信時に例外になる可能性が高い（§7.1 の 13）。
 *   移行後は office/signature を使う（差分として報告）
 */
export function buildSetPwMail(admin: AdminLike, appUrl: string, from: string): MailMessage {
  const newsIndexUrl = `${appUrl}/admins/newses`;
  const forgotUrl = `${appUrl}/office/forgot/pw/input`;
  const html =
    `${escapeHtml(admin.name)} 様<br><br>\n\n` +
    `パスワードの変更が完了しました。<br>\n` +
    `※パスワードはログイン時に必要になるため、ご自身で大切に管理していただくようお願いいたします。<br><br>\n\n` +
    `NoaChoice URL：<br>\n` +
    `→ <a href="${escapeHtml(newsIndexUrl)}" target="_blank">${escapeHtml(newsIndexUrl)}</a><br><br><br>\n\n\n` +
    `パスワードを変更した覚えがない場合は、下記のURLよりパスワードの設定をお願いいたします。<br>\n` +
    `→ <a href="${escapeHtml(forgotUrl)}" target="_blank">${escapeHtml(forgotUrl)}</a><br><br><br><br>\n\n\n\n` +
    SIGNATURE_HTML;
  return {
    from,
    to: admin.email ?? "",
    subject: "【OBFall】パスワード変更完了のお知らせ",
    text: htmlToText(html),
    html,
  };
}
