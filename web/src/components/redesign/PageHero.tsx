import type { ReactNode } from "react";

type Props = {
  /**
   * 英字ラベル。段数で階層を表す: 1 階層目のページは付けず（タイトル 1 段）、
   * 2 階層目のページは親ページ名を付ける（例: "ACHIEVEMENTS"、"SERVICE / PRODUCTS"）
   */
  label?: string;
  /** ページタイトル */
  title: string;
  /** 和文タイトル（人権方針など）。明朝体で少し小さく出す（design/stitch/human-rights-policy.html） */
  jpTitle?: boolean;
  /** タイトル下の小さめの一文（企業理念ページの「あなたの、あなたによる、あなたのための」。旧 PageHero の sub と同じ位置づけ） */
  sub?: ReactNode;
};

/**
 * 下層ページのタイトル帯（design/stitch/service.html の Sub-Hero Page Title Band）。
 * 青のグラデーション帯 + 翅の線のモチーフ + 英字ラベル + タイトル。
 * 帯は固定ヘッダーの下（main の pt-20 の後）から始まるので、帯の中で上下中央に置けば
 * 「ヘッダーの下端から帯の下端まで」の中央になる。高さは全ページ共通（最小の高さ。長いタイトルでは伸びる）。
 * 表示時に英字ラベル → タイトル → 一文の順に現れ、背景の線がゆっくり揺らぐ（redesign.css の .hero-in-* / .venation-drift）。
 * パンくずは帯の中ではなく <main> の末尾に置く（Breadcrumb）。
 */
export default function PageHero({ label, title, jpTitle = false, sub }: Props) {
  return (
    <section className="relative flex min-h-[176px] w-full items-center overflow-clip bg-gradient-to-r from-on-background via-primary to-secondary py-space-xl text-on-primary lg:min-h-[240px]">
      <div aria-hidden="true" className="pointer-events-none absolute inset-0 opacity-20">
        <svg className="venation-drift h-full w-full" fill="none" viewBox="0 0 1440 320" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path className="text-primary-container" d="M-100 360 C150 280, 320 80, 620 120 C880 150, 1020 -40, 1540 180" stroke="currentColor" strokeWidth="1.2" />
          <path className="text-secondary-fixed" d="M120 400 C280 260, 460 140, 780 160 C1100 180, 1260 20, 1600 240" stroke="currentColor" strokeWidth="0.8" />
          <path className="text-on-primary" d="M300 380 C440 240, 620 200, 840 220 C1060 240, 1280 80, 1500 300" stroke="currentColor" strokeWidth="0.6" />
        </svg>
      </div>
      <div className="wrap relative z-10">
        <div className="max-w-3xl space-y-space-xs">
          {label ? <p className="hero-in-1 font-latin text-xs uppercase tracking-[0.2em] text-primary-fixed-dim sm:text-sm sm:tracking-[0.25em]">{label}</p> : null}
          <h1
            className={
              jpTitle
                ? "hero-in-2 font-serif-jp text-[26px] leading-snug font-bold tracking-tight text-on-primary lg:text-[36px]"
                : "hero-in-2 font-latin text-4xl font-semibold tracking-tight text-on-primary lg:text-5xl"
            }
          >
            {title}
          </h1>
          {sub ? <p className="hero-in-3 pt-space-xs font-serif-jp text-[15px] leading-relaxed font-medium tracking-wide text-primary-fixed sm:text-[18px] lg:text-[20px]">{sub}</p> : null}
        </div>
      </div>
    </section>
  );
}
