/**
 * 管理 自社開発の URL 組み立て（office-news-links.ts と同じ方式。一覧クエリを `back` で持ち回る）。
 * 現行 URL: /inhouse_developments, /inhouse_developments/{id}, /inhouse_developments/create/{input,complete},
 *           /inhouse_developments/{id}/edit/{input,complete}
 */
export const OFFICE_DEVELOPMENTS_INDEX = "/inhouse_developments";

export function officeDevelopmentsIndexHref(back: string): string {
  return back ? `${OFFICE_DEVELOPMENTS_INDEX}?${back}` : OFFICE_DEVELOPMENTS_INDEX;
}

export function officeDevelopmentsIndexHrefWith(back: string, extra: Record<string, string>): string {
  const params = new URLSearchParams(back);
  for (const [k, v] of Object.entries(extra)) params.set(k, v);
  const qs = params.toString();
  return qs ? `${OFFICE_DEVELOPMENTS_INDEX}?${qs}` : OFFICE_DEVELOPMENTS_INDEX;
}

const withBack = (path: string, back: string) => (back ? `${path}?back=${encodeURIComponent(back)}` : path);

export const officeDevelopmentShowHref = (id: number, back: string) => withBack(`${OFFICE_DEVELOPMENTS_INDEX}/${id}`, back);
export const officeDevelopmentCreateHref = (back: string) => withBack(`${OFFICE_DEVELOPMENTS_INDEX}/create/input`, back);
export const officeDevelopmentCreateCompleteHref = (back: string) => withBack(`${OFFICE_DEVELOPMENTS_INDEX}/create/complete`, back);
export const officeDevelopmentEditHref = (id: number, back: string) => withBack(`${OFFICE_DEVELOPMENTS_INDEX}/${id}/edit/input`, back);
export const officeDevelopmentEditCompleteHref = (id: number, back: string) =>
  withBack(`${OFFICE_DEVELOPMENTS_INDEX}/${id}/edit/complete`, back);
