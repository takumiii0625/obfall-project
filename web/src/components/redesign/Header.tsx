"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useEffect, useRef, useState } from "react";
import { NAV_ITEMS } from "@/components/nav-items";

/**
 * リデザイン版の共通ヘッダー（design/stitch/service.html のヘッダーを参考）。
 * - ロゴ = 旧ロゴのマーク（logo_icon.png）+「OBFall」、メニュー 5 項目（項目と遷移先は既存 nav-items.ts と同じ）
 * - 表示中のページのメニューに青い下線（aria-current="page"）
 * - ボタン・人型アイコンは置かない
 * - 1024px 未満はメニューをハンバーガーで開閉する（HTML には SP 用の表現が無いため最小限の実装）。
 *   項目のタップ、メニューの外のタップ、Esc キーで閉じる。開閉のアニメーションは無し
 */
export default function Header() {
  const pathname = usePathname();
  const [open, setOpen] = useState(false);

  const headerRef = useRef<HTMLElement>(null);

  const isActive = (href: string) => pathname === href || pathname.startsWith(`${href}/`);

  // モバイルメニューを開いている間、メニューの外のタップと Esc キーで閉じる
  useEffect(() => {
    if (!open) return;
    const onPointerDown = (e: PointerEvent) => {
      if (!headerRef.current?.contains(e.target as Node)) setOpen(false);
    };
    const onKeyDown = (e: KeyboardEvent) => {
      if (e.key === "Escape") setOpen(false);
    };
    document.addEventListener("pointerdown", onPointerDown);
    document.addEventListener("keydown", onKeyDown);
    return () => {
      document.removeEventListener("pointerdown", onPointerDown);
      document.removeEventListener("keydown", onKeyDown);
    };
  }, [open]);

  return (
    <header ref={headerRef} className="fixed top-0 left-0 z-50 w-full bg-surface/85 shadow-[0_1px_8px_rgba(0,0,0,0.04)] backdrop-blur-xl">
      <div className="wrap flex h-20 items-center justify-between">
        <Link href="/" className="flex items-center gap-space-sm" aria-label="OBFall株式会社 トップ">
          {/* 旧ヘッダーのロゴ画像（logo_OBFall.png）左端のマークを切り出したもの。青い点は置かない（2026-10-03 の指示） */}
          {/* eslint-disable-next-line @next/next/no-img-element */}
          <img src="/image/logo_icon.png" alt="" width={50} height={44} className="h-6 w-auto" aria-hidden="true" />
          <span className="font-latin text-2xl font-bold tracking-tight text-on-surface">OBFall</span>
        </Link>

        <nav className="hidden items-center gap-space-lg lg:flex lg:gap-space-xl" aria-label="グローバルナビゲーション">
          {NAV_ITEMS.map((item) => (
            <NavLink key={item.href} href={item.href} active={isActive(item.href)} newTab={item.newTab}>
              {item.label}
            </NavLink>
          ))}
        </nav>

        <button
          type="button"
          className="flex h-10 w-10 flex-col items-center justify-center gap-[5px] lg:hidden"
          aria-label="メニュー"
          aria-expanded={open}
          aria-controls="global-nav-mobile"
          onClick={() => setOpen((v) => !v)}
        >
          <span className={`h-[1.5px] w-6 bg-on-surface transition-transform ${open ? "translate-y-[6.5px] rotate-45" : ""}`} />
          <span className={`h-[1.5px] w-6 bg-on-surface transition-opacity ${open ? "opacity-0" : ""}`} />
          <span className={`h-[1.5px] w-6 bg-on-surface transition-transform ${open ? "-translate-y-[6.5px] -rotate-45" : ""}`} />
        </button>
      </div>

      <nav
        id="global-nav-mobile"
        className={`${open ? "flex" : "hidden"} flex-col border-t border-surface-container-high/60 bg-surface px-margin-mobile py-space-md lg:hidden`}
        aria-label="グローバルナビゲーション（モバイル）"
      >
        {NAV_ITEMS.map((item) => (
          <NavLink key={item.href} href={item.href} active={isActive(item.href)} newTab={item.newTab} mobile onClick={() => setOpen(false)}>
            {item.label}
          </NavLink>
        ))}
      </nav>
    </header>
  );
}

function NavLink({
  href,
  active,
  newTab,
  mobile,
  onClick,
  children,
}: {
  href: string;
  active: boolean;
  newTab?: boolean;
  mobile?: boolean;
  /** モバイルメニューを閉じる */
  onClick?: () => void;
  children: React.ReactNode;
}) {
  const base = "font-latin text-sm uppercase tracking-widest transition-colors";
  const color = active ? "text-primary" : "text-on-surface-variant hover:text-on-surface";
  // 現在地の下線は文字の幅（PC・モバイル共通）。モバイルは行全体をタップ領域（44px 以上）にする
  const underline = active ? "relative after:absolute after:left-0 after:h-[2px] after:w-full after:bg-primary after:content-['']" : "";
  const layout = mobile ? "flex min-h-11 items-center" : "py-1";
  return (
    <Link
      href={href}
      className={`${base} ${color} ${layout}`}
      aria-current={active ? "page" : undefined}
      onClick={onClick}
      {...(newTab ? { target: "_blank", rel: "noopener noreferrer" } : {})}
    >
      <span className={`${underline} ${mobile ? "py-1 after:bottom-0" : "after:-bottom-3"}`}>{children}</span>
    </Link>
  );
}
