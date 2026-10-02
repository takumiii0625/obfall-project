import Link from "next/link";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import Butterfly from "@/components/redesign/Butterfly";
import TextLink from "@/components/redesign/TextLink";
import { getTopNewses } from "@/lib/newses";

/**
 * トップ GET /（リデザイン版。design/stitch/top.html を参考）
 *
 * - 文言は既存トップ（src/app/(site)/_legacy-top/page.tsx と components/top/HeroSection.tsx）のものを正とする
 * - お知らせは既存と同じく DB（newses）から公開中の先頭3件。ISR（NEWS_REVALIDATE_SECONDS）+ 保存時のオンデマンド再検証
 * - アニメーションは入れない（フェーズ1）
 * - 装飾は HTML を正とし、蝶のモチーフと背景の大きな英字（bleed word）を再現。DESIGN.md のグラスモーフィズム等は採用しない
 * - はみ出す装飾を持つセクションは overflow-hidden ではなく overflow-clip にする（hidden だとスクロールコンテナになり、
 *   アンカー遷移や scrollIntoView で中身が横にずれることがある）
 */
export const revalidate = 600;

/** セクション背景に敷く大きな英字（HTML の Bleed Background Text） */
function BleedWord({ children, className }: { children: string; className: string }) {
  return (
    <div className={`pointer-events-none absolute z-0 select-none ${className}`} aria-hidden="true">
      <span className="inline-block font-latin leading-none font-normal">{children}</span>
    </div>
  );
}

/** 見出し下のアクセント線 */
function AccentBar({ className = "bg-primary" }: { className?: string }) {
  return <div className={`h-[2px] w-12 ${className}`} aria-hidden="true" />;
}

const SERVICES = [
  { num: "01", name: "自社開発", bg: "bg-surface-container-low", offset: "lg:translate-y-0" },
  { num: "02", name: "受託開発", bg: "bg-surface", offset: "lg:translate-y-8" },
  { num: "03", name: "脆弱性診断", bg: "bg-surface", offset: "lg:-translate-y-4" },
  { num: "04", name: "SES", bg: "bg-surface-container-low", offset: "lg:translate-y-4" },
];

export default async function Home() {
  const newsList = await getTopNewses();

  return (
    <>
      <Header />

      <main className="w-full overflow-clip bg-background pt-20">
        {/* ── HERO ── */}
        <section className="relative -mt-20 flex min-h-[92vh] w-full items-center justify-center overflow-clip bg-gradient-to-br from-[#003254] via-[#004e8c] to-[#00a6ff] px-margin-mobile pt-20 text-on-primary md:px-margin">
          {/* 翅の葉脈のような線（HTML の Butterfly Venation） */}
          <div className="pointer-events-none absolute inset-0 opacity-25 mix-blend-screen" aria-hidden="true">
            <svg className="h-full w-full scale-110" fill="none" viewBox="0 0 1200 900" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
              <path d="M 600,450 C 420,180 200,80 50,160 C -40,210 20,430 180,520 C 320,600 480,510 600,450 Z" stroke="rgba(255,255,255,0.7)" strokeWidth="1.2" />
              <path d="M 600,450 C 500,280 320,200 120,230" stroke="rgba(255,255,255,0.5)" strokeWidth="0.8" />
              <path d="M 520,380 C 410,290 280,260 140,310" stroke="rgba(255,255,255,0.4)" strokeWidth="0.7" />
              <path d="M 450,420 C 360,370 260,360 160,430" stroke="rgba(255,255,255,0.4)" strokeWidth="0.7" />
              <path d="M 600,450 C 470,550 310,680 140,640 C 60,620 90,520 220,480" stroke="rgba(255,255,255,0.5)" strokeWidth="0.8" />
              <path d="M 600,450 C 780,180 1000,80 1150,160 C 1240,210 1180,430 1020,520 C 880,600 720,510 600,450 Z" stroke="rgba(255,255,255,0.7)" strokeWidth="1.2" />
              <path d="M 600,450 C 700,280 880,200 1080,230" stroke="rgba(255,255,255,0.5)" strokeWidth="0.8" />
              <path d="M 680,380 C 790,290 920,260 1060,310" stroke="rgba(255,255,255,0.4)" strokeWidth="0.7" />
              <path d="M 750,420 C 840,370 940,360 1040,430" stroke="rgba(255,255,255,0.4)" strokeWidth="0.7" />
              <path d="M 600,450 C 730,550 890,680 1060,640 C 1140,620 1110,520 980,480" stroke="rgba(255,255,255,0.5)" strokeWidth="0.8" />
              <path d="M 600,120 L 600,780" stroke="rgba(255,255,255,0.2)" strokeDasharray="3 6" strokeWidth="1" />
            </svg>
          </div>

          <div className="relative z-10 mx-auto flex w-full max-w-[1180px] flex-col justify-between py-space-3xl">
            <div className="my-auto max-w-3xl space-y-space-xl">
              <h1 className="font-serif-jp text-[36px] leading-[1.3] font-bold tracking-tight text-on-primary sm:text-[46px] lg:text-[58px]">
                <span className="block">「あなたの、あなたによる、あなたのための」</span>
                <span className="mt-2 block text-[26px] font-normal tracking-widest text-primary-fixed sm:text-[34px] lg:text-[42px]">を全てのひとへ</span>
              </h1>
              <p className="max-w-xl text-[15px] leading-[2.1] tracking-wide text-surface-container-low opacity-95 sm:text-[17px]">
                私たちは皆、人生の主人公です。働くことも人生の一部。
                <br />
                OBFall株式会社は、従来にない新しい会社の形を実現します。
              </p>
              <div className="pt-space-md">
                <TextLink href="/philosophy" tone="inverse">
                  企業理念はこちら
                </TextLink>
              </div>
            </div>
          </div>

          <div className="absolute bottom-0 left-1/2 z-30 -translate-x-1/2 translate-y-1/2 text-primary-container drop-shadow-[0_4px_12px_rgba(0,162,211,0.4)]">
            <Butterfly className="h-12 w-12" />
          </div>
        </section>

        {/* ── SERVICE ── */}
        <section className="relative w-full overflow-clip bg-surface-container-lowest py-space-3xl text-on-surface">
          <BleedWord className="top-1/2 -left-20 -translate-y-1/2 text-[170px] tracking-tighter text-surface-container/60 sm:text-[230px] lg:text-[320px]">
            SERVICE
          </BleedWord>

          <div className="wrap relative z-10">
            <div className="grid grid-cols-1 items-start gap-space-2xl lg:grid-cols-12">
              <div className="space-y-space-lg lg:col-span-5">
                <div className="space-y-space-md">
                  <h2 className="font-serif-jp text-[30px] leading-[1.4] font-bold text-on-surface sm:text-[38px]">
                    ITの力で、
                    <br />
                    人と社会の可能性を広げる。
                  </h2>
                  <AccentBar />
                </div>
                <p className="text-[15px] leading-[2.1] text-on-surface-variant sm:text-[16px]">
                  自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、人々の人生をより豊かにします。
                </p>
                <div className="pt-space-sm">
                  <TextLink href="/service">サービス詳細画面へ</TextLink>
                </div>
              </div>

              <div className="grid grid-cols-1 gap-space-lg pt-4 sm:grid-cols-2 lg:col-span-7">
                {SERVICES.map((s) => (
                  <div
                    key={s.num}
                    className={`rounded-xl p-space-xl shadow-sm transition-all duration-300 hover:shadow-md ${s.bg} ${s.offset}`}
                  >
                    <div className="mb-space-sm font-latin text-[13px] font-bold tracking-widest text-tertiary-container">{s.num}</div>
                    <h3 className="mb-space-xs font-serif-jp text-[20px] font-bold text-on-surface">{s.name}</h3>
                    <div className="h-px w-8 bg-primary-container/40" aria-hidden="true" />
                  </div>
                ))}
              </div>
            </div>
          </div>

          <div className="absolute right-1/4 -bottom-6 z-30 rotate-12 text-primary drop-shadow-[0_2px_8px_rgba(0,100,148,0.2)]">
            <Butterfly className="h-10 w-10" fill="rgba(240,248,253,0.9)" body="#009fe8" />
          </div>
        </section>

        {/* ── ACHIEVEMENTS ── */}
        <section className="relative w-full overflow-clip bg-surface-container-low py-space-3xl text-on-surface">
          <BleedWord className="top-1/2 -right-24 -translate-y-1/2 text-[140px] tracking-tighter text-surface-container-high/50 sm:text-[210px] lg:text-[290px]">
            ACHIEVEMENTS
          </BleedWord>

          <div className="wrap relative z-10">
            <div className="grid grid-cols-1 items-center gap-space-2xl lg:grid-cols-12">
              {/* つくる・支える・守る */}
              <div className="relative order-2 lg:order-1 lg:col-span-6">
                <svg
                  className="pointer-events-none absolute top-1/2 left-0 h-32 w-full -translate-y-1/2 text-secondary opacity-40"
                  fill="none"
                  viewBox="0 0 500 120"
                  preserveAspectRatio="none"
                  aria-hidden="true"
                >
                  <path d="M 10 80 Q 130 10, 250 70 T 490 50" stroke="currentColor" strokeDasharray="6 8" strokeWidth="2" />
                </svg>
                <div className="relative flex items-center justify-between gap-2 py-space-xl sm:gap-4">
                  <div className="flex -rotate-2 flex-col items-center rounded-xl bg-surface-container-lowest px-3 py-6 shadow-sm sm:px-6 sm:py-8">
                    <span className="font-serif-jp text-[20px] font-bold whitespace-nowrap text-primary sm:text-[30px]">つくる</span>
                  </div>
                  <div className="flex translate-y-6 rotate-1 flex-col items-center rounded-xl bg-surface-container-lowest px-3 py-8 shadow-md sm:px-6 sm:py-10">
                    <span className="font-serif-jp text-[22px] font-bold whitespace-nowrap text-secondary sm:text-[32px]">支える</span>
                  </div>
                  <div className="flex -translate-y-4 -rotate-1 flex-col items-center rounded-xl bg-surface-container-lowest px-3 py-6 shadow-sm sm:px-6 sm:py-8">
                    <span className="font-serif-jp text-[20px] font-bold whitespace-nowrap text-on-surface sm:text-[30px]">守る</span>
                  </div>
                </div>
              </div>

              <div className="order-1 space-y-space-lg lg:order-2 lg:col-span-6 lg:pl-space-xl">
                <div className="space-y-space-md">
                  <h2 className="font-serif-jp text-[30px] leading-[1.4] font-bold text-on-surface sm:text-[38px]">
                    ITの可能性を、
                    <br />
                    実績で証明する。
                  </h2>
                  <AccentBar className="bg-secondary" />
                </div>
                <p className="text-[15px] leading-[2.1] text-on-surface-variant sm:text-[16px]">
                  自社開発・受託開発・SES・脆弱性診断の4つの領域で、
                  <br className="hidden sm:inline" />
                  &quot;つくる・支える・守る&quot;を軸に、課題解決に挑んでいます。
                </p>
                <div className="pt-space-sm">
                  {/* 既存トップと同じく別タブで開く */}
                  <TextLink href="/achievements" tone="secondary" newTab>
                    実績・事例紹介
                  </TextLink>
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* ── ABOUT US ── */}
        <section className="relative w-full overflow-clip bg-surface-container-lowest py-space-3xl text-on-surface">
          <BleedWord className="top-12 left-1/2 -translate-x-1/2 text-[160px] tracking-tight whitespace-nowrap text-surface-container/50 sm:text-[240px] lg:text-[340px]">
            ABOUT US
          </BleedWord>

          <div className="wrap relative z-10">
            <div className="grid grid-cols-1 items-center gap-space-xl lg:grid-cols-12">
              <div className="space-y-space-lg lg:col-span-5">
                <div className="space-y-space-sm">
                  <h2 className="font-serif-jp text-[32px] font-bold text-on-surface sm:text-[40px]">会社概要</h2>
                  <AccentBar />
                </div>
                <p className="text-[15px] leading-[2.2] text-on-surface-variant sm:text-[16px]">
                  会社情報をご紹介いたします。
                  <br />
                  OBFall株式会社は、ITの力で社会課題の解決を図り、 人と社会の可能性を広げる企業として成長を続けてまいります。
                </p>
                <div className="pt-space-sm">
                  <TextLink href="/aboutus">会社概要画面へ</TextLink>
                </div>
              </div>

              {/* 写真 2 枚（既存トップの about_us2 / about_us1） */}
              <div className="relative mt-8 flex justify-center lg:col-span-7 lg:mt-0 lg:justify-end">
                <div className="grid w-full max-w-[520px] grid-cols-1 gap-space-md sm:grid-cols-2">
                  <figure className="aspect-[4/3] overflow-clip rounded-xl bg-surface-container shadow-lg">
                    {/* eslint-disable-next-line @next/next/no-img-element */}
                    <img src="/image/about_us2.jpg" alt="オフィスの様子" className="h-full w-full object-cover" loading="lazy" />
                  </figure>
                  <figure className="aspect-[4/3] overflow-clip rounded-xl bg-surface-container-high shadow-lg transition-transform duration-300 hover:-translate-y-1">
                    {/* eslint-disable-next-line @next/next/no-img-element */}
                    <img src="/image/about_us1.jpg" alt="チームの様子" className="h-full w-full object-cover" loading="lazy" />
                  </figure>
                </div>
              </div>
            </div>
          </div>

          <div className="absolute -bottom-6 left-1/3 z-30 -rotate-6 text-tertiary-container drop-shadow-[0_2px_8px_rgba(0,162,211,0.25)]">
            <Butterfly className="h-11 w-11" fill="rgba(255,255,255,0.95)" body="#0077c8" />
          </div>
        </section>

        {/* ── NEWS / RECRUIT ── */}
        <section className="relative w-full bg-surface text-on-surface">
          <div className="grid min-h-[600px] grid-cols-1 lg:grid-cols-2">
            {/* NEWS */}
            <div className="relative flex flex-col justify-between overflow-clip bg-surface-container-low px-margin-mobile py-space-3xl shadow-[inset_-8px_0_16px_rgba(0,0,0,0.02)] md:px-margin">
              <BleedWord className="-top-6 -left-10 text-[120px] tracking-tighter text-surface-container-high/40 sm:text-[180px] lg:text-[220px]">
                NEWS
              </BleedWord>
              <div className="relative z-10 space-y-space-2xl">
                <div className="space-y-space-md">
                  <h2 className="font-serif-jp text-[28px] font-bold text-on-surface sm:text-[34px]">新着情報</h2>
                  <AccentBar className="w-10 bg-outline-variant" />
                </div>

                {newsList.length === 0 ? (
                  <div className="py-space-xl">
                    <p className="text-[15px] tracking-wide text-on-surface-variant">お知らせはありません。</p>
                  </div>
                ) : (
                  <ul className="divide-y divide-surface-container-highest">
                    {newsList.map((item) => (
                      <li key={item.id}>
                        <Link href={`/newses/${item.id}`} className="group flex items-center gap-space-md py-space-md">
                          <span className="h-[72px] w-[72px] shrink-0 overflow-clip rounded-lg bg-surface-container shadow-sm">
                            {/* eslint-disable-next-line @next/next/no-img-element */}
                            <img src={item.thumb} alt="" className="h-full w-full object-cover" loading="lazy" />
                          </span>
                          <span className="min-w-0 flex-1">
                            <span className="block truncate font-medium text-on-surface transition-colors group-hover:text-primary" title={item.title}>
                              {item.title}
                            </span>
                            {item.createdAtFmt ? (
                              <time className="font-latin text-xs tracking-wider text-outline">{item.createdAtFmt}</time>
                            ) : null}
                          </span>
                        </Link>
                      </li>
                    ))}
                  </ul>
                )}

                <div>
                  <TextLink href="/newses">新着情報</TextLink>
                </div>
              </div>
            </div>

            {/* RECRUIT */}
            <div className="relative flex flex-col justify-between overflow-clip bg-surface-container-lowest px-margin-mobile py-space-3xl shadow-[inset_8px_0_16px_rgba(0,0,0,0.02)] md:px-margin">
              <BleedWord className="-top-6 -right-10 text-[120px] tracking-tighter text-surface-container-low/80 sm:text-[180px] lg:text-[220px]">
                RECRUIT
              </BleedWord>
              <div className="relative z-10 space-y-space-xl">
                <div className="space-y-space-md">
                  <h2 className="font-serif-jp text-[28px] leading-[1.4] font-bold text-on-surface sm:text-[34px]">
                    あなたの、あなたによる、
                    <br />
                    あなたのための場所で。
                  </h2>
                  <AccentBar className="w-10 bg-primary-container" />
                </div>
                <p className="max-w-lg text-[15px] leading-[2.1] text-on-surface-variant sm:text-[16px]">
                  私たちは、働くことを人生の一部として誇れる舞台をつくります。
                  <br />
                  OBFallでの挑戦が、あなたの成長と物語を彩りますように。
                </p>
                <div className="pt-space-sm">
                  {/* 既存トップと同じ外部の採用サイト */}
                  <TextLink href="https://obfall-recruit.com/" newTab>
                    採用情報
                  </TextLink>
                </div>
              </div>

              <div className="absolute right-4 bottom-10 z-30 -rotate-12 text-primary-container drop-shadow-[0_2px_10px_rgba(0,159,232,0.3)]">
                <Butterfly className="h-12 w-12" fill="rgba(242,243,255,0.9)" body="#006494" />
              </div>
            </div>
          </div>
        </section>

        {/* ── エンディング ── */}
        <section className="relative w-full bg-surface-container-lowest px-margin-mobile py-space-3xl text-center text-on-surface md:px-margin" aria-label="closing">
          <div className="mx-auto max-w-[840px] space-y-space-lg py-space-xl">
            <p className="font-latin text-[32px] leading-tight font-normal tracking-tight text-primary sm:text-[44px] lg:text-[54px]">
              of you, by you, for all.
            </p>
            <p className="font-serif-jp text-[16px] leading-[2.2] font-medium tracking-wide text-on-surface sm:text-[19px]">
              あなたの、あなたによる、あなたのための。
              <br className="hidden sm:inline" />
              その想いから、すべての人の未来へ。
            </p>
            <div className="mx-auto mt-space-lg h-[1.5px] w-16 bg-primary-container" aria-hidden="true" />
          </div>
        </section>
      </main>

      <Footer />
    </>
  );
}
