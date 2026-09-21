"use server";

import { redirect } from "next/navigation";
import type { NewsFormState } from "@/lib/news-form-state";
import { discardImages, readImageInputs, uploadImageInputs, validateImageInputs } from "@/lib/news-images";
import { validateNewsFields } from "@/lib/news-schema";
import { getOfficeNewsById, updateNews } from "@/lib/newses";
import { MSG_DB_ERROR, MSG_UNEXPECTED_ERROR } from "@/lib/office-form-state";
import { officeNewsEditCompleteHref, officeNewsIndexHrefWith } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";
import { revalidateNewsPages } from "@/lib/revalidate";

/**
 * お知らせ編集（現行 editConfirm の検証・画像処理 + editExecute の update を1回で行う。§2.3 #42, #43）。
 * 画像: 新規ファイルがあれば置き換え、削除チェックなら null、それ以外は既存を維持。
 * 不要になった既存画像は update 成功後に削除する。
 * ※ 現行は画像2の削除判定キーが `delete_news_mage_url_2` と誤っており削除できなかった（§7.1 の 12）。
 *   移行後は正しく削除する（差分として報告。現行どおりにする指示があれば slot 2 の remove を無視する）
 * ※ 現行は画像を差し替えても古いファイルを消さない。移行後は消す（Blob の容量対策。差分）
 */
export async function updateNewsAction(id: number, _prev: NewsFormState, formData: FormData): Promise<NewsFormState> {
  await requireActiveAdmin();

  const back = String(formData.get("back") ?? "");
  const raw = {
    title: String(formData.get("title") ?? ""),
    content: String(formData.get("content") ?? ""),
    status: String(formData.get("status") ?? ""),
  };
  const state: NewsFormState = { values: raw };

  const record = await getOfficeNewsById(id);
  if (!record) {
    redirect(officeNewsIndexHrefWith(back, { error: "notfound" }));
  }

  const validated = validateNewsFields(raw);
  const inputs = readImageInputs(formData);
  const imageErrors = validateImageInputs(inputs);
  if (!validated.ok || Object.keys(imageErrors).length > 0) {
    return { ...state, fieldErrors: { ...(validated.ok ? {} : validated.errors), ...imageErrors } };
  }

  let images;
  try {
    images = await uploadImageInputs(inputs, {
      1: record.news_image_url_1,
      2: record.news_image_url_2,
      3: record.news_image_url_3,
    });
  } catch (e) {
    console.error("[office:news:edit] 画像アップロード失敗", e);
    return { ...state, error: MSG_UNEXPECTED_ERROR };
  }

  try {
    await updateNews(id, {
      title: validated.data.title,
      content: validated.data.content,
      status: Number(validated.data.status),
      news_image_url_1: images.urls[1],
      news_image_url_2: images.urls[2],
      news_image_url_3: images.urls[3],
    });
  } catch (e) {
    console.error("[office:news:edit] update 失敗", e);
    await discardImages(images.uploaded);
    return { ...state, error: MSG_DB_ERROR };
  }

  await discardImages(images.obsolete);
  revalidateNewsPages(id);
  redirect(officeNewsEditCompleteHref(id, back));
}
