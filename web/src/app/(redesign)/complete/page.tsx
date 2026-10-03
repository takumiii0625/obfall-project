import type { Metadata } from "next";
import Link from "next/link";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import ArrowIcon from "@/components/redesign/ArrowIcon";

export const metadata: Metadata = {
  title: "送信完了 | OBFall Inc.",
};

/**
 * 送信完了 GET /complete（リデザイン版。contact の構成を流用）
 * 現行どおり直接 GET でも表示される。フッターは問い合わせ系と同じく「お問い合わせはこちら」ボタン無し。
 */
export default function CompletePage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero label="THANK YOU" title="Thank You" />

        <div className="wrap py-space-2xl lg:py-space-3xl">
          <div className="mx-auto flex w-full max-w-[720px] flex-col items-center rounded-xl bg-surface-container-lowest px-space-lg py-space-2xl text-center shadow-sm md:px-space-xl">
            <span className="mb-space-lg flex h-16 w-16 items-center justify-center rounded-full bg-primary-fixed text-primary" aria-hidden="true">
              <svg className="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                <path d="M5 12.5l4.5 4.5L19 7.5" strokeLinecap="round" strokeLinejoin="round" />
              </svg>
            </span>
            <h1 className="mb-space-md font-serif-jp text-[24px] font-bold text-on-surface lg:text-[30px]">送信が完了しました</h1>
            <p className="mb-space-xl text-base leading-loose text-on-surface-variant">
              お問い合わせいただきありがとうございます。
              <br className="hidden lg:inline" />
              内容を確認のうえ、担当者よりご連絡いたします。
            </p>
            <Link
              href="/"
              className="inline-flex items-center justify-center gap-space-sm rounded-full bg-primary px-10 py-3.5 text-sm font-medium text-on-primary shadow transition-colors hover:bg-secondary"
            >
              <span>Topに戻る</span>
              <ArrowIcon className="h-[18px] w-[18px]" />
            </Link>
          </div>
        </div>

        <Breadcrumb items={[{ label: "お問い合わせ", href: "/contact" }, { label: "送信完了" }]} />
      </main>
      <Footer showContactButton={false} />
    </>
  );
}
