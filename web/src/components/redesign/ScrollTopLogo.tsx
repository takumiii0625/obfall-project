"use client";

/**
 * フッターの社名ロゴ。押すとページ最上部へスムーズにスクロールする（ページ遷移はしない）。
 * 動きを減らす設定（prefers-reduced-motion）のときは即時に移動する。
 * html に scroll-behavior: smooth があるため、即時移動は "auto" ではなく "instant" を指定する。
 *
 * iPhone の Safari で効かないとの報告（2026-11-05）への対応:
 * - 見た目を変えずに押せる範囲を高さ 44px に広げる（-my-3 py-3）
 * - スムーズスクロールが始まらなかったときは、少し待って即時移動する
 */
const SMOOTH_FALLBACK_MS = 250;

export default function ScrollTopLogo() {
  const handleClick = () => {
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      window.scrollTo({ top: 0, behavior: "instant" });
      return;
    }
    const start = window.scrollY;
    window.scrollTo({ top: 0, behavior: "smooth" });
    window.setTimeout(() => {
      if (window.scrollY > 0 && window.scrollY >= start) window.scrollTo({ top: 0, behavior: "instant" });
    }, SMOOTH_FALLBACK_MS);
  };

  return (
    <button
      type="button"
      onClick={handleClick}
      className="relative z-10 -my-3 inline-flex cursor-pointer touch-manipulation items-center py-3"
      aria-label="ページの先頭へ戻る（OBFall株式会社）"
    >
      {/* eslint-disable-next-line @next/next/no-img-element */}
      <img src="/image/logo_company.png" alt="" width={396} height={45} className="h-5 w-auto" aria-hidden="true" />
    </button>
  );
}
