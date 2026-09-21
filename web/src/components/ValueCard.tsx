/**
 * 番号付き価値カード（.value-card）。
 * 現行の Philosophy / Service 系ビューで共通のマークアップ。
 * スタイルは各画面の CSS（:where(.page-*) .value-card*）側で定義する。
 */
export type ValueCardItem = {
  num: string;
  kicker: string;
  title: string;
  desc: string;
};

export default function ValueCard({ num, kicker, title, desc }: ValueCardItem) {
  return (
    <article className="value-card">
      <div className="value-card__num">{num}</div>
      <div className="value-card__kicker">{kicker}</div>
      <h3 className="value-card__title">{title}</h3>
      <p className="value-card__desc">{desc}</p>
    </article>
  );
}
