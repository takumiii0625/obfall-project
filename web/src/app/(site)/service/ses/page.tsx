import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import SectionHeading from "@/components/SectionHeading";
import ValueCard, { type ValueCardItem } from "@/components/ValueCard";
import "../service.css";

export const metadata: Metadata = {
  title: "SES（技術支援） | OBFall Inc.",
};

const ABOUT: ValueCardItem[] = [
  {
    num: "01",
    kicker: "Vision",
    title: "私たちの想い",
    desc: "人が主役の現場を、もっと誇れる場所に。OBFallのSESは、エンジニア一人ひとりが自分らしく力を発揮できる環境をつくることで、企業と人の\"成長の循環\"を生み出します。単なる人材支援ではなく、共に挑み、共に成長するパートナーとして並走します。",
  },
  {
    num: "02",
    kicker: "Service",
    title: "サービス概要",
    desc: "私たちは、クライアントの現場課題に最も適したエンジニアをアサインし、開発・運用・保守などのプロジェクトを技術面とチーム面から支援します。配属後も定期的なフォローやスキルアップ支援を行い、長期的な関係構築と高品質な成果創出を両立します。",
  },
];

const WHY_US: ValueCardItem[] = [
  {
    num: "01",
    kicker: "Empathy",
    title: "\"人\"を中心とした関係づくり",
    desc: "スキルシートだけでなく、価値観やキャリアビジョンまでを見据え、企業と人が共に成長できる\"関係\"を設計します。「どんな現場ならその人が最も輝くか」を起点に考え、人とチームの可能性を最大限に引き出します。",
  },
  {
    num: "02",
    kicker: "Growth",
    title: "継続的な伴走と成長支援",
    desc: "配属後もチーム単位でフォローし、キャリアアップ・スキル共有・勉強会など人と組織が共に進化する環境を提供します。",
  },
  {
    num: "03",
    kicker: "Craftsmanship",
    title: "現場で磨かれる技術力",
    desc: "OBFallでは、自社開発・受託開発を通じて技術を磨き続けています。その実践的な知見と経験が、SESにおいても高い提案力と課題解決力を支えています。現場に\"成長と信頼\"という価値をもたらすのが、私たちの強みです。",
  },
];

/**
 * SES紹介 GET /service/ses（§2.1 #7）
 * 現行: resources/views/user/services/ses.blade.php（クロージャルート、サーバー処理なし）
 */
export default function ServiceSesPage() {
  return (
    <div className="page-service page-service-ses">
      <Header />

      <PageHero title="IT × Team" sub="人が輝く現場を、技術で支える。" variant="constellation" />

      {/* リード文 */}
      <section className="sec">
        <div className="wrap">
          <p className="lead-text">
            エンジニアが力を発揮できる環境を整え、技術とチームの両面から現場を支援。
            <br />
            「人」と「組織」がともに成長する関係を築くことが、OBFallのSESです。
          </p>
        </div>
      </section>

      {/* 私たちの想い・サービス概要 */}
      <section className="sec sec--alt">
        <div className="wrap">
          <SectionHeading kicker="About SES" title="サービスについて" />
          <div className="value-grid value-grid--2">
            {ABOUT.map((v) => (
              <ValueCard key={v.num} {...v} />
            ))}
          </div>
        </div>
      </section>

      {/* 選ばれる理由 */}
      <section className="sec">
        <div className="wrap">
          <SectionHeading kicker="Why Us" title="OBFallのSESが選ばれる理由" />
          <div className="value-grid value-grid--3">
            {WHY_US.map((v) => (
              <ValueCard key={v.num} {...v} />
            ))}
          </div>
        </div>
      </section>

      {/* メッセージ */}
      <section className="sec sec--alt">
        <div className="wrap">
          <div className="message-box">
            <span className="message-box__kicker">Message</span>
            <h2 className="message-box__title">メッセージ</h2>
            <p className="message-box__text">
              SESを、&quot;人を送るビジネス&quot;から&quot;人が活きる仕組み&quot;へ。
              <br />
              OBFallは、ITの力で働く人と企業の関係をより良くデザインしていきます。
            </p>
          </div>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb parents={[{ label: "サービス", href: "/service" }]} current="SES" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
