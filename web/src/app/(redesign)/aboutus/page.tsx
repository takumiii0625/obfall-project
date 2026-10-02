import type { Metadata } from "next";
import type { ReactNode } from "react";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import ArrowIcon from "@/components/redesign/ArrowIcon";

export const metadata: Metadata = {
  title: "About US | OBFall Inc.",
};

/**
 * Google マップの URL（現行 Blade のエンコード済み文字列）。
 * 現行はビル名が「汐染芝離宮」だったが、2026-10-02 の指示で「汐留芝離宮」に修正。
 */
const MAP_QUERY =
  "%E6%9D%B1%E4%BA%AC%E9%83%BD%E6%B8%AF%E5%8C%BA%E6%B5%B7%E5%B2%B81-2-3%20%E6%B1%90%E7%95%99%E8%8A%9D%E9%9B%A2%E5%AE%AE%E3%83%93%E3%83%AB%E3%83%87%E3%82%A3%E3%83%B3%E3%82%B0%2021F";
const MAP_EMBED_URL = `https://www.google.com/maps?q=${MAP_QUERY}&hl=ja&z=16&output=embed`;
const MAP_DIRECTIONS_URL = `https://www.google.com/maps/dir/?api=1&destination=${MAP_QUERY}`;

/**
 * 会社概要 GET /aboutus（リデザイン版。design/stitch/aboutus.html を参考）
 * 文言は既存ページのもの。HTML の地図はプレースホルダーだが、既存の Google マップ埋め込みをそのまま使う。
 * 英字タイトルは既存の「About US」を踏襲（HTML は「About Us」。確認事項）。
 */
export default function AboutUsPage() {
  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "会社概要" }]} label="ABOUT US" title="About US" />

        <div className="wrap pt-space-2xl pb-space-3xl">
          <div className="flex max-w-4xl flex-col">
            <div className="mb-space-2xl flex items-center border-l-[3px] border-primary-container pl-space-md">
              <h2 className="font-serif-jp text-[22px] font-bold tracking-tight text-on-surface lg:text-[26px]">私たちOBFall株式会社について</h2>
            </div>

            <div className="mb-space-lg">
              <h3 className="inline-block border-b-2 border-primary-container pb-space-sm font-serif-jp text-lg font-bold tracking-tight text-on-surface">会社情報</h3>
            </div>

            <dl className="flex w-full flex-col border-t border-outline-variant/40">
              <Row label="会社名">OBFall株式会社</Row>
              <Row label="代表取締役">上遠野　博紀</Row>
              <Row label="所在地">
                <div className="flex flex-col gap-space-md">
                  <span className="leading-relaxed">
                    〒105-0022
                    <br />
                    東京都港区海岸1-2-3
                    <br />
                    汐留芝離宮ビルディング 21F
                  </span>
                  <div className="relative w-full overflow-clip rounded border border-outline-variant/40 bg-surface-container-low">
                    <div className="aspect-video w-full">
                      <iframe
                        src={MAP_EMBED_URL}
                        loading="lazy"
                        referrerPolicy="no-referrer-when-downgrade"
                        allowFullScreen
                        title="OBFall株式会社 所在地の地図"
                        className="h-full w-full"
                      ></iframe>
                    </div>
                  </div>
                  <div className="flex items-center">
                    <a
                      className="inline-flex items-center gap-1.5 text-sm font-medium text-primary transition-colors hover:text-tertiary"
                      target="_blank"
                      rel="noopener"
                      href={MAP_DIRECTIONS_URL}
                    >
                      <span>ルートを検索</span>
                      <ArrowIcon className="h-4 w-4" />
                    </a>
                  </div>
                </div>
              </Row>
              <Row label="電話番号">
                <span className="font-latin text-[17px] tracking-wide">03-5403-5904</span>
              </Row>
              <Row label="設立">
                <span className="font-latin text-[17px]">2022</span>年<span className="font-latin text-[17px]">8</span>月
                <span className="font-latin text-[17px]">2</span>日
              </Row>
              <Row label="資本金">
                <span className="font-latin text-[17px]">1,000,000</span>円
              </Row>
              <Row label="取引先銀行">みずほ銀行</Row>
            </dl>
          </div>
        </div>
      </main>
      <Footer />
    </>
  );
}

function Row({ label, children }: { label: string; children: ReactNode }) {
  return (
    <div className="flex flex-col border-b border-outline-variant/40 py-space-md md:flex-row md:gap-space-xl">
      <dt className="pb-space-xs text-sm font-medium text-on-surface md:w-40 md:shrink-0 md:pb-0">{label}</dt>
      <dd className="text-sm text-on-surface md:flex-1">{children}</dd>
    </div>
  );
}
