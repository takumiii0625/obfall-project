import type { Metadata } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import ContactForm from "./ContactForm";
import "./contact.css";

export const metadata: Metadata = {
  title: "Contact | OBFall Inc.",
};

/**
 * お問い合わせ 入力 GET /contact（§2.1 #15）+ 確認（#16、現行 POST /confirm）
 * 現行: contacts/contact.blade.php / contacts/confirm.blade.php + ContactsController
 * フォーム本体はクライアントコンポーネント（ContactForm）。ヒーローはサーバーで描画して渡す。
 * フッターは問い合わせ系3画面共通で「お問い合わせはこちら」ボタン無し。
 */
export default function ContactPage() {
  return (
    <div className="page-contact">
      <Header />
      <ContactForm
        heroInput={<PageHero title="Contact" sub="お気軽にお問い合わせください。" variant="mail" />}
        heroConfirm={<PageHero title="Confirm" sub="入力内容をご確認ください。" variant="mail" />}
        turnstileSiteKey={process.env.NEXT_PUBLIC_TURNSTILE_SITE_KEY}
      />
      <Footer showContactButton={false} />
    </div>
  );
}
