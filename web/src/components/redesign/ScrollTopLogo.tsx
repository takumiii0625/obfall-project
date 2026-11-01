"use client";

/**
 * フッターの社名ロゴ。押すとページ最上部へスムーズにスクロールする（ページ遷移はしない）。
 * 動きを減らす設定（prefers-reduced-motion）のときは即時に移動する。
 */
export default function ScrollTopLogo() {
  const handleClick = () => {
    const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    window.scrollTo({ top: 0, behavior: reduce ? "auto" : "smooth" });
  };

  return (
    <button
      type="button"
      onClick={handleClick}
      className="inline-flex cursor-pointer items-center"
      aria-label="ページの先頭へ戻る（OBFall株式会社）"
    >
      {/* eslint-disable-next-line @next/next/no-img-element */}
      <img src="/image/logo_company.png" alt="" width={396} height={45} className="h-5 w-auto" aria-hidden="true" />
    </button>
  );
}
