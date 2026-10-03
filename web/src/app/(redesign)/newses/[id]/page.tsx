import type { Metadata } from "next";
import Link from "next/link";
import { redirect } from "next/navigation";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import { getNewsById, getPublishedNewsIds } from "@/lib/newses";

// ISR。Next.js のセグメント設定はリテラルでなければならないため直書き（値は lib/revalidate.ts の NEWS_REVALIDATE_SECONDS と合わせる）
export const revalidate = 600;

/** 公開中の詳細はビルド時に生成。一覧に無い id も dynamicParams で初回アクセス時に生成され、以後 ISR キャッシュ */
export async function generateStaticParams() {
  const ids = await getPublishedNewsIds();
  return ids.map((id) => ({ id: String(id) }));
}

/** <title> は「記事タイトル | OBFall Inc.」（他のページと同じ形）。記事が無い場合は既定のまま（本体でリダイレクトする） */
export async function generateMetadata({ params }: PageProps<"/newses/[id]">): Promise<Metadata> {
  const { id } = await params;
  const news = await getNewsById(Number(id));
  if (!news) return {};
  return { title: `${news.title} | OBFall Inc.` };
}

/**
 * お知らせ詳細 GET /newses/{id}（リデザイン版。newses 一覧の構成を流用）
 * データ取得・リダイレクト・ISR は既存 (site)/newses/[id]/_legacy/page.tsx と同じ。
 * 現行どおり status を見ない（§7.1 の 9）。
 */
export default async function NewsShowPage({ params }: PageProps<"/newses/[id]">) {
  const { id } = await params;
  const news = await getNewsById(Number(id));
  if (!news) {
    redirect("/newses");
  }

  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero breadcrumbs={[{ label: "最新情報", href: "/newses" }, { label: news.title || "最新情報" }]} label="NEWS" title="News" />

        <section className="w-full py-space-2xl lg:py-space-3xl">
          <div className="wrap">
            <article className="mx-auto max-w-4xl rounded-xl bg-surface-container-lowest p-space-lg shadow-sm md:p-space-xl lg:p-space-2xl">
              {/* 日付とタイトル */}
              <div className="mb-space-lg border-b border-outline-variant/40 pb-space-lg">
                {news.createdAtFmt ? <time className="mb-space-md block font-latin text-sm tracking-wider text-outline">{news.createdAtFmt}</time> : null}
                <h1 className="font-serif-jp text-[24px] leading-snug font-bold text-on-surface lg:text-[32px]">{news.title}</h1>
              </div>

              {/* 画像（1枚だけ、トリミングなし） */}
              {news.image ? (
                <figure className="mb-space-lg">
                  {/* eslint-disable-next-line @next/next/no-img-element */}
                  <img src={news.image} alt="お知らせ画像" className="block h-auto max-w-full rounded-lg" />
                </figure>
              ) : null}

              {/* 本文（改行維持） */}
              <div className="text-base leading-loose whitespace-pre-line text-on-surface">{news.content}</div>

              <div className="mt-space-2xl">
                <Link
                  href="/newses"
                  className="inline-flex items-center gap-space-sm rounded-full border border-primary px-space-lg py-space-sm text-sm font-medium text-primary transition-colors hover:bg-primary hover:text-on-primary"
                >
                  <svg className="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" aria-hidden="true">
                    <path d="M19 12H5M11 6l-6 6 6 6" strokeLinecap="round" strokeLinejoin="round" />
                  </svg>
                  一覧に戻る
                </Link>
              </div>
            </article>
          </div>
        </section>
      </main>
      <Footer />
    </>
  );
}
