"use server";

import { redirect } from "next/navigation";
import type { DevelopmentFormState } from "@/lib/development-form-state";
import { DEVELOPMENT_IMAGE_FIELD, readDevelopmentImageFile, validateDevelopmentFields } from "@/lib/development-schema";
import { getOfficeDevelopmentById, updateDevelopment } from "@/lib/developments";
import { validateImageFile } from "@/lib/news-schema";
import { officeDevelopmentEditCompleteHref, officeDevelopmentsIndexHrefWith } from "@/lib/office-development-links";
import { MSG_DB_ERROR, MSG_UNEXPECTED_ERROR } from "@/lib/office-form-state";
import { requireActiveAdmin } from "@/lib/office-session";
import { deleteImage, uploadImage } from "@/lib/storage";

/**
 * 自社開発編集（現行 editConfirm の検証・画像処理 + editExecute の update。§2.3 #53, #54）。
 * 画像: 新規ファイルがあれば置き換え（旧ファイルは update 成功後に削除）、無ければ既存を維持。
 * ※ 現行ビューに削除チェックが無いため削除指定は受けない（確認事項）
 */
export async function updateDevelopmentAction(id: number, _prev: DevelopmentFormState, formData: FormData): Promise<DevelopmentFormState> {
  await requireActiveAdmin();

  const back = String(formData.get("back") ?? "");
  const raw = {
    category: String(formData.get("category") ?? ""),
    title: String(formData.get("title") ?? ""),
    content: String(formData.get("content") ?? ""),
    inhouse_developments_home_page_url: String(formData.get("inhouse_developments_home_page_url") ?? ""),
    status: String(formData.get("status") ?? ""),
  };
  const state: DevelopmentFormState = { values: raw };

  const record = await getOfficeDevelopmentById(id);
  if (!record) {
    redirect(officeDevelopmentsIndexHrefWith(back, { error: "notfound" }));
  }

  const validated = validateDevelopmentFields(raw);
  const file = readDevelopmentImageFile(formData);
  const imageError = file ? validateImageFile(file) : null;
  if (!validated.ok || imageError) {
    return { ...state, fieldErrors: { ...(validated.ok ? {} : validated.errors), ...(imageError ? { [DEVELOPMENT_IMAGE_FIELD]: imageError } : {}) } };
  }

  let imageUrl = record.inhouse_developments_image_url;
  let uploaded: string | null = null;
  try {
    if (file) {
      uploaded = await uploadImage(file);
      imageUrl = uploaded;
    }
  } catch (e) {
    console.error("[office:development:edit] 画像アップロード失敗", e);
    return { ...state, error: MSG_UNEXPECTED_ERROR };
  }

  try {
    await updateDevelopment(id, {
      category: validated.data.category,
      title: validated.data.title,
      content: validated.data.content,
      inhouse_developments_image_url: imageUrl,
      inhouse_developments_home_page_url: validated.data.inhouse_developments_home_page_url || null,
      status: Number(validated.data.status),
    });
  } catch (e) {
    console.error("[office:development:edit] update 失敗", e);
    await deleteImage(uploaded);
    return { ...state, error: MSG_DB_ERROR };
  }

  if (uploaded) await deleteImage(record.inhouse_developments_image_url);
  redirect(officeDevelopmentEditCompleteHref(id, back));
}
