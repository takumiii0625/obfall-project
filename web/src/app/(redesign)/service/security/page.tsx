import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import LeadStatement from "@/components/redesign/LeadStatement";
import SectionTitle from "@/components/redesign/SectionTitle";
import BleedWord from "@/components/redesign/BleedWord";
import ValueCard, { type ValueCardItem } from "@/components/redesign/ValueCard";

export const metadata: Metadata = {
  title: "脆弱性診断（Vulnerability Assessment） | OBFall Inc.",
};

/** 文言は既存 (site)/service/security/_legacy/page.tsx の APPROACH / TARGETS / WHY_US */
const APPROACH: ValueCardItem[] = [
  {
    num: "01",
    kicker: "Integrity",
    title: "開発を知る診断チーム",
    desc: "私たちは自社でシステム開発も行うエンジニア集団です。実装の意図や設計思想を踏まえたうえで診断を行うため、「なぜその脆弱性が生まれたのか」「どう修正すべきか」まで踏み込んだ支援が可能です。",
  },
  {
    num: "02",
    kicker: "Tactics",
    title: "攻撃者の視点からの実践的アプローチ",
    desc: "ツール検査だけでなく、手動検証を中心とした実戦型診断を実施。入力値検証・認証認可・情報漏洩・セッション管理・設定不備など、実際の攻撃手法をシミュレーションし、ビジネスリスクを可視化します。",
  },
  {
    num: "03",
    kicker: "Integration",
    title: "開発と診断のワンストップ体制",
    desc: "開発フェーズからセキュリティを設計に組み込み、受託開発・SESチームと連携して脆弱性を未然に防止。診断結果は再発防止策や運用ガイドラインにまで落とし込みます。",
  },
  {
    num: "04",
    kicker: "Precision",
    title: "再現性と改善を重視したレポート",
    desc: "検出結果を「開発者が理解し、すぐ行動できる形」で提示。リスク説明と修正手順をセットで提供し、診断が\"一過性の報告\"で終わらないよう支援します。",
  },
];

/** 診断対象（既存は Bootstrap Icons。アイコンフォントを読み込まないためインライン SVG に置き換え） */
const TARGETS = [
  { icon: "globe", label: "Webアプリ（Laravel, Rails, Node.js など）" },
  { icon: "phone", label: "モバイルアプリ（iOS / Android / Flutter）" },
  { icon: "diagram", label: "API / GraphQL / 外部連携" },
  { icon: "gear", label: "管理画面・社内システム" },
  { icon: "cloud", label: "クラウド設定診断（GCP / AWS）" },
] as const;

const WHY_US: ValueCardItem[] = [
  {
    num: "01",
    kicker: "Integrate",
    title: "開発と診断を一社完結",
    desc: "「外部に委託せず、開発と診断を自社で行う」ため、情報漏洩リスクが低く、開発者との連携スピードも圧倒的。",
  },
  {
    num: "02",
    kicker: "Validation",
    title: "実践経験に基づく検証",
    desc: "診断員は全員が現役エンジニア。脆弱性の発生要因をコード・構成レベルで分析し、修正コストを最小限に抑える提案を行います。",
  },
  {
    num: "03",
    kicker: "Partnership",
    title: "伴走型セキュリティ支援",
    desc: "診断後も改修支援・再診断・運用設計までサポート。「脆弱性をなくすこと」ではなく「安全に成長し続けること」を目指します。",
  },
  {
    num: "04",
    kicker: "Flexibility",
    title: "コストと柔軟性のバランス",
    desc: "大手セキュリティベンダーのような高額コストや硬直的な体制ではなく、「必要な範囲を、最適なコストで」診断する柔軟なプランをご提案します。中間コストを省き、開発者が直接対応することで、品質とスピードを両立させた現実的なセキュリティ対策を実現します。",
  },
];

/**
 * 脆弱性診断紹介 GET /service/security（リデザイン版。service/contract の構成を流用）
 */
export default function ServiceSecurityPage() {
  const [a1, a2, a3, a4] = APPROACH;
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero label="SECURITY" title="Security × Engineering" />

        <LeadStatement
          statement="安全は、後付けではなく、設計から。"
          bodyCard
          body={
            <p>
              私たちは、「開発を理解するセキュリティ専門チーム」として、
              <br className="hidden lg:inline" />
              Webアプリ・モバイルアプリ・APIなどの脆弱性診断を提供しています。
              <br className="hidden lg:inline" />
              開発現場の構造を理解したうえで&quot;攻撃者の視点&quot;からリスクを特定し、
              <br className="hidden lg:inline" />
              再現性のある改善提案を通じて、プロダクトを安全に前進させます。
            </p>
          }
        />

        {/* 大切にしていること */}
        <section className="relative w-full overflow-clip border-y border-surface-container-high bg-surface-container-low py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-8 right-4 text-[110px] font-bold text-on-surface opacity-[0.035] lg:text-[160px]">APPROACH</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="Our Approach" title="脆弱性診断で大切にしていること" className="mb-space-2xl" />
            <div className="grid grid-cols-1 gap-space-lg lg:grid-cols-12">
              <ValueCard {...a1} size="lg" className="border-t-2 border-primary-container bg-surface-container-lowest lg:col-span-7" />
              <ValueCard {...a2} className="border border-surface-container-high bg-surface-container-lowest/80 lg:col-span-5" />
              <ValueCard {...a3} className="border border-surface-container-high bg-surface-container-lowest/80 lg:col-span-5" />
              <ValueCard {...a4} size="lg" className="border-t-2 border-on-primary-container bg-surface-container-lowest lg:col-span-7" />
            </div>
          </div>
        </section>

        {/* 診断対象 */}
        <section className="relative w-full overflow-clip border-b border-surface-container-high bg-surface-container-lowest py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-6 left-6 text-[120px] font-bold text-on-surface opacity-[0.03] lg:text-[180px]">SCOPE</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="Scope" title="診断対象" className="mb-space-2xl" />
            <ul className="grid grid-cols-1 gap-space-md md:grid-cols-2 lg:grid-cols-3">
              {TARGETS.map((t) => (
                <li key={t.icon} className="flex items-center gap-space-md rounded-lg border border-surface-container-high bg-surface-container-low/60 px-space-md py-space-sm">
                  <span className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-surface-container-lowest text-primary shadow-sm">
                    <TargetIcon kind={t.icon} />
                  </span>
                  <span className="text-sm text-on-surface lg:text-base">{t.label}</span>
                </li>
              ))}
            </ul>
          </div>
        </section>

        {/* 選ばれる理由 */}
        <section className="relative w-full overflow-clip border-b border-surface-container-high bg-surface-container-low py-space-2xl lg:py-space-3xl">
          <BleedWord className="top-8 right-4 text-[120px] font-bold text-on-surface opacity-[0.03] lg:text-[180px]">WHY US</BleedWord>
          <div className="wrap relative z-10">
            <SectionTitle kicker="Why Us" title="選ばれる理由" className="mb-space-2xl" />
            <div className="grid grid-cols-1 gap-space-lg lg:grid-cols-2">
              {WHY_US.map((v, i) => (
                <ValueCard
                  key={v.num}
                  {...v}
                  className={i % 3 === 0 ? "border-t-2 border-secondary bg-surface-container-lowest" : "border border-surface-container-high bg-surface-container-lowest"}
                />
              ))}
            </div>
          </div>
        </section>

        <Breadcrumb items={[{ label: "サービス", href: "/service" }, { label: "脆弱性診断" }]} />
      </main>
      <Footer />
    </>
  );
}

/** 診断対象のアイコン（線画の簡易 SVG。Bootstrap Icons の globe / phone / diagram-3 / gear / cloud に相当） */
function TargetIcon({ kind }: { kind: (typeof TARGETS)[number]["icon"] }) {
  const common = { className: "h-5 w-5", viewBox: "0 0 24 24", fill: "none", stroke: "currentColor", strokeWidth: 1.6, strokeLinecap: "round" as const, strokeLinejoin: "round" as const, "aria-hidden": true };
  switch (kind) {
    case "globe":
      return (
        <svg {...common}>
          <circle cx="12" cy="12" r="9" />
          <path d="M3 12h18M12 3c2.5 2.7 2.5 15.3 0 18M12 3c-2.5 2.7-2.5 15.3 0 18" />
        </svg>
      );
    case "phone":
      return (
        <svg {...common}>
          <rect x="7" y="2.5" width="10" height="19" rx="2" />
          <path d="M11 18h2" />
        </svg>
      );
    case "diagram":
      return (
        <svg {...common}>
          <rect x="9" y="3" width="6" height="4" rx="1" />
          <rect x="3" y="15" width="6" height="4" rx="1" />
          <rect x="15" y="15" width="6" height="4" rx="1" />
          <path d="M12 7v4M6 15v-2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2" />
        </svg>
      );
    case "gear":
      return (
        <svg {...common}>
          <circle cx="12" cy="12" r="3" />
          <path d="M12 2.5v3M12 18.5v3M2.5 12h3M18.5 12h3M5.3 5.3l2.1 2.1M16.6 16.6l2.1 2.1M5.3 18.7l2.1-2.1M16.6 7.4l2.1-2.1" />
        </svg>
      );
    case "cloud":
      return (
        <svg {...common}>
          <path d="M7 18a4 4 0 0 1-.5-8A6 6 0 0 1 18 9a4.5 4.5 0 0 1-.5 9z" />
        </svg>
      );
  }
}
