import "server-only";
import { redirect } from "next/navigation";
import { auth, signOut } from "@/auth";
import { findActiveAdminById } from "@/lib/admins";
import type { AdminRow } from "@/db/schema";

/**
 * ログイン後ページで毎リクエスト呼ぶ（現行 RedirectIfNoUser の移植）。
 * セッションがあっても、管理者が退職・削除・未有効化なら強制ログアウトしてログインへ戻す。
 *
 * ※ 現行はホスト名に "office" を含むときだけ動作しており本番では実質無効だった（§3.1.2）。
 *   移行後は常に有効にする（差分として報告）。
 */
export async function requireActiveAdmin(): Promise<AdminRow> {
  const session = await auth();
  const id = Number(session?.user?.id);
  if (!session?.user || !Number.isInteger(id) || id <= 0) {
    redirect("/office/login");
  }
  if (session.user.needsInit) {
    redirect("/init/input");
  }
  const admin = await findActiveAdminById(id);
  if (!admin) {
    await signOut({ redirect: false });
    redirect("/office/login");
  }
  return admin;
}

/** 初期設定ページ用: needsInit のセッションから管理者 id を取る */
export async function requireInitialAdminId(): Promise<number> {
  const session = await auth();
  const id = Number(session?.user?.id);
  if (!session?.user || !Number.isInteger(id) || id <= 0) redirect("/office/login");
  if (!session.user.needsInit) redirect("/admins/newses");
  return id;
}
