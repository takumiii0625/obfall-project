import { z } from "zod";
import { validateWith } from "@/lib/office-auth-schema";

/**
 * お知らせ登録・編集の Zod スキーマ（現行 App\Http\Requests\Office\News\CreateRequest / EditRequest の移植）。
 *   title   : required max:100
 *   content : required max:1000
 *   status  : required in(0,1)
 *   画像1〜3: nullable。現行の max:8192 は文字列長の検証で実質無検証（§3.4）。移行後はファイルサイズ 8MB 以内・画像 MIME を検証する
 * クライアント（確認画面へ進む前）と Server Action で同じスキーマを使う。
 */
export const REQUIRED_MESSAGE = "必須項目です。";
export const IN_MESSAGE = "正しい値を入力または選択してください。";
const maxMessage = (max: number) => `${max}文字以内でご入力ください。`;

/** 現行 App\Enums\PublishList */
export const PUBLISH_STATUS = { "0": "非公開", "1": "公開" } as const;
export type PublishStatusKey = keyof typeof PUBLISH_STATUS;
export const PUBLISH_STATUS_KEYS = Object.keys(PUBLISH_STATUS) as PublishStatusKey[];

export function publishStatusLabel(status: number | string | null | undefined): string {
  return PUBLISH_STATUS[String(status ?? "") as PublishStatusKey] ?? "";
}

/** 現行 TrimStrings ミドルウェアにより title / content は前後の空白が除かれる */
export const newsFieldsSchema = z.object({
  title: z.string().trim().min(1, { error: REQUIRED_MESSAGE }).max(100, { error: maxMessage(100) }),
  content: z.string().trim().min(1, { error: REQUIRED_MESSAGE }).max(1000, { error: maxMessage(1000) }),
  status: z.enum(PUBLISH_STATUS_KEYS, { error: (issue) => (issue.input === "" ? REQUIRED_MESSAGE : IN_MESSAGE) }),
});

export type NewsFields = z.infer<typeof newsFieldsSchema>;

export function validateNewsFields(values: unknown) {
  return validateWith(newsFieldsSchema, values);
}

/** 画像スロット（news_image_url_1〜3） */
export const IMAGE_SLOTS = [1, 2, 3] as const;
export type ImageSlot = (typeof IMAGE_SLOTS)[number];
export const imageFieldName = (slot: ImageSlot) => `news_image_url_${slot}` as const;
export const deleteImageFieldName = (slot: ImageSlot) => `delete_news_image_url_${slot}` as const;
export type ImageFieldName = ReturnType<typeof imageFieldName>;

/** 現行 max:8192 の意図（8192KB）に合わせる */
export const IMAGE_MAX_BYTES = 8 * 1024 * 1024;
export const IMAGE_MESSAGE = "画像ファイル（8MB 以内）を選択してください。";

/** File が画像として受け付けられるか。問題があればメッセージを返す */
export function validateImageFile(file: File): string | null {
  if (file.size === 0) return IMAGE_MESSAGE;
  if (file.size > IMAGE_MAX_BYTES) return IMAGE_MESSAGE;
  if (file.type && !file.type.startsWith("image/")) return IMAGE_MESSAGE;
  return null;
}

/** FormData から画像ファイルを取り出す（未選択の <input type=file> は size 0 の File になるため null 扱い） */
export function readImageFile(formData: FormData, slot: ImageSlot): File | null {
  const value = formData.get(imageFieldName(slot));
  if (!(value instanceof File) || value.size === 0) return null;
  return value;
}

export function readDeleteFlag(formData: FormData, slot: ImageSlot): boolean {
  return formData.get(deleteImageFieldName(slot)) === "1";
}
