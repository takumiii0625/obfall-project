"use server";

import { redirect } from "next/navigation";
import { softDeleteDevelopment } from "@/lib/developments";
import { officeDevelopmentsIndexHrefWith } from "@/lib/office-development-links";
import { requireActiveAdmin } from "@/lib/office-session";

/**
 * 自社開発削除（現行 OfficeDevelopmentsController@deleteExecute、§2.3 #56）。
 * 論理削除 → 一覧（検索条件を復元）へ「削除しました。」。公開側は DB を読まないため再検証は不要。
 */
export async function deleteDevelopmentAction(id: number, back: string): Promise<void> {
  await requireActiveAdmin();

  let ok = true;
  try {
    await softDeleteDevelopment(id);
  } catch (e) {
    console.error("[office:development:delete] 失敗", e);
    ok = false;
  }
  if (!ok) redirect(officeDevelopmentsIndexHrefWith(back, { error: "db" }));
  redirect(officeDevelopmentsIndexHrefWith(back, { deleted: "1" }));
}
