"use server";

import { redirect } from "next/navigation";
import type { NewsFormState } from "@/lib/news-form-state";
import { discardImages, readImageInputs, uploadImageInputs, validateImageInputs } from "@/lib/news-images";
import { validateNewsFields } from "@/lib/news-schema";
import { insertNews } from "@/lib/newses";
import { MSG_DB_ERROR, MSG_UNEXPECTED_ERROR } from "@/lib/office-form-state";
import { officeNewsCreateCompleteHref } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";
import { revalidateNewsPages } from "@/lib/revalidate";

/**
 * お知らせ登録（現行 createConfirm の検証 + createExecute の insert を1回で行う。§2.3 #38, #39）。
 * 画像は検証 → アップロード → insert の順。insert に失敗したらアップロード済み画像を消す。
 * 成功時は公開ページを再検証して完了画面へ。
 */
export async function createNewsAction(_prev: NewsFormState, formData: FormData): Promise<NewsFormState> {
  await requireActiveAdmin();

  const back = String(formData.get("back") ?? "");
  const raw = {
    title: String(formData.get("title") ?? ""),
    content: String(formData.get("content") ?? ""),
    status: String(formData.get("status") ?? ""),
  };
  const state: NewsFormState = { values: raw };

  const validated = validateNewsFields(raw);
  const inputs = readImageInputs(formData);
  const imageErrors = validateImageInputs(inputs);
  if (!validated.ok || Object.keys(imageErrors).length > 0) {
    return { ...state, fieldErrors: { ...(validated.ok ? {} : validated.errors), ...imageErrors } };
  }

  let images;
  try {
    images = await uploadImageInputs(inputs, { 1: null, 2: null, 3: null });
  } catch (e) {
    console.error("[office:news:create] 画像アップロード失敗", e);
    return { ...state, error: MSG_UNEXPECTED_ERROR };
  }

  let id: number;
  try {
    id = await insertNews({
      title: validated.data.title,
      content: validated.data.content,
      status: Number(validated.data.status),
      news_image_url_1: images.urls[1],
      news_image_url_2: images.urls[2],
      news_image_url_3: images.urls[3],
    });
  } catch (e) {
    console.error("[office:news:create] insert 失敗", e);
    await discardImages(images.uploaded);
    return { ...state, error: MSG_DB_ERROR };
  }

  revalidateNewsPages(id);
  redirect(officeNewsCreateCompleteHref(back));
}
