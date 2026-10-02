import type { Metadata } from "next";
import Link from "next/link";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import "../complete.css";

export const metadata: Metadata = {
  title: "送信完了 | OBFall Inc.",
};

/**
 * 送信完了 GET /complete（§2.1 #18）
 * 現行: contacts/complete.blade.php + ContactsController@complete（サーバー処理なし。直接 GET でも表示される）
 */
export default function CompletePage() {
  return (
    <div className="page-complete">
      <Header />
      <PageHero title="Thank You" sub="お問い合わせありがとうございました。" variant="mail" />

      <section className="sec">
        <div className="wrap">
          <div className="complete-card">
            <div className="complete-card__icon">
              <i className="fa-solid fa-check"></i>
            </div>
            <h1 className="complete-card__title">送信が完了しました</h1>
            <p className="complete-card__text">
              お問い合わせいただきありがとうございます。
              <br />
              内容を確認のうえ、担当者よりご連絡いたします。
            </p>
            <Link href="/" className="complete-card__btn">
              Topに戻る <i className="fa-solid fa-arrow-right"></i>
            </Link>
          </div>
        </div>
      </section>

      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb current="送信完了" parents={[{ label: "お問い合わせ", href: "/contact" }]} />
        </div>
      </div>

      <Footer showContactButton={false} />
    </div>
  );
}
