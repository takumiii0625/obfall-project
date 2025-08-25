@if ($paginator->hasPages())
<nav class="d-flex justify-content-end">
    <div class="d-flex flex-fill justify-content-end">
        <ul class="pagination mb-0">
            {{-- 最初のページへ --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="先頭へ">
                <span class="page-link" aria-hidden="true">&laquo;&laquo;</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}" rel="first" aria-label="先頭へ">&laquo;&laquo;</a>
            </li>
            @endif

            {{-- 前のページ --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="前へ">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="前へ">&laquo;</a>
            </li>
            @endif

            {{-- 中央のページ番号リンク --}}
            @php
            $linkNum = 5; // 表示するページ数の上限
            $lastPage = $paginator->lastPage();
            $currentPage = $paginator->currentPage();
            $half = floor($linkNum / 2);
            $start = max(1, $currentPage - $half);
            $end = min($lastPage, $start + $linkNum - 1);
            if ($end - $start < $linkNum - 1) {
                $start=max(1, $end - $linkNum + 1);
                }
                @endphp

                @for ($i=$start; $i <=$end; $i++)
                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                @if ($i == $currentPage)
                <span class="page-link">{{ $i }}</span>
                @else
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                @endif
                </li>
                @endfor

                {{-- 次のページ --}}
                @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="次へ">&raquo;</a>
                </li>
                @else
                <li class="page-item disabled" aria-disabled="true" aria-label="次へ">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
                @endif

                {{-- 最後のページへ --}}
                @if ($paginator->currentPage() === $paginator->lastPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="最後へ">
                    <span class="page-link" aria-hidden="true">&raquo;&raquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" rel="last" aria-label="最後へ">&raquo;&raquo;</a>
                </li>
                @endif
        </ul>
    </div>
</nav>
@endif