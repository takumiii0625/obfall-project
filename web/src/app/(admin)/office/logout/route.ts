import { NextResponse } from "next/server";
import { signOut } from "@/auth";

/**
 * ログアウト GET /office/logout（§2.2 #34）
 * 現行: OfficeAuthController@logout（Auth::logout + session flush → /office/login に success フラッシュ）
 * 現行どおり GET。セッション Cookie を消してログイン画面へ戻す。
 */
export async function GET(request: Request) {
  await signOut({ redirect: false });
  return NextResponse.redirect(new URL("/office/login?logout=1", request.url));
}

export const dynamic = "force-dynamic";
