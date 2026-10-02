import type { Metadata } from "next";
import Link from "next/link";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import SectionHeading from "@/components/SectionHeading";
import ValueCard, { type ValueCardItem } from "@/components/ValueCard";
import ProductCard, { type ProductCardItem } from "@/components/ProductCard";
import "../../service.css";

export const metadata: Metadata = {
  title: "自社開発（Products） | OBFall Inc.",
};

const VALUES: ValueCardItem[] = [
  {
    num: "01",
    kicker: "Embody",
    title: "人の想いを形にする",
    desc: "誰かの「こうありたい」という想いを起点に、テクノロジーで実現へと近づけます。",
  },
  {
    num: "02",
    kicker: "Empathy",
    title: "社会に寄り添うサービスづくり",
    desc: "便利さや効率だけでなく、人と人のつながり・安心・挑戦を支える仕組みを届けます。",
  },
  {
    num: "03",
    kicker: "Cocreate",
    title: "共に育てるプロダクト",
    desc: "使う人と共に磨き、社会に溶け込む\"続いていく価値\"を生み出します。",
  },
];

const PRODUCTS: ProductCardItem[] = [
  { logo: "/image/digOn_logo.png", alt: "digOn ロゴ", name: "digOn", desc: "音楽発掘をもっと身近にする音楽アプリ" },
  { logo: "/image/store-pass_logo.png", alt: "ストパス ロゴ", name: "ストパス", desc: "ストア特化の来店・販促パスポート" },
  {
    logo: "/image/dx_logo.png",
    alt: "農業向け業務効率化 ロゴ",
    name: "農業DX",
    desc: "農作業と記録の効率化を支援",
    badge: "開発中",
  },
];

/**
 * 自社開発サービス紹介 GET /service/products（§2.1 #5）
 * 現行: resources/views/user/services/products.blade.php（クロージャルート、サーバー処理なし）
 */
export default function ServiceProductsPage() {
  return (
    <div className="page-service page-service-products">
      <Header />

      <PageHero title="IT × Vision" sub="人と社会の可能性を広げる、自社プロダクト。" variant="launch" />

      {/* リード文 */}
      <section className="sec">
        <div className="wrap">
          <p className="lead-text">
            OBFallの自社開発は、「テクノロジーで人生をより豊かにする」という理念をかたちにする取り組みです。
            <br className="d-none d-md-inline" />
            人の生き方や働き方、暮らしの中にある課題を見つめ、
            <br className="d-none d-md-inline" />
            誰もが自分らしく生きられる社会を実現するためのプロダクトを開発しています。
          </p>
        </div>
      </section>

      {/* 3つの価値 */}
      <section className="sec sec--alt">
        <div className="wrap">
          <SectionHeading kicker="Our Values" title="プロダクト開発で大切にしていること" />
          <div className="value-grid value-grid--3">
            {VALUES.map((v) => (
              <ValueCard key={v.num} {...v} />
            ))}
          </div>
        </div>
      </section>

      {/* プロダクト一覧 */}
      <section className="sec">
        <div className="wrap">
          <SectionHeading kicker="Products" title="実績・事例紹介" />
          <div className="product-grid product-grid--3">
            {PRODUCTS.map((p) => (
              <ProductCard key={p.name} {...p} />
            ))}
          </div>

          <div className="product-more">
            <Link className="product-more__link" href="/achievements/products">
              実績を詳しく見る <i className="bi bi-arrow-right"></i>
            </Link>
          </div>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb parents={[{ label: "サービス", href: "/service" }]} current="自社開発" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
