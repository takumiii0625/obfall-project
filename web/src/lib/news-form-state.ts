import type { OfficeFormState } from "@/lib/office-form-state";
import type { ImageFieldName } from "@/lib/news-schema";

/** 登録・編集フォームで再表示する値（画像は File なので state には持たない） */
export type NewsFormValues = { title: string; content: string; status: string };
export type NewsFormField = keyof NewsFormValues | ImageFieldName;
export type NewsFormState = OfficeFormState<NewsFormValues, NewsFormField>;

export const NEWS_FORM_INITIAL_STATE: NewsFormState = { values: { title: "", content: "", status: "" } };
