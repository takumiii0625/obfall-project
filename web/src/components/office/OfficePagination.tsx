import Link from "next/link";

type Props = {
  currentPage: number;
  lastPage: number;
  /** ページ番号から URL を作る（検索条件のクエリを引き継ぐ） */
  pageHref: (page: number) => string;
};

/** 現行 office/parts/item/pagination.blade.php の表示ページ数上限 */
const LINK_NUM = 5;

/**
 * 管理画面のページャー（現行 office/parts/item/pagination.blade.php）。
 * 先頭 / 前 / 中央 5 ページ / 次 / 最後。1 ページしかなければ描画しない（hasPages()）。
 */
export default function OfficePagination({ currentPage, lastPage, pageHref }: Props) {
  if (lastPage <= 1) return null;

  const half = Math.floor(LINK_NUM / 2);
  let start = Math.max(1, currentPage - half);
  const end = Math.min(lastPage, start + LINK_NUM - 1);
  if (end - start < LINK_NUM - 1) start = Math.max(1, end - LINK_NUM + 1);
  const pages: number[] = [];
  for (let i = start; i <= end; i += 1) pages.push(i);

  const onFirst = currentPage <= 1;
  const onLast = currentPage >= lastPage;

  return (
    <nav className="d-flex justify-content-end">
      <div className="d-flex flex-fill justify-content-end">
        <ul className="pagination mb-0">
          {/* 最初のページへ */}
          {onFirst ? (
            <li className="page-item disabled" aria-label="先頭へ">
              <span className="page-link" aria-hidden="true">
                &laquo;&laquo;
              </span>
            </li>
          ) : (
            <li className="page-item">
              <Link className="page-link" href={pageHref(1)} rel="first" aria-label="先頭へ">
                &laquo;&laquo;
              </Link>
            </li>
          )}

          {/* 前のページ */}
          {onFirst ? (
            <li className="page-item disabled" aria-label="前へ">
              <span className="page-link" aria-hidden="true">
                &laquo;
              </span>
            </li>
          ) : (
            <li className="page-item">
              <Link className="page-link" href={pageHref(currentPage - 1)} rel="prev" aria-label="前へ">
                &laquo;
              </Link>
            </li>
          )}

          {/* 中央のページ番号リンク */}
          {pages.map((page) => (
            <li key={page} className={`page-item ${page === currentPage ? "active" : ""}`}>
              {page === currentPage ? (
                <span className="page-link">{page}</span>
              ) : (
                <Link className="page-link" href={pageHref(page)}>
                  {page}
                </Link>
              )}
            </li>
          ))}

          {/* 次のページ */}
          {onLast ? (
            <li className="page-item disabled" aria-label="次へ">
              <span className="page-link" aria-hidden="true">
                &raquo;
              </span>
            </li>
          ) : (
            <li className="page-item">
              <Link className="page-link" href={pageHref(currentPage + 1)} rel="next" aria-label="次へ">
                &raquo;
              </Link>
            </li>
          )}

          {/* 最後のページへ */}
          {onLast ? (
            <li className="page-item disabled" aria-label="最後へ">
              <span className="page-link" aria-hidden="true">
                &raquo;&raquo;
              </span>
            </li>
          ) : (
            <li className="page-item">
              <Link className="page-link" href={pageHref(lastPage)} rel="last" aria-label="最後へ">
                &raquo;&raquo;
              </Link>
            </li>
          )}
        </ul>
      </div>
    </nav>
  );
}
