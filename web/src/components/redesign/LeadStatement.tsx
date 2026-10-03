import type { ReactNode } from "react";

type Props = {
  /** 左にアクセント線を添えた明朝の一文（既存ページの PageHero sub に相当） */
  statement: ReactNode;
  /** 右（SP では下）に置く本文（既存ページのリード文）。省略可 */
  body?: ReactNode;
  /** 本文をカード（薄い背景 + 枠）で囲む（design/stitch/service-contract.html） */
  bodyCard?: boolean;
};

/**
 * 下層ページ冒頭のリード（design/stitch/service.html / achievements.html / achievements-products.html の
 * 「縦線 + 明朝の一文 + 本文」の 2 カラム）。
 */
export default function LeadStatement({ statement, body, bodyCard = false }: Props) {
  return (
    <section className="w-full bg-surface py-space-2xl lg:py-space-3xl">
      <div className="wrap">
        <div className={`grid grid-cols-1 items-center gap-space-xl lg:gap-space-2xl ${body ? "lg:grid-cols-12" : ""}`}>
          <div className={`relative pl-space-lg lg:pl-space-xl ${body ? "lg:col-span-7" : ""}`}>
            <div className="absolute top-1 bottom-1 left-0 w-[3px] rounded-full bg-primary-container" aria-hidden="true" />
            <h2 className="font-serif-jp text-[22px] leading-snug font-bold text-on-surface lg:text-[28px]">{statement}</h2>
          </div>
          {body ? (
            <div className={`lg:col-span-5 ${bodyCard ? "rounded-sm border border-surface-container-high bg-surface-container-low p-space-lg shadow-sm" : ""}`}>
              <div className="text-sm leading-loose text-on-surface-variant lg:text-base">{body}</div>
            </div>
          ) : null}
        </div>
      </div>
    </section>
  );
}
