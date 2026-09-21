/**
 * ロゴ付きプロダクトカード（.product-card）。
 * 現行 services/products・services/contract の実績・事例紹介で共通のマークアップ。
 * 画像は現行と同じく素の <img>（高さ 64px 固定・幅 auto を CSS 側で指定）。
 */
export type ProductCardItem = {
  /** /image/ 配下のファイル名を含むパス（例: "/image/digOn_logo.png"） */
  logo: string;
  alt: string;
  name: string;
  desc: string;
  /** 例: "開発中"。指定時のみバッジを表示 */
  badge?: string;
};

export default function ProductCard({ logo, alt, name, desc, badge }: ProductCardItem) {
  return (
    <article className="product-card">
      {/* eslint-disable-next-line @next/next/no-img-element -- 現行と同じ素の img（サイズは CSS で固定） */}
      <img src={logo} alt={alt} className="product-card__logo" loading="lazy" />
      <h3 className="product-card__name">{name}</h3>
      <p className="product-card__desc">{desc}</p>
      {badge && <span className="product-card__badge">{badge}</span>}
    </article>
  );
}
