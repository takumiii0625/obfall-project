"use server";

import { redirect } from "next/navigation";
import { softDeleteNews } from "@/lib/newses";
import { requireActiveAdmin } from "@/lib/office-session";
import { officeNewsIndexHrefWith } from "@/lib/office-news-links";
import { revalidateNewsPages } from "@/lib/revalidate";

/**
 * お知らせ削除（現行 OfficeNewsesController@deleteExecute、§2.3 #45）。
 * 論理削除 → 公開ページを再検証 → 一覧（検索条件を復元）へ「削除しました。」
 * 現行は id の存在を確認せず update しており、0 行でも成功扱い。同じにする。
 */
export async function deleteNewsAction(id: number, back: string): Promise<void> {
  await requireActiveAdmin();

  let ok = true;
  try {
    await softDeleteNews(id);
  } catch (e) {
    console.error("[office:news:delete] 失敗", e);
    ok = false;
  }
  if (!ok) redirect(officeNewsIndexHrefWith(back, { error: "db" }));

  revalidateNewsPages(id);
  redirect(officeNewsIndexHrefWith(back, { deleted: "1" }));
}
