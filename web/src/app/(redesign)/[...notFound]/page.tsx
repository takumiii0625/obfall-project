import type { Metadata } from "next";
import { notFound } from "next/navigation";

// ブラウザ向けの応答ではこのページの metadata が、検索エンジン向けの応答では not-found.tsx の metadata が使われるため、両方に同じ値を置く
export const metadata: Metadata = {
  title: "404 | OBFall Inc.",
  robots: { index: false },
  alternates: { canonical: null },
};

/**
 * どのルートにも一致しない URL の受け皿。notFound() で (redesign)/not-found.tsx を 404 として表示する。
 * ルートレイアウトが複数ある構成では app 直下の not-found が使えないため、キャッチオールで受ける。
 */
export default function CatchAllNotFound() {
  notFound();
}
