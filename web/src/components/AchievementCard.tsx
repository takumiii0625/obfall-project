import type { ReactNode } from "react";

/**
 * 横長の実績カード（.achievement-card）。
 * 現行 achievements/products・contract・security で共通のマークアップ。
 * 左（または右）にビジュアル、右に本文（バッジ / 名前 / 説明 / 外部リンク / 任意の子要素）。
 * スタイルは各画面の CSS（:where(.page-*) .achievement-card*）側で定義する。
 */
export type AchievementCardItem = {
  /** /image/ 配下のパス（例: "/image/digOn_logo.png"） */
  image: string;
  alt: string;
  /** "logo" = ロゴ（max-width 160px）、"photo" = 写真（max-width 240px、width 100%） */
  imageKind?: "logo" | "photo";
  name: string;
  /** 省略可（security はスペック一覧のみで説明文なし） */
  desc?: string;
  /** 例: "開発中"。指定時のみ名前の上にバッジを表示 */
  badge?: string;
  /** 外部サイトへのリンク。指定時のみ表示（現行と同じく target="_blank"） */
  link?: { href: string; label: string };
  /** 768px 以上でビジュアルを右側に配置（現行 __inner--reverse） */
  reverse?: boolean;
};

type Props = AchievementCardItem & {
  /** 本文末尾に差し込む要素（security のスペック一覧など） */
  children?: ReactNode;
};

export default function AchievementCard({
  image,
  alt,
  imageKind = "logo",
  name,
  desc,
  badge,
  link,
  reverse = false,
  children,
}: Props) {
  const innerClass = reverse
    ? "achievement-card__inner achievement-card__inner--reverse"
    : "achievement-card__inner";
  const imgClass = imageKind === "photo" ? "achievement-card__img" : "achievement-card__logo";

  return (
    <article className="achievement-card">
      <div className={innerClass}>
        <div className="achievement-card__visual">
          {/* eslint-disable-next-line @next/next/no-img-element -- 現行と同じ素の img（サイズは CSS で指定） */}
          <img src={image} alt={alt} className={imgClass} loading="lazy" />
        </div>
        <div className="achievement-card__body">
          {badge && <span className="achievement-card__badge">{badge}</span>}
          <h3 className="achievement-card__name">{name}</h3>
          {desc && <p className="achievement-card__desc">{desc}</p>}
          {link && (
            <a className="achievement-card__link" href={link.href} target="_blank" rel="noopener noreferrer">
              {link.label} <i className="bi bi-arrow-right"></i>
            </a>
          )}
          {children}
        </div>
      </div>
    </article>
  );
}
