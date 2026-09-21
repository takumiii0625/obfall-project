import "server-only";
import {
  IMAGE_SLOTS,
  imageFieldName,
  readDeleteFlag,
  readImageFile,
  validateImageFile,
  type ImageFieldName,
  type ImageSlot,
} from "@/lib/news-schema";
import { deleteImage, uploadImage } from "@/lib/storage";

/**
 * 登録・編集の Server Action で共通の画像処理。
 *   1. FormData の画像を検証（フィールド別エラー）
 *   2. 新規ファイルをアップロード
 *   3. スロットごとの最終 URL を決める（新規 > 削除指定なら null > 既存）
 * 途中で失敗したら、アップロード済みの新規ファイルを消して呼び出し側へ例外を返す。
 */
export type ImageInputs = Record<ImageSlot, { file: File | null; remove: boolean }>;

export function readImageInputs(formData: FormData): ImageInputs {
  const out = {} as ImageInputs;
  for (const slot of IMAGE_SLOTS) {
    out[slot] = { file: readImageFile(formData, slot), remove: readDeleteFlag(formData, slot) };
  }
  return out;
}

export function validateImageInputs(inputs: ImageInputs): Partial<Record<ImageFieldName, string>> {
  const errors: Partial<Record<ImageFieldName, string>> = {};
  for (const slot of IMAGE_SLOTS) {
    const file = inputs[slot].file;
    if (!file) continue;
    const message = validateImageFile(file);
    if (message) errors[imageFieldName(slot)] = message;
  }
  return errors;
}

export type ResolvedImages = {
  /** DB に保存する URL */
  urls: Record<ImageSlot, string | null>;
  /** 今回アップロードした URL（DB 失敗時に消す） */
  uploaded: string[];
  /** 置き換え・削除で不要になった既存 URL（DB 成功後に消す） */
  obsolete: string[];
};

export async function uploadImageInputs(inputs: ImageInputs, existing: Record<ImageSlot, string | null>): Promise<ResolvedImages> {
  const urls = { ...existing };
  const uploaded: string[] = [];
  const obsolete: string[] = [];
  try {
    for (const slot of IMAGE_SLOTS) {
      const { file, remove } = inputs[slot];
      if (file) {
        const url = await uploadImage(file);
        uploaded.push(url);
        if (existing[slot]) obsolete.push(existing[slot] as string);
        urls[slot] = url;
      } else if (remove && existing[slot]) {
        obsolete.push(existing[slot] as string);
        urls[slot] = null;
      }
    }
  } catch (e) {
    await discardImages(uploaded);
    throw e;
  }
  return { urls, uploaded, obsolete };
}

export async function discardImages(urls: string[]): Promise<void> {
  await Promise.all(urls.map((u) => deleteImage(u)));
}
