"use server";

import { redirect } from "next/navigation";
import type { DevelopmentFormState } from "@/lib/development-form-state";
import { DEVELOPMENT_IMAGE_FIELD, readDevelopmentImageFile, validateDevelopmentFields } from "@/lib/development-schema";
import { insertDevelopment } from "@/lib/developments";
import { validateImageFile } from "@/lib/news-schema";
import { officeDevelopmentCreateCompleteHref } from "@/lib/office-development-links";
import { MSG_DB_ERROR, MSG_UNEXPECTED_ERROR } from "@/lib/office-form-state";
import { requireActiveAdmin } from "@/lib/office-session";
import { deleteImage, uploadImage } from "@/lib/storage";

function readValues(formData: FormData) {
  return {
    category: String(formData.get("category") ?? ""),
    title: String(formData.get("title") ?? ""),
    content: String(formData.get("content") ?? ""),
    inhouse_developments_home_page_url: String(formData.get("inhouse_developments_home_page_url") ?? ""),
    status: String(formData.get("status") ?? ""),
  };
}

/**
 * 自社開発登録（現行 createConfirm の検証 + createExecute の insert。§2.3 #49, #50）。
 * 画像は検証 → アップロード → insert。insert に失敗したらアップロード済み画像を消す。
 */
export async function createDevelopmentAction(_prev: DevelopmentFormState, formData: FormData): Promise<DevelopmentFormState> {
  await requireActiveAdmin();

  const back = String(formData.get("back") ?? "");
  const raw = readValues(formData);
  const state: DevelopmentFormState = { values: raw };

  const validated = validateDevelopmentFields(raw);
  const file = readDevelopmentImageFile(formData);
  const imageError = file ? validateImageFile(file) : null;
  if (!validated.ok || imageError) {
    return { ...state, fieldErrors: { ...(validated.ok ? {} : validated.errors), ...(imageError ? { [DEVELOPMENT_IMAGE_FIELD]: imageError } : {}) } };
  }

  let imageUrl: string | null = null;
  try {
    if (file) imageUrl = await uploadImage(file);
  } catch (e) {
    console.error("[office:development:create] 画像アップロード失敗", e);
    return { ...state, error: MSG_UNEXPECTED_ERROR };
  }

  try {
    await insertDevelopment({
      category: validated.data.category,
      title: validated.data.title,
      content: validated.data.content,
      inhouse_developments_image_url: imageUrl,
      inhouse_developments_home_page_url: validated.data.inhouse_developments_home_page_url || null,
      status: Number(validated.data.status),
    });
  } catch (e) {
    console.error("[office:development:create] insert 失敗", e);
    await deleteImage(imageUrl);
    return { ...state, error: MSG_DB_ERROR };
  }

  redirect(officeDevelopmentCreateCompleteHref(back));
}
