import "server-only";
import { del, put } from "@vercel/blob";
import { mkdir, unlink, writeFile } from "node:fs/promises";
import path from "node:path";

/**
 * 画像ストレージ（docs/移行方針.md の既定: Vercel Blob）。
 *
 * - BLOB_READ_WRITE_TOKEN があれば Vercel Blob（公開 URL を返す。DB にはこの完全 URL を保存する）
 * - 無い場合、開発環境では web/public/uploads/ に保存し、現行と同じ相対パス `uploads/<name>` を返す
 *   （表示側の resolveImageUrl が先頭に / を付ける）。本番では例外
 *
 * ファイル名は現行 `time() . '_' . 元ファイル名` に倣い `<ms>_<元ファイル名>`（記号は _ に置換）。
 * Blob 側は addRandomSuffix で衝突を避ける。
 */
const LOCAL_DIR = path.join(process.cwd(), "public", "uploads");
const BLOB_HOST_PATTERN = /\.blob\.vercel-storage\.com\//;

function hasBlobToken(): boolean {
  return !!process.env.BLOB_READ_WRITE_TOKEN;
}

export function buildUploadName(originalName: string): string {
  const ext = path.extname(originalName).replace(/[^\w.]+/g, "").toLowerCase();
  // 日本語などの非 ASCII は _ に置換し、それで名前が残らなければ image にする（URL に使うため）
  const stem = path.basename(originalName, path.extname(originalName)).replace(/[^\w-]+/g, "_").replace(/^_+|_+$/g, "");
  return `${Date.now()}_${stem || "image"}${ext}`;
}

/** 画像を保存し、DB に保存する URL（Blob の完全 URL か `uploads/<name>`）を返す */
export async function uploadImage(file: File): Promise<string> {
  const name = buildUploadName(file.name);

  if (hasBlobToken()) {
    const blob = await put(`uploads/${name}`, file, {
      access: "public",
      addRandomSuffix: true,
      contentType: file.type || undefined,
    });
    return blob.url;
  }

  if (process.env.NODE_ENV === "production") {
    throw new Error("BLOB_READ_WRITE_TOKEN が設定されていません（Vercel の Storage で Blob を接続してください）");
  }
  await mkdir(LOCAL_DIR, { recursive: true });
  await writeFile(path.join(LOCAL_DIR, name), Buffer.from(await file.arrayBuffer()));
  return `uploads/${name}`;
}

/**
 * 画像を削除する（ベストエフォート。失敗してもログのみで例外にしない）。
 * Blob の URL なら del()、`uploads/<name>` ならローカルの public/uploads から unlink。
 * 現行 public/uploads の既存ファイル（本番は Blob へ移設予定）以外のパスは触らない。
 */
export async function deleteImage(url: string | null | undefined): Promise<void> {
  if (!url) return;
  try {
    if (BLOB_HOST_PATTERN.test(url)) {
      if (hasBlobToken()) await del(url);
      return;
    }
    if (url.startsWith("uploads/")) {
      await unlink(path.join(LOCAL_DIR, path.basename(url))).catch(() => undefined);
    }
  } catch (e) {
    console.warn("[storage] 画像の削除に失敗", url, e instanceof Error ? e.message : e);
  }
}
