import bcrypt from "bcryptjs";

/**
 * パスワードハッシュ（bcrypt）。
 * 現行 Laravel の Hash::make は接頭辞 `$2y$`。bcryptjs は `$2y$` をそのまま照合できるが、
 * 念のため `$2b$` に読み替えてから照合する（§3.1.3）。新規ハッシュは `$2b$`（現行の PHP 側でも照合可能）。
 */
const COST = 10;

export async function hashPassword(plain: string): Promise<string> {
  return bcrypt.hash(plain, COST);
}

export async function verifyPassword(plain: string, hash: string | null | undefined): Promise<boolean> {
  if (!hash) return false;
  const normalized = hash.replace(/^\$2y\$/, "$2b$");
  try {
    return await bcrypt.compare(plain, normalized);
  } catch {
    return false;
  }
}
