import Link from "next/link";

export type BreadcrumbItem = {
  label: string;
  /** 省略時は現在地（リンクにしない） */
  href?: string;
};

/**
 * パンくず（design/stitch/service.html のタイトル帯内のもの）。PageHero の中で使う。
 * 先頭に「トップ」を自動で付ける。
 */
export default function Breadcrumb({ items }: { items: BreadcrumbItem[] }) {
  const all: BreadcrumbItem[] = [{ label: "トップ", href: "/" }, ...items];
  return (
    <nav className="mb-space-lg flex flex-wrap items-center gap-space-xs text-xs tracking-wider text-secondary-fixed" aria-label="パンくず">
      {all.map((item, i) => (
        <span key={`${item.label}-${i}`} className="inline-flex items-center gap-space-xs">
          {i > 0 ? (
            <span className="font-latin text-primary-container" aria-hidden="true">
              &gt;
            </span>
          ) : null}
          {item.href ? (
            <Link href={item.href} className="font-medium transition-colors hover:text-on-primary">
              {item.label}
            </Link>
          ) : (
            <span className="font-medium text-on-primary" aria-current="page">
              {item.label}
            </span>
          )}
        </span>
      ))}
    </nav>
  );
}
