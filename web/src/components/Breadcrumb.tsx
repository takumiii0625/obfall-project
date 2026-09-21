import type { CSSProperties } from "react";
import Link from "next/link";

export type BreadcrumbParent = {
  label: string;
  href: string;
};

type Props = {
  /** 現在ページの表示名（例: "最新情報"） */
  current: string;
  /**
   * トップと現在ページの間に挟む中間階層（例: サービス配下なら [{ label: "サービス", href: "/service" }]）。
   * 省略時は「トップ ＞ 現在ページ」の2階層。
   */
  parents?: BreadcrumbParent[];
  /** <nav> に付けるクラス（現行は画面により "m-3" またはなし） */
  className?: string;
};

const breadcrumbStyle = {
  "--bs-breadcrumb-divider": "'＞'",
  fontSize: "clamp(.875rem, 1.8vw, 1rem)",
} as CSSProperties;

/**
 * パンくず（各公開ビュー共通のマークアップ）
 * 先頭は常に「トップ」、末尾は現在ページ（リンクなし）。
 */
export default function Breadcrumb({ current, parents = [], className }: Props) {
  return (
    <nav aria-label="breadcrumb" className={className}>
      <ol className="breadcrumb" style={breadcrumbStyle}>
        <li className="breadcrumb-item">
          <Link href="/">トップ</Link>
        </li>
        {parents.map((p) => (
          <li key={p.href} className="breadcrumb-item">
            <Link href={p.href}>{p.label}</Link>
          </li>
        ))}
        <li className="breadcrumb-item">{current}</li>
      </ol>
    </nav>
  );
}
