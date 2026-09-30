/**
 * 現行 public/uploads/ の画像を Vercel Blob へ複製する（フェーズ4 セッション14）。
 *
 *   cd web && npm run migrate:images            # 実行
 *   cd web && npm run migrate:images -- --dry-run
 *
 * - 元ファイル（../public/uploads/）は読み取るだけで変更・削除しない
 * - Blob 上のパスは `legacy/<記号を _ に置換したファイル名>`。addRandomSuffix を付けず allowOverwrite にするので
 *   何度実行しても同じ URL に上書きされる（冪等）
 * - 結果は scripts/legacy-image-map.json に `{"uploads/<元ファイル名>": "<Blob URL>"}` で保存する。
 *   migrate-legacy-data.ts が DB の画像列（uploads/... 形式）をこの表で Blob URL に置き換える
 * - BLOB_READ_WRITE_TOKEN は .env.local（`vercel env pull` 済み）から読む
 */
import { put } from "@vercel/blob";
import { readdir, readFile, writeFile } from "node:fs/promises";
import path from "node:path";

const SRC_DIR = path.resolve(process.cwd(), "..", "public", "uploads");
const MAP_FILE = path.resolve(process.cwd(), "scripts", "legacy-image-map.json");
const BLOB_PREFIX = "legacy";

const CONTENT_TYPES: Record<string, string> = {
  ".jpg": "image/jpeg",
  ".jpeg": "image/jpeg",
  ".png": "image/png",
  ".gif": "image/gif",
  ".webp": "image/webp",
};

/** lib/storage.ts の buildUploadName と同じ規則（先頭の time() は元ファイル名に含まれているので付けない） */
function toBlobName(originalName: string): string {
  const ext = path.extname(originalName).toLowerCase();
  const stem = path.basename(originalName, path.extname(originalName)).replace(/[^\w-]+/g, "_").replace(/^_+|_+$/g, "");
  return `${stem || "image"}${ext}`;
}

async function main() {
  const dryRun = process.argv.includes("--dry-run");
  if (!dryRun && !process.env.BLOB_READ_WRITE_TOKEN) {
    throw new Error("BLOB_READ_WRITE_TOKEN が未設定です（web/.env.local を確認）");
  }

  const names = (await readdir(SRC_DIR)).filter((n) => !n.startsWith(".")).sort();
  console.log(`${SRC_DIR}: ${names.length} ファイル${dryRun ? "（dry-run）" : ""}`);

  let existing: Record<string, string> = {};
  try {
    existing = JSON.parse(await readFile(MAP_FILE, "utf8"));
  } catch {
    /* 初回 */
  }

  const map: Record<string, string> = { ...existing };
  for (const name of names) {
    const key = `uploads/${name}`;
    const blobPath = `${BLOB_PREFIX}/${toBlobName(name)}`;
    const ext = path.extname(name).toLowerCase();
    const body = await readFile(path.join(SRC_DIR, name));
    if (dryRun) {
      console.log(`  ${key} -> ${blobPath} (${body.length} bytes)`);
      continue;
    }
    const blob = await put(blobPath, body, {
      access: "public",
      addRandomSuffix: false,
      allowOverwrite: true,
      contentType: CONTENT_TYPES[ext],
    });
    map[key] = blob.url;
    console.log(`  ${key} -> ${blob.url}`);
  }

  if (!dryRun) {
    await writeFile(MAP_FILE, JSON.stringify(map, null, 2) + "\n");
    console.log(`対応表を保存: ${MAP_FILE}（${Object.keys(map).length} 件）`);
  }
}

main().catch((e) => {
  console.error(e);
  process.exit(1);
});
