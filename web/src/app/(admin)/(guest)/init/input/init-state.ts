import type { OfficeFormState } from "@/lib/office-form-state";

/** 再表示する値（現行 old()。パスワードは戻さない） */
export type InitValues = { name: string; email: string };
export type InitState = OfficeFormState<InitValues, "name" | "email" | "password">;
export const INIT_INITIAL_STATE: InitState = { values: { name: "", email: "" } };
