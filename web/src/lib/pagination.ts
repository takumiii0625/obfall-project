/**
 * Laravel の LengthAwarePaginator + UrlWindow（onEachSide(1)）の
 * 表示ロジックを移植したもの。
 *
 * 返り値は Laravel の $elements と同じ構造:
 *   - number[]  … 連続したページ番号のブロック
 *   - "..."     … 省略記号
 */
export type PaginationElement = number[] | "...";

export type PaginationState = {
  currentPage: number;
  lastPage: number;
  perPage: number;
  total: number;
  /** 現在ページの先頭インデックス（0 始まり） */
  offset: number;
};

export function paginate(total: number, perPage: number, requestedPage: number): PaginationState {
  const lastPage = Math.max(1, Math.ceil(total / perPage));
  const currentPage = Number.isInteger(requestedPage) && requestedPage >= 1 ? requestedPage : 1;
  return {
    currentPage,
    lastPage,
    perPage,
    total,
    offset: (currentPage - 1) * perPage,
  };
}

function range(start: number, end: number): number[] {
  const out: number[] = [];
  for (let i = start; i <= end; i += 1) out.push(i);
  return out;
}

/** Illuminate\Pagination\UrlWindow::get() 相当 */
export function buildPaginationElements(
  currentPage: number,
  lastPage: number,
  onEachSide = 1,
): PaginationElement[] {
  if (lastPage <= 1) return [];

  // getSmallSlider: ページ数が少ないときは全ページを並べる
  if (lastPage < onEachSide * 2 + 8) {
    return [range(1, lastPage)];
  }

  const window = onEachSide + 4;
  let first: number[];
  let slider: number[] | null = null;
  let last: number[];

  if (currentPage <= window) {
    // getSliderTooCloseToBeginning
    first = range(1, window + onEachSide);
    last = range(lastPage - 1, lastPage);
  } else if (currentPage > lastPage - window) {
    // getSliderTooCloseToEnding
    first = range(1, 2);
    last = range(lastPage - (window + onEachSide - 1), lastPage);
  } else {
    // getFullSlider
    first = range(1, 2);
    slider = range(currentPage - onEachSide, currentPage + onEachSide);
    last = range(lastPage - 1, lastPage);
  }

  const elements: PaginationElement[] = [first];
  if (slider) {
    elements.push("...", slider);
  }
  elements.push("...", last);
  return elements;
}
