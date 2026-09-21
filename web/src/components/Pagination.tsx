import Link from "next/link";
import { buildPaginationElements } from "@/lib/pagination";

type Props = {
  currentPage: number;
  lastPage: number;
  /** ページ番号を付与するパス（例: "/newses"） */
  basePath: string;
  /** Laravel の onEachSide() 相当 */
  onEachSide?: number;
};

/**
 * Laravel 標準の pagination::bootstrap-4 テンプレートと同じマークアップを出力する。
 * 1ページしかない場合は何も描画しない（$paginator->hasPages() が false のとき同様）。
 */
export default function Pagination({ currentPage, lastPage, basePath, onEachSide = 1 }: Props) {
  if (lastPage <= 1) return null;

  const pageUrl = (page: number) => `${basePath}?page=${page}`;
  const elements = buildPaginationElements(currentPage, lastPage, onEachSide);

  return (
    <nav>
      <ul className="pagination">
        {/* Previous Page Link */}
        {currentPage <= 1 ? (
          <li className="page-item disabled" aria-label="&laquo; Previous">
            <span className="page-link" aria-hidden="true">
              &lsaquo;
            </span>
          </li>
        ) : (
          <li className="page-item">
            <Link className="page-link" href={pageUrl(currentPage - 1)} rel="prev" aria-label="&laquo; Previous">
              &lsaquo;
            </Link>
          </li>
        )}

        {/* Pagination Elements */}
        {elements.map((element, index) =>
          element === "..." ? (
            <li key={`dots-${index}`} className="page-item disabled">
              <span className="page-link">...</span>
            </li>
          ) : (
            element.map((page) =>
              page === currentPage ? (
                <li key={page} className="page-item active" aria-current="page">
                  <span className="page-link">{page}</span>
                </li>
              ) : (
                <li key={page} className="page-item">
                  <Link className="page-link" href={pageUrl(page)}>
                    {page}
                  </Link>
                </li>
              ),
            )
          ),
        )}

        {/* Next Page Link */}
        {currentPage < lastPage ? (
          <li className="page-item">
            <Link className="page-link" href={pageUrl(currentPage + 1)} rel="next" aria-label="Next &raquo;">
              &rsaquo;
            </Link>
          </li>
        ) : (
          <li className="page-item disabled" aria-label="Next &raquo;">
            <span className="page-link" aria-hidden="true">
              &rsaquo;
            </span>
          </li>
        )}
      </ul>
    </nav>
  );
}
