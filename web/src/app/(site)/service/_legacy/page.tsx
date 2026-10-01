import type { Metadata } from "next";
import Link from "next/link";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import "../service.css";

export const metadata: Metadata = {
  title: "Services | OBFall Inc.",
};

/** 4事業カード（現行 show.blade.php の srv-card 4件） */
const SERVICES = [
  {
    num: "01",
    kicker: "Products",
    title: "自社開発",
    en: "IT × Vision",
    desc: "人と社会の可能性を広げる、自社プロダクト。",
    href: "/service/products",
  },
  {
    num: "02",
    kicker: "Contract Development",
    title: "受託開発",
    en: "IT × Collaboration",
    desc: "ともにつくり、ともに前へ。",
    href: "/service/contract",
  },
  {
    num: "03",
    kicker: "Team Support",
    title: "SES",
    en: "IT × Team",
    desc: "人が輝く現場を、技術で支える。",
    href: "/service/ses",
  },
  {
    num: "04",
    kicker: "Security",
    title: "脆弱性診断",
    en: "Security × Engineering",
    desc: "安全は、後付けではなく、設計から。",
    href: "/service/security",
  },
];

/**
 * サービス一覧 GET /service（§2.1 #4）
 * 現行: resources/views/user/services/show.blade.php（UserServicesController@show）
 * 現行は inhouse_developments を DB から取得するがビューで未使用のため、DB 接続は行わない。
 */
export default function ServicePage() {
  return (
    <div className="page-service">
      <Header />

      <PageHero title="Service" sub="ITの力で、人と社会の可能性を広げる。" variant="hexgrid" />

      {/* リード文 */}
      <section className="sec">
        <div className="wrap">
          <p className="lead-text">
            自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、
            <br className="d-none d-md-inline" />
            テクノロジーで人生をより豊かにします。
          </p>
        </div>
      </section>

      {/* サービス一覧 */}
      <section className="sec sec--alt">
        <div className="wrap">
          <div className="srv-grid">
            {SERVICES.map((s) => (
              <article key={s.href} className="srv-card">
                <div className="srv-card__num">{s.num}</div>
                <div className="srv-card__kicker">{s.kicker}</div>
                <h2 className="srv-card__title">{s.title}</h2>
                <div className="srv-card__en">{s.en}</div>
                <p className="srv-card__desc">{s.desc}</p>
                <Link className="srv-card__link" href={s.href}>
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
          <Breadcrumb current="サービス" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
