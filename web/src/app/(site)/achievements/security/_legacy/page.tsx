import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import SectionHeading from "@/components/SectionHeading";
import AchievementCard from "@/components/AchievementCard";
import "../../achievements.css";

export const metadata: Metadata = {
  title: "脆弱性診断実績 | OBFall Inc.",
};

/** スペック一覧（現行 .spec-grid の 4 項目） */
const SPECS = [
  {
    label: "開発言語",
    value: "JavaScript (Vue.js / React / TypeScript)、Java（Spring Boot）、PHP（Laravel）、Dart（Flutter）",
  },
  { label: "診断種別", value: "Webアプリケーション診断" },
  { label: "診断手法", value: "ツール（Burp Suite Professional）による自動診断 + 診断作業者による手動診断" },
  { label: "診断規模", value: "約100画面、約500機能" },
];

/**
 * 脆弱性診断実績 GET /achievements/security（§2.1 #12）
 * 現行: resources/views/user/achievements/security.blade.php（クロージャルート、サーバー処理なし）
 */
export default function AchievementsSecurityPage() {
  return (
    <div className="page-achievements page-achievements-security">
      <Header />

      <PageHero
        title="Security Assessment"
        sub={
          <>
            安全は、後付けではなく、設計から。
            <br />
            開発と診断をワンストップで行い、
            <br />
            信頼できるプロダクトづくりを支えます。
          </>
        }
        variant="shield"
      />

      {/* リード文 */}
      <section className="sec">
        <div className="wrap">
          <p className="lead-text">
            OBFallでは、開発現場を理解したエンジニアが脆弱性診断を実施しています。
            <br />
            システムの構造や業務要件を踏まえたうえで、
            <br className="d-none d-md-inline" />
            「攻撃者の視点」と「開発者の視点」の両面から現実的なリスクを検証。
            <br />
            単なる報告にとどまらず、修正提案や再発防止まで一貫してサポートしています。
          </p>
        </div>
      </section>

      {/* 実績紹介 */}
      <section className="sec sec--alt">
        <div className="wrap">
          <SectionHeading kicker="Assessment Results" title="実績紹介" />
          <div className="achievement-list">
            <AchievementCard
              image="/image/security.jpg"
              alt="脆弱性診断"
              imageKind="photo"
              name="Webアプリケーション脆弱性診断"
            >
              <div className="spec-grid">
                {SPECS.map((s) => (
                  <div key={s.label} className="spec-item">
                    <div className="spec-item__label">{s.label}</div>
                    <p className="spec-item__value">{s.value}</p>
                  </div>
                ))}
              </div>
            </AchievementCard>
          </div>
        </div>
      </section>

      {/* まとめ */}
      <section className="sec">
        <div className="wrap">
          <p className="closing-text">
            診断は&quot;終わり&quot;ではなく&quot;成長のはじまり&quot;。
            <br />
            開発を理解するセキュリティチームが、
            <br className="d-none d-md-inline" />
            安心して使い続けられるプロダクトの実現を支えています。
          </p>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb parents={[{ label: "実績・事例紹介", href: "/achievements" }]} current="脆弱性診断" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
