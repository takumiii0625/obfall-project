import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import LeadStatement from "@/components/redesign/LeadStatement";
import SectionTitle from "@/components/redesign/SectionTitle";
import BleedWord from "@/components/redesign/BleedWord";
import ValueCard, { type ValueCardItem } from "@/components/redesign/ValueCard";

export const metadata: Metadata = {
  title: "SES（技術支援） | OBFall Inc.",
};

/** 文言は既存 (site)/service/ses/_legacy/page.tsx の ABOUT / WHY_US */
const ABOUT: ValueCardItem[] = [
  {
    num: "01",
    kicker: "Vision",
    title: "私たちの想い",
    desc: "人が主役の現場を、もっと誇れる場所に。OBFallのSESは、エンジニア一人ひとりが自分らしく力を発揮できる環境をつくることで、企業と人の\"成長の循環\"を生み出します。単なる人材支援ではなく、共に挑み、共に成長するパートナーとして並走します。",
  },
  {
    num: "02",
    kicker: "Service",
    title: "サービス概要",
    desc: "私たちは、クライアントの現場課題に最も適したエンジニアをアサインし、開発・運用・保守などのプロジェクトを技術面とチーム面から支援します。配属後も定期的なフォローやスキルアップ支援を行い、長期的な関係構築と高品質な成果創出を両立します。",
  },
];

const WHY_US: ValueCardItem[] = [
  {
    num: "01",
    kicker: "Empathy",
    title: "\"人\"を中心とした関係づくり",
    desc: "スキルシートだけでなく、価値観やキャリアビジョンまでを見据え、企業と人が共に成長できる\"関係\"を設計します。「どんな現場ならその人が最も輝くか」を起点に考え、人とチームの可能性を最大限に引き出します。",
  },
  {
    num: "02",
    kicker: "Growth",
    title: "継続的な伴走と成長支援",
    desc: "配属後もチーム単位でフォローし、キャリアアップ・スキル共有・勉強会など人と組織が共に進化する環境を提供します。",
  },
  {
    num: "03",
    kicker: "Craftsmanship",
    title: "現場で磨かれる技術力",
    desc: "OBFallでは、自社開発・受託開発を通じて技術を磨き続けています。その実践的な知見と経験が、SESにおいても高い提案力と課題解決力を支えています。現場に\"成長と信頼\"という価値をもたらすのが、私たちの強みです。",
  },
];

/**
 * SES紹介 GET /service/ses（リデザイン版。service/contract の構成を流用、メッセージは philosophy のカードを流用）
 */
export default function ServiceSesPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "サービス", href: "/service" }, { label: "SES" }]} label="SERVICE" title="IT × Team" />

        <LeadStatement
          statement="人が輝く現場を、技術で支える。"
          bodyCard
          body={
            <p>
              エンジニアが力を発揮できる環境を整え、技術とチームの両面から現場を支援。
              <br />
              「人」と「組織」がともに成長する関係を築くことが、OBFallのSESです。
            </p>
          }
        />

        {/* サービスについて */}
        <section className="relative w-full overflow-clip border-y border-surface-container-high bg-surface-container-low py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-8 right-4 text-[100px] font-bold text-on-surface opacity-[0.035] lg:text-[150px]">ABOUT SES</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="About SES" title="サービスについて" className="mb-space-2xl" />
            <div className="grid grid-cols-1 gap-space-lg lg:grid-cols-2">
              <ValueCard {...ABOUT[0]} size="lg" className="border-t-2 border-primary-container bg-surface-container-lowest" />
              <ValueCard {...ABOUT[1]} size="lg" className="border-t-2 border-on-primary-container bg-surface-container-lowest" />
            </div>
          </div>
        </section>

        {/* 選ばれる理由 */}
        <section className="relative w-full overflow-clip border-b border-surface-container-high bg-surface-container-lowest py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-6 left-6 text-[120px] font-bold text-on-surface opacity-[0.03] lg:text-[180px]">WHY US</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="Why Us" title="OBFallのSESが選ばれる理由" align="right" className="mb-space-2xl" />
            <div className="grid grid-cols-1 gap-space-lg lg:grid-cols-3">
              {WHY_US.map((v, i) => (
                <ValueCard
                  key={v.num}
                  {...v}
                  className={i === 2 ? "border-t-2 border-secondary bg-surface-container-low" : "border border-surface-container-high bg-surface-container-lowest"}
                />
              ))}
            </div>
          </div>
        </section>

        {/* メッセージ */}
        <section className="w-full bg-surface-container-low/40 py-space-2xl lg:py-space-3xl">
          <div className="wrap">
            <div className="rounded-xl bg-surface-container-lowest p-space-xl shadow-[0_8px_30px_rgba(0,159,232,0.06)]">
              <span className="mb-space-md block font-latin text-xl tracking-widest text-primary">Message</span>
              <h2 className="mb-space-xl font-serif-jp text-[26px] leading-snug font-bold text-on-surface lg:text-[34px]">メッセージ</h2>
              <p className="max-w-3xl text-base leading-relaxed text-on-surface-variant">
                SESを、&quot;人を送るビジネス&quot;から&quot;人が活きる仕組み&quot;へ。
                <br />
                OBFallは、ITの力で働く人と企業の関係をより良くデザインしていきます。
              </p>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </>
  );
}
