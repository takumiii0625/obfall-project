import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import SectionHeading from "@/components/SectionHeading";
import ValueCard, { type ValueCardItem } from "@/components/ValueCard";
import "../../service.css";

export const metadata: Metadata = {
  title: "脆弱性診断（Vulnerability Assessment） | OBFall Inc.",
};

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

/** 診断対象（Bootstrap Icons のクラス名 + ラベル） */
const TARGETS = [
  { icon: "bi-globe", label: "Webアプリ（Laravel, Rails, Node.js など）" },
  { icon: "bi-phone", label: "モバイルアプリ（iOS / Android / Flutter）" },
  { icon: "bi-diagram-3", label: "API / GraphQL / 外部連携" },
  { icon: "bi-gear", label: "管理画面・社内システム" },
  { icon: "bi-cloud", label: "クラウド設定診断（GCP / AWS）" },
];

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
 * 脆弱性診断紹介 GET /service/security（§2.1 #8）
 * 現行: resources/views/user/services/security.blade.php（クロージャルート、サーバー処理なし）
 */
export default function ServiceSecurityPage() {
  return (
    <div className="page-service page-service-security">
      <Header />

      <PageHero title="Security × Engineering" sub="安全は、後付けではなく、設計から。" variant="shield" />

      {/* リード文 */}
      <section className="sec">
        <div className="wrap">
          <p className="lead-text">
            私たちは、「開発を理解するセキュリティ専門チーム」として、
            <br className="d-none d-md-inline" />
            Webアプリ・モバイルアプリ・APIなどの脆弱性診断を提供しています。
            <br />
            開発現場の構造を理解したうえで&quot;攻撃者の視点&quot;からリスクを特定し、
            <br className="d-none d-md-inline" />
            再現性のある改善提案を通じて、プロダクトを安全に前進させます。
          </p>
        </div>
      </section>

      {/* 大切にしていること */}
      <section className="sec sec--alt">
        <div className="wrap">
          <SectionHeading kicker="Our Approach" title="脆弱性診断で大切にしていること" />
          <div className="value-grid value-grid--4">
            {APPROACH.map((v) => (
              <ValueCard key={v.num} {...v} />
            ))}
          </div>
        </div>
      </section>

      {/* 診断対象 */}
      <section className="sec">
        <div className="wrap">
          <SectionHeading kicker="Scope" title="診断対象" />
          <div className="target-list">
            {TARGETS.map((t) => (
              <div key={t.icon} className="target-item">
                <i className={`bi ${t.icon}`}></i> {t.label}
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* 選ばれる理由 */}
      <section className="sec sec--alt">
        <div className="wrap">
          <SectionHeading kicker="Why Us" title="選ばれる理由" />
          <div className="value-grid value-grid--4">
            {WHY_US.map((v) => (
              <ValueCard key={v.num} {...v} />
            ))}
          </div>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb parents={[{ label: "サービス", href: "/service" }]} current="脆弱性診断" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
