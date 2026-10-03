import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import LeadStatement from "@/components/redesign/LeadStatement";
import CardLink from "@/components/redesign/CardLink";

export const metadata: Metadata = {
  title: "Services | OBFall Inc.",
};

/** 4事業（文言は既存 (site)/service/_legacy/page.tsx の SERVICES） */
const SERVICES = [
  { num: "01", kicker: "Products", title: "自社開発", en: "IT × Vision", desc: "人と社会の可能性を広げる、自社プロダクト。", href: "/service/products" },
  { num: "02", kicker: "Contract Development", title: "受託開発", en: "IT × Collaboration", desc: "ともにつくり、ともに前へ。", href: "/service/contract" },
  { num: "03", kicker: "Team Support", title: "SES", en: "IT × Team", desc: "人が輝く現場を、技術で支える。", href: "/service/ses" },
  { num: "04", kicker: "Security", title: "脆弱性診断", en: "Security × Engineering", desc: "安全は、後付けではなく、設計から。", href: "/service/security" },
];

/**
 * サービス一覧 GET /service（リデザイン版。design/stitch/service.html を参考）
 * 01 と 04 は横長の大カード、02 と 03 は 2 列の小カード（HTML の非対称レイアウト）。
 */
export default function ServicePage() {
  const [s1, s2, s3, s4] = SERVICES;
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "サービス" }]} label="SERVICE" title="Service" />

        <LeadStatement
          statement="ITの力で、人と社会の可能性を広げる。"
          body={
            <p>
              自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、
              <br className="hidden lg:inline" />
              テクノロジーで人生をより豊かにします。
            </p>
          }
        />

        <section className="relative w-full overflow-clip bg-surface-container-low py-space-2xl lg:py-space-3xl">
          <div aria-hidden="true" className="pointer-events-none absolute inset-0 opacity-30">
            <svg className="h-full w-full" fill="none" viewBox="0 0 1200 1200" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
              <path className="text-primary-container/20" d="M1200 200 C900 150, 700 450, 600 700 C500 950, 200 1100, -100 1150" stroke="currentColor" strokeWidth="0.8" />
              <path className="text-secondary/20" d="M1250 350 C1000 320, 850 580, 750 820 C650 1060, 350 1200, 50 1300" stroke="currentColor" strokeWidth="0.6" />
            </svg>
          </div>

          <div className="wrap relative z-10 space-y-space-xl lg:space-y-space-2xl">
            <WideCard {...s1} numColor="text-primary-container" chipColor="bg-surface-container text-primary" accent />
            <div className="grid grid-cols-1 items-start gap-space-xl lg:grid-cols-2">
              <SmallCard {...s2} numColor="text-primary" chipColor="bg-surface-container-high text-secondary" />
              <SmallCard {...s3} numColor="text-primary-container" chipColor="bg-surface-container text-primary-container" />
            </div>
            <WideCard {...s4} numColor="text-secondary" chipColor="bg-surface-container text-tertiary" />
          </div>
        </section>
      </main>
      <Footer />
    </>
  );
}

type CardProps = (typeof SERVICES)[number] & { numColor: string; chipColor: string; accent?: boolean };

function WideCard({ num, kicker, title, en, desc, href, numColor, chipColor, accent }: CardProps) {
  return (
    <article className="relative overflow-clip rounded-xl border border-surface-container-high/60 bg-surface-container-lowest shadow-sm transition-all duration-300 hover:shadow-md">
      {accent ? <div className="absolute top-0 right-0 left-0 h-1 bg-gradient-to-r from-primary to-primary-container" aria-hidden="true" /> : null}
      <div className="grid grid-cols-1 items-center gap-space-lg p-space-xl lg:grid-cols-12 lg:gap-space-2xl lg:p-space-2xl">
        <div className="space-y-space-md lg:col-span-8">
          <div className="flex flex-wrap items-baseline gap-space-md">
            <span className={`font-latin text-4xl font-semibold tracking-tight lg:text-5xl ${numColor}`}>{num}</span>
            <span className="font-latin text-lg tracking-wider text-outline uppercase">/ {kicker}</span>
            <span className={`inline-flex items-center rounded-full px-3 py-0.5 font-latin text-xs font-semibold tracking-wider ${chipColor}`}>{en}</span>
          </div>
          <div className="space-y-space-xs pt-space-xs">
            <h3 className="font-serif-jp text-2xl font-bold tracking-tight text-on-surface">{title}</h3>
            <p className="pt-space-xs text-sm text-on-surface-variant">{desc}</p>
          </div>
        </div>
        <div className="flex items-center pt-space-md lg:col-span-4 lg:justify-end">
          <CardLink href={href}>詳しく見る</CardLink>
        </div>
      </div>
    </article>
  );
}

function SmallCard({ num, kicker, title, en, desc, href, numColor, chipColor }: CardProps) {
  return (
    <article className="relative rounded-xl border border-surface-container-high/60 bg-surface-container-lowest p-space-xl shadow-sm transition-all duration-300 hover:shadow-md">
      <div className="space-y-space-lg">
        <div className="flex flex-wrap items-center justify-between gap-space-sm border-b border-surface-container-high pb-space-sm">
          <div className="flex items-baseline gap-space-sm">
            <span className={`font-latin text-3xl font-semibold ${numColor}`}>{num}</span>
            <span className="font-latin text-sm tracking-wider text-outline uppercase">/ {kicker}</span>
          </div>
          <span className={`rounded-full px-3 py-0.5 font-latin text-xs font-semibold tracking-wider ${chipColor}`}>{en}</span>
        </div>
        <div className="space-y-space-xs py-space-sm">
          <h3 className="font-serif-jp text-2xl font-bold tracking-tight text-on-surface">{title}</h3>
          <p className="text-sm text-on-surface-variant">{desc}</p>
        </div>
        <div className="pt-space-md">
          <CardLink href={href}>詳しく見る</CardLink>
        </div>
      </div>
    </article>
  );
}
