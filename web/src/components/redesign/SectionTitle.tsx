type Props = {
  /** 英字の小見出し（例: "Our Approach"） */
  kicker: string;
  /** 和文タイトル */
  title: string;
  className?: string;
};

/**
 * セクション見出し（英字 kicker + 明朝タイトル + アクセント線）。
 * design/stitch/service-contract.html / achievements-products.html / philosophy.html に共通の形。
 */
export default function SectionTitle({ kicker, title, className = "" }: Props) {
  return (
    <div className={`max-w-2xl ${className}`}>
      <span className="mb-2 block font-latin text-sm font-semibold tracking-[0.2em] text-primary-container uppercase">{kicker}</span>
      <h2 className="font-serif-jp text-[26px] font-bold tracking-wide text-on-surface lg:text-[30px]">{title}</h2>
      <div className="mt-4 h-[2px] w-12 bg-primary-container" aria-hidden="true" />
    </div>
  );
}
