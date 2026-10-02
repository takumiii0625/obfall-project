import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import "../../achievements.css";

export const metadata: Metadata = {
  title: "受託開発実績 | OBFall Inc.",
};

/**
 * 受託開発実績 GET /achievements/contract（§2.1 #11）
 * 現行: resources/views/user/achievements/contract.blade.php（クロージャルート、サーバー処理なし）
 * 2026-09-30: 現行にあった個別プロジェクト（CareerLog / NoaChoice）の紹介セクションは会社の意向で削除
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
