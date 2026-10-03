import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import LeadStatement from "@/components/redesign/LeadStatement";
import SectionTitle from "@/components/redesign/SectionTitle";
import BleedWord from "@/components/redesign/BleedWord";
import ValueCard, { type ValueCardItem } from "@/components/redesign/ValueCard";
import CardLink from "@/components/redesign/CardLink";

export const metadata: Metadata = {
  title: "自社開発（Products） | OBFall Inc.",
};

/** 文言は既存 (site)/service/products/_legacy/page.tsx の VALUES / PRODUCTS */
const VALUES: ValueCardItem[] = [
  { num: "01", kicker: "Embody", title: "人の想いを形にする", desc: "誰かの「こうありたい」という想いを起点に、テクノロジーで実現へと近づけます。" },
  { num: "02", kicker: "Empathy", title: "社会に寄り添うサービスづくり", desc: "便利さや効率だけでなく、人と人のつながり・安心・挑戦を支える仕組みを届けます。" },
  { num: "03", kicker: "Cocreate", title: "共に育てるプロダクト", desc: "使う人と共に磨き、社会に溶け込む\"続いていく価値\"を生み出します。" },
];

const PRODUCTS = [
  { logo: "/image/digOn_logo.png", alt: "digOn ロゴ", name: "digOn", desc: "音楽発掘をもっと身近にする音楽アプリ" },
  { logo: "/image/store-pass_logo.png", alt: "ストパス ロゴ", name: "ストパス", desc: "ストア特化の来店・販促パスポート" },
  { logo: "/image/dx_logo.png", alt: "農業向け業務効率化 ロゴ", name: "農業DX", desc: "農作業と記録の効率化を支援", badge: "開発中" },
];

/**
 * 自社開発サービス紹介 GET /service/products（リデザイン版。service/contract の構成を流用）
 */
export default function ServiceProductsPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "サービス", href: "/service" }, { label: "自社開発" }]} label="PRODUCTS" title="IT × Vision" />

        <LeadStatement
          statement="人と社会の可能性を広げる、自社プロダクト。"
          bodyCard
          body={
            <p>
              OBFallの自社開発は、「テクノロジーで人生をより豊かにする」という理念をかたちにする取り組みです。
              <br className="hidden lg:inline" />
              人の生き方や働き方、暮らしの中にある課題を見つめ、
              <br className="hidden lg:inline" />
              誰もが自分らしく生きられる社会を実現するためのプロダクトを開発しています。
            </p>
          }
        />

        {/* 大切にしていること */}
        <section className="relative w-full overflow-clip border-y border-surface-container-high bg-surface-container-low py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-8 right-4 text-[110px] font-bold text-on-surface opacity-[0.035] lg:text-[160px]">VALUES</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="Our Values" title="プロダクト開発で大切にしていること" className="mb-space-2xl" />
            <div className="grid grid-cols-1 gap-space-lg lg:grid-cols-3">
              {VALUES.map((v, i) => (
                <ValueCard
                  key={v.num}
                  {...v}
                  className={i === 0 ? "border-t-2 border-primary-container bg-surface-container-lowest" : "border border-surface-container-high bg-surface-container-lowest/80"}
                />
              ))}
            </div>
          </div>
        </section>

        {/* 実績・事例紹介 */}
        <section className="relative w-full overflow-clip bg-surface-container-lowest py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-6 left-6 text-[120px] font-bold text-on-surface opacity-[0.03] lg:text-[180px]">PRODUCTS</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="Products" title="実績・事例紹介" className="mb-space-2xl" />
            <div className="grid grid-cols-1 gap-space-lg md:grid-cols-3">
              {PRODUCTS.map((p) => (
                <article key={p.name} className="flex flex-col items-center gap-space-md rounded-xl border border-surface-container-high bg-surface-container-low/60 p-space-lg text-center shadow-sm">
                  <div className="flex h-24 w-full items-center justify-center rounded-lg bg-surface-container-lowest p-space-sm">
                    {/* eslint-disable-next-line @next/next/no-img-element */}
                    <img src={p.logo} alt={p.alt} className="max-h-16 w-auto object-contain" loading="lazy" />
                  </div>
                  <div className="flex flex-col items-center gap-space-xs">
                    <h3 className="font-serif-jp text-xl font-bold text-on-surface">{p.name}</h3>
                    <p className="text-sm leading-relaxed text-on-surface-variant">{p.desc}</p>
                    {p.badge ? (
                      <span className="mt-1 rounded-full bg-surface-container-high px-2.5 py-0.5 text-xs font-medium text-on-surface-variant">{p.badge}</span>
                    ) : null}
                  </div>
                </article>
              ))}
            </div>
            <div className="pt-space-xl">
              <CardLink href="/achievements/products">実績を詳しく見る</CardLink>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </>
  );
}
