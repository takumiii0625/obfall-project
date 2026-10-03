import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import SectionTitle from "@/components/redesign/SectionTitle";
import BleedWord from "@/components/redesign/BleedWord";
import Butterfly from "@/components/redesign/Butterfly";
import ValueCard from "@/components/redesign/ValueCard";

export const metadata: Metadata = {
  title: "受託開発（Contract Development） | OBFall Inc.",
};

/** 文言は既存 (site)/service/contract/_legacy/page.tsx の APPROACH / WHY_US */
const APPROACH = [
  {
    num: "01",
    kicker: "Insight",
    title: "本質をともに見つめる",
    desc: "課題を「作ること」ではなく「解決すること」として捉え、共に考え抜く。クライアントの想いや事業の背景を深く理解し、長期的な成長を見据えた開発を行います。",
  },
  {
    num: "02",
    kicker: "Synthesis",
    title: "デザインと技術の融合",
    desc: "使いやすさ・伝わりやすさ・拡張性を意識し、想いをかたちに。UI/UX・機能性・パフォーマンスのすべてで\"心地よく使われる体験\"を設計します。",
  },
  {
    num: "03",
    kicker: "Reliability",
    title: "安心まで届ける開発体制",
    desc: "開発後には、自社のセキュリティチームによる脆弱性診断を実施。見た目や機能だけでなく、安全性まで一貫して担保できることが私たちの強みです。「創って終わり」ではなく、「安心して使い続けられる」未来を届けます。",
  },
  {
    num: "04",
    kicker: "Partnership",
    title: "長く続く関係を築く",
    desc: "納品して終わりではなく、成長と変化に寄り添う\"伴走型\"の開発を大切に。プロダクトの成長を共に見届けながら、技術支援・改善提案を継続的に行います。",
  },
];

const WHY_US = [
  {
    num: "01",
    kicker: "Cocreation",
    title: "共創の姿勢",
    desc: "単なる受託ではなく、クライアントのビジョンを共有し、同じチームとして挑む。プロジェクトの成功を「成果物の完成」ではなく「価値の創出」として捉えます。",
  },
  {
    num: "02",
    kicker: "Consistency",
    title: "一貫した技術力と体制",
    desc: "企画から設計・デザイン・開発・診断までをワンストップで対応。社内のエンジニア・デザイナー・セキュリティチームが密に連携し、品質・スピード・安心をすべて両立させます。",
  },
  {
    num: "03",
    kicker: "Empowerment",
    title: "成長を支える開発文化",
    desc: "自社開発・SESで培ったノウハウを常にアップデートし、プロジェクトごとに新しい価値を生み出す仕組みを持っています。開発を通じて、人も、企業も、社会も前へ進むことを目指します。",
  },
];

/**
 * 受託開発サービス紹介 GET /service/contract（リデザイン版。design/stitch/service-contract.html を参考）
 * HTML 末尾の「実績・事例紹介」（CareerLog / NoaChoice）は 2026-09-30 の会社の意向で既存ページから削除済みのため置かない。
 */
export default function ServiceContractPage() {
  const [a1, a2, a3, a4] = APPROACH;
  const [w1, w2, w3] = WHY_US;
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "サービス", href: "/service" }, { label: "受託開発" }]} label="CONTRACT DEVELOPMENT" title="IT × Collaboration" />

        {/* リード */}
        <section className="relative w-full overflow-clip border-b border-surface-container-high bg-surface-container-lowest py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-4 left-4 text-[120px] font-bold text-on-surface opacity-[0.03] lg:text-[180px]">COLLABORATION</BleedWord>
          <div className="wrap relative z-10">
            <div className="grid grid-cols-1 items-start gap-space-xl lg:grid-cols-12">
              <div className="border-l-2 border-primary-container py-2 pl-space-md lg:col-span-5">
                <p className="mb-4 font-serif-jp text-2xl leading-relaxed font-bold text-on-surface">ともにつくり、ともに前へ。</p>
                <p className="font-serif-jp text-base leading-relaxed text-secondary">
                  クライアントの想いを汲み取り、共に課題を解決するパートナーとして。
                </p>
              </div>
              <div className="rounded-sm border border-surface-container-high bg-surface-container-low p-space-lg shadow-sm lg:col-span-7 lg:p-space-xl">
                <p className="text-sm leading-loose text-on-surface-variant lg:text-base">
                  OBFallの受託開発は、「作る」ことを目的とせず、「価値を生み出す」ことを目的とする開発です。
                  <br className="hidden lg:inline" />
                  Webサービス、アプリケーション、業務システムなど多様な開発に対応しながら、
                  <br className="hidden lg:inline" />
                  企画から設計・デザイン・実装・セキュリティ診断まで一貫した体制で提供しています。
                  <br className="hidden lg:inline" />
                  クライアントと同じ目線で課題を見つめ、長く続く価値を共に育てていきます。
                </p>
              </div>
            </div>
          </div>
          <div className="absolute right-8 bottom-4 text-primary-container opacity-40">
            <Butterfly className="h-16 w-16" fill="rgba(255,255,255,0.9)" body="#009fe8" />
          </div>
        </section>

        {/* 大切にしていること */}
        <section className="relative w-full overflow-clip border-b border-surface-container-high bg-surface-container-low py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-8 right-4 text-[110px] font-bold text-on-surface opacity-[0.035] lg:text-[160px]">APPROACH</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="Our Approach" title="受託開発で大切にしていること" className="mb-space-2xl" />
            <div className="grid grid-cols-1 gap-space-lg lg:grid-cols-12">
              <ValueCard {...a1} size="lg" className="border-t-2 border-primary-container bg-surface-container-lowest lg:col-span-7" />
              <ValueCard {...a2} className="border border-surface-container-high bg-surface-container-lowest/80 lg:col-span-5" />
              <ValueCard {...a3} className="border border-surface-container-high bg-surface-container-lowest/80 lg:col-span-5" />
              <ValueCard {...a4} size="lg" className="border-t-2 border-on-primary-container bg-surface-container-lowest lg:col-span-7" />
            </div>
          </div>
        </section>

        {/* 選ばれる理由 */}
        <section className="relative w-full overflow-clip border-b border-surface-container-high bg-surface-container-lowest py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-6 left-6 text-[120px] font-bold text-on-surface opacity-[0.03] lg:text-[180px]">WHY US</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="Why Us" title="選ばれる理由" className="mb-space-2xl" />
            <div className="space-y-space-lg">
              <article className="border-l-4 border-primary-container bg-gradient-to-br from-surface-container-low to-surface-container-lowest p-space-lg shadow-sm lg:p-space-xl">
                <div className="grid grid-cols-1 items-baseline gap-space-md lg:grid-cols-12 lg:gap-space-lg">
                  <div className="lg:col-span-4">
                    <span className="mb-1 block font-latin text-2xl font-normal tracking-wider text-primary">
                      {w1.num} / {w1.kicker}
                    </span>
                    <h3 className="font-serif-jp text-2xl font-bold text-on-surface">{w1.title}</h3>
                  </div>
                  <div className="lg:col-span-8">
                    <p className="text-sm leading-relaxed text-on-surface-variant lg:text-base">{w1.desc}</p>
                  </div>
                </div>
              </article>
              <div className="grid grid-cols-1 items-stretch gap-space-lg lg:grid-cols-2">
                <ValueCard {...w2} className="border border-surface-container-high bg-surface-container-lowest" />
                <ValueCard {...w3} className="border-t-2 border-secondary bg-surface-container-low" />
              </div>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </>
  );
}
