import type { Metadata } from "next";
import Script from "next/script";
import "../globals.css";

export const metadata: Metadata = {
  title: "OBFall株式会社",
  icons: { icon: "/image/favicon.png" },
  openGraph: {
    images: ["https://obfall.com/image/logo_OBFall2.png"],
  },
};

export default function RootLayout({ children }: LayoutProps<"/">) {
  return (
    <html lang="ja">
      <body>
        {children}
        {/* Font Awesome Kit（当面は現行と同じ Kit を利用） */}
        <Script src="https://kit.fontawesome.com/1c70550d95.js" crossOrigin="anonymous" strategy="afterInteractive" />
      </body>
    </html>
  );
}
