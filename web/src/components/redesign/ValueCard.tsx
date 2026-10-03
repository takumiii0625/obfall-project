export type ValueCardItem = {
  num: string;
  kicker: string;
  title: string;
  desc: string;
};

type Props = ValueCardItem & {
  /** lg = 見出しを一回り大きく（横長カード向け） */
  size?: "md" | "lg";
  /** 背景・枠線・列幅など（例: "border-t-2 border-primary-container bg-surface-container-lowest lg:col-span-7"） */
  className?: string;
};

/**
 * 番号付きの価値カード「01 / Insight + タイトル + 説明」（design/stitch/service-contract.html の Approach / Why Us カード）。
 * サービス詳細 4 画面で共用する。
 */
export default function ValueCard({ num, kicker, title, desc, size = "md", className = "" }: Props) {
  return (
    <article className={`relative p-space-lg shadow-sm lg:p-space-xl ${className}`}>
      <div className={`mb-3 font-latin font-normal tracking-wider text-primary ${size === "lg" ? "text-3xl" : "text-2xl"}`}>
        {num} / {kicker}
      </div>
      <h3 className={`mb-4 font-serif-jp font-bold text-on-surface ${size === "lg" ? "text-2xl" : "text-xl"}`}>{title}</h3>
      <p className="text-sm leading-relaxed text-on-surface-variant lg:text-base">{desc}</p>
    </article>
  );
}
