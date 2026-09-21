import type { Metadata } from "next";
import DevelopmentForm from "@/components/office/DevelopmentForm";
import { DEVELOPMENT_FORM_INITIAL_STATE } from "@/lib/development-form-state";
import { readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";
import { createDevelopmentAction } from "./actions";

export const metadata: Metadata = {
  title: "自社開発登録 | OBFall株式会社",
};

/**
 * 自社開発登録 入力・確認 GET /inhouse_developments/create/input（§2.3 #48, #49）
 * 現行: office/inhouse_developments/create/{input,confirm}.blade.php
 */
export default async function OfficeDevelopmentCreateInputPage({ searchParams }: PageProps<"/inhouse_developments/create/input">) {
  await requireActiveAdmin();
  const back = readBack((await searchParams).back);
  return <DevelopmentForm mode="create" action={createDevelopmentAction} initialState={DEVELOPMENT_FORM_INITIAL_STATE} back={back} />;
}
