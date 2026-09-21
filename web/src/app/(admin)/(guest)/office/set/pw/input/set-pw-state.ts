import type { OfficeFormState } from "@/lib/office-form-state";

/** 署名付き URL のクエリをフォームの隠しフィールドで持ち回る（現行はセッション token / hasValidSignature） */
export type SetPwValues = { token: string; expires: string; signature: string };
export type SetPwState = OfficeFormState<SetPwValues, "password">;

/** 署名対象のパス（署名付き URL の生成・検証で共有。"use server" ファイルからは定数を export できないためここに置く） */
export const SET_PW_PATH = "/office/set/pw/input";
