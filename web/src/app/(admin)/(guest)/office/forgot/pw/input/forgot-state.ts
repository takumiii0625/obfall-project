import type { OfficeFormState } from "@/lib/office-form-state";

export type ForgotValues = { email: string };
export type ForgotState = OfficeFormState<ForgotValues>;
export const FORGOT_INITIAL_STATE: ForgotState = { values: { email: "" } };
