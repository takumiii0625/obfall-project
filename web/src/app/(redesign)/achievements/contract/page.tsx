import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import LeadStatement from "@/components/redesign/LeadStatement";

export const metadata: Metadata = {
  title: "受託開発実績 | OBFall Inc.",
};

/**
 * 受託開発実績 GET /achievements/contract（リデザイン版。achievements/products の構成を流用）
 * 個別プロジェクト（CareerLog / NoaChoice）の紹介は 2026-09-30 の会社の意向で削除済みのため、リードのみ。
 */
export default function AchievementsContractPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero
          breadcrumbs={[{ label: "実績・事例紹介", href: "/achievements" }, { label: "受託開発" }]}
          label="CONTRACT DEVELOPMENT"
          title="Contract Development"
        />

        <LeadStatement
          statement={
            <>
              ともにつくり、ともに前へ。
              <br />
              クライアントの想いを汲み取り、共に課題を解決するパートナーとして。
            </>
          }
          body={
            <p>
              OBFallの受託開発は、「作る」ことを目的とせず、「価値を生み出す」ことを目的とする開発です。
              <br />
              Webサービス、アプリケーション、業務システムなど多様な開発に対応しながら、
              <br className="hidden lg:inline" />
              企画から設計・デザイン・実装・セキュリティ診断まで一貫した体制で提供しています。
              <br />
              クライアントと同じ目線で課題を見つめ、長く続く価値を共に育てていきます。
            </p>
          }
        />
      </main>
      <Footer />
    </>
  );
}
