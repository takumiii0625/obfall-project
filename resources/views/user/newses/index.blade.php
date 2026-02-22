<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="https://obfall.com/image/logo_OBFall2.png">
    <title>OBFall株式会社</title>
    <link rel="icon" href="../image/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Bootstrap 5 CDN (例) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="top">
        <x-header />
        <nav class="nav-02">
            <ul>

                <li class="link text-dark "><a href="{{ route('philosophy') }}" class="text-dark text-decoration-none">PHILOSOPHY</a></li>
                <li class="link text-dark "><a href="{{ route('userServicesShow') }}" class="text-dark text-decoration-none">SERVICE</a></li>
                <li class="link text-dark "><a href="{{ route('achievements') }}" class="text-dark text-decoration-none">ACHIEVEMENTS</a></li>
                <li class="link text-dark "><a href="{{ route('aboutus') }}" class="text-dark text-decoration-none">ABOUT US</a></li>
                <li class="link text-dark "><a href="{{ route('contact') }}" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTACT</a></li>

            </ul>
        </nav>


    </div>
    <x-page-hero title="News" sub="最新情報一覧" variant="wave" />
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <article class="card border-0 shadow-sm">
                        {{-- user/newses/index.blade.php の一覧部分 --}}
                        <div class="container py-4">
                            <h1 class="h4 mb-3">最新情報一覧</h1>

                            <div class="list-group list-group-flush">
                                @forelse ($assign['newsList'] as $item)
                                @php
                                $raw = $item->news_image_url_1 ?? null;
                                $thumb = $raw
                                ? (\Illuminate\Support\Str::startsWith($raw, ['http://','https://','/']) ? $raw : asset($raw))
                                : asset('image/noimg-square.jpg');
                                $date = $item->created_at_fmt ?? '';
                                @endphp

                                <a href="{{ route('userNewsShow', ['id' => $item->id]) }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center gap-3 text-decoration-none text-dark">

                                    {{-- サムネ --}}
                                    <div class="ratio ratio-1x1 flex-shrink-0" style="width:80px;">
                                        <img src="{{ $thumb }}" alt="{{ $item->title }}"
                                            class="w-100 h-100 rounded shadow-sm" style="object-fit:cover;" loading="lazy">
                                    </div>

                                    {{-- タイトル＋日付 --}}
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold text-truncate pe-2" title="{{ $item->title }}">
                                            {{ $item->title }}
                                        </div>
                                        @if($date)
                                        <time class="text-muted small">{{ $date }}</time>
                                        @endif
                                    </div>

                                    {{-- 右端の矢印（Font Awesome）--}}
                                    <i class="fa-solid fa-chevron-right text-muted ms-auto go-icon" aria-hidden="true"></i>
                                    <span class="visually-hidden">詳細へ</span>
                                </a>
                                @empty
                                <div class="text-muted p-3">お知らせはありません。</div>
                                @endforelse
                            </div>
                            {{-- 合計件数だけ --}}
                            <div class="row mt-4">
                                <div class="col-12">
                                    該当件数 : {{ number_format($assign['newsList']->total()) }}件
                                </div>
                            </div>

                            {{-- ページネーション（10件） --}}
                            <div class="mt-3">
                                {{-- ページネーション（Bootstrap 5 & 中央寄せ） --}}
                                <nav aria-label="お知らせのページ送り" class="mt-3">
                                    <div class="d-flex justify-content-center">
                                        {{ $assign['newsList']->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
                                    </div>
                                </nav>

                            </div>
                        </div>

                    </article>
                </div>
            </div>

        </div>
        <nav aria-label="breadcrumb" class="m-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">

                <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                <li class="breadcrumb-item">最新情報</a></li>
            </ol>
        </nav>


    </main>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>


</body>


<style>
    :root {
        --bg: #f8fafc;
        --ink: #1a1a1a;
        --ink-2: #1e3a5f;
        --muted: #5a6978;
        --blue: #0dcaf0;
        --blue-weak: #eef4f8;
        --card: #ffffff;
        --divider: #dde5ed;
        --radius: 12px;
        --shadow: 0 4px 20px rgba(30, 58, 95, .10);
        --maxw: 1120px;
    }

    .human-rights-policy {
        color: #eef6ff
    }

    html,
    body {
        background: var(--bg);
        color: var(--ink);
        font-family: -apple-system, BlinkMacSystemFont, "Hiragino Kaku Gothic ProN", "Noto Sans JP", Segoe UI, Roboto, Ubuntu, "Helvetica Neue", "Helvetica", Arial, sans-serif;
        line-height: 1.8;
    }

    h1,
    h2,
    h3 {
        line-height: 1.35;
        margin: 0 0 .5em
    }


    h2 {
        font-size: clamp(18px, 2.6vw, 26px);
        font-weight: 700;
        color: var(--blue)
    }

    h3 {
        font-size: clamp(16px, 2.2vw, 22px);
        font-weight: 700
    }

    p {
        margin: .6em 0
    }

    .wrap {
        max-width: var(--maxw);
        margin: 0 auto;
        padding: 0 20px
    }

    section {
        padding: 80px 0;
        border-top: 1px solid var(--divider)
    }

    /* スマホ表示用のスタイル */
    @media (max-width: 767px) {
        .fs-7 {
            font-size: 3px;
        }

    }

    .human-rights-policy {
        color: #eef6ff
    }

</style>