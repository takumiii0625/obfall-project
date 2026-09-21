import type { Metadata } from "next";
import { redirect } from "next/navigation";
import DevelopmentForm from "@/components/office/DevelopmentForm";
import { getOfficeDevelopmentById } from "@/lib/developments";
import { resolveImageUrl } from "@/lib/newses";
import { officeDevelopmentsIndexHrefWith } from "@/lib/office-development-links";
import { readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";
import { updateDevelopmentAction } from "./actions";

export const metadata: Metadata = {
  title: "自社開発編集 | OBFall株式会社",
};

/**
 * 自社開発編集 入力・確認 GET /inhouse_developments/{id}/edit/input（§2.3 #52, #53）
 * 現行: office/inhouse_developments/edit/{input,confirm}.blade.php + OfficeDevelopmentsController@editInput
 */
export default async function OfficeDevelopmentEditInputPage({ params, searchParams }: PageProps<"/inhouse_developments/[id]/edit/input">) {
  await requireActiveAdmin();
  const { id: idParam } = await params;
  const back = readBack((await searchParams).back);
  const id = Number.parseInt(idParam, 10);

  const record = await getOfficeDevelopmentById(id);
  if (!record) {
    redirect(officeDevelopmentsIndexHrefWith(back, { error: "notfound" }));
  }

  return (
    <DevelopmentForm
      mode="edit"
      action={updateDevelopmentAction.bind(null, record.id)}
      initialState={{
        values: {
          category: record.category ?? "",
          title: record.title ?? "",
          content: record.content ?? "",
          inhouse_developments_home_page_url: record.inhouse_developments_home_page_url ?? "",
          status: String(record.status),
        },
      }}
      existingImage={resolveImageUrl(record.inhouse_developments_image_url)}
      back={back}
    />
  );
}
