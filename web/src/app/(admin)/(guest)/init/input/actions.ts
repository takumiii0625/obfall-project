"use server";

import { redirect } from "next/navigation";
import { auth, signOut } from "@/auth";
import { activateInitialAdmin } from "@/lib/admins";
import { hasMailDns } from "@/lib/email-dns";
import { EMAIL_MESSAGE, initSchema, validateWith } from "@/lib/office-auth-schema";
import { MSG_DB_ERROR } from "@/lib/office-form-state";
import { hashPassword } from "@/lib/password";
import type { InitState } from "./init-state";

/**
 * 初期管理者の本登録（現行 OfficeAuthController@initExecute、§2.2 #24）。
 * - 現行はセッション firstAdmin を前提。移行後は needsInit 付きの Auth.js セッションを前提にする
 * - name / email / password / created_at / activated_at を更新
 * - 現行の initComplete がセッションを flush するのに合わせ、更新後にサインアウトして /init/complete へ
 */
export async function initAction(_prev: InitState, formData: FormData): Promise<InitState> {
  const session = await auth();
  const adminId = Number(session?.user?.id);
  if (!session?.user?.needsInit || !Number.isInteger(adminId) || adminId <= 0) {
    redirect("/office/login");
  }

  const raw = {
    name: String(formData.get("name") ?? ""),
    email: String(formData.get("email") ?? ""),
    password: String(formData.get("password") ?? ""),
  };
  const state: InitState = { values: { name: raw.name.trim(), email: raw.email.trim() } };

  const validated = validateWith(initSchema, raw);
  if (!validated.ok) {
    return { ...state, fieldErrors: validated.errors };
  }

  // 現行 email:rfc,dns の dns 部分
  if (!(await hasMailDns(validated.data.email))) {
    return { ...state, fieldErrors: { email: EMAIL_MESSAGE } };
  }

  try {
    await activateInitialAdmin(adminId, session.user.email ?? "", {
      name: validated.data.name,
      email: validated.data.email,
      passwordHash: await hashPassword(validated.data.password),
    });
  } catch (e) {
    console.error("[office:init] 更新失敗", e);
    return { ...state, error: MSG_DB_ERROR };
  }

  await signOut({ redirect: false });
  redirect("/init/complete");
}
