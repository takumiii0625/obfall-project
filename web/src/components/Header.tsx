"use client";

import Link from "next/link";
import { useEffect, useRef, useState, type ReactNode } from "react";
import { NAV_ITEMS } from "./nav-items";

/**
 * 共通ヘッダー（現行 components/header.blade.php + 各ビュー直書きの nav-02 の移植）
 *
 * - header … 固定ヘッダー（ロゴ + PC ナビ nav-01 + ハンバーガー）
 * - nav-02 … SP 用スライドドロワー（〜768px）
 * - main.js の「読込後に header へ fadein-active02 付与」「ハンバーガー開閉」
 *   「ドロワー外クリックで閉じる」を React の state / effect で再現
 * - children … .top 配下に続けて描画する要素（トップページのヒーロー。現行 indexDev.blade.php は
 *   <div class="top"> の中に header / nav-02 / hero-section を並べており、
 *   app.css の `.top p`（〜500px）がヒーロー内の <p> に効くため同じ構造を保つ）
 */
type Props = {
  children?: ReactNode;
};

export default function Header({ children }: Props = {}) {
  const [drawerOpen, setDrawerOpen] = useState(false);
  const headerRef = useRef<HTMLElement>(null);
  const drawerListRef = useRef<HTMLUListElement>(null);
  const hamburgerRef = useRef<HTMLDivElement>(null);

  // $('header').addClass('fadein-active02') 相当
  // （CSS 側の transition-delay: 1s で 1 秒後に上からフェードインする）
  useEffect(() => {
    headerRef.current?.classList.add("fadein-active02");
  }, []);

  // オーバーレイ（ドロワー外）クリックで閉じる
  useEffect(() => {
    if (!drawerOpen) return;
    const onDocumentClick = (e: MouseEvent) => {
      const target = e.target as Node;
      if (drawerListRef.current?.contains(target)) return;
      if (hamburgerRef.current?.contains(target)) return;
      setDrawerOpen(false);
    };
    document.addEventListener("click", onDocumentClick);
    return () => document.removeEventListener("click", onDocumentClick);
  }, [drawerOpen]);

  const navList = (
    <>
      {NAV_ITEMS.map((item) => (
        <li key={item.href} className="link text-dark ">
          <Link
            href={item.href}
            className="text-dark text-decoration-none"
            {...(item.newTab ? { target: "_blank", rel: "noopener noreferrer" } : {})}
          >
            {item.label}
          </Link>
        </li>
      ))}
    </>
  );

  return (
    <div className="top">
      <header ref={headerRef} className="fadein-first fadein-from-up">
        <div className="wrap">
          <Link href="/" className="text-dark text-decoration-none ">
            <div className="logo-container">
              {/* eslint-disable-next-line @next/next/no-img-element */}
              <img src="/image/logo_OBFall.png" className="link" alt="OBFall株式会社" />
              <div className="title"></div>
            </div>
          </Link>
          <nav className="nav-01">
            <ul className="mb-0">{navList}</ul>
          </nav>
          <div
            ref={hamburgerRef}
            className={`hamburger${drawerOpen ? " close" : ""}`}
            role="button"
            aria-label="メニュー"
            aria-expanded={drawerOpen}
            onClick={() => setDrawerOpen((open) => !open)}
          >
            <span className="bar bar-top"></span>
            <span className="bar bar-middle"></span>
            <span className="bar bar-bottom"></span>
          </div>
        </div>
      </header>
      <nav className={`nav-02${drawerOpen ? " nav-02-active" : ""}`}>
        <ul ref={drawerListRef}>{navList}</ul>
      </nav>
      {children}
    </div>
  );
}
