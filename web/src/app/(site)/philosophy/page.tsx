import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import "./philosophy.css";

export const metadata: Metadata = {
  title: "Philosophy | OBFall Inc.",
};

/**
 * 企業理念 GET /philosophy（§2.1 #14）
 * 現行: resources/views/user/philosophy/show.blade.php（クロージャルート、サーバー処理なし）
 */
export default function PhilosophyPage() {
  return (
    <div className="page-philosophy">
      <Header />

      <PageHero
        title="Philosophy"
        sub={
          <>
            「あなたの、あなたによる、あなたのための」
            <br />
            をすべての人へ。
          </>
        }
        variant="neural"
      />

      {/* Vision */}
      <section className="sec">
        <div className="wrap">
          <div className="statement">
            <span className="statement__kicker">Vision</span>
            <h2 className="statement__title">「あなたの、あなたによる、あなたのための」をすべての人へ。</h2>
            <p className="statement__body">
              テクノロジーの力で、人と社会の可能性を広げ、
              <br className="d-none d-md-inline" />
              誰もが自分らしく生き、挑戦できる未来を目指します。
            </p>
          </div>
        </div>
      </section>

      {/* Mission */}
      <section className="sec sec--alt">
        <div className="wrap">
          <div className="statement">
            <span className="statement__kicker">Mission</span>
            <h2 className="statement__title">
              働くすべての人が、自分自身のために、
              <br className="d-none d-md-inline" />
              自由にそして熱意を持って働ける社会をつくっていきます。
            </h2>
            <p className="statement__body">
              その実現のために、私たちはテクノロジーを通じて、挑戦する人と組織を支え、
              <br className="d-none d-md-inline" />
              &quot;つくる・支える・守る&quot;という3つの軸で、社会に新しい価値を届け続けます。
            </p>
          </div>
        </div>
      </section>

      {/* Core Values */}
      <section className="sec">
        <div className="wrap">
          <div className="sec-heading">
            <span className="sec-heading__kicker">Core Values</span>
            <h2 className="sec-heading__title">3つの柱</h2>
          </div>

          <div className="value-grid">
            <article className="value-card">
              <div className="value-card__num">01</div>
              <div className="value-card__kicker">Principle</div>
              <h3 className="value-card__title">理念採用</h3>
              <p className="value-card__desc">
                共感を軸に、人と組織をつなぐ。理念に共鳴する仲間とともに、価値ある未来を創ります。
              </p>
            </article>

            <article className="value-card">
              <div className="value-card__num">02</div>
              <div className="value-card__kicker">Satisfaction</div>
              <h3 className="value-card__title">ES＝CS</h3>
              <p className="value-card__desc">
                働く人の幸福が、顧客の満足を生む。社員満足と顧客満足の両立を通じて、持続的な成長を目指します。
              </p>
            </article>

            <article className="value-card">
              <div className="value-card__num">03</div>
              <div className="value-card__kicker">Growth &amp; Challenge</div>
              <h3 className="value-card__title">成長と挑戦</h3>
              <p className="value-card__desc">
                一人ひとりが自らの成長に挑み、変化を恐れず前へ。挑戦を後押しする文化を大切にします。
              </p>
            </article>
          </div>
        </div>
      </section>

      {/* Message */}
      <section className="sec sec--alt">
        <div className="wrap">
          <div className="message-box">
            <span className="message-box__kicker">Message</span>
            <h2 className="message-box__title">人と社会が、ともに成長できる世界へ。</h2>
            <p className="message-box__text">
              OBFallは、ITの力で&quot;人&quot;と&quot;社会&quot;が共に成長できる世界を目指しています。
              <br />
              働くことが、あなたの人生を豊かにする体験であってほしい。
              <br className="d-none d-md-inline" />
              その想いを胸に、私たちは挑戦を続けていきます。
            </p>
          </div>
        </div>
      </section>

      {/* Origin */}
      <section className="sec">
        <div className="wrap">
          <div className="origin-box">
            <span className="origin-box__kicker">Origin of Our Philosophy</span>
            <h3 className="origin-box__title">理念と社名の由来</h3>
            <p className="origin-box__text">
              「あなたの、あなたによる、あなたのための」という言葉は、アメリカ第16代大統領エイブラハム・リンカーンの演説に由来しています。
              社名 <strong>OBFall</strong> は、その演説に登場する &quot;of the people, by the people, for the
              people&quot; に、<strong>&quot;すべての人へ（all）&quot;</strong> という想いを込めて名づけました。
              OBFallは、テクノロジーの力で、すべての人に可能性を届ける企業でありたいと考えています。
            </p>
          </div>
        </div>
      </section>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb current="企業理念" />
        </div>
      </div>

      <Footer />
    </div>
  );
}
