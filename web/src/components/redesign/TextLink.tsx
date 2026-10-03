import Link from "next/link";
import type { ReactNode } from "react";

type Props = {
  href: string;
  children: ReactNode;
  /** 色: primary（既定）/ secondary / inverse（濃い背景上の白） */
  tone?: "primary" | "secondary" | "inverse";
  newTab?: boolean;
  className?: string;
};

const TONES = {
  primary: { text: "text-primary hover:text-tertiary", bar: "bg-primary" },
  secondary: { text: "text-secondary hover:text-primary", bar: "bg-secondary" },
  inverse: { text: "text-on-primary", bar: "bg-on-primary" },
} as const;

/**
 * 下線付きテキストリンク「○○ →」（design/stitch/top.html の各セクションのリンク）。
 * 矢印「→」は文言の一部として表示する。
 */
export default function TextLink({ href, children, tone = "primary", newTab, className = "" }: Props) {
  const t = TONES[tone];
  const external = /^https?:\/\//.test(href);
  const props = newTab ? { target: "_blank", rel: "noopener noreferrer" } : {};
  const inner = (
    <span className="relative pb-1">
      {children} →
      <span className={`absolute bottom-0 left-0 h-[1.5px] w-full origin-left transition-transform duration-300 group-hover:scale-x-110 ${t.bar}`} />
    </span>
  );
  const cls = `group inline-flex items-center gap-space-xs text-[15px] font-medium tracking-wider transition-colors ${t.text} ${className}`;
  return external ? (
    <a href={href} className={cls} {...props}>
      {inner}
    </a>
  ) : (
    <Link href={href} className={cls} {...props}>
      {inner}
    </Link>
  );
}
