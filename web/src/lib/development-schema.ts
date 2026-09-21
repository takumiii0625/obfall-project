import { z } from "zod";
import { IN_MESSAGE, PUBLISH_STATUS_KEYS, REQUIRED_MESSAGE } from "@/lib/news-schema";
import { validateWith } from "@/lib/office-auth-schema";

/**
 * 自社開発 登録・編集の Zod スキーマ（現行 App\Http\Requests\Office\Developments\CreateRequest / EditRequest の移植）。
 *   category : required max:100
 *   title    : required max:100
 *   content  : required max:1000
 *   inhouse_developments_home_page_url : nullable max:100（URL 形式の検証は現行に無いので行わない）
 *   status   : required in(0,1)
 *   画像1枚  : nullable。ファイルの検証は news-schema の validateImageFile を共用
 */
const maxMessage = (max: number) => `${max}文字以内でご入力ください。`;

export const developmentFieldsSchema = z.object({
  category: z.string().trim().min(1, { error: REQUIRED_MESSAGE }).max(100, { error: maxMessage(100) }),
  title: z.string().trim().min(1, { error: REQUIRED_MESSAGE }).max(100, { error: maxMessage(100) }),
  content: z.string().trim().min(1, { error: REQUIRED_MESSAGE }).max(1000, { error: maxMessage(1000) }),
  inhouse_developments_home_page_url: z.string().trim().max(100, { error: maxMessage(100) }),
  status: z.enum(PUBLISH_STATUS_KEYS, { error: (issue) => (issue.input === "" ? REQUIRED_MESSAGE : IN_MESSAGE) }),
});

export type DevelopmentFields = z.infer<typeof developmentFieldsSchema>;

export function validateDevelopmentFields(values: unknown) {
  return validateWith(developmentFieldsSchema, values);
}

export const DEVELOPMENT_IMAGE_FIELD = "inhouse_developments_image_url";
export const DEVELOPMENT_DELETE_IMAGE_FIELD = "delete_inhouse_developments_image_url";

/** FormData から画像ファイルを取り出す（未選択は size 0 の File のため null 扱い） */
export function readDevelopmentImageFile(formData: FormData): File | null {
  const value = formData.get(DEVELOPMENT_IMAGE_FIELD);
  if (!(value instanceof File) || value.size === 0) return null;
  return value;
}
