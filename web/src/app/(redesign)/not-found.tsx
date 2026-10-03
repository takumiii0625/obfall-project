import type { Metadata } from "next";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import TextLink from "@/components/redesign/TextLink";

export const metadata: Metadata = {
  title: "404 | OBFall Inc.",
  alternates: { canonical: null },
};

/**
 * 404 ページ（リデザイン版）。存在しない URL（[...notFound]）と、各ページの notFound() で表示する。
 * 文言は 2026-10-03 の指示のもの。noindex は Next.js が 404 応答に自動で付ける。
 */
export default function NotFound() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero title="404" />

        <div className="wrap py-space-2xl lg:py-space-3xl">
          <div className="mx-auto flex w-full max-w-[720px] flex-col items-center rounded-xl bg-surface-container-lowest px-space-lg py-space-2xl text-center shadow-sm md:px-space-xl">
            <h2 className="mb-space-md font-serif-jp text-[24px] font-bold text-on-surface lg:text-[30px]">ページが見つかりませんでした。</h2>
            <p className="mb-space-xl text-base leading-loose text-on-surface-variant">お探しのページは、移動または削除された可能性があります。</p>
            <TextLink href="/">トップに戻る</TextLink>
          </div>
        </div>
      </main>
      <Footer />
    </>
  );
}
