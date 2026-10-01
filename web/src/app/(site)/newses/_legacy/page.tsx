import Link from "next/link";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import PageHero from "@/components/PageHero";
import Pagination from "@/components/Pagination";
import Breadcrumb from "@/components/Breadcrumb";
import { countPublishedNewses, getPublishedNewses, NEWS_PER_PAGE } from "@/lib/newses";
import { paginate } from "@/lib/pagination";
import "../newses.css";

/**
 * お知らせ一覧 GET /newses
 * 現行: resources/views/user/newses/index.blade.php + UserNewsesController@index
 * データは DB（newses）。?page= を持つため動的レンダリング（ISR の対象外。現行も毎回 DB 参照）。
 */
export default async function NewsesPage({ searchParams }: PageProps<"/newses">) {
  const { page } = await searchParams;
  const requestedPage = Number.parseInt(Array.isArray(page) ? page[0] : (page ?? "1"), 10);

  const total = await countPublishedNewses();
  const pager = paginate(total, NEWS_PER_PAGE, requestedPage);
  const newsList = await getPublishedNewses(pager.offset, pager.perPage);

  return (
    <div className="page-newses">
      <Header />
      <PageHero title="News" sub="最新情報一覧" variant="wave" />
      <main className="py-5">
        <div className="container">
          <div className="row justify-content-center">
            <div className="col-lg-9">
              <article className="card border-0 shadow-sm">
                <div className="container py-4">
                  <h1 className="h4 mb-3">最新情報一覧</h1>

                  <div className="list-group list-group-flush">
                    {newsList.length === 0 ? (
                      <div className="text-muted p-3">お知らせはありません。</div>
                    ) : (
                      newsList.map((item) => (
                        <Link
                          key={item.id}
                          href={`/newses/${item.id}`}
                          className="list-group-item list-group-item-action d-flex align-items-center gap-3 text-decoration-none text-dark"
                        >
                          {/* サムネ */}
                          <div className="ratio ratio-1x1 flex-shrink-0" style={{ width: 80 }}>
                            {/* eslint-disable-next-line @next/next/no-img-element */}
                            <img
                              src={item.thumb}
                              alt={item.title}
                              className="w-100 h-100 rounded shadow-sm"
                              style={{ objectFit: "cover" }}
                              loading="lazy"
                            />
                          </div>

                          {/* タイトル＋日付 */}
                          <div className="flex-grow-1">
                            <div className="fw-semibold text-truncate pe-2" title={item.title}>
                              {item.title}
                            </div>
                            {item.createdAtFmt ? <time className="text-muted small">{item.createdAtFmt}</time> : null}
                          </div>

                          {/* 右端の矢印（Font Awesome） */}
                          <i className="fa-solid fa-chevron-right text-muted ms-auto go-icon" aria-hidden="true"></i>
                          <span className="visually-hidden">詳細へ</span>
                        </Link>
                      ))
                    )}
                  </div>

                  {/* 合計件数だけ */}
                  <div className="row mt-4">
                    <div className="col-12">該当件数 : {pager.total.toLocaleString("ja-JP")}件</div>
                  </div>

                  {/* ページネーション（10件） */}
                  <div className="mt-3">
                    <nav aria-label="お知らせのページ送り" className="mt-3">
                      <div className="d-flex justify-content-center">
                        <Pagination currentPage={pager.currentPage} lastPage={pager.lastPage} basePath="/newses" />
                      </div>
                    </nav>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
        <Breadcrumb current="最新情報" className="m-3" />
      </main>
      <Footer />
    </div>
  );
}
