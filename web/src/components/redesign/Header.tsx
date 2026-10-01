"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useState } from "react";
import { NAV_ITEMS } from "@/components/nav-items";

/**
 * リデザイン版の共通ヘッダー（design/stitch/service.html のヘッダーを参考）。
 * - ロゴ「OBFall」+ 水色の点、メニュー 5 項目（項目と遷移先は既存 nav-items.ts と同じ）
 * - 表示中のページのメニューに青い下線（aria-current="page"）
 * - ボタン・人型アイコンは置かない
 * - 1024px 未満はメニューをハンバーガーで開閉する（HTML には SP 用の表現が無いため最小限の実装。仮置き）
 */
export default function Header() {
  const pathname = usePathname();
  const [open, setOpen] = useState(false);

  const isActive = (href: string) => pathname === href || pathname.startsWith(`${href}/`);

  return (
    <header className="fixed top-0 left-0 z-50 w-full bg-surface/85 shadow-[0_1px_8px_rgba(0,0,0,0.04)] backdrop-blur-xl">
      <div className="wrap flex h-20 items-center justify-between">
        <Link href="/" className="flex items-center gap-space-xs" aria-label="OBFall株式会社 トップ">
          <span className="font-latin text-2xl font-bold tracking-tight text-on-surface">OBFall</span>
          <span className="mb-1 h-2 w-2 rounded-full bg-primary-container" aria-hidden="true" />
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
  const state = active
    ? "relative text-primary after:absolute after:left-0 after:h-[2px] after:w-full after:bg-primary after:content-['']"
    : "text-on-surface-variant hover:text-on-surface";
  const layout = mobile ? "py-space-sm after:-bottom-0" : "py-1 after:-bottom-2";
  return (
    <Link
      href={href}
      className={`${base} ${state} ${layout}`}
      aria-current={active ? "page" : undefined}
      onClick={onClick}
      {...(newTab ? { target: "_blank", rel: "noopener noreferrer" } : {})}
    >
      {children}
    </Link>
  );
}
