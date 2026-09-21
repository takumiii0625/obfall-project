import { and, eq, isNotNull, isNull, sql } from "drizzle-orm";
import { db, dbWrite, type Db } from "@/db";
import { admins, type AdminRow } from "@/db/schema";

/**
 * admins テーブルのアクセス層（認証まわり）。
 * 現行 OfficeAuthController@loginExecute / RedirectIfNoUser のクエリを移植。
 *
 *   新規登録した管理者 : created_at IS NOT NULL
 *   有効中の管理者     : activated_at IS NOT NULL
 *   退職済みの管理者   : terminated_at IS NOT NULL
 *   削除済みの管理者   : deleted_at IS NOT NULL
 */

/** 現行: 6回目の失敗でロック */
export const LOGIN_LOCK_THRESHOLD = 6;
/** 現行: ロックは1時間 */
export const LOGIN_LOCK_MS = 60 * 60 * 1000;

const notTerminated = and(isNull(admins.terminated_at), isNull(admins.deleted_at));

/** 初期管理者（activated_at 未設定）をメールで検索 */
export async function findInitialAdminByEmail(email: string): Promise<AdminRow | null> {
  const rows = await db()
    .select()
    .from(admins)
    .where(and(eq(admins.email, email), isNull(admins.activated_at), notTerminated))
    .limit(1);
  return rows[0] ?? null;
}

/** 有効中の管理者をメールで検索 */
export async function findActiveAdminByEmail(email: string): Promise<AdminRow | null> {
  const rows = await db()
    .select()
    .from(admins)
    .where(and(eq(admins.email, email), isNotNull(admins.activated_at), notTerminated))
    .limit(1);
  return rows[0] ?? null;
}

/** 有効中の管理者を id で検索（毎リクエストの有効性確認用。現行 RedirectIfNoUser） */
export async function findActiveAdminById(id: number): Promise<AdminRow | null> {
  const rows = await db()
    .select()
    .from(admins)
    .where(and(eq(admins.id, id), isNotNull(admins.activated_at), notTerminated))
    .limit(1);
  return rows[0] ?? null;
}

/** ロック解除（現行: ロックから1時間経過後の初回ログイン試行時） */
export async function unlockAdmin(id: number): Promise<void> {
  await dbWrite().update(admins).set({ login_locked_at: null, login_failed_count: 0 }).where(eq(admins.id, id));
}

/** ログイン成功: 失敗回数をリセット */
export async function resetLoginFailures(id: number): Promise<void> {
  await dbWrite().update(admins).set({ login_failed_count: 0 }).where(eq(admins.id, id));
}

/**
 * ログイン失敗: 回数を +1 し、閾値に達したら login_locked_at を記録する。
 * 戻り値は更新後の失敗回数。
 */
export async function recordLoginFailure(id: number): Promise<number> {
  const rows = await dbWrite()
    .update(admins)
    .set({ login_failed_count: sql`${admins.login_failed_count} + 1` })
    .where(eq(admins.id, id))
    .returning({ count: admins.login_failed_count });
  const count = rows[0]?.count ?? 0;
  if (count >= LOGIN_LOCK_THRESHOLD) {
    await dbWrite().update(admins).set({ login_locked_at: new Date() }).where(eq(admins.id, id));
  }
  return count;
}

/**
 * 初期管理者の本登録（現行 initExecute）。id と現在のメールが一致する行の
 * name / email / password / created_at / activated_at を更新する。更新行数を返す。
 */
export async function activateInitialAdmin(
  id: number,
  currentEmail: string,
  input: { name: string; email: string; passwordHash: string },
): Promise<number> {
  const now = new Date();
  const rows = await dbWrite()
    .update(admins)
    .set({
      name: input.name,
      email: input.email,
      password: input.passwordHash,
      created_at: now,
      activated_at: now,
    })
    .where(and(eq(admins.id, id), eq(admins.email, currentEmail), isNull(admins.activated_at)))
    .returning({ id: admins.id });
  return rows.length;
}

/** PW 再設定トークンを保存（現行 forgotPwExecute: remember_token）。executor にトランザクションを渡せる */
export async function setPasswordResetToken(id: number, token: string | null, executor: Db = dbWrite()): Promise<void> {
  await executor.update(admins).set({ remember_token: token }).where(eq(admins.id, id));
}

/** トークンから管理者を検索（現行 setPwInput: remember_token 一致、退職・削除済みを除く） */
export async function findAdminByResetToken(token: string): Promise<AdminRow | null> {
  if (!token) return null;
  const rows = await db()
    .select()
    .from(admins)
    .where(and(eq(admins.remember_token, token), notTerminated))
    .limit(1);
  return rows[0] ?? null;
}

/**
 * PW 更新（現行 setPwExecute）: id と remember_token が一致する行の
 * password を更新し、remember_token を消して activated_at を現在時刻にする。更新行数を返す。
 */
export async function completePasswordReset(
  id: number,
  token: string,
  passwordHash: string,
  executor: Db = dbWrite(),
): Promise<number> {
  const rows = await executor
    .update(admins)
    .set({ password: passwordHash, remember_token: null, activated_at: new Date() })
    .where(and(eq(admins.id, id), eq(admins.remember_token, token)))
    .returning({ id: admins.id });
  return rows.length;
}
