import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import PrivacyPolicyText from "@/components/redesign/PrivacyPolicyText";

export const metadata: Metadata = {
  title: "プライバシーポリシー | OBFall株式会社",
};

/**
 * プライバシーポリシー GET /privacy-policy（リデザイン版。human-rights-policy の本文幅と contact のポリシー枠を流用）
 * 文言は既存 components/PrivacyPolicyText（問い合わせページの全文）をそのまま使う。
 */
export default function PrivacyPolicyPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero title="Privacy Policy" />

        <div className="w-full bg-surface py-space-2xl lg:py-space-3xl">
          <div className="mx-auto w-full max-w-[800px] px-margin-mobile md:px-margin">
            <div className="rounded-xl bg-surface-container-lowest p-space-lg shadow-sm md:p-space-xl">
              <h2 className="mb-space-lg border-b-2 border-primary-container pb-3 font-serif-jp text-[22px] font-bold tracking-tight text-on-surface lg:text-[26px]">
                プライバシーポリシー
              </h2>
              <div className="text-sm leading-loose text-on-surface-variant lg:text-base">
                <PrivacyPolicyText />
              </div>
            </div>
          </div>
        </div>

        <Breadcrumb items={[{ label: "プライバシーポリシー" }]} />
      </main>
      <Footer />
    </>
  );
}
