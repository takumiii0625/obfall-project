import { and, count, desc, eq, inArray, isNull, like, type SQL } from "drizzle-orm";
import { db, dbWrite } from "@/db";
import { newses, type NewsRow } from "@/db/schema";
import { formatJaDate } from "@/lib/dates";

export type { NewsRow };

/** 一覧・トップ表示用に整形した行 */
export type NewsListItem = {
  id: number;
  title: string;
  /** サムネイル URL（未設定時は既定画像） */
  thumb: string;
  /** "YYYY年MM月DD日" */
  createdAtFmt: string;
};

/** 詳細表示用 */
export type NewsDetail = {
  id: number;
  title: string;
  content: string;
  /** 画像1〜3の最初の非空。無ければ null（詳細では既定画像を出さない） */
  image: string | null;
  createdAtFmt: string;
};

/** 現行 PerPage::NEWS_LIST */
export const NEWS_PER_PAGE = 10;

/** 現行 indexDev.blade.php の $visibleCount */
export const TOP_NEWS_VISIBLE_COUNT = 3;

/** 現行の既定サムネイル。※ public/image/ に実ファイルは存在しない（§4.2） */
const NO_IMAGE_URL = "/image/noimg-square.jpg";

/**
 * 現行の asset() 判定を移植:
 *   http(s):// または / 始まりはそのまま、それ以外は先頭に / を付ける
 */
export function resolveImageUrl(raw: string | null | undefined): string | null {
  if (!raw) return null;
  if (/^(https?:\/\/|\/)/.test(raw)) return raw;
  return `/${raw}`;
}

/** 一覧用: 未設定なら既定画像 */
export function resolveThumb(raw: string | null | undefined): string {
  return resolveImageUrl(raw) ?? NO_IMAGE_URL;
}

/** 画像1〜3の最初の非空（indexDev / show の collect()->first(filled) 判定） */
function firstImage(row: Pick<NewsRow, "news_image_url_1" | "news_image_url_2" | "news_image_url_3">) {
  return [row.news_image_url_1, row.news_image_url_2, row.news_image_url_3].find((u) => !!u) ?? null;
}

function toListItem(row: NewsRow): NewsListItem {
  return {
    id: row.id,
    title: row.title ?? "",
    thumb: resolveThumb(firstImage(row)),
    createdAtFmt: formatJaDate(row.created_at),
  };
}

/** 公開中（status=1、deleted_at IS NULL）の共通条件 */
const publishedWhere = and(eq(newses.status, 1), isNull(newses.deleted_at));

/**
 * 公開中の件数（一覧のページネーション用）。
 */
export async function countPublishedNewses(): Promise<number> {
  const rows = await db().select({ id: newses.id }).from(newses).where(publishedWhere);
  return rows.length;
}

/**
 * 公開中を id 降順で offset / limit 取得（現行 UserNewsesController@index の paginate(10) 相当）。
 * ※ 一覧サムネは現行どおり news_image_url_1 のみを見る（トップと異なる）
 */
export async function getPublishedNewses(offset: number, limit: number): Promise<NewsListItem[]> {
  const rows = await db().select().from(newses).where(publishedWhere).orderBy(desc(newses.id)).offset(offset).limit(limit);
  return rows.map((row) => ({
    ...toListItem(row),
    thumb: resolveThumb(row.news_image_url_1),
  }));
}

/**
 * トップの NEWS セクション用（現行 TopController@indexDev + indexDev.blade.php）。
 * 公開中を id 降順、先頭3件。サムネは画像1〜3の最初の非空。
 */
export async function getTopNewses(): Promise<NewsListItem[]> {
  const rows = await db()
    .select()
    .from(newses)
    .where(publishedWhere)
    .orderBy(desc(newses.id))
    .limit(TOP_NEWS_VISIBLE_COUNT);
  return rows.map(toListItem);
}

/**
 * 詳細（現行 UserNewsesController@show）。
 * 現行どおり deleted_at IS NULL のみで status は見ない（非公開でも直 URL で閲覧できる。§7.1 の 9。
 * 修正可否の回答が出るまで現行踏襲）。存在しなければ null。
 */
export async function getNewsById(id: number): Promise<NewsDetail | null> {
  if (!Number.isInteger(id) || id <= 0) return null;
  const rows = await db()
    .select()
    .from(newses)
    .where(and(eq(newses.id, id), isNull(newses.deleted_at)))
    .limit(1);
  const row = rows[0];
  if (!row) return null;
  return {
    id: row.id,
    title: row.title ?? "",
    content: row.content ?? "",
    image: resolveImageUrl(firstImage(row)),
    createdAtFmt: formatJaDate(row.created_at),
  };
}

/**
 * 公開中のお知らせ id 一覧（詳細ページの generateStaticParams 用）。
 * ビルド時に公開中の詳細を事前生成し、それ以外の id（非公開・新規）は初回アクセス時に生成して ISR キャッシュする。
 */
export async function getPublishedNewsIds(): Promise<number[]> {
  const rows = await db().select({ id: newses.id }).from(newses).where(publishedWhere).orderBy(desc(newses.id));
  return rows.map((r) => r.id);
}

/* ------------------------------------------------------------------ */
/* 管理画面（office）用                                                 */
/* ------------------------------------------------------------------ */

/** 一覧の検索条件（現行 OfficeNewsesController@index） */
export type OfficeNewsSearch = {
  title?: string;
  content?: string;
  /** 公開ステータス。空なら絞り込まない */
  statuses?: number[];
};

/** 現行 Utils::perPage: 20〜300 ならその値、それ以外は 50 */
export const OFFICE_PER_PAGE_OPTIONS = [10, 20, 50, 100, 200, 300] as const;
export function normalizeOfficePerPage(value: string | undefined): number {
  const n = Number.parseInt(value ?? "", 10);
  // ※ 選択肢に 10 があるが Utils::perPage は 20 未満を既定（50）に戻す（§7.1 の 22）。回答があるまで現行どおり
  return n >= 20 && n <= 300 ? n : 50;
}

/** LIKE のワイルドカードをエスケープ（現行は未エスケープだが、% や _ の入力を文字どおり検索できるようにする） */
function likeContains(value: string): string {
  return `%${value.replace(/[\\%_]/g, (c) => `\\${c}`)}%`;
}

function officeSearchWhere(search: OfficeNewsSearch): SQL | undefined {
  const conditions: SQL[] = [isNull(newses.deleted_at)];
  if (search.title) conditions.push(like(newses.title, likeContains(search.title)));
  if (search.content) conditions.push(like(newses.content, likeContains(search.content)));
  // ※ 現行はビューが status[]（複数）を送るのにコントローラは単一値として where しており、実際には検索できない（§7.1 の 21）。
  //   移行後はビューの意図どおり複数選択の IN 検索にする（差分として報告）
  if (search.statuses && search.statuses.length > 0) conditions.push(inArray(newses.status, search.statuses));
  return and(...conditions);
}

/**
 * 管理 一覧: 有効なレコード（deleted_at IS NULL）を id 降順で検索し、ページ分の行と総件数を返す。
 */
export async function searchOfficeNewses(
  search: OfficeNewsSearch,
  offset: number,
  limit: number,
): Promise<{ rows: NewsRow[]; total: number }> {
  const where = officeSearchWhere(search);
  const [rows, totals] = await Promise.all([
    db().select().from(newses).where(where).orderBy(desc(newses.id)).offset(offset).limit(limit),
    db().select({ value: count() }).from(newses).where(where),
  ]);
  return { rows, total: totals[0]?.value ?? 0 };
}

/** 管理 詳細・編集用: 有効なレコードを id で取得（公開ステータスは問わない） */
export async function getOfficeNewsById(id: number): Promise<NewsRow | null> {
  if (!Number.isInteger(id) || id <= 0) return null;
  const rows = await db()
    .select()
    .from(newses)
    .where(and(eq(newses.id, id), isNull(newses.deleted_at)))
    .limit(1);
  return rows[0] ?? null;
}

export type NewsWriteValues = {
  title: string;
  content: string;
  status: number;
  news_image_url_1: string | null;
  news_image_url_2: string | null;
  news_image_url_3: string | null;
};

/** 登録（現行 createExecute）。採番された id を返す */
export async function insertNews(values: NewsWriteValues): Promise<number> {
  const rows = await dbWrite().insert(newses).values(values).returning({ id: newses.id });
  return rows[0].id;
}

/** 更新（現行 editExecute: id 一致かつ deleted_at IS NULL）。更新行数を返す */
export async function updateNews(id: number, values: NewsWriteValues): Promise<number> {
  const rows = await dbWrite()
    .update(newses)
    .set(values)
    .where(and(eq(newses.id, id), isNull(newses.deleted_at)))
    .returning({ id: newses.id });
  return rows.length;
}

/** 論理削除（現行 deleteExecute: deleted_at を現在時刻に。画像ファイルは現行どおり消さない） */
export async function softDeleteNews(id: number): Promise<number> {
  const rows = await dbWrite()
    .update(newses)
    .set({ deleted_at: new Date() })
    .where(and(eq(newses.id, id), isNull(newses.deleted_at)))
    .returning({ id: newses.id });
  return rows.length;
}
