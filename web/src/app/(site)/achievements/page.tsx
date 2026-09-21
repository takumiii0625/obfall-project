import type { Metadata } from "next";
import Link from "next/link";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import "./achievements.css";

export const metadata: Metadata = {
  title: "Achievements | OBFall Inc.",
};

/** 3領域カード（現行 show.blade.php の srv-card 3件） */
const AREAS = [
  {
    num: "01",
    kicker: "Products",
    title: "自社開発",
    en: "IT × Vision",
    desc: "人と社会の可能性を広げる、自社プロダクト。OBFallの想いを、サービスというかたちで届けます。",
    href: "/achievements/products",
  },
  {
    num: "02",
    kicker: "Contract Development",
    title: "受託開発",
    en: "IT × Collaboration",
    desc: "ともにつくり、ともに前へ。クライアントの想いを汲み取り、共に課題を解決するパートナーとして伴走します。",
    href: "/achievements/contract",
  },
  {
    num: "03",
    kicker: "Security Assessment",
    title: "脆弱性診断",
    en: "Security × Engineering",
    desc: "安全は、後付けではなく、設計から。開発と診断をワンストップで行い、信頼できるプロダクトづくりを支えます。",
    href: "/achievements/security",
  },
];

/**
 * 実績トップ GET /achievements（§2.1 #9）
 * 現行: resources/views/user/achievements/show.blade.php（クロージャルート、サーバー処理なし）
 */
export default function AchievementsPage() {
  return (
    <div className="page-achievements">
      <Header />

      <PageHero
        title="Achievements"
        sub={
          <>
            ITの力で、人と社会の可能性を広げる。
            <br />
            OBFallの挑戦と成果。
          </>
        }
        variant="chart"
      />

      {/* リード文 */}
      <section className="sec">
        <div className="wrap">
          <p className="lead-text">
            私たちは、「テクノロジーで人生をより豊かにする」という理念のもと、
            <br className="d-none d-md-inline" />
            自社開発・受託開発・脆弱性診断の3つの領域で、
            <br className="d-none d-md-inline" />
            社会や現場の課題を&quot;仕組み&quot;として解決してきました。
            <br />
            ここで紹介するのは、私たちの手で形にしてきたプロジェクトたち。
            <br className="d-none d-md-inline" />
            どれも、「人」や「社会」に新しい選択肢を生み出すための挑戦です。
          </p>
        </div>
      </section>

      {/* 実績カード一覧 */}
      <section className="sec sec--alt">
        <div className="wrap">
          <div className="srv-grid">
            {AREAS.map((a) => (
              <article key={a.href} className="srv-card">
                <div className="srv-card__num">{a.num}</div>
                <div className="srv-card__kicker">{a.kicker}</div>
                <h2 className="srv-card__title">{a.title}</h2>
                <div className="srv-card__en">{a.en}</div>
                <p className="srv-card__desc">{a.desc}</p>
                <Link className="srv-card__link" href={a.href}>
                  詳しく見る <i className="bi bi-arrow-right"></i>
                </Link>
              </article>
            ))}
          </div>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb current="実績・事例紹介" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
