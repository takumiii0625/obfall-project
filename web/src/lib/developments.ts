import { and, count, desc, eq, inArray, isNull, like, type SQL } from "drizzle-orm";
import { db, dbWrite } from "@/db";
import { inhouseDevelopments } from "@/db/schema";

/**
 * inhouse_developments テーブルのアクセス層（管理画面用。現行 OfficeDevelopmentsController の移植）。
 * 公開側は現行でもビューで未使用のため DB を読まない（§7.1 の 10）。保存後の再検証は不要。
 */
export type DevelopmentRow = typeof inhouseDevelopments.$inferSelect;

export type OfficeDevelopmentSearch = {
  title?: string;
  content?: string;
  statuses?: number[];
};

function likeContains(value: string): string {
  return `%${value.replace(/[\\%_]/g, (c) => `\\${c}`)}%`;
}

function officeSearchWhere(search: OfficeDevelopmentSearch): SQL | undefined {
  const conditions: SQL[] = [isNull(inhouseDevelopments.deleted_at)];
  if (search.title) conditions.push(like(inhouseDevelopments.title, likeContains(search.title)));
  if (search.content) conditions.push(like(inhouseDevelopments.content, likeContains(search.content)));
  // ※ お知らせと同じく、現行はステータス検索が機能しない（§7.1 の 21）。ビューの意図どおり IN 検索にする
  if (search.statuses && search.statuses.length > 0) conditions.push(inArray(inhouseDevelopments.status, search.statuses));
  return and(...conditions);
}

/** 一覧: 有効なレコードを id 降順で検索し、ページ分の行と総件数を返す */
export async function searchOfficeDevelopments(
  search: OfficeDevelopmentSearch,
  offset: number,
  limit: number,
): Promise<{ rows: DevelopmentRow[]; total: number }> {
  const where = officeSearchWhere(search);
  const [rows, totals] = await Promise.all([
    db().select().from(inhouseDevelopments).where(where).orderBy(desc(inhouseDevelopments.id)).offset(offset).limit(limit),
    db().select({ value: count() }).from(inhouseDevelopments).where(where),
  ]);
  return { rows, total: totals[0]?.value ?? 0 };
}

/** 詳細・編集用: 有効なレコードを id で取得 */
export async function getOfficeDevelopmentById(id: number): Promise<DevelopmentRow | null> {
  if (!Number.isInteger(id) || id <= 0) return null;
  const rows = await db()
    .select()
    .from(inhouseDevelopments)
    .where(and(eq(inhouseDevelopments.id, id), isNull(inhouseDevelopments.deleted_at)))
    .limit(1);
  return rows[0] ?? null;
}

export type DevelopmentWriteValues = {
  category: string;
  title: string;
  content: string;
  inhouse_developments_image_url: string | null;
  inhouse_developments_home_page_url: string | null;
  status: number;
};

export async function insertDevelopment(values: DevelopmentWriteValues): Promise<number> {
  const rows = await dbWrite().insert(inhouseDevelopments).values(values).returning({ id: inhouseDevelopments.id });
  return rows[0].id;
}

export async function updateDevelopment(id: number, values: DevelopmentWriteValues): Promise<number> {
  const rows = await dbWrite()
    .update(inhouseDevelopments)
    .set(values)
    .where(and(eq(inhouseDevelopments.id, id), isNull(inhouseDevelopments.deleted_at)))
    .returning({ id: inhouseDevelopments.id });
  return rows.length;
}

/** 論理削除（画像ファイルは現行どおり消さない） */
export async function softDeleteDevelopment(id: number): Promise<number> {
  const rows = await dbWrite()
    .update(inhouseDevelopments)
    .set({ deleted_at: new Date() })
    .where(and(eq(inhouseDevelopments.id, id), isNull(inhouseDevelopments.deleted_at)))
    .returning({ id: inhouseDevelopments.id });
  return rows.length;
}
