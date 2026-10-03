import Link from "next/link";
import Header from "@/components/redesign/Header";
import Footer from "@/components/redesign/Footer";
import PageHero from "@/components/redesign/PageHero";
import Breadcrumb from "@/components/redesign/Breadcrumb";
import { countPublishedNewses, getPublishedNewses, NEWS_PER_PAGE } from "@/lib/newses";
import { buildPaginationElements, paginate } from "@/lib/pagination";

/**
 * お知らせ一覧 GET /newses（リデザイン版。design/stitch/news.html を参考）
 * データ取得・ページ送りのロジックは既存 (site)/newses/_legacy/page.tsx と同じ（?page=、10 件、Laravel 互換の省略記号）。
 * HTML は 0 件表示のみのため、一覧の行とページ送りの見た目は仮置き。
 */
export default async function NewsesPage({ searchParams }: PageProps<"/newses">) {
  const { page } = await searchParams;
  const requestedPage = Number.parseInt(Array.isArray(page) ? page[0] : (page ?? "1"), 10);
  const total = await countPublishedNewses();
  const pager = paginate(total, NEWS_PER_PAGE, requestedPage);
  const newsList = await getPublishedNewses(pager.offset, pager.perPage);

  return (
    <>
      <Header />
      <main className="w-full bg-surface pt-20">
        <PageHero title="News" />

        <section className="w-full py-space-2xl lg:py-space-3xl">
          <div className="wrap">
            <div className="mb-space-xl flex items-center gap-4">
              <div className="h-8 w-1 bg-primary-container" aria-hidden="true" />
              <h2 className="font-serif-jp text-2xl font-bold tracking-wide text-on-surface">最新情報一覧</h2>
            </div>

            <div>
              <div className="border-b border-outline-variant/40 pb-3 text-right text-xs text-on-surface-variant">
                該当件数 : {pager.total.toLocaleString("ja-JP")}件
              </div>

              {newsList.length === 0 ? (
                <div className="border-b border-outline-variant/40 py-space-3xl text-center">
                  <p className="font-serif-jp text-base tracking-wider text-on-surface-variant">お知らせはありません。</p>
                </div>
              ) : (
                <ul className="divide-y divide-outline-variant/40 border-b border-outline-variant/40">
                  {newsList.map((item) => (
                    <li key={item.id}>
                      <Link href={`/newses/${item.id}`} className="group flex items-center gap-space-md py-space-md transition-colors hover:bg-surface-container-low">
                        <span className="h-20 w-20 shrink-0 overflow-clip rounded-lg bg-surface-container shadow-sm">
                          {/* eslint-disable-next-line @next/next/no-img-element */}
                          <img src={item.thumb} alt="" className="h-full w-full object-cover" loading="lazy" />
                        </span>
                        <span className="min-w-0 flex-1">
                          <span className="block truncate pr-2 font-medium text-on-surface transition-colors group-hover:text-primary" title={item.title}>
                            {item.title}
                          </span>
                          {item.createdAtFmt ? <time className="font-latin text-xs tracking-wider text-outline">{item.createdAtFmt}</time> : null}
                        </span>
                        <span className="ml-auto text-outline transition-colors group-hover:text-primary" aria-hidden="true">
                          <svg className="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M9 6l6 6-6 6" strokeLinecap="round" strokeLinejoin="round" />
                          </svg>
                        </span>
                        <span className="sr-only">詳細へ</span>
                      </Link>
                    </li>
                  ))}
                </ul>
              )}

              <Pagination currentPage={pager.currentPage} lastPage={pager.lastPage} basePath="/newses" />
            </div>
          </div>
        </section>

        <Breadcrumb items={[{ label: "最新情報" }]} />
      </main>
      <Footer />
    </>
  );
}

/** ページ送り（既存 components/Pagination.tsx と同じ並び。見た目だけリデザイン） */
function Pagination({ currentPage, lastPage, basePath }: { currentPage: number; lastPage: number; basePath: string }) {
  if (lastPage <= 1) return null;
  const pageUrl = (p: number) => `${basePath}?page=${p}`;
  const elements = buildPaginationElements(currentPage, lastPage, 1);
  const base = "inline-flex h-9 min-w-9 items-center justify-center rounded-full px-3 font-latin text-sm transition-colors";
  const idle = `${base} text-on-surface-variant hover:bg-surface-container-low hover:text-primary`;
  const disabled = `${base} text-outline-variant`;
  const active = `${base} bg-primary text-on-primary`;

  return (
    <nav aria-label="お知らせのページ送り" className="mt-space-xl flex justify-center">
      <ul className="flex items-center gap-1">
        <li>
          {currentPage <= 1 ? (
            <span className={disabled} aria-hidden="true">
              ‹
            </span>
          ) : (
            <Link className={idle} href={pageUrl(currentPage - 1)} rel="prev" aria-label="前のページ">
              ‹
            </Link>
          )}
        </li>
        {elements.map((el, i) =>
          el === "..." ? (
            <li key={`dots-${i}`}>
              <span className={disabled}>…</span>
            </li>
          ) : (
            el.map((p) => (
              <li key={p}>
                {p === currentPage ? (
                  <span className={active} aria-current="page">
                    {p}
                  </span>
                ) : (
                  <Link className={idle} href={pageUrl(p)}>
                    {p}
                  </Link>
                )}
              </li>
            ))
          ),
        )}
        <li>
          {currentPage < lastPage ? (
            <Link className={idle} href={pageUrl(currentPage + 1)} rel="next" aria-label="次のページ">
              ›
            </Link>
          ) : (
            <span className={disabled} aria-hidden="true">
              ›
            </span>
          )}
        </li>
      </ul>
    </nav>
  );
}
