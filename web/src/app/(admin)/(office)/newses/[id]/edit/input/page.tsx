import type { Metadata } from "next";
import { redirect } from "next/navigation";
import NewsForm from "@/components/office/NewsForm";
import { getOfficeNewsById, resolveImageUrl } from "@/lib/newses";
import { officeNewsIndexHrefWith, readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";
import { updateNewsAction } from "./actions";

export const metadata: Metadata = {
  title: "お知らせ編集 | OBFall株式会社",
};

/**
 * お知らせ編集 入力・確認 GET /newses/{id}/edit/input（§2.3 #41, #42）
 * 現行: office/newses/edit/{input,confirm}.blade.php + OfficeNewsesController@editInput
 * 存在しなければ一覧へ「お知らせが存在しません。」
 */
export default async function OfficeNewsEditInputPage({ params, searchParams }: PageProps<"/newses/[id]/edit/input">) {
  await requireActiveAdmin();
  const { id: idParam } = await params;
  const back = readBack((await searchParams).back);
  const id = Number.parseInt(idParam, 10);

  const record = await getOfficeNewsById(id);
  if (!record) {
    redirect(officeNewsIndexHrefWith(back, { error: "notfound" }));
  }

  return (
    <NewsForm
      mode="edit"
      action={updateNewsAction.bind(null, record.id)}
      initialState={{
        values: { title: record.title ?? "", content: record.content ?? "", status: String(record.status) },
      }}
      existingImages={{
        1: resolveImageUrl(record.news_image_url_1),
        2: resolveImageUrl(record.news_image_url_2),
        3: resolveImageUrl(record.news_image_url_3),
      }}
      back={back}
    />
  );
}
