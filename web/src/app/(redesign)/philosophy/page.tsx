import type { Metadata } from "next";
import type { ReactNode } from "react";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Butterfly from "@/components/redesign/Butterfly";

export const metadata: Metadata = {
  title: "Philosophy | OBFall Inc.",
};

/**
 * 企業理念 GET /philosophy（リデザイン版。design/stitch/philosophy.html を参考）
 * 文言は既存 (site)/philosophy/_legacy/page.tsx のもの。
 */
export default function PhilosophyPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "企業理念" }]} label="PHILOSOPHY" title="Philosophy" />

        {/* 理念の一文 */}
        <section className="w-full bg-surface-container-low py-space-2xl">
          <div className="wrap">
            <div className="flex items-start gap-space-lg">
              <div className="mt-2 h-16 w-1.5 shrink-0 rounded-full bg-primary-container" aria-hidden="true" />
              <div className="font-serif-jp text-[24px] leading-tight font-bold tracking-normal text-on-surface lg:text-[34px]">
                <p>「あなたの、あなたによる、あなたのための」</p>
                <p className="mt-2 text-primary">をすべての人へ。</p>
              </div>
            </div>
          </div>
        </section>

        {/* Vision */}
        <section className="w-full py-space-2xl lg:py-space-3xl">
          <div className="wrap">
            <StatementCard kicker="Vision" accent="bg-primary-container" title="「あなたの、あなたによる、あなたのための」をすべての人へ。">
              テクノロジーの力で、人と社会の可能性を広げ、
              <br className="hidden lg:inline" />
              誰もが自分らしく生き、挑戦できる未来を目指します。
            </StatementCard>
          </div>
        </section>

        {/* Mission */}
        <section className="w-full bg-surface-container-low/50 py-space-2xl lg:py-space-3xl">
          <div className="wrap">
            <StatementCard
              kicker="Mission"
              accent="bg-secondary"
              title={
                <>
                  働くすべての人が、自分自身のために、
                  <br className="hidden lg:inline" />
                  自由にそして熱意を持って働ける社会をつくっていきます。
                </>
              }
            >
              その実現のために、私たちはテクノロジーを通じて、挑戦する人と組織を支え、
              <br className="hidden lg:inline" />
              &quot;つくる・支える・守る&quot;という3つの軸で、社会に新しい価値を届け続けます。
            </StatementCard>
          </div>
        </section>

        {/* Core Values */}
        <section className="w-full py-space-2xl lg:py-space-3xl">
          <div className="wrap">
            <div className="mb-space-2xl">
              <span className="mb-space-xs block font-latin text-xl tracking-widest text-primary">Core Values</span>
              <h2 className="font-serif-jp text-[28px] font-bold text-on-surface lg:text-[36px]">3つの柱</h2>
              <div className="mt-space-sm h-[2px] w-12 bg-primary-container" aria-hidden="true" />
            </div>
            <div className="grid grid-cols-1 gap-6 lg:grid-cols-12">
              <article className="relative flex flex-col items-start justify-between gap-space-xl rounded-xl bg-surface-container-lowest p-space-xl shadow-[0_8px_24px_rgba(0,159,232,0.07)] lg:col-span-12 lg:flex-row lg:items-center">
                <div className="flex max-w-2xl flex-col space-y-3">
                  <span className="font-latin text-2xl tracking-wider text-primary">01 / Principle</span>
                  <h3 className="font-serif-jp text-[24px] font-bold text-on-surface lg:text-[28px]">理念採用</h3>
                  <p className="pt-2 text-base leading-relaxed text-on-surface-variant">
                    共感を軸に、人と組織をつなぐ。理念に共鳴する仲間とともに、価値ある未来を創ります。
                  </p>
                </div>
              </article>
              <ValueCard num="02" kicker="Satisfaction" title="ES＝CS" className="bg-surface-container-lowest shadow-[0_8px_24px_rgba(0,159,232,0.07)] lg:col-span-6">
                働く人の幸福が、顧客の満足を生む。社員満足と顧客満足の両立を通じて、持続的な成長を目指します。
              </ValueCard>
              <ValueCard num="03" kicker="Growth & Challenge" title="成長と挑戦" className="bg-surface-container-high/40 shadow-[0_8px_24px_rgba(0,159,232,0.05)] lg:col-span-6">
                一人ひとりが自らの成長に挑み、変化を恐れず前へ。挑戦を後押しする文化を大切にします。
              </ValueCard>
            </div>
          </div>
        </section>

        {/* Message */}
        <section className="w-full bg-surface-container-low/40 py-space-2xl lg:py-space-3xl">
          <div className="wrap">
            <div className="rounded-xl bg-surface-container-lowest p-space-xl shadow-[0_8px_30px_rgba(0,159,232,0.06)]">
              <span className="mb-space-md block font-latin text-xl tracking-widest text-primary">Message</span>
              <h2 className="mb-space-xl font-serif-jp text-[26px] leading-snug font-bold text-on-surface lg:text-[34px]">人と社会が、ともに成長できる世界へ。</h2>
              <div className="max-w-3xl space-y-4 text-base leading-relaxed text-on-surface-variant">
                <p>OBFallは、ITの力で&quot;人&quot;と&quot;社会&quot;が共に成長できる世界を目指しています。</p>
                <p>働くことが、あなたの人生を豊かにする体験であってほしい。</p>
                <p>その想いを胸に、私たちは挑戦を続けていきます。</p>
              </div>
            </div>
          </div>
        </section>

        {/* Origin */}
        <section className="relative w-full overflow-clip py-space-2xl lg:py-space-3xl">
          <div className="wrap relative">
            <div className="relative flex flex-col items-start justify-between gap-space-xl overflow-clip rounded-xl bg-surface-container-lowest p-space-xl shadow-[0_8px_30px_rgba(0,159,232,0.06)] lg:flex-row">
              <div className="flex-1">
                <div className="mb-space-lg">
                  <span className="mb-space-xs block font-latin text-xl tracking-widest text-primary">Origin of Our Philosophy</span>
                  <h2 className="font-serif-jp text-[26px] font-bold text-on-surface lg:text-[34px]">理念と社名の由来</h2>
                  <div className="mt-space-sm h-[2px] w-12 bg-primary-container" aria-hidden="true" />
                </div>
                <div className="max-w-2xl space-y-5 text-base leading-relaxed text-on-surface-variant">
                  <p>「あなたの、あなたによる、あなたのための」という言葉は、アメリカ第16代大統領エイブラハム・リンカーンの演説に由来しています。</p>
                  <p>
                    社名 <strong className="font-bold text-on-surface">OBFall</strong> は、その演説に登場する &quot;of the people, by the people, for the
                    people&quot; に、<strong className="font-bold text-on-surface">&quot;すべての人へ（all）&quot;</strong> という想いを込めて名づけました。
                  </p>
                  <p>OBFallは、テクノロジーの力で、すべての人に可能性を届ける企業でありたいと考えています。</p>
                </div>
              </div>
              <div className="relative flex w-full items-center justify-center text-primary-container lg:w-64" aria-hidden="true">
                <Butterfly className="h-40 w-40" strokeWidth={0.4} />
              </div>
            </div>
          </div>
        </section>
      </main>
      <Footer />
    </>
  );
}

function StatementCard({ kicker, accent, title, children }: { kicker: string; accent: string; title: ReactNode; children: ReactNode }) {
  return (
    <div className="relative overflow-clip rounded-xl bg-surface-container-lowest p-space-xl shadow-[0_8px_30px_rgba(0,159,232,0.06)]">
      <div className={`absolute top-0 left-0 h-1 w-24 ${accent}`} aria-hidden="true" />
      <span className="mb-space-md block font-latin text-xl tracking-widest text-primary">{kicker}</span>
      <h2 className="mb-space-xl max-w-4xl font-serif-jp text-[24px] leading-snug font-bold text-on-surface lg:text-[32px]">{title}</h2>
      <p className="max-w-3xl text-base leading-relaxed text-on-surface-variant">{children}</p>
    </div>
  );
}

function ValueCard({
  num,
  kicker,
  title,
  className = "",
  children,
}: {
  num: string;
  kicker: string;
  title: string;
  className?: string;
  children: ReactNode;
}) {
  return (
    <article className={`rounded-xl p-space-xl ${className}`}>
      <span className="mb-space-xs block font-latin text-xl tracking-wider text-primary">
        {num} / {kicker}
      </span>
      <h3 className="mb-space-md font-serif-jp text-[22px] font-bold text-on-surface">{title}</h3>
      <p className="text-sm leading-relaxed text-on-surface-variant">{children}</p>
    </article>
  );
}
