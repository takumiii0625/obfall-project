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
    <x-page-hero title="News" sub="最新情報" variant="wave" />
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <article class="card border-0 shadow-sm">
                        <div class="card-body p-4 p-md-5">

                            {{-- タイトル & 日付（通常フロー） --}}
                            @php
                            $date = $assign['record']->created_at_fmt
                            ?? ($assign['record']->created_at ? $assign['record']->created_at->format('Y-m-d') : '');
                            @endphp

                            <div class="mb-3">
                                @if($date)
                                <div class="text-body-secondary small mb-4">{{ $date }}</div>
                                @endif
                                <h1 class="h3 h2-md mb-1">{{ $assign['record']->title }}</h1>

                            </div>

                            {{-- 画像（1枚だけ、トリミングなし） --}}
                            @php
                            $image = collect([
                            $assign['record']->news_image_url_1 ?? null,
                            $assign['record']->news_image_url_2 ?? null,
                            $assign['record']->news_image_url_3 ?? null,
                            ])->first(fn($u) => !empty($u));
                            @endphp

                            @if($image)
                            <figure class="mb-4">
                                <img src="{{ asset($image) }}"
                                    alt="お知らせ画像"
                                    class="img-fluid rounded d-block"
                                    style="max-width:100%; height:auto;">
                            </figure>
                            @endif

                            {{-- 本文（改行維持） --}}
                            <div class="fs-6 lh-lg" style="white-space: pre-line;">
                                {{ $assign['record']->content }}
                            </div>

                            <!-- お知らせ一覧に戻るボタン -->
                            <div class="mt-5">
                                <a href="{{ route('userNewsIndex') }}" class="btn btn-outline-primary">
                                    <i class="fa-solid fa-circle-arrow-left me-2"></i>一覧に戻る
                                </a>
                            </div>

                        </div>
                    </article>
                </div>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="m-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">

                <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('userNewsIndex') }}">最新情報</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $assign['record']->title ?? '最新情報' }}</li>
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