import { z } from "zod";

/**
 * お問い合わせフォームのバリデーション（Zod）。クライアント・サーバーで共有する。
 *
 * 現行 ContactsController@confirm の $request->validate() を移植:
 *   name: required|max:10 / email: required|email / tel: nullable|numeric
 *   company: required / contents: required / privacy_agree: required
 * メッセージは resources/lang/en/validation.php（required / email / max.string / numeric）と
 * attributes（お名前 / メールアドレス / 電話番号 / 会社名 / お問い合わせ内容 / プライバシーポリシー）から組み立てる。
 * 現行は Laravel の TrimStrings / ConvertEmptyStringsToNull により前後空白が除去されるため trim() を通す。
 */

export const CONTACT_ATTRIBUTES = {
  name: "お名前",
  email: "メールアドレス",
  tel: "電話番号",
  company: "会社名",
  contents: "お問い合わせ内容",
  privacy_agree: "プライバシーポリシー",
} as const;

export type ContactField = keyof typeof CONTACT_ATTRIBUTES;

const required = (field: ContactField) => `${CONTACT_ATTRIBUTES[field]}は必須項目です。`;
const maxString = (field: ContactField, max: number) => `${CONTACT_ATTRIBUTES[field]}は${max}文字以内で入力してください。`;

/** 現行 名前の上限（max:10） */
export const CONTACT_NAME_MAX = 10;

/**
 * Laravel の numeric（PHP is_numeric 相当）: 符号・小数・指数を許容し、ハイフンは不可。
 * ※ プレースホルダの「03-1234-5678」と矛盾する現行仕様（§7.1 の 20）をそのまま再現
 */
const NUMERIC_RE = /^[+-]?(\d+\.?\d*|\.\d+)([eE][+-]?\d+)?$/;

export const contactSchema = z.object({
  name: z
    .string()
    .trim()
    .min(1, { error: required("name") })
    .max(CONTACT_NAME_MAX, { error: maxString("name", CONTACT_NAME_MAX) }),
  email: z
    .string()
    .trim()
    .min(1, { error: required("email") })
    .pipe(z.email({ error: `${CONTACT_ATTRIBUTES.email}が正しくありません。` })),
  company: z.string().trim().min(1, { error: required("company") }),
  tel: z
    .string()
    .trim()
    .refine((v) => v === "" || NUMERIC_RE.test(v), {
      error: `${CONTACT_ATTRIBUTES.tel}は数字で入力してください。`,
    }),
  contents: z.string().trim().min(1, { error: required("contents") }),
  privacy_agree: z.literal(true, { error: required("privacy_agree") }),
});

/** 検証済みの入力値 */
export type ContactInput = z.infer<typeof contactSchema>;

/** フォームの生の値（検証前）。checkbox は boolean */
export type ContactFormValues = {
  name: string;
  email: string;
  company: string;
  tel: string;
  contents: string;
  privacy_agree: boolean;
};

export const EMPTY_CONTACT_VALUES: ContactFormValues = {
  name: "",
  email: "",
  company: "",
  tel: "",
  contents: "",
  privacy_agree: false,
};

/** 項目ごとの最初のエラー（現行は $errors->first() で1件のみ表示） */
export type ContactErrors = Partial<Record<ContactField, string>>;

export type ContactValidation = { ok: true; data: ContactInput } | { ok: false; errors: ContactErrors };

export function validateContact(values: unknown): ContactValidation {
  const result = contactSchema.safeParse(values);
  if (result.success) return { ok: true, data: result.data };

  const errors: ContactErrors = {};
  for (const issue of result.error.issues) {
    const field = issue.path[0];
    if (typeof field === "string" && field in CONTACT_ATTRIBUTES && !errors[field as ContactField]) {
      errors[field as ContactField] = issue.message;
    }
  }
  return { ok: false, errors };
}
