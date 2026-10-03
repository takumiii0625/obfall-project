import Link from "next/link";

export type BreadcrumbItem = {
  label: string;
  /** 省略時は現在地（リンクにしない） */
  href?: string;
};

/** 構造化データに出す絶対 URL の基点（本番ドメイン） */
const SITE_URL = "https://obfall.com";

/**
 * パンくず。現行サイトと同じく、本文の最後とフッターの間（<main> の末尾）に置く。
 * 先頭に「トップ」を自動で付ける。現在地（最後の項目）以外はリンク。
 * 検索エンジン向けに BreadcrumbList の JSON-LD も出力する（現在地は URL を省略）。
 */
export default function Breadcrumb({ items }: { items: BreadcrumbItem[] }) {
  const all: BreadcrumbItem[] = [{ label: "トップ", href: "/" }, ...items];
  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    itemListElement: all.map((item, i) => ({
      "@type": "ListItem",
      position: i + 1,
      name: item.label,
      ...(item.href ? { item: `${SITE_URL}${item.href}` } : {}),
    })),
  };
  return (
    <nav className="w-full border-t border-surface-container-high bg-surface" aria-label="パンくず">
      <ol className="wrap flex flex-wrap items-center gap-x-space-sm gap-y-space-xs py-space-lg text-[13px] tracking-wider text-on-surface-variant">
        {all.map((item, i) => (
          <li key={`${item.label}-${i}`} className="inline-flex min-w-0 items-center gap-space-sm">
            {i > 0 ? (
              <span className="font-latin text-outline" aria-hidden="true">
                &gt;
              </span>
            ) : null}
            {item.href ? (
              <Link href={item.href} className="text-primary underline-offset-4 transition-colors hover:text-tertiary hover:underline">
                {item.label}
              </Link>
            ) : (
              <span className="min-w-0 font-medium text-on-surface" aria-current="page">
                {item.label}
              </span>
            )}
          </li>
        ))}
      </ol>
      <script type="application/ld+json" dangerouslySetInnerHTML={{ __html: JSON.stringify(jsonLd).replace(/</g, "\\u003c") }} />
    </nav>
  );
}
