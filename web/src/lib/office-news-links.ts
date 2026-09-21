/**
 * 管理 お知らせの URL 組み立て。
 * 現行は検索条件をセッション（officeNewsIndexSearchParams）に保管して「戻る」で復元していたが、
 * 移行後は一覧のクエリ文字列を `back` パラメータで持ち回る（§3.6）。
 */
export const OFFICE_NEWS_INDEX = "/admins/newses";

/** 一覧のクエリ文字列（先頭の ? 無し）から一覧 URL を作る */
export function officeNewsIndexHref(back: string): string {
  return back ? `${OFFICE_NEWS_INDEX}?${back}` : OFFICE_NEWS_INDEX;
}

/** 一覧のクエリに flash 用パラメータを足した URL（削除完了・存在しない等） */
export function officeNewsIndexHrefWith(back: string, extra: Record<string, string>): string {
  const params = new URLSearchParams(back);
  for (const [k, v] of Object.entries(extra)) params.set(k, v);
  const qs = params.toString();
  return qs ? `${OFFICE_NEWS_INDEX}?${qs}` : OFFICE_NEWS_INDEX;
}

const withBack = (path: string, back: string) => (back ? `${path}?back=${encodeURIComponent(back)}` : path);

export const officeNewsShowHref = (id: number, back: string) => withBack(`${OFFICE_NEWS_INDEX}/${id}`, back);
export const officeNewsCreateHref = (back: string) => withBack("/newses/create/input", back);
export const officeNewsCreateCompleteHref = (back: string) => withBack("/newses/create/complete", back);
export const officeNewsEditHref = (id: number, back: string) => withBack(`/newses/${id}/edit/input`, back);
export const officeNewsEditCompleteHref = (id: number, back: string) => withBack(`/newses/${id}/edit/complete`, back);

/** searchParams の back を文字列にする（配列・未指定は空） */
export function readBack(value: string | string[] | undefined): string {
  return typeof value === "string" ? value : "";
}
