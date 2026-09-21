import NextAuth from "next-auth";
import { NextResponse } from "next/server";
import { authConfig } from "./auth.config";

/**
 * 管理画面のルートガード（現行ミドルウェアの移植。Next.js 16 では middleware ではなく proxy）。
 *
 * - RedirectIfNotAuthenticated: ログイン後ルートは未ログインなら /office/login へ
 * - RedirectIfAuthenticated:    未ログイン用ルートはログイン済みなら /admins/newses へ
 * - 初期管理者（needsInit）は /init/* 以外の管理ルートへ入れず /init/input へ
 *
 * 管理者が今も有効か（RedirectIfNoUser）の DB 確認はここでは行わず、
 * 管理レイアウト側の requireActiveAdmin()（src/lib/office-session.ts）で毎リクエスト行う。
 */
const { auth } = NextAuth(authConfig);

/** ログイン後専用（現行 routes/web.php の RedirectIfNotAuthenticated グループ） */
const PROTECTED = [/^\/admins(\/|$)/, /^\/inhouse_developments(\/|$)/, /^\/newses\/create(\/|$)/, /^\/newses\/\d+\/edit(\/|$)/];
/** 未ログイン専用（RedirectIfAuthenticated グループ）のうち、セッション不要のもの */
const GUEST_ONLY = [/^\/office\/(login|forgot|set)(\/|$)/, /^\/onetime(\/|$)/, /^\/init\/complete(\/|$)/];
/** 初期管理者専用（現行はセッション firstAdmin が必要） */
const INIT_ONLY = [/^\/init\/input(\/|$)/];

const matches = (patterns: RegExp[], path: string) => patterns.some((re) => re.test(path));

export default auth((req) => {
  const { pathname } = req.nextUrl;
  const session = req.auth;
  const loggedIn = !!session?.user;
  const needsInit = loggedIn && session.user.needsInit;

  const to = (path: string) => NextResponse.redirect(new URL(path, req.nextUrl.origin));

  if (matches(PROTECTED, pathname)) {
    if (!loggedIn) return to("/office/login");
    if (needsInit) return to("/init/input");
    return NextResponse.next();
  }

  if (matches(INIT_ONLY, pathname)) {
    // 現行: セッション firstAdmin が無ければログインへ。ログイン済み（有効中）なら管理トップへ
    if (!loggedIn) return to("/office/login");
    if (!needsInit) return to("/admins/newses");
    return NextResponse.next();
  }

  if (matches(GUEST_ONLY, pathname)) {
    // /office/logout はログイン済みでも通す。/init/complete は初期設定直後（サインアウト済み）に表示する
    if (loggedIn) return to(needsInit ? "/init/input" : "/admins/newses");
    return NextResponse.next();
  }

  return NextResponse.next();
});

export const config = {
  matcher: [
    "/admins/:path*",
    "/inhouse_developments/:path*",
    "/newses/create/:path*",
    "/newses/:id/edit/:path*",
    "/office/:path*",
    "/init/:path*",
    "/onetime/:path*",
  ],
};
