import Link from "next/link";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import HeroSection from "@/components/top/HeroSection";
import CharAnim from "@/components/top/CharAnim";
import TopEffects from "@/components/top/TopEffects";
import { ServiceShape, AchievementsShape, RecruitShape } from "@/components/top/SectionShapes";
import { getTopNewses } from "@/lib/newses";
import "./top.css";

/**
 * トップ GET /（§2.1 #1）
 * 現行: resources/views/indexDev.blade.php + TopController@indexDev + public/js/main.js
 *
 * - お知らせは DB（newses）から公開中の先頭3件。ISR（NEWS_REVALIDATE_SECONDS）+ 保存時のオンデマンド再検証
 * - TopController は inhouse_developments も取得するがビューで未使用のため移植しない（§7.1 の 10）
 * - 見出しの <h1><div class="heading-chip"> という入れ子は現行のまま
 * - JS 演出は <TopEffects />（クライアント）に集約
 */
// ISR。Next.js のセグメント設定はリテラルでなければならないため直書き（値は lib/revalidate.ts の NEWS_REVALIDATE_SECONDS と合わせる）
export const revalidate = 600;

export default async function Home() {
  const newsList = await getTopNewses();

  return (
    <div className="page-top">
      <TopEffects />

      {/* 現行は <div class="top"> 内に header / nav-02 / hero-section が並ぶ */}
      <Header>
        <HeroSection />
      </Header>

      <main>
        <div id="about" className="service pt-4">
          {/* ── SERVICE ── */}
          <h1 className="fadein-scroll fadein-from-left m-0 text-start">
            <div className="heading-chip">SERVICE</div>
          </h1>
          <div className="section-block">
            <section className="section-spacing">
              <div className="container">
                <div className="row g-4 align-items-center">
                  <div className="col-md-6 order-2 order-md-1 section-shape">
                    <ServiceShape />
                  </div>
                  <div className="col-md-6 order-1 order-md-2">
                    <div className="text-muted small mb-1 text-end text-md-start anim-fade-up" data-anim="fade-up">
                      サービス
                    </div>
                    <h2 className="h4 mb-3 text-container maintitle text-end text-md-start anim-line" data-anim="line">
                      SERVICE
                    </h2>
                    <p className="mb-4 anim-fade-up" data-anim="fade-up">
                      ITの力で、人と社会の可能性を広げる。
                      <br />
                      自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、人々の人生をより豊かにします。
                    </p>
                    <Link href="/service" className="link-button shadow anim-fade-up" data-anim="fade-up">
                      サービス詳細画面へ <i className="fa-solid fa-circle-arrow-right ms-1"></i>
                    </Link>
                  </div>
                </div>
              </div>
            </section>
          </div>

          {/* ── ACHIEVEMENTS ── */}
          <h1 className="fadein-scroll fadein-from-right m-0 text-end">
            <div className="heading-chip--flip">ACHIEVEMENTS</div>
          </h1>
          <div className="section-block">
            <section className="section-spacing">
              <div className="container">
                <div className="row g-4 align-items-center">
                  <div className="col-md-6">
                    <div className="text-muted small mb-1 anim-fade-up" data-anim="fade-up">
                      実績・事例紹介
                    </div>
                    <h2 className="h4 maintitle text-container mb-3 anim-line" data-anim="line">
                      ACHIEVEMENTS
                    </h2>
                    <p className="mb-4 anim-fade-up" data-anim="fade-up">
                      ITの可能性を、実績で証明する。
                      <br />
                      自社開発・受託開発・SES・脆弱性診断の4つの領域で、
                      <br /> &quot;つくる・支える・守る&quot;を軸に、課題解決に挑んでいます。
                    </p>
                    <Link
                      href="/achievements"
                      className="link-button shadow anim-fade-up"
                      data-anim="fade-up"
                      target="_blank"
                      rel="noopener noreferrer"
                    >
                      実績・事例紹介 <i className="fa-solid fa-circle-arrow-right ms-1"></i>
                    </Link>
                  </div>
                  <div className="col-md-6 section-shape">
                    <AchievementsShape />
                  </div>
                </div>
              </div>
            </section>
          </div>

          {/* ── ABOUT US ── */}
          <h1 className="fadein-scroll fadein-from-left m-0 text-start">
            <div className="heading-chip">ABOUT US</div>
          </h1>
          <div className="section-block">
            <section className="section-spacing">
              <div className="container">
                <div className="row g-4 align-items-center">
                  <div className="col-md-5 order-2 order-md-1">
                    <div className="about-card">
                      <div className="about-card__main">
                        {/* eslint-disable-next-line @next/next/no-img-element */}
                        <img src="/image/about_us2.jpg" alt="オフィスの様子" />
                      </div>
                      <div className="about-card__sub">
                        {/* eslint-disable-next-line @next/next/no-img-element */}
                        <img src="/image/about_us1.jpg" alt="チームの様子" />
                      </div>
                    </div>
                  </div>
                  <div className="col-md-1 order-2 order-md-1"></div>
                  <div className="col-md-6 order-1 order-md-2">
                    <div className="text-muted small mb-1 text-end text-md-start anim-fade-up" data-anim="fade-up">
                      会社概要
                    </div>
                    <h2 className="h4 mb-3 text-container text-end text-md-start maintitle anim-line" data-anim="line">
                      ABOUT US
                    </h2>
                    <p className="mb-4 anim-fade-up" data-anim="fade-up">
                      会社情報をご紹介いたします。
                      <br />
                      OBFall株式会社は、ITの力で社会課題の解決を図り、 人と社会の可能性を広げる企業として成長を続けてまいります。
                    </p>
                    <Link href="/aboutus" className="link-button shadow anim-fade-up" data-anim="fade-up">
                      会社概要画面へ <i className="fa-solid fa-circle-arrow-right ms-1"></i>
                    </Link>
                  </div>
                </div>
              </div>
            </section>
          </div>

          {/* ── NEWS ── */}
          <h1 className="fadein-scroll fadein-from-right m-0 text-end">
            <div className="heading-chip--flip">NEWS</div>
          </h1>
          <div className="section-block">
            <section className="section-spacing">
              <div className="container">
                <div className="row g-4 align-items-center">
                  <div className="col-12">
                    <div className="text-muted small mb-1 anim-fade-up" data-anim="fade-up">
                      新着情報
                    </div>
                    <h2 className="h4 mb-3 text-container maintitle anim-line" data-anim="line">
                      NEWS
                    </h2>
                  </div>
                  <div className="col-12">
                    <div className="achievements-jobs fadein-scroll fadein-from-down">
                      <div className="row g-3 align-items-start">
                        <div className="col-12 col-md-3">
                          <div className="d-grid d-md-block">
                            <Link href="/newses" className="link-button shadow">
                              新着情報 <i className="fa-solid fa-circle-arrow-right ms-1"></i>
                            </Link>
                          </div>
                        </div>
                        <div className="col-12 col-md-9">
                          <div className="bg-white">
                            {newsList.length === 0 ? (
                              <p className="text-muted m-0 p-3">お知らせはありません。</p>
                            ) : (
                              newsList.map((item) => (
                                <div key={item.id} className="border-bottom news-item">
                                  <Link href={`/newses/${item.id}`} className="d-flex text-decoration-none text-dark mb-3 mt-3">
                                    <div className="ratio ratio-1x1 flex-shrink-0 me-3" style={{ width: 72 }}>
                                      {/* eslint-disable-next-line @next/next/no-img-element */}
                                      <img
                                        src={item.thumb}
                                        alt={item.title}
                                        className="w-100 h-100 rounded shadow-sm"
                                        style={{ objectFit: "cover" }}
                                        loading="lazy"
                                      />
                                    </div>
                                    <div className="flex-grow-1">
                                      <div className="fw-semibold text-truncate" title={item.title}>
                                        {item.title}
                                      </div>
                                      {item.createdAtFmt ? <time className="text-muted small">{item.createdAtFmt}</time> : null}
                                    </div>
                                  </Link>
                                </div>
                              ))
                            )}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>

          {/* ── RECRUIT ── */}
          <h1 className="fadein-scroll fadein-from-left m-0 text-start">
            <div className="heading-chip">RECRUIT</div>
          </h1>
          <div className="section-block">
            <section className="section-spacing">
              <div className="container">
                <div className="row g-4 align-items-center">
                  <div className="col-md-6 order-2 order-md-1 section-shape">
                    <RecruitShape />
                  </div>
                  <div className="col-md-6 order-1 order-md-2">
                    <div className="text-muted small mb-1 text-end text-md-start anim-fade-up" data-anim="fade-up">
                      採用情報
                    </div>
                    <h2 className="h4 mb-3 text-container text-end text-md-start maintitle anim-line" data-anim="line">
                      RECRUIT
                    </h2>
                    <p className="mb-4 anim-fade-up" data-anim="fade-up">
                      あなたの、あなたによる、あなたのための場所で。
                      <br />
                      私たちは、働くことを人生の一部として誇れる舞台をつくります。
                      <br />
                      OBFallでの挑戦が、あなたの成長と物語を彩りますように。
                    </p>
                    {/* 現行は rel 無しの target="_blank"（外部サイト） */}
                    <a
                      href="https://obfall-recruit.com/"
                      className="link-button shadow anim-fade-up"
                      data-anim="fade-up"
                      target="_blank"
                      rel="noopener noreferrer"
                    >
                      採用情報 <i className="fa-solid fa-circle-arrow-right ms-1"></i>
                    </a>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </main>

      {/* ── エンディング ── */}
      <section className="ending" aria-label="closing">
        <div className="wrap">
          <CharAnim as="p" className="ending__tagline" text="of you, by you, for all." />
          <p className="ending__message anim-fade-up" data-anim="fade-up">
            あなたの、あなたによる、あなたのための。
          </p>
          <p className="ending__message anim-fade-up" data-anim="fade-up">
            その想いから、すべての人の未来へ。
          </p>
        </div>
      </section>

      <Footer />
    </div>
  );
}
