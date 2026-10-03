import Link from "next/link";
import type { ReactNode } from "react";
import ArrowIcon from "./ArrowIcon";

type Props = {
  href: string;
  children: ReactNode;
  newTab?: boolean;
  className?: string;
};

/**
 * カード内のリンク「詳しく見る」「○○公式サイト」など（design/stitch の各カード末尾。矢印はインライン SVG）。
 */
export default function CardLink({ href, children, newTab, className = "" }: Props) {
  const cls = `inline-flex items-center gap-1.5 font-serif-jp text-sm tracking-widest text-primary transition-colors hover:text-tertiary ${className}`;
  const props = newTab ? { target: "_blank", rel: "noopener noreferrer" } : {};
  const inner = (
    <>
      <span>{children}</span>
      <ArrowIcon className="h-[18px] w-[18px]" />
    </>
  );
  return /^https?:\/\//.test(href) ? (
    <a href={href} className={cls} {...props}>
      {inner}
    </a>
  ) : (
    <Link href={href} className={cls} {...props}>
      {inner}
    </Link>
  );
}
