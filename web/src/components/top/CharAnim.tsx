import type { CSSProperties } from "react";

type Props = {
  text: string;
  /** 現行はヒーローが <strong>、エンディングが <p> */
  as?: "strong" | "p";
  className?: string;
};

/**
 * 1文字ずつ出現するテキスト（main.js の [data-anim="char"] 処理の移植）。
 * 現行は JS で textContent を空にして .char-span を生成していたが、
 * React では最初から span を描画する（見た目・アニメーションは同じ）。
 * is-visible の付与は TopEffects（IntersectionObserver）が行う。
 */
export default function CharAnim({ text, as: Tag = "strong", className = "" }: Props) {
  return (
    <Tag className={`${className} char-anim`.trim()} data-anim="char" aria-label={text}>
      {Array.from(text).map((ch, i) => (
        <span key={i} className="char-span" style={{ "--i": i } as CSSProperties}>
          {ch === " " ? " " : ch}
        </span>
      ))}
    </Tag>
  );
}
