/**
 * セクション背景に敷く大きな英字（design/stitch の Bleed Background Text）。
 * 位置・サイズ・色は className で指定する。親は relative + overflow-clip にする。
 */
export default function BleedWord({ children, className }: { children: string; className: string }) {
  return (
    <div className={`pointer-events-none absolute z-0 select-none ${className}`} aria-hidden="true">
      <span className="inline-block font-latin leading-none font-normal whitespace-nowrap">{children}</span>
    </div>
  );
}
