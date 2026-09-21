import type { ContactInput } from "@/lib/contact-schema";

/**
 * 問い合わせメール2通の本文・件名・ヘッダー（現行 App\Mail\ContactMail + resources/views/mails/*.blade.php の移植）。
 * どちらもテキストメール。React Email は使わない（docs/移行方針.md）。
 *
 * 現行との差分:
 *   - Blade の {{ }} はテキストメールでも HTML エスケープするため、本文に & < > " ' を含むと
 *     &amp; 等に化けていた。移行後はエスケープしない（確認事項として報告）。
 *   - 差出人・宛先アドレスは環境変数（CONTACT_MAIL_FROM / CONTACT_MAIL_TO）。現行は h.katono@obfall.co.jp 固定。
 */

export type MailMessage = {
  /** "表示名 <addr>" 形式 */
  from: string;
  to: string;
  replyTo?: string;
  subject: string;
  text: string;
  /** HTML 版（管理者向けメールのみ。問い合わせメールはテキストのみ） */
  html?: string;
};

/** 現行の送信元表示名（送信者向け） */
export const COMPANY_NAME = "OBFall株式会社";

/** メールヘッダーの表示名に使えない改行・山括弧・引用符を除く */
export function sanitizeDisplayName(name: string): string {
  return name.replace(/[\r\n<>"]/g, " ").replace(/\s+/g, " ").trim();
}

/** 件名などヘッダー1行に使う値から改行を除く（ヘッダーインジェクション対策） */
export function sanitizeHeaderLine(value: string): string {
  return value.replace(/[\r\n]+/g, " ").trim();
}

export function formatAddress(displayName: string, address: string): string {
  const name = sanitizeDisplayName(displayName);
  return name ? `${name} <${address}>` : address;
}

/** mails/contact.blade.php と mails/contact_to_company.blade.php で共通の明細ブロック */
function detailBlock(data: ContactInput): string {
  return [
    "=================",
    `お名前： ${data.name}`,
    "",
    `メールアドレス： ${data.email}`,
    "",
    `会社名： ${data.company}`,
    "",
    `電話番号： ${data.tel}`,
    "",
    `お問い合わせ内容： ${data.contents}`,
    "=================",
  ].join("\n");
}

/**
 * 送信者向け自動返信（mails.contact）
 * From: OBFall株式会社 <FROM> / To: 入力メール
 */
export function buildContactMailToUser(data: ContactInput, fromAddress: string): MailMessage {
  const text = [
    `${data.name} 様`,
    "",
    "この度はホームページよりお問い合わせいただき誠にありがとうございます。",
    "",
    "近日中に弊社担当者よりご返信致しますので、今しばらくお待ちください。",
    "内容によっては、時間がかかる場合や回答いたしかねる場合がございますのでご了承願います。",
    "",
    detailBlock(data),
    "",
    "このメールはお問い合わせいただいた方に自動でお送りしております。",
    "本メールに返信していただきましても、",
    "ご質問・ご依頼などにはお答えできませんので、あらかじめご了承ください。",
    "",
    "何卒よろしくお願い申し上げます。",
    "",
    COMPANY_NAME,
    "https://obfall.com",
  ].join("\n");

  return {
    from: formatAddress(COMPANY_NAME, fromAddress),
    to: data.email,
    subject: "【OBFall株式会社】お問い合わせありがとうございます",
    text,
  };
}

/**
 * 会社向け通知（mails.contact_to_company）
 * From: <入力会社名> <FROM> / Reply-To: <入力会社名> <入力メール> / To: CONTACT_MAIL_TO
 * ※ 現行どおり From の表示名に入力された会社名を使う（なりすまし判定を受けやすい点は確認事項）
 */
export function buildContactMailToCompany(data: ContactInput, fromAddress: string, toAddress: string): MailMessage {
  return {
    from: formatAddress(data.company, fromAddress),
    to: toAddress,
    replyTo: formatAddress(data.company, data.email),
    subject: sanitizeHeaderLine(`【${data.company}】新しいお問い合わせがありました`),
    text: detailBlock(data),
  };
}
