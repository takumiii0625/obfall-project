import type { Metadata } from "next";
import { EB_Garamond, Shippori_Mincho_B1, Zen_Kaku_Gothic_New } from "next/font/google";
import "./redesign.css";

/**
 * リデザイン（redesign ブランチ）用ルートレイアウト。
 * - 既存の (site)/layout.tsx（Bootstrap + globals.css + Font Awesome Kit）とは独立。Tailwind CSS v4 のみを読み込む
 * - 書体は design/stitch/*.html で実際に使われているものを next/font でセルフホストする。
 *   使うウェイトは最小限（見出し 400/700、本文 400/500/700、英字 400/600）。
 *   和文フォントは unicode-range で分割配信されるため preload せず、必要な文字範囲だけがブラウザで読み込まれる
 */
const serifJp = Shippori_Mincho_B1({
  weight: ["400", "700"],
  display: "swap",
  preload: false,
  variable: "--font-shippori-mincho",
});

const sansJp = Zen_Kaku_Gothic_New({
  weight: ["400", "500", "700"],
  display: "swap",
  preload: false,
  variable: "--font-zen-kaku-gothic",
});

const latin = EB_Garamond({
  weight: ["400", "600"],
  subsets: ["latin"],
  display: "swap",
  variable: "--font-eb-garamond",
});

export const metadata: Metadata = {
  title: "OBFall Inc.",
  icons: { icon: "/image/favicon.png" },
  openGraph: {
    images: ["https://obfall.com/image/logo_OBFall2.png"],
  },
};

export default function RedesignRootLayout({ children }: LayoutProps<"/">) {
  return (
    <html lang="ja" className={`${serifJp.variable} ${sansJp.variable} ${latin.variable}`}>
      <body>{children}</body>
    </html>
  );
}
