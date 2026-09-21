import { z } from "zod";

/**
 * 管理画面 認証系フォームの Zod スキーマ。
 * 現行 App\Http\Requests\Office\Auth\* のルールとメッセージを移植。
 *   LoginRequest   : email / password required
 *   ForgotPwRequest: email required
 *   InitRequest    : name required max:100 / email required max:200 email:rfc,dns / password required max:50 PasswordRule
 *   SetPwRequest   : password required max:50 PasswordRule
 * メッセージ: '*.required' => '必須項目です。', '*.max' => ':max文字以内でご入力ください。', '*.email' => 'メールアドレスが正しくありません。'
 * ※ email の dns 検証は Zod ではできないため lib/email-dns.ts で Server Action 側が行う
 */
export const REQUIRED_MESSAGE = "必須項目です。";
export const EMAIL_MESSAGE = "メールアドレスが正しくありません。";
const maxMessage = (max: number) => `${max}文字以内でご入力ください。`;

/** 現行 App\Http\Requests\Rules\PasswordRule */
export const PASSWORD_MESSAGE = "パスワードは半角英数大文字小文字記号をそれぞれ組み合わせて8文字以上で入力してください。";
const ALLOWED_SYMBOLS = "!#$%&\\-^@;:,.\\[\\]()+=~";
const PASSWORD_PATTERN = new RegExp(`^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[${ALLOWED_SYMBOLS}]).{8,}$`);
const PASSWORD_INVALID = new RegExp(`[^a-zA-Z\\d${ALLOWED_SYMBOLS}]`);

export function passesPasswordRule(value: string): boolean {
  return PASSWORD_PATTERN.test(value) && !PASSWORD_INVALID.test(value);
}

/** password は現行 TrimStrings の除外対象のため trim しない */
const passwordField = z
  .string()
  .min(1, { error: REQUIRED_MESSAGE })
  .max(50, { error: maxMessage(50) })
  .refine(passesPasswordRule, { error: PASSWORD_MESSAGE });

export const loginSchema = z.object({
  email: z.string().trim().min(1, { error: REQUIRED_MESSAGE }),
  password: z.string().min(1, { error: REQUIRED_MESSAGE }),
});

export const forgotPwSchema = z.object({
  email: z.string().trim().min(1, { error: REQUIRED_MESSAGE }),
});

export const initSchema = z.object({
  name: z.string().trim().min(1, { error: REQUIRED_MESSAGE }).max(100, { error: maxMessage(100) }),
  email: z
    .string()
    .trim()
    .min(1, { error: REQUIRED_MESSAGE })
    .max(200, { error: maxMessage(200) })
    .pipe(z.email({ error: EMAIL_MESSAGE })),
  password: passwordField,
});

export const setPwSchema = z.object({
  password: passwordField,
});

export type LoginInput = z.infer<typeof loginSchema>;
export type LoginFieldErrors = Partial<Record<keyof LoginInput, string>>;

/** 項目ごとに最初のエラーだけを返す（現行 bail + @error の挙動） */
export type FieldErrors<T> = Partial<Record<keyof T & string, string>>;

export function validateWith<S extends z.ZodObject>(
  schema: S,
  values: unknown,
): { ok: true; data: z.infer<S> } | { ok: false; errors: FieldErrors<z.infer<S>> } {
  const result = schema.safeParse(values);
  if (result.success) return { ok: true, data: result.data };
  const errors: Record<string, string> = {};
  for (const issue of result.error.issues) {
    const key = issue.path[0];
    if (typeof key === "string" && !errors[key]) errors[key] = issue.message;
  }
  return { ok: false, errors: errors as FieldErrors<z.infer<S>> };
}

export function validateLogin(values: unknown) {
  return validateWith(loginSchema, values);
}
