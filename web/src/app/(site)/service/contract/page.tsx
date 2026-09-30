import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import SectionHeading from "@/components/SectionHeading";
import ValueCard, { type ValueCardItem } from "@/components/ValueCard";
import "../service.css";

export const metadata: Metadata = {
  title: "受託開発（Contract Development） | OBFall Inc.",
};

const APPROACH: ValueCardItem[] = [
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

const WHY_US: ValueCardItem[] = [
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
 * 受託開発サービス紹介 GET /service/contract（§2.1 #6）
 * 現行: resources/views/user/services/contract.blade.php（クロージャルート、サーバー処理なし）
 * 2026-09-30: 現行にあった「実績・事例紹介」（CareerLog / NoaChoice のカード + 実績ページへのリンク）は会社の意向で削除
 */
export default function ServiceContractPage() {
  return (
    <div className="page-service page-service-contract">
      <Header />

      <PageHero
        title="IT × Collaboration"
        sub={
          <>
            ともにつくり、ともに前へ。
            <br />
            クライアントの想いを汲み取り、共に課題を解決するパートナーとして。
          </>
        }
        variant="connect"
      />

      {/* リード文 */}
      <section className="sec">
        <div className="wrap">
          <p className="lead-text">
            OBFallの受託開発は、「作る」ことを目的とせず、「価値を生み出す」ことを目的とする開発です。
            <br />
            Webサービス、アプリケーション、業務システムなど多様な開発に対応しながら、
            <br className="d-none d-md-inline" />
            企画から設計・デザイン・実装・セキュリティ診断まで一貫した体制で提供しています。
            <br />
            クライアントと同じ目線で課題を見つめ、長く続く価値を共に育てていきます。
          </p>
        </div>
      </section>

      {/* 大切にしていること */}
      <section className="sec sec--alt">
        <div className="wrap">
          <SectionHeading kicker="Our Approach" title="受託開発で大切にしていること" />
          <div className="value-grid value-grid--4">
            {APPROACH.map((v) => (
              <ValueCard key={v.num} {...v} />
            ))}
          </div>
        </div>
      </section>

      {/* 選ばれる理由 */}
      <section className="sec">
        <div className="wrap">
          <SectionHeading kicker="Why Us" title="選ばれる理由" />
          <div className="value-grid value-grid--3">
            {WHY_US.map((v) => (
              <ValueCard key={v.num} {...v} />
            ))}
          </div>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb parents={[{ label: "サービス", href: "/service" }]} current="受託開発" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
