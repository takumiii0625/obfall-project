import type { OfficeFormState } from "@/lib/office-form-state";

/** 登録・編集フォームで再表示する値（画像は File なので state には持たない） */
export type DevelopmentFormValues = {
  category: string;
  title: string;
  content: string;
  inhouse_developments_home_page_url: string;
  status: string;
};
export type DevelopmentFormField = keyof DevelopmentFormValues | "inhouse_developments_image_url";
export type DevelopmentFormState = OfficeFormState<DevelopmentFormValues, DevelopmentFormField>;

export const DEVELOPMENT_FORM_INITIAL_STATE: DevelopmentFormState = {
  values: { category: "", title: "", content: "", inhouse_developments_home_page_url: "", status: "" },
};
