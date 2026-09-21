import { neon, Pool as NeonPool } from "@neondatabase/serverless";
import { drizzle as drizzleNeonHttp } from "drizzle-orm/neon-http";
import { drizzle as drizzleNeonWs } from "drizzle-orm/neon-serverless";
import { drizzle as drizzleNodePg } from "drizzle-orm/node-postgres";
import type { PgDatabase, PgQueryResultHKT } from "drizzle-orm/pg-core";
import { Pool } from "pg";
import * as schema from "./schema";

/**
 * DB 接続（docs/移行方針.md「技術選定」に従う）。
 *
 * - Neon（本番 / プレビュー）:
 *     読み取り … `@neondatabase/serverless` の HTTP（`neon()`）。1クエリ1リクエストで低レイテンシ。トランザクション不可
 *     書き込み … `Pool`（WebSocket）。トランザクションが使える
 * - ローカル開発: Homebrew 等の PostgreSQL に node-postgres で接続（読み書き同じ接続）
 *
 * 切替は DATABASE_URL のホストで自動判定（`neon.tech` を含めば Neon）。DB_DRIVER=neon|pg で明示もできる。
 * Neon の WebSocket 接続は Node 22 以降のグローバル WebSocket を使う（Vercel の既定ランタイムで可）。
 */

export type Db = PgDatabase<PgQueryResultHKT, typeof schema>;

type DbPair = { read: Db; write: Db };

declare global {
  // 開発時の HMR でプールが増殖しないよう globalThis に保持する
  var __obfallDb: DbPair | undefined;
}

function resolveDriver(url: string): "neon" | "pg" {
  const forced = process.env.DB_DRIVER;
  if (forced === "neon" || forced === "pg") return forced;
  return /neon\.tech/.test(url) ? "neon" : "pg";
}

function createDb(): DbPair {
  const url = process.env.DATABASE_URL;
  if (!url) {
    throw new Error("DATABASE_URL が設定されていません（web/.env.local を参照）");
  }

  if (resolveDriver(url) === "neon") {
    const read = drizzleNeonHttp(neon(url), { schema }) as unknown as Db;
    const write = drizzleNeonWs(new NeonPool({ connectionString: url }), { schema }) as unknown as Db;
    return { read, write };
  }

  const pool = new Pool({ connectionString: url });
  const db = drizzleNodePg(pool, { schema }) as unknown as Db;
  return { read: db, write: db };
}

function getPair(): DbPair {
  if (!globalThis.__obfallDb) {
    globalThis.__obfallDb = createDb();
  }
  return globalThis.__obfallDb;
}

/** 読み取り用（公開ページの一覧・詳細・トップ） */
export function db(): Db {
  return getPair().read;
}

/** 書き込み・トランザクション用（管理画面の CRUD、シード） */
export function dbWrite(): Db {
  return getPair().write;
}

export { schema };
