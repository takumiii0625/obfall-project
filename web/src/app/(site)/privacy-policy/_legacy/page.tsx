import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import PrivacyPolicyText from "@/components/PrivacyPolicyText";
import "../privacy-policy.css";

export const metadata: Metadata = {
  title: "プライバシーポリシー | OBFall株式会社",
};

/**
 * プライバシーポリシー GET /privacy-policy（§2.1 #19）
 *
 * 現行の privacy_policy.blade.php は 0 バイトの空ファイルで白紙ページが返る（§7.1 の 8）。
 * SESSION_PLAN の既定どおり「問い合わせページ内の全文を独立ページ化」した。
 * 見た目は問い合わせページの .privacy-box を流用（スクロール枠のみ解除）。
 * PageHero の variant は現行に対応が無いため shield を仮採用（確認事項）。
 */
export default function PrivacyPolicyPage() {
  return (
    <div className="page-privacy-policy">
      <Header />
      <PageHero title="Privacy Policy" sub="プライバシーポリシー" variant="shield" />

      <main>
        <section className="sec">
          <div className="wrap">
            <div className="privacy-box">
              <h4>プライバシーポリシー</h4>
              <PrivacyPolicyText />
            </div>
          </div>
        </section>

        <section className="breadcrumb-sec">
          <div className="wrap">
            <Breadcrumb current="プライバシーポリシー" />
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
}
