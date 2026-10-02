import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import LeadStatement from "@/components/redesign/LeadStatement";
import SectionTitle from "@/components/redesign/SectionTitle";

export const metadata: Metadata = {
  title: "脆弱性診断実績 | OBFall Inc.",
};

/** スペック一覧（文言は既存 (site)/achievements/security/_legacy/page.tsx の SPECS） */
const SPECS = [
  { label: "開発言語", value: "JavaScript (Vue.js / React / TypeScript)、Java（Spring Boot）、PHP（Laravel）、Dart（Flutter）" },
  { label: "診断種別", value: "Webアプリケーション診断" },
  { label: "診断手法", value: "ツール（Burp Suite Professional）による自動診断 + 診断作業者による手動診断" },
  { label: "診断規模", value: "約100画面、約500機能" },
];

/**
 * 脆弱性診断実績 GET /achievements/security（リデザイン版。achievements/products の横長カードを流用）
 */
export default function AchievementsSecurityPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "実績・事例紹介", href: "/achievements" }, { label: "脆弱性診断" }]} label="SECURITY ASSESSMENT" title="Security Assessment" />

        <LeadStatement
          statement={
            <>
              安全は、後付けではなく、設計から。
              <br />
              開発と診断をワンストップで行い、
              <br />
              信頼できるプロダクトづくりを支えます。
            </>
          }
          body={
            <p>
              OBFallでは、開発現場を理解したエンジニアが脆弱性診断を実施しています。
              <br />
              システムの構造や業務要件を踏まえたうえで、
              <br className="hidden lg:inline" />
              「攻撃者の視点」と「開発者の視点」の両面から現実的なリスクを検証。
              <br />
              単なる報告にとどまらず、修正提案や再発防止まで一貫してサポートしています。
            </p>
          }
        />

        {/* 実績紹介 */}
        <section className="w-full bg-surface-container-low/60 py-space-2xl lg:py-space-3xl">
          <div className="wrap flex flex-col gap-space-2xl">
            <SectionTitle kicker="Assessment Results" title="実績紹介" />
            <article className="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm lg:p-space-xl">
              <div className="grid grid-cols-1 items-center gap-space-xl lg:grid-cols-12">
                <figure className="relative aspect-[4/3] w-full overflow-clip rounded-lg bg-surface-container-low lg:col-span-5">
                  {/* eslint-disable-next-line @next/next/no-img-element */}
                  <img src="/image/security.jpg" alt="脆弱性診断" className="h-full w-full object-cover" loading="lazy" />
                </figure>
                <div className="flex flex-col gap-space-md lg:col-span-7">
                  <h3 className="font-serif-jp text-[22px] font-bold text-on-surface lg:text-[26px]">Webアプリケーション脆弱性診断</h3>
                  <dl className="grid grid-cols-1 gap-space-md sm:grid-cols-2">
                    {SPECS.map((s) => (
                      <div key={s.label} className="rounded-lg border border-surface-container-high bg-surface-container-low/60 p-space-md">
                        <dt className="mb-1 text-sm font-medium text-primary">{s.label}</dt>
                        <dd className="text-sm leading-relaxed text-on-surface-variant">{s.value}</dd>
                      </div>
                    ))}
                  </dl>
                </div>
              </div>
            </article>
          </div>
        </section>

        {/* まとめ */}
        <section className="w-full bg-surface-container-lowest px-margin-mobile py-space-2xl text-center md:px-margin lg:py-space-3xl">
          <div className="mx-auto max-w-[840px]">
            <p className="font-serif-jp text-[18px] leading-[2] font-medium tracking-wide text-on-surface lg:text-[22px]">
              診断は&quot;終わり&quot;ではなく&quot;成長のはじまり&quot;。
              <br />
              開発を理解するセキュリティチームが、
              <br className="hidden lg:inline" />
              安心して使い続けられるプロダクトの実現を支えています。
            </p>
            <div className="mx-auto mt-space-lg h-[1.5px] w-16 bg-primary-container" aria-hidden="true" />
          </div>
        </section>
      </main>
      <Footer />
    </>
  );
}
