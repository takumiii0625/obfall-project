/**
 * 日付整形。現行は SQL 側の DATE_FORMAT(created_at, "%Y年%m月%d日") で行っていたが、
 * 移行方針どおりアプリ側（Intl）で行う。DB は timestamptz（UTC）なので JST に変換して日付を取る。
 */
const JA_DATE = new Intl.DateTimeFormat("ja-JP", {
  timeZone: "Asia/Tokyo",
  year: "numeric",
  month: "2-digit",
  day: "2-digit",
});

/** Date → "YYYY年MM月DD日"（null/undefined は空文字） */
export function formatJaDate(value: Date | string | null | undefined): string {
  if (!value) return "";
  const date = typeof value === "string" ? new Date(value) : value;
  if (Number.isNaN(date.getTime())) return "";
  const parts = JA_DATE.formatToParts(date);
  const get = (type: Intl.DateTimeFormatPartTypes) => parts.find((p) => p.type === type)?.value ?? "";
  return `${get("year")}年${get("month")}月${get("day")}日`;
}
