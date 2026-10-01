import Breadcrumb, { type BreadcrumbItem } from "./Breadcrumb";

type Props = {
  /** パンくず（「トップ」は自動で先頭に付く。最後の項目は href 無し＝現在地） */
  breadcrumbs: BreadcrumbItem[];
  /** 英字ラベル（例: "SERVICE"）。省略可 */
  label?: string;
  /** ページタイトル */
  title: string;
};

/**
 * 下層ページのタイトル帯（design/stitch/service.html の Sub-Hero Page Title Band）。
 * 青のグラデーション帯 + 翅の線のモチーフ + パンくず + 英字ラベル + タイトル。
 */
export default function PageHero({ breadcrumbs, label, title }: Props) {
  return (
    <section className="relative w-full overflow-hidden bg-gradient-to-r from-on-background via-primary to-secondary py-space-2xl text-on-primary md:py-space-3xl">
      <div aria-hidden="true" className="pointer-events-none absolute inset-0 opacity-20">
        <svg className="h-full w-full" fill="none" viewBox="0 0 1440 320" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
          <path className="text-primary-container" d="M-100 360 C150 280, 320 80, 620 120 C880 150, 1020 -40, 1540 180" stroke="currentColor" strokeWidth="1.2" />
          <path className="text-secondary-fixed" d="M120 400 C280 260, 460 140, 780 160 C1100 180, 1260 20, 1600 240" stroke="currentColor" strokeWidth="0.8" />
          <path className="text-on-primary" d="M300 380 C440 240, 620 200, 840 220 C1060 240, 1280 80, 1500 300" stroke="currentColor" strokeWidth="0.6" />
        </svg>
      </div>
      <div className="wrap relative z-10 pt-space-md lg:pt-space-lg">
        <Breadcrumb items={breadcrumbs} />
        <div className="max-w-2xl space-y-space-xs">
          {label ? <p className="font-latin text-sm uppercase tracking-[0.25em] text-primary-fixed-dim">{label}</p> : null}
          <h1 className="font-latin text-4xl font-semibold tracking-tight text-on-primary lg:text-5xl">{title}</h1>
        </div>
      </div>
    </section>
  );
}
