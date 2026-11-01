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
 *
 * 2026-11-01 の変更（現行からの仕様変更）:
 * - 文字数の上限を追加: メールアドレス 254 / 会社名 100 / 電話番号 13 / お問い合わせ内容 2000
 * - 電話番号はハイフン入りを受け付ける（数字とハイフンのみ。先頭・末尾・連続のハイフンは不可）。
 *   全角数字・全角ハイフンは NFKC で半角にそろえてから検証する
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
/** メールアドレスの上限（RFC 上の最大長） */
export const CONTACT_EMAIL_MAX = 254;
export const CONTACT_COMPANY_MAX = 100;
/** 電話番号の上限（ハイフン入りの携帯番号 090-1234-5678 = 13 文字） */
export const CONTACT_TEL_MAX = 13;
export const CONTACT_CONTENTS_MAX = 2000;

/** 数字とハイフンのみ（先頭・末尾・連続のハイフンは不可）。例: 03-1234-5678 / 09012345678 */
const TEL_RE = /^\d+(-\d+)*$/;

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
    .max(CONTACT_EMAIL_MAX, { error: maxString("email", CONTACT_EMAIL_MAX) })
    .pipe(z.email({ error: `${CONTACT_ATTRIBUTES.email}が正しくありません。` })),
  company: z
    .string()
    .trim()
    .min(1, { error: required("company") })
    .max(CONTACT_COMPANY_MAX, { error: maxString("company", CONTACT_COMPANY_MAX) }),
  tel: z
    .string()
    .normalize("NFKC")
    .trim()
    .max(CONTACT_TEL_MAX, { error: maxString("tel", CONTACT_TEL_MAX) })
    .refine((v) => v === "" || TEL_RE.test(v), {
      error: `${CONTACT_ATTRIBUTES.tel}は数字とハイフンで入力してください。`,
    }),
  contents: z
    .string()
    .trim()
    .min(1, { error: required("contents") })
    .max(CONTACT_CONTENTS_MAX, { error: maxString("contents", CONTACT_CONTENTS_MAX) }),
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
