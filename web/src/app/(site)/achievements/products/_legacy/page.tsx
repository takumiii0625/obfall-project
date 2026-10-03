import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import SectionHeading from "@/components/SectionHeading";
import AchievementCard, { type AchievementCardItem } from "@/components/AchievementCard";
import "../../achievements.css";

export const metadata: Metadata = {
  title: "自社開発実績 | OBFall Inc.",
};

const PRODUCTS: AchievementCardItem[] = [
  {
    image: "/image/digOn_logo.png",
    alt: "digOn ロゴ",
    name: "digOn（ディグオン）",
    desc: "音楽と人の感性をつなぐ、新しい発見体験。 音楽との出会いをもっと自由に、もっと感覚的に。 Flutter × Firebase × Webで構築された、クロスプラットフォーム対応の音楽アプリ。 再生履歴・レコメンド・お気に入り管理など、ユーザー体験を重視したUIを設計。",
    link: { href: "https://dig-on.com/", label: "digOn公式サイト" },
  },
  {
    image: "/image/store-pass_logo.png",
    alt: "ストパス ロゴ",
    name: "ストパス（Store-Pass）",
    desc: "店舗とユーザーをつなぐ共通特典アプリ。 月額無料で、ユーザーは加盟店舗全体で特典を利用可能。 「店舗をまたぐ特典利用」「垣根を超えた顧客体験」を実現するアプリとして開発。 加盟店の情報表示や特典管理を統合し、地域の活性化を支える仕組みを提供しています。",
    link: { href: "https://store-pass.com", label: "Store-Pass公式サイト" },
    reverse: true,
  },
  {
    image: "/image/dx_logo.webp",
    alt: "農業向け業務効率化 ロゴ",
    name: "未来共創DX支援事業",
    desc: "地域と人に寄り添うパートナーとして、デジタルの力で課題を解決し、お客様と共に新たな価値を生み出すことを目指しています。 飲食・小売・農業など、多様な現場と対話を重ね、「現場のリアルな声」を大切にした、\"本当に使える\"仕組みづくりを進めています。 現在は、農家の方々の販売・業務効率化を支援するECプラットフォームの開発を推進中です。",
    badge: "開発中",
  },
];

/**
 * 自社開発実績 GET /achievements/products（§2.1 #10）
 * 現行: resources/views/user/achievements/products.blade.php（クロージャルート、サーバー処理なし）
 */
export default function AchievementsProductsPage() {
  return (
    <div className="page-achievements page-achievements-products">
      <Header />

      <PageHero
        title="Products"
        sub={
          <>
            人と社会の可能性を広げる、自社プロダクト。
            <br />
            OBFallの想いを、サービスというかたちで届ける。
          </>
        }
        variant="launch"
      />

      {/* リード文 */}
      <section className="sec">
        <div className="wrap">
          <p className="lead-text">
            OBFallの自社開発は、社会の&quot;まだ満たされていないニーズ&quot;に焦点をあて、
            <br className="d-none d-md-inline" />
            「テクノロジーで人生をより豊かにする」という理念を実践する取り組みです。
            <br />
            便利さよりも、&quot;人がより自分らしく生きられる仕組み&quot;を目指し、
            <br className="d-none d-md-inline" />
            発想から企画、開発、運用まですべて自社で行っています。
          </p>
        </div>
      </section>

      {/* プロダクト一覧 */}
      <section className="sec sec--alt">
        <div className="wrap">
          <SectionHeading kicker="Our Products" title="プロダクト紹介" />
          <div className="achievement-list">
            {PRODUCTS.map((p) => (
              <AchievementCard key={p.name} {...p} />
            ))}
          </div>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb parents={[{ label: "実績・事例紹介", href: "/achievements" }]} current="自社開発" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
