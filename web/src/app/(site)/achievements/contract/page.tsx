import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import SectionHeading from "@/components/SectionHeading";
import AchievementCard, { type AchievementCardItem } from "@/components/AchievementCard";
import "../achievements.css";

export const metadata: Metadata = {
  title: "受託開発実績 | OBFall Inc.",
};

const PROJECTS: AchievementCardItem[] = [
  {
    image: "/image/careerlog_logo.png",
    alt: "CareerLog ロゴ",
    name: "CareerLog（キャリアログ）",
    desc: "キャリアログは、社会人が業界・職種の経験者に1対1で相談できるOB/OG訪問サービス。 登録不要で今すぐOBを検索でき、実体験に基づくアドバイスで転職やキャリアの不安を解消し、自分だけの進路設計を後押しします。",
    link: { href: "https://career-log.com/", label: "CareerLog公式サイト" },
  },
  {
    image: "/image/NoaChoice_logo.jpg",
    alt: "NoaChoice ロゴ",
    name: "NoaChoice（ノアチョイス）",
    desc: "結婚式準備の\"探す・比べる・決める\"をオンラインで完結できるブライダルECサイトです。 ドレス・タキシード・和装・ジュエリー・ペーパーアイテム・引出物まで、厳選アイテムを適正価格でお届け。 サイズガイドと試着キット、パーソナルサポートで、初めての方でも安心してお選びいただけます。",
    link: { href: "https://noa-choice.com/", label: "NoaChoice公式サイト" },
    reverse: true,
  },
];

/**
 * 受託開発実績 GET /achievements/contract（§2.1 #11）
 * 現行: resources/views/user/achievements/contract.blade.php（クロージャルート、サーバー処理なし）
 */
export default function AchievementsContractPage() {
  return (
    <div className="page-achievements page-achievements-contract">
      <Header />

      <PageHero
        title="Contract Development"
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

      {/* 実績一覧 */}
      <section className="sec sec--alt">
        <div className="wrap">
          <SectionHeading kicker="Projects" title="プロジェクト紹介" />
          <div className="achievement-list">
            {PROJECTS.map((p) => (
              <AchievementCard key={p.name} {...p} />
            ))}
          </div>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb parents={[{ label: "実績・事例紹介", href: "/achievements" }]} current="受託開発" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
