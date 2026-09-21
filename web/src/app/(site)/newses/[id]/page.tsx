import Link from "next/link";
import { redirect } from "next/navigation";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Breadcrumb from "@/components/Breadcrumb";
import { getNewsById, getPublishedNewsIds } from "@/lib/newses";
import "./news-show.css";

// ISR。Next.js のセグメント設定はリテラルでなければならないため直書き（値は lib/revalidate.ts の NEWS_REVALIDATE_SECONDS と合わせる）
export const revalidate = 600;

/**
 * 公開中の詳細はビルド時に生成。一覧に無い id（非公開・ビルド後の新規）も dynamicParams（既定 true）で
 * 初回アクセス時に生成され、以後は ISR キャッシュされる。
 */
export async function generateStaticParams() {
  const ids = await getPublishedNewsIds();
  return ids.map((id) => ({ id: String(id) }));
}

/**
 * お知らせ詳細 GET /newses/{id}（§2.1 #3）
 * 現行: resources/views/user/newses/show.blade.php + User\UserNewsesController@show
 *
 * - 現行どおり status を見ない（非公開でも直 URL で閲覧可。§7.1 の 9。修正可否は会社回答待ち）
 * - 存在しない・削除済み・id が数値でない場合は現行どおり一覧へリダイレクト
 *   （現行はフラッシュ 'お知らせが存在しません。' を付けるが、一覧ビューに表示箇所が無いため移植しない）
 * - <title> は現行どおり既定の「OBFall株式会社」（ページ固有 metadata なし）
 */
export default async function NewsShowPage({ params }: PageProps<"/newses/[id]">) {
  const { id } = await params;
  const news = await getNewsById(Number(id));
  if (!news) {
    redirect("/newses");
  }

  return (
    <div className="page-news-show">
      <Header />
      <PageHero title="News" sub="最新情報" variant="wave" />
      <main className="py-5">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-9">
              <article className="card border-0 shadow-sm">
                <div className="card-body p-4 p-md-5">
                  {/* タイトル & 日付 */}
                  <div className="mb-3">
                    {news.createdAtFmt ? <div className="text-body-secondary small mb-4">{news.createdAtFmt}</div> : null}
                    <h1 className="h3 h2-md mb-1">{news.title}</h1>
                  </div>

                  {/* 画像（1枚だけ、トリミングなし） */}
                  {news.image ? (
                    <figure className="mb-4">
                      {/* eslint-disable-next-line @next/next/no-img-element */}
                      <img
                        src={news.image}
                        alt="お知らせ画像"
                        className="img-fluid rounded d-block"
                        style={{ maxWidth: "100%", height: "auto" }}
                      />
                    </figure>
                  ) : null}

                  {/* 本文（改行維持） */}
                  <div className="fs-6 lh-lg" style={{ whiteSpace: "pre-line" }}>
                    {news.content}
                  </div>

                  {/* お知らせ一覧に戻るボタン */}
                  <div className="mt-5">
                    <Link href="/newses" className="btn btn-outline-primary">
                      <i className="fa-solid fa-circle-arrow-left me-2"></i>一覧に戻る
                    </Link>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
        <Breadcrumb current={news.title || "最新情報"} parents={[{ label: "最新情報", href: "/newses" }]} className="m-3" />
      </main>
      <Footer />
    </div>
  );
}
