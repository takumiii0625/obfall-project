import type { Metadata } from "next";
import NewsForm from "@/components/office/NewsForm";
import { NEWS_FORM_INITIAL_STATE } from "@/lib/news-form-state";
import { readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";
import { createNewsAction } from "./actions";

export const metadata: Metadata = {
  title: "お知らせ登録 | OBFall株式会社",
};

/**
 * お知らせ登録 入力・確認 GET /newses/create/input（§2.3 #37, #38）
 * 現行: office/newses/create/{input,confirm}.blade.php。確認は同一 URL 内のステップ。
 */
export default async function OfficeNewsCreateInputPage({ searchParams }: PageProps<"/newses/create/input">) {
  await requireActiveAdmin();
  const back = readBack((await searchParams).back);
  return <NewsForm mode="create" action={createNewsAction} initialState={NEWS_FORM_INITIAL_STATE} back={back} />;
}
