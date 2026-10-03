import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import LeadStatement from "@/components/redesign/LeadStatement";
import CardLink from "@/components/redesign/CardLink";

export const metadata: Metadata = {
  title: "Achievements | OBFall Inc.",
};

/** 3領域（文言は既存 (site)/achievements/_legacy/page.tsx の AREAS） */
const AREAS = [
  {
    num: "01",
    kicker: "PRODUCTS",
    title: "自社開発",
    en: "IT × Vision",
    desc: "人と社会の可能性を広げる、自社プロダクト。OBFallの想いを、サービスというかたちで届けます。",
    href: "/achievements/products",
    chip: "bg-secondary-fixed text-on-secondary-fixed",
  },
  {
    num: "02",
    kicker: "CONTRACT DEVELOPMENT",
    title: "受託開発",
    en: "IT × Collaboration",
    desc: "ともにつくり、ともに前へ。クライアントの想いを汲み取り、共に課題を解決するパートナーとして伴走します。",
    href: "/achievements/contract",
    chip: "bg-secondary-fixed text-on-secondary-fixed",
  },
  {
    num: "03",
    kicker: "SECURITY ASSESSMENT",
    title: "脆弱性診断",
    en: "Security × Engineering",
    desc: "安全は、後付けではなく、設計から。開発と診断をワンストップで行い、信頼できるプロダクトづくりを支えます。",
    href: "/achievements/security",
    chip: "bg-tertiary-fixed text-on-tertiary-fixed",
  },
];

/**
 * 実績トップ GET /achievements（リデザイン版。design/stitch/achievements.html を参考）
 * 01 は横長の大カード、02・03 は 2 列。
 */
export default function AchievementsPage() {
  const [a1, a2, a3] = AREAS;
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero title="Achievements" />

        <LeadStatement
          statement={
            <>
              ITの力で、人と社会の可能性を広げる。
              <br />
              OBFallの挑戦と成果。
            </>
          }
          body={
            <>
              <p>
                私たちは、「テクノロジーで人生をより豊かにする」という理念のもと、
                <br className="hidden lg:inline" />
                自社開発・受託開発・脆弱性診断の3つの領域で、
                <br className="hidden lg:inline" />
                社会や現場の課題を&quot;仕組み&quot;として解決してきました。
              </p>
              <p className="mt-4">
                ここで紹介するのは、私たちの手で形にしてきたプロジェクトたち。
                <br className="hidden lg:inline" />
                どれも、「人」や「社会」に新しい選択肢を生み出すための挑戦です。
              </p>
            </>
          }
        />

        <section className="relative w-full bg-surface-container-low py-space-2xl lg:py-space-3xl">
          <div className="wrap space-y-space-lg">
            {/* 01: 横長 */}
            <article className="relative w-full overflow-clip rounded-xl bg-surface-container-lowest p-space-xl shadow-sm transition-shadow hover:shadow-md">
              <div className="absolute top-0 right-0 left-0 h-1 rounded-t-full bg-gradient-to-r from-primary via-primary-container to-tertiary-container" aria-hidden="true" />
              <div className="flex flex-col justify-between gap-space-lg pt-2 lg:flex-row lg:items-end">
                <div className="max-w-3xl space-y-space-md">
                  <div className="flex flex-wrap items-center gap-space-md">
                    <span className="font-latin text-lg font-semibold tracking-wider text-secondary">
                      {a1.num} / {a1.kicker}
                    </span>
                    <span className={`inline-flex items-center rounded-full px-3 py-0.5 text-[11px] font-bold tracking-[0.08em] ${a1.chip}`}>{a1.en}</span>
                  </div>
                  <h2 className="font-serif-jp text-[28px] font-bold tracking-tight text-on-surface lg:text-[36px]">{a1.title}</h2>
                  <p className="text-base leading-relaxed text-on-surface-variant">{a1.desc}</p>
                </div>
                <CardLink href={a1.href}>詳しく見る</CardLink>
              </div>
            </article>

            {/* 02 / 03 */}
            <div className="grid grid-cols-1 items-stretch gap-space-lg lg:grid-cols-2">
              {[a2, a3].map((a) => (
                <article key={a.href} className="flex flex-col justify-between rounded-xl bg-surface-container-lowest p-space-xl shadow-sm transition-shadow hover:shadow-md">
                  <div className="space-y-space-md">
                    <div className="flex flex-wrap items-center gap-3">
                      <span className="font-latin text-lg font-semibold tracking-wider text-secondary">
                        {a.num} / {a.kicker}
                      </span>
                      <span className={`inline-flex items-center rounded-full px-3 py-0.5 text-[11px] font-bold tracking-[0.08em] ${a.chip}`}>{a.en}</span>
                    </div>
                    <h2 className="font-serif-jp text-[24px] font-bold tracking-tight text-on-surface lg:text-[28px]">{a.title}</h2>
                    <p className="text-sm leading-relaxed text-on-surface-variant">{a.desc}</p>
                  </div>
                  <div className="pt-space-xl">
                    <CardLink href={a.href}>詳しく見る</CardLink>
                  </div>
                </article>
              ))}
            </div>
          </div>
        </section>

        <Breadcrumb items={[{ label: "実績・事例紹介" }]} />
      </main>
      <Footer />
    </>
  );
}
