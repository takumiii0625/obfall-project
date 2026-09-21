import { revalidatePath } from "next/cache";

/**
 * 公開ページの配信方針（docs/移行方針.md）:
 *   お知らせ一覧・詳細・トップは ISR。管理画面の保存時に revalidateNewsPages() でオンデマンド再検証する。
 *
 * ※ 各ページの `export const revalidate` はリテラル必須のため直書きしている。変更時は両方を合わせること。
 * ISR の期限は保険。管理画面（セッション12）ができるまでは DB を直接編集しても最大この秒数は反映が遅れる。
 */
export const NEWS_REVALIDATE_SECONDS = 600;

/**
 * お知らせに関係するページをまとめて再検証する（セッション12 のお知らせ CRUD の保存・削除後に呼ぶ）。
 * Server Action / Route Handler の中でのみ呼べる。
 */
export function revalidateNewsPages(id?: number) {
  revalidatePath("/");
  revalidatePath("/newses");
  if (id !== undefined) {
    revalidatePath(`/newses/${id}`);
  } else {
    revalidatePath("/newses/[id]", "page");
  }
}
