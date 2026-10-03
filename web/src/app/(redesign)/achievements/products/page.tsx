import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import LeadStatement from "@/components/redesign/LeadStatement";
import SectionTitle from "@/components/redesign/SectionTitle";
import CardLink from "@/components/redesign/CardLink";

export const metadata: Metadata = {
  title: "自社開発実績 | OBFall Inc.",
};

/**
 * プロダクト（文言は既存 (site)/achievements/products/_legacy/page.tsx の PRODUCTS）。
 * HTML は説明文の最初の一文を強調して残りを本文にしているため、既存の desc を文の区切りで分けて表示する（文言は同一）。
 */
const PRODUCTS = [
  {
    image: "/image/digOn_logo.png",
    alt: "digOn ロゴ",
    name: "digOn（ディグオン）",
    lead: "音楽と人の感性をつなぐ、新しい発見体験。",
    body: [
      "音楽との出会いをもっと自由に、もっと感覚的に。",
      "Flutter × Firebase × Webで構築された、クロスプラットフォーム対応の音楽アプリ。",
      "再生履歴・レコメンド・お気に入り管理など、ユーザー体験を重視したUIを設計。",
    ],
    link: { href: "https://dig-on.com/", label: "digOn公式サイト" },
  },
  {
    image: "/image/store-pass_logo.png",
    alt: "ストパス ロゴ",
    name: "ストパス（Store-Pass）",
    lead: "店舗とユーザーをつなぐ共通特典アプリ。",
    body: [
      "月額無料で、ユーザーは加盟店舗全体で特典を利用可能。",
      "「店舗をまたぐ特典利用」「垣根を超えた顧客体験」を実現するアプリとして開発。",
      "加盟店の情報表示や特典管理を統合し、地域の活性化を支える仕組みを提供しています。",
    ],
    link: { href: "https://store-pass.com", label: "Store-Pass公式サイト" },
  },
  {
    image: "/image/dx_logo.png",
    alt: "農業向け業務効率化 ロゴ",
    name: "未来共創DX支援事業",
    badge: "開発中",
    body: [
      "地域と人に寄り添うパートナーとして、デジタルの力で課題を解決し、お客様と共に新たな価値を生み出すことを目指しています。",
      "飲食・小売・農業など、多様な現場と対話を重ね、「現場のリアルな声」を大切にした、\"本当に使える\"仕組みづくりを進めています。",
      "現在は、農家の方々の販売・業務効率化を支援するECプラットフォームの開発を推進中です。",
    ],
  },
];

/**
 * 自社開発実績 GET /achievements/products（リデザイン版。design/stitch/achievements-products.html を参考）
 * HTML のロゴ枠はプレースホルダーだが、既存ページにロゴ画像があるためそれを表示する。
 */
export default function AchievementsProductsPage() {
  const [p1, p2, p3] = PRODUCTS;
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero label="ACHIEVEMENTS" title="Products" />

        <LeadStatement
          statement={
            <>
              人と社会の可能性を広げる、自社プロダクト。
              <br />
              OBFallの想いを、サービスというかたちで届ける。
            </>
          }
          body={
            <p>
              OBFallの自社開発は、社会の&quot;まだ満たされていないニーズ&quot;に焦点をあて、
              <br className="hidden lg:inline" />
              「テクノロジーで人生をより豊かにする」という理念を実践する取り組みです。
              <br className="hidden lg:inline" />
              便利さよりも、&quot;人がより自分らしく生きられる仕組み&quot;を目指し、
              <br className="hidden lg:inline" />
              発想から企画、開発、運用まですべて自社で行っています。
            </p>
          }
        />

        <section className="w-full bg-surface-container-low/60 py-space-2xl lg:py-space-3xl">
          <div className="wrap flex flex-col gap-space-2xl">
            <SectionTitle kicker="Our Products" title="プロダクト紹介" />

            <div className="grid grid-cols-1 gap-space-lg">
              {/* 01: 横長（ロゴ左・本文右） */}
              <article className="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm lg:p-space-xl">
                <div className="grid grid-cols-1 items-center gap-space-xl lg:grid-cols-12">
                  <LogoFrame image={p1.image} alt={p1.alt} className="aspect-[16/10] lg:col-span-5" />
                  <div className="flex h-full flex-col justify-between lg:col-span-7">
                    <div className="flex flex-col gap-space-sm">
                      <h3 className="font-serif-jp text-[22px] font-bold text-on-surface lg:text-[26px]">{p1.name}</h3>
                      <p className="text-base leading-relaxed font-semibold text-primary">{p1.lead}</p>
                      <div className="pt-space-xs">
                        <ProductBody lines={p1.body} />
                      </div>
                    </div>
                    {p1.link ? (
                      <div className="pt-space-lg">
                        <CardLink href={p1.link.href} newTab>
                          {p1.link.label}
                        </CardLink>
                      </div>
                    ) : null}
                  </div>
                </div>
              </article>

              {/* 02 / 03 */}
              <div className="grid grid-cols-1 gap-space-lg lg:grid-cols-2">
                {[p2, p3].map((p) => (
                  <article key={p.name} className="flex flex-col justify-between rounded-xl bg-surface-container-lowest p-space-lg shadow-sm">
                    <div className="flex flex-col gap-space-lg">
                      <LogoFrame image={p.image} alt={p.alt} className="aspect-[16/8]" />
                      <div className="flex flex-col gap-space-xs">
                        {p.badge ? (
                          <span className="w-fit rounded-full bg-surface-container-high px-2.5 py-0.5 text-xs font-medium text-on-surface-variant">{p.badge}</span>
                        ) : null}
                        <h3 className="pt-1 font-serif-jp text-[22px] font-bold text-on-surface">{p.name}</h3>
                        {p.lead ? <p className="pt-1 text-sm leading-normal font-semibold text-primary">{p.lead}</p> : null}
                        <div className="pt-space-xs">
                          <ProductBody lines={p.body} />
                        </div>
                      </div>
                    </div>
                    {p.link ? (
                      <div className="pt-space-xl">
                        <CardLink href={p.link.href} newTab>
                          {p.link.label}
                        </CardLink>
                      </div>
                    ) : null}
                  </article>
                ))}
              </div>
            </div>
          </div>
        </section>

        <Breadcrumb items={[{ label: "実績・事例紹介", href: "/achievements" }, { label: "自社開発" }]} />
      </main>
      <Footer />
    </>
  );
}

function LogoFrame({ image, alt, className = "" }: { image: string; alt: string; className?: string }) {
  return (
    <div className={`relative flex w-full items-center justify-center overflow-clip rounded-lg bg-surface-container-low p-space-lg ${className}`}>
      <div className="absolute inset-0 bg-gradient-to-tr from-primary-container/5 to-transparent" aria-hidden="true" />
      {/* eslint-disable-next-line @next/next/no-img-element */}
      <img src={image} alt={alt} className="relative max-h-full max-w-[60%] object-contain" loading="lazy" />
    </div>
  );
}

function ProductBody({ lines }: { lines: string[] }) {
  return (
    <p className="text-sm leading-[1.85] text-on-surface-variant">
      {lines.map((line, i) => (
        <span key={i}>
          {i > 0 ? <br className="hidden lg:inline" /> : null}
          {line}
        </span>
      ))}
    </p>
  );
}
