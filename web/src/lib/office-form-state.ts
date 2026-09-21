/**
 * 管理画面フォーム共通の useActionState 用 state。
 * fieldErrors = 現行 @error、error = 現行 session('error') / withError、values = 現行 old()。
 *
 * Field は検証エラーを出す項目名。既定は values のキーだが、パスワードのように
 * 再表示しない（values に含めない）項目にもエラーを出したい場合は明示する。
 */
export type OfficeFormState<Values extends Record<string, string>, Field extends string = keyof Values & string> = {
  fieldErrors?: Partial<Record<Field, string>>;
  error?: string | null;
  success?: string | null;
  values: Values;
};

/** 現行 Controller の catch 節の文言 */
export const MSG_DB_ERROR = "データベースエラーが発生しました。時間をおいて再度お試しください。";
export const MSG_UNEXPECTED_ERROR = "予期せぬエラーが発生しました。時間をおいて再度お試しください。";
