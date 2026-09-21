/**
 * ローカル開発用シード。`npm run db:seed`（tsx --env-file=.env.local）で実行する。
 *
 * - newses: セッション2〜7で使っていたモック（src/data/newses.json）を投入
 * - admins: 現行 database/seeders/AdminsTableSeeder.php と同じ test@co.jp / !Pass0120（activated_at 未設定 = 初期管理者。
 *           ログインすると /init/input へ誘導される）に加え、通常ログインの確認用に有効化済みの
 *           dev@example.com / !Pass0120 を入れる（ローカル専用）
 *
 * 何度実行しても同じ状態になるよう、対象テーブルを TRUNCATE してから入れ直す（本番では使わない）。
 */
import { sql } from "drizzle-orm";
import { dbWrite } from "./index";
import { admins, newses } from "./schema";
import { hashPassword } from "../lib/password";
import mockNewses from "../data/newses.json";

type MockNews = {
  id: number;
  title: string;
  content: string;
  news_image_url_1: string | null;
  news_image_url_2?: string | null;
  news_image_url_3?: string | null;
  status: number;
  deleted_at: string | null;
  created_at: string;
};

async function main() {
  const url = process.env.DATABASE_URL ?? "";
  if (/neon\.tech/.test(url) && process.env.ALLOW_SEED_ON_NEON !== "1") {
    throw new Error("Neon に対するシードは ALLOW_SEED_ON_NEON=1 を付けた場合のみ実行できます（TRUNCATE を伴うため）");
  }

  const db = dbWrite();

  await db.execute(sql`TRUNCATE TABLE ${newses}, ${admins} RESTART IDENTITY`);

  const rows = (mockNewses as MockNews[]).map((m) => ({
    id: m.id,
    title: m.title,
    content: m.content,
    news_image_url_1: m.news_image_url_1,
    news_image_url_2: m.news_image_url_2 ?? null,
    news_image_url_3: m.news_image_url_3 ?? null,
    status: m.status,
    // モックの "YYYY-MM-DD HH:mm:ss" は JST の壁時計値として扱う
    created_at: new Date(`${m.created_at.replace(" ", "T")}+09:00`),
    deleted_at: m.deleted_at ? new Date(`${m.deleted_at.replace(" ", "T")}+09:00`) : null,
  }));
  await db.insert(newses).values(rows);
  // 明示 id で入れたので identity の次値を進める
  await db.execute(sql`SELECT setval(pg_get_serial_sequence('newses', 'id'), (SELECT MAX(id) FROM newses))`);

  const password = await hashPassword("!Pass0120");
  await db.insert(admins).values([
    { email: "test@co.jp", password },
    { email: "dev@example.com", name: "開発用管理者", password, activated_at: new Date() },
  ]);

  const count = await db.select({ id: newses.id }).from(newses);
  console.log(`seed 完了: newses ${count.length}件 / admins 2件`);
}

main()
  .then(() => process.exit(0))
  .catch((e) => {
    console.error(e);
    process.exit(1);
  });
