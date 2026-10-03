import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import ContactForm from "./ContactForm";

export const metadata: Metadata = {
  title: "Contact | OBFall Inc.",
};

/**
 * お問い合わせ 入力 GET /contact + 確認（リデザイン版。design/stitch/contact.html を参考）
 * Server Action は既存の (site)/contact/actions.ts をそのまま使う。
 * フッターは既存どおり問い合わせ系の画面では「お問い合わせはこちら」ボタンを出さない。
 */
export default function ContactPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <ContactForm
          heroInput={<PageHero title="Contact" />}
          breadcrumbInput={<Breadcrumb items={[{ label: "お問い合わせ" }]} />}
          heroConfirm={<PageHero label="CONTACT" title="Confirm" />}
          breadcrumbConfirm={<Breadcrumb items={[{ label: "お問い合わせ", href: "/contact" }, { label: "確認" }]} />}
          turnstileSiteKey={process.env.NEXT_PUBLIC_TURNSTILE_SITE_KEY}
        />
      </main>
      <Footer showContactButton={false} />
    </>
  );
}
