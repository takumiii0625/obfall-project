/**
 * 現行 MySQL のダンプ（phpMyAdmin / mysqldump の SQL）を Neon / PostgreSQL へ複製する（フェーズ4 セッション14）。
 *
 *   cd web && npm run migrate:data -- --file=../path/to/dump.sql --dry-run   # 内容確認のみ
 *   cd web && npm run migrate:data -- --file=../path/to/dump.sql             # .env.local の DATABASE_URL へ投入
 *   DATABASE_URL=<Neon の unpooled URL> ALLOW_MIGRATE_ON_NEON=1 npx tsx scripts/migrate-legacy-data.ts --file=...
 *
 * オプション:
 *   --file=<path>        ダンプ SQL（必須）
 *   --tables=a,b         対象テーブル（既定: newses,inhouse_developments,admins）
 *   --tz=+09:00          ダンプの DATETIME をどのタイムゾーンの壁時計値として読むか（既定 +09:00）。
 *                        newses / inhouse_developments の created_at は MySQL の DEFAULT CURRENT_TIMESTAMP で入るため
 *                        サーバー TZ（ロリポップは JST）に依存する。ダンプの値と現行サイトの表示日付を見比べて決める
 *   --dry-run            DB に書かず、解析結果と変換後の行を表示する
 *
 * 方針:
 *   - ダンプは読むだけ。現行 MySQL には接続しない（複製であり、現行側は最後まで残す）
 *   - id を保ったまま UPSERT（ON CONFLICT (id) DO UPDATE）するので何度実行しても最新のダンプの状態に揃う。
 *     ダンプに無い行は消さない（新環境で登録した行を守るため）
 *   - 画像列（uploads/<name>）は scripts/legacy-image-map.json（migrate-legacy-images.ts の出力）で Blob URL に置換。
 *     対応が無ければそのまま残し、最後に一覧で警告する
 *   - admins.password（$2y$ bcrypt）はそのまま移す（lib/password.ts が $2y$ を照合できる）。login_failed_count は 0
 *   - 投入後に identity の次値を MAX(id) に進める
 *   - Neon（neon.tech）へは ALLOW_MIGRATE_ON_NEON=1 のときだけ書き込む
 */
import { sql } from "drizzle-orm";
import { readFile } from "node:fs/promises";
import path from "node:path";
import { dbWrite } from "../src/db/index";
import { admins, inhouseDevelopments, newses } from "../src/db/schema";

type Scalar = string | number | null;
type Row = Record<string, Scalar>;

const DEFAULT_TABLES = ["newses", "inhouse_developments", "admins"] as const;
type TableName = (typeof DEFAULT_TABLES)[number];

const IMAGE_COLUMNS: Record<TableName, string[]> = {
  newses: ["news_image_url_1", "news_image_url_2", "news_image_url_3"],
  inhouse_developments: ["inhouse_developments_image_url"],
  admins: [],
};

const DATETIME_COLUMNS = new Set([
  "created_at",
  "updated_at",
  "deleted_at",
  "login_locked_at",
  "activated_at",
  "terminated_at",
]);

// ---------------------------------------------------------------- 引数

function arg(name: string): string | undefined {
  const hit = process.argv.find((a) => a.startsWith(`--${name}=`));
  return hit ? hit.slice(name.length + 3) : undefined;
}

// ---------------------------------------------------------------- MySQL ダンプの解析

/** `CREATE TABLE \`t\` (...)` から列名の並びを取る（列リスト無しの INSERT 用） */
function parseCreateColumns(dump: string): Map<string, string[]> {
  const result = new Map<string, string[]>();
  const re = /CREATE TABLE(?: IF NOT EXISTS)? `?(\w+)`?\s*\(/gi;
  let m: RegExpExecArray | null;
  while ((m = re.exec(dump))) {
    // 対応する閉じ括弧まで（`varchar(255)` などの入れ子を数える）
    let depth = 1;
    let i = m.index + m[0].length;
    const start = i;
    while (i < dump.length && depth > 0) {
      if (dump[i] === "(") depth++;
      else if (dump[i] === ")") depth--;
      i++;
    }
    const cols: string[] = [];
    for (const line of dump.slice(start, i - 1).split("\n")) {
      const c = line.trim().match(/^`(\w+)`/);
      if (c) cols.push(c[1]);
    }
    result.set(m[1], cols);
    re.lastIndex = i;
  }
  return result;
}

/** VALUES 以降を先頭から読み、`(...)` の並びを行配列にする。戻り値は [rows, 読み終えた位置] */
function parseValueTuples(src: string, start: number): [Scalar[][], number] {
  const rows: Scalar[][] = [];
  let i = start;
  const n = src.length;

  const skipWs = () => {
    while (i < n && /\s/.test(src[i])) i++;
  };

  for (;;) {
    skipWs();
    if (src[i] !== "(") break;
    i++;
    const row: Scalar[] = [];
    for (;;) {
      skipWs();
      const ch = src[i];
      if (ch === "'" || ch === '"') {
        const quote = ch;
        i++;
        let out = "";
        for (;;) {
          const c = src[i];
          if (c === undefined) throw new Error("文字列リテラルが閉じていません");
          if (c === "\\") {
            const e = src[i + 1];
            const map: Record<string, string> = { n: "\n", r: "\r", t: "\t", "0": "\0", Z: "\x1a", b: "\b" };
            out += map[e] ?? e;
            i += 2;
            continue;
          }
          if (c === quote) {
            if (src[i + 1] === quote) {
              out += quote;
              i += 2;
              continue;
            }
            i++;
            break;
          }
          out += c;
          i++;
        }
        row.push(out);
      } else if (src.startsWith("NULL", i)) {
        row.push(null);
        i += 4;
      } else {
        let j = i;
        while (j < n && src[j] !== "," && src[j] !== ")") j++;
        const raw = src.slice(i, j).trim();
        i = j;
        row.push(/^-?\d+(\.\d+)?$/.test(raw) ? Number(raw) : raw);
      }
      skipWs();
      if (src[i] === ",") {
        i++;
        continue;
      }
      if (src[i] === ")") {
        i++;
        break;
      }
      throw new Error(`予期しない文字 '${src[i]}' at ${i}`);
    }
    rows.push(row);
    skipWs();
    if (src[i] === ",") {
      i++;
      continue;
    }
    if (src[i] === ";") i++;
    break;
  }
  return [rows, i];
}

/** ダンプ全体から対象テーブルの INSERT を集めて行オブジェクトにする */
function parseDump(dump: string, tables: readonly string[]): Map<string, Row[]> {
  const createCols = parseCreateColumns(dump);
  const out = new Map<string, Row[]>();
  for (const t of tables) out.set(t, []);

  const re = /INSERT(?: IGNORE)? INTO `?(\w+)`?\s*(\(([^)]*)\))?\s*VALUES\s*/gi;
  let m: RegExpExecArray | null;
  while ((m = re.exec(dump))) {
    const table = m[1];
    if (!out.has(table)) continue;
    const columns = m[3]
      ? m[3].split(",").map((c) => c.trim().replace(/^`|`$/g, ""))
      : createCols.get(table);
    if (!columns) throw new Error(`${table}: 列リストが無く CREATE TABLE も見つかりません`);
    const [tuples, end] = parseValueTuples(dump, m.index + m[0].length);
    re.lastIndex = end;
    for (const tuple of tuples) {
      if (tuple.length !== columns.length) {
        throw new Error(`${table}: 列数 ${columns.length} に対して値が ${tuple.length} 個の行があります: ${JSON.stringify(tuple).slice(0, 120)}`);
      }
      const row: Row = {};
      columns.forEach((c, idx) => (row[c] = tuple[idx]));
      out.get(table)!.push(row);
    }
  }
  return out;
}

// ---------------------------------------------------------------- 変換

function toDate(v: Scalar, tz: string): Date | null {
  if (v === null || v === "" || v === "0000-00-00 00:00:00") return null;
  const s = String(v).replace(" ", "T");
  const d = new Date(`${s}${tz}`);
  if (Number.isNaN(d.getTime())) throw new Error(`日時を解釈できません: ${v}`);
  return d;
}

function mapImage(v: Scalar, imageMap: Record<string, string>, missing: Set<string>): string | null {
  if (v === null || v === "") return null;
  const s = String(v);
  if (imageMap[s]) return imageMap[s];
  if (s.startsWith("uploads/")) missing.add(s);
  return s;
}

// ---------------------------------------------------------------- メイン

async function main() {
  const file = arg("file");
  if (!file) throw new Error("--file=<ダンプ SQL のパス> を指定してください");
  const tz = arg("tz") ?? "+09:00";
  const tables = (arg("tables")?.split(",") ?? [...DEFAULT_TABLES]).map((t) => t.trim()) as TableName[];
  const dryRun = process.argv.includes("--dry-run");

  const url = process.env.DATABASE_URL ?? "";
  if (!dryRun && /neon\.tech/.test(url) && process.env.ALLOW_MIGRATE_ON_NEON !== "1") {
    throw new Error("Neon への投入は ALLOW_MIGRATE_ON_NEON=1 を付けた場合のみ実行できます");
  }

  const dump = await readFile(path.resolve(file), "utf8");
  const parsed = parseDump(dump, tables);

  let imageMap: Record<string, string> = {};
  try {
    imageMap = JSON.parse(await readFile(path.resolve(process.cwd(), "scripts", "legacy-image-map.json"), "utf8"));
  } catch {
    console.warn("scripts/legacy-image-map.json が無いため画像 URL は置換しません（先に npm run migrate:images）");
  }
  const missingImages = new Set<string>();

  console.log(`ダンプ: ${file} / TZ: ${tz}${dryRun ? " / dry-run" : ""}`);
  for (const t of tables) console.log(`  ${t}: ${parsed.get(t)?.length ?? 0} 行`);

  const db = dryRun ? null : dbWrite();

  for (const table of tables) {
    const rows = parsed.get(table) ?? [];
    if (rows.length === 0) continue;

    const converted = rows.map((r) => {
      const o: Record<string, unknown> = {};
      for (const [k, v] of Object.entries(r)) {
        if (DATETIME_COLUMNS.has(k)) o[k] = toDate(v, tz);
        else if (IMAGE_COLUMNS[table].includes(k)) o[k] = mapImage(v, imageMap, missingImages);
        else if (k === "status") o[k] = Number(v ?? 1);
        else o[k] = v;
      }
      if (table === "admins") {
        o.login_failed_count = 0;
        delete o.onetime_key_expires_at; // 現行にあっても新スキーマには無い列（保険）
      }
      return o;
    });

    if (dryRun) {
      for (const c of converted) {
        const preview = { ...c } as Record<string, unknown>;
        if (typeof preview.content === "string") preview.content = `${(preview.content as string).slice(0, 40)}…`;
        if (typeof preview.password === "string") preview.password = "(bcrypt)";
        console.log(`  [${table}]`, JSON.stringify(preview));
      }
      continue;
    }

    const target = table === "newses" ? newses : table === "inhouse_developments" ? inhouseDevelopments : admins;
    const columns = Object.keys(converted[0]).filter((k) => k !== "id");
    const setClause = Object.fromEntries(columns.map((k) => [k, sql.raw(`excluded."${k}"`)]));

    await db!
      .insert(target)
      .values(converted as never)
      .onConflictDoUpdate({ target: target.id, set: setClause });
    await db!.execute(sql.raw(`SELECT setval(pg_get_serial_sequence('${table}', 'id'), (SELECT COALESCE(MAX(id), 1) FROM ${table}))`));
    console.log(`  ${table}: ${converted.length} 行を UPSERT`);
  }

  if (missingImages.size > 0) {
    console.warn("\n対応する Blob URL が無い画像（uploads/ のまま保存されました）:");
    for (const m of missingImages) console.warn(`  ${m}`);
  }
  console.log(dryRun ? "\ndry-run 完了（DB は変更していません）" : "\n投入完了");
}

main()
  .then(() => process.exit(0))
  .catch((e) => {
    console.error(e);
    process.exit(1);
  });
