import type { Metadata } from "next";
import type { ReactNode } from "react";

/**
 * 独立ページ用のルートレイアウト。
 *
 * 現行の human-rights-policy.blade.php は共通ヘッダー/フッター・Bootstrap・app.css を
 * 一切読み込まない単独 HTML のため、globals.css を読み込む (site) とは別の
 * ルートレイアウト（ルートグループ）に分けて再現する。
 * ここには何も import しない（各ページが自分の CSS だけを読み込む）。
 */
// canonical は本番ドメイン（obfall.com）を正とする。"./" は各ページのパスに解決される
export const metadata: Metadata = {
  metadataBase: new URL("https://obfall.com"),
  alternates: { canonical: "./" },
};

export default function StandaloneLayout({ children }: { children: ReactNode }) {
  return (
    <html lang="ja">
      <body>{children}</body>
    </html>
  );
}
