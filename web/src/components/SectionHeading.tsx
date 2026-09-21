/**
 * セクション見出し（kicker + タイトル）。
 * 現行の各公開ビューに共通する .sec-heading マークアップ。
 * スタイルは各画面の CSS（:where(.page-*) .sec-heading*）側で定義する。
 */
type Props = {
  kicker: string;
  title: string;
};

export default function SectionHeading({ kicker, title }: Props) {
  return (
    <div className="sec-heading">
      <span className="sec-heading__kicker">{kicker}</span>
      <h2 className="sec-heading__title">{title}</h2>
    </div>
  );
}
