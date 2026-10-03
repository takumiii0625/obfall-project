import type { Metadata, Viewport } from "next";
import type { ReactNode } from "react";

export const metadata: Metadata = {
  robots: { index: false, follow: false, noarchive: true },
  icons: { icon: "/image/favicon.png" },
};

/** 現行 office/parts/app.blade.php の viewport（拡大禁止） */
export const viewport: Viewport = {
  width: "device-width",
  initialScale: 1,
  minimumScale: 1,
  maximumScale: 1,
  userScalable: false,
};

/** Sneat テンプレートの CSS（現行 public/backend/vendor をそのまま web/public/backend にコピー） */
const STYLESHEETS = [
  "/backend/vendor/fonts/boxicons.css",
  "/backend/vendor/css/rtl/core.css",
  "/backend/vendor/css/rtl/theme-default.css",
  "/backend/vendor/libs/bootstrap/bootstrap-datepicker.css",
  "/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css",
  "/backend/vendor/libs/typeahead-js/typeahead.css",
  "/backend/vendor/libs/apex-charts/apex-charts.css",
];

/**
 * 管理画面（office）用ルートレイアウト。現行 office/parts/app.blade.php の <head> と <body> 属性の移植。
 * 公開サイトの globals.css / Bootstrap は読み込まず、Sneat テンプレートの CSS だけを使う。
 * 未ログイン時の認証カード（authentication-wrapper）は OfficeAuthShell（(guest)/layout.tsx）、
 * ログイン後のサイドメニュー + ヘッダーは (office)/layout.tsx。
 * Sneat の JS（helpers.js / config.js を含む）は素の <script> にするとハイドレーション不一致を起こすため、
 * ログイン後レイアウトの OfficeScripts がクライアント側で順序どおり読み込む。未ログイン画面は CSS のみで成立する。
 */
export default function OfficeRootLayout({ children }: { children: ReactNode }) {
  return (
    <html
      lang="ja"
      className="light-style layout-compact layout-menu-fixed"
      dir="ltr"
      data-theme="theme-default"
      data-assets-path="/"
      data-template="vertical-menu-template-default"
      // Sneat の core.css が html { scroll-behavior: smooth } を当てているため Next にそれを知らせる（遷移時の警告回避）
      data-scroll-behavior="smooth"
    >
      <head>
        <link href="https://fonts.googleapis.com" rel="preconnect" />
        <link href="https://fonts.gstatic.com" rel="preconnect" crossOrigin="anonymous" />
        {/* ルートレイアウトなので全管理ページに効く（eslint-disable-next-line は誤検知回避） */}
        {/* eslint-disable-next-line @next/next/no-page-custom-font */}
        <link
          href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet"
        />
        {STYLESHEETS.map((href) => (
          <link key={href} href={href} rel="stylesheet" />
        ))}
      </head>
      <body className="d-flex flex-column h-100">{children}</body>
    </html>
  );
}
