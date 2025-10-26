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
        <header class="fadein-first fadein-from-up">
            <div class="wrap">
                <a href="{{ route('indexDev') }}" class="text-dark text-decoration-none">
                    <div class="logo-container">
                        <img src="../image/logo_OBFall.png" class="link" onclick="scrollToTop()" />
                        <div class="title" onclick="scrollToTop()">OBFall株式会社</div>
                    </div>
                </a>
                <nav class="nav-01">
                    <ul>
                        <li class="link text-dark "><a href="{{ route('philosophy') }}" class="text-dark text-decoration-none">PHILOSOPHY</a></li>
                        <li class="link text-dark "><a href="{{ route('userServicesShow') }}" class="text-dark text-decoration-none">SERVICE</a></li>
                        <li class="link text-dark "><a href="{{ route('achievements') }}" class="text-dark text-decoration-none">ACHIEVEMENTS</a></li>
                        <li class="link text-dark "><a href="{{ route('aboutus') }}" class="text-dark text-decoration-none">ABOUT US</a></li>
                        <li class="link text-dark "><a href="{{ route('contact') }}" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTACT</a></li>

                    </ul>
                </nav>
                <div class="hamburger">
                    <span class="bar bar-top"></span>
                    <span class="bar bar-middle"></span>
                    <span class="bar bar-bottom"></span>
                </div>
            </div>

        </header>
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
    <section class="hero">
        <div class="wrap">
            <div class="title">
                <h1 class="">News</h1>
                <div class="sub">最新情報</div>
            </div>

        </div>
    </section>
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

    <footer>
        <div class=" devwrap d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <!-- PC:左 / SP:一番上（ロゴ＋ページトップへ） -->
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center order-1 order-md-1">
                <img src="../image/logo_OBFall_white.png"
                    class="link logo" onclick="scrollToTop()" alt="OBFall株式会社ロゴ">
            </div>

            <!-- PC:中央 / SP:一番下（住所など） -->
            <div class="footer-left col-12 col-md-4 order-3 order-md-2 text-center text-md-start">
                <p>
                    〒105-0022<br>
                    東京都港区海岸1-2-3&nbsp;&nbsp;汐留芝離宮ビルディング 21F<br>
                    TEL:03-5403-5904<br>
                    <a href="{{ url('/human-rights-policy') }}" target="_blank" class="human-rights-policy">
                        人権に関する基本方針と社内相談窓口
                    </a>
                </p>

            </div>

            <!-- PC:右 / SP:2番目（お問い合わせボタン） -->
            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center order-2 order-md-3">
                <a href="{{ route('contact') }}" class="btn btn-dark" target="_blank" rel="noopener noreferrer">
                    お問い合わせ画面へ <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/main.js') }}" defer></script>


</body>


<style>
    :root {
        --bg: #ffffff;
        --ink: #1A1A1A;
        --ink-2: #3a3a3a;
        --muted: #6b7785;
        --blue: #1E90FF;
        --blue-weak: #F6FAFD;
        --card: #ffffff;
        --divider: #E7EEF5;
        --radius: 16px;
        --shadow: 0 2px 14px rgba(0, 0, 0, .06);
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

    h1 {
        font-size: clamp(28px, 4vw, 40px);
        font-weight: 800;
        color: black;
        font-family: 'Times New Roman', Times, serif;
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

    .hero {
        --hero-img: url('../image/chou.jpg');

        position: relative;
        background-image: var(--hero-img);
        background-size: cover;
        /* 画面いっぱいにフィット */
        background-position: center;
        /* 中央寄せ */
        background-repeat: no-repeat;
        min-height: 56vh;
        /* お好みで高さ調整 */
        color: #111;
        /* テキスト色 */
    }

    /* 白フィルター（上に薄く被せる） */
    .hero::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.45);
        /* 透明度はお好みで 0.3〜0.6 */
        pointer-events: none;
        /* クリック干渉を防ぐ */
    }

    /* テキストを最前面に */
    .hero .wrap {
        position: relative;
        z-index: 1;
        padding: clamp(48px, 8vw, 120px) 16px;
    }


    .hero .title h1 {
        line-height: 1.3;
        margin: 0 0 .5rem;
    }

    .hero .sub {
        font-weight: 600;
        letter-spacing: .06em;
        opacity: .9;
    }

    .hero .lead {
        margin-top: 1rem;
        max-width: 60ch;
    }

    /* md=768px 基準 */
    @media (max-width: 767.98px) {
        .hero {
            --hero-img: url('../image/chou.jpg');

            position: relative;
            background-image: var(--hero-img);
            background-size: cover;
            /* 画面いっぱいにフィット */
            background-position: center;
            /* 中央寄せ */
            background-repeat: no-repeat;
            min-height: 46vh;
            /* お好みで高さ調整 */
            color: #111;
            /* テキスト色 */
        }

        .hero .wrap {
            position: relative;
            z-index: 1;
            padding: clamp(48px, 8vw, 160px) 10px;
        }

        .hero .title h1 {
            font-size: 1.070rem;
            line-height: 1.3;
            margin: 0 0 .5rem;
        }

        .hero .sub {
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: .06em;
            opacity: .9;
        }

        .lead {
            font-size: 0.875rem;
        }

        /* small 相当 */
    }
</style>