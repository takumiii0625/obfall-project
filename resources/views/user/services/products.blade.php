<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Bootstrap 5 CDN (例) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <title>自社開発（Products） | OBFall Inc.</title>
    <style>
        :root {
            --ink: #1a1a1a;
            --muted: #5a6978;
            --blue: #0dcaf0;
            --blue-light: rgba(13,202,240,.08);
            --bg: #fff;
            --bg-alt: #f8fafc;
            --card: #fff;
            --line: #e2e8f0;
            --radius: 16px;
            --shadow: 0 4px 24px rgba(0,0,0,.06);
            --shadow-hover: 0 12px 40px rgba(0,0,0,.10);
            --maxw: 1100px;
            --font-heading: "Times New Roman", "Noto Serif JP", Georgia, serif;
        }

        .human-rights-policy { color: #eef6ff }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--bg);
            font-family: -apple-system, BlinkMacSystemFont, "Noto Sans JP", "Segoe UI", Roboto, Arial, sans-serif;
            line-height: 1.8;
        }

        .wrap {
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ── セクション ── */
        .sec { padding: 80px 0; }
        .sec--alt { background: var(--bg-alt); }

        /* ── リード文 ── */
        .lead-text {
            font-size: clamp(1rem, 1.8vw, 1.18rem);
            max-width: 720px;
            line-height: 2;
            color: #444;
            margin: 0 auto;
            text-align: center;
        }

        /* ── セクション見出し ── */
        .sec-heading {
            text-align: center;
            margin-bottom: 48px;
        }
        .sec-heading__kicker {
            display: block;
            font-size: .75rem;
            letter-spacing: .14em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .sec-heading__title {
            font-family: var(--font-heading);
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 700;
            margin: 0;
            line-height: 1.4;
        }

        /* ── 3つの価値カード ── */
        .value-grid {
            display: grid;
            gap: 28px;
            grid-template-columns: 1fr;
        }
        @media (min-width: 768px) {
            .value-grid { grid-template-columns: repeat(3, 1fr); }
        }

        .value-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 36px 32px 32px;
            box-shadow: var(--shadow);
            transition: transform .3s ease, box-shadow .3s ease;
            text-align: center;
        }
        .value-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .value-card__num {
            font-size: 2.5rem;
            font-weight: 800;
            color: rgba(13,202,240,.12);
            line-height: 1;
            margin-bottom: 8px;
            font-family: var(--font-heading);
        }

        .value-card__kicker {
            font-size: .75rem;
            letter-spacing: .14em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .value-card__title {
            font-family: var(--font-heading);
            font-size: clamp(1.15rem, 2vw, 1.35rem);
            font-weight: 700;
            margin: 0 0 12px;
            line-height: 1.5;
        }

        .value-card__desc {
            color: var(--muted);
            font-size: .92rem;
            line-height: 1.9;
            margin: 0;
        }

        /* ── プロダクト一覧 ── */
        .product-grid {
            display: grid;
            gap: 28px;
            grid-template-columns: 1fr;
        }
        @media (min-width: 768px) {
            .product-grid { grid-template-columns: repeat(3, 1fr); }
        }

        .product-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 36px 28px 28px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .product-card__logo {
            height: 64px;
            width: auto;
            object-fit: contain;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .product-card__name {
            font-family: var(--font-heading);
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .product-card__desc {
            color: var(--muted);
            font-size: .92rem;
            line-height: 1.8;
            margin: 0;
            flex: 1;
        }

        .product-card__badge {
            display: inline-block;
            font-size: .72rem;
            font-weight: 600;
            color: var(--blue);
            background: var(--blue-light);
            padding: 3px 10px;
            border-radius: 99px;
            margin-top: 16px;
        }

        /* ── 実績リンク ── */
        .product-more {
            text-align: center;
            margin-top: 48px;
        }
        .product-more__link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--blue);
            text-decoration: none;
            font-size: .95rem;
            font-weight: 600;
            padding: 12px 28px;
            border: 2px solid var(--blue);
            border-radius: 99px;
            transition: background .25s ease, color .25s ease, gap .25s ease;
        }
        .product-more__link:hover {
            background: var(--blue);
            color: #fff;
            gap: 12px;
        }

        /* ── パンくず ── */
        .breadcrumb-sec {
            padding: 32px 0 48px;
        }

        /* ── スマホ対応 ── */
        @media (max-width: 767.98px) {
            .sec { padding: 48px 0; }
            .wrap { padding: 0 16px; }
            .lead-text { text-align: left; font-size: .95rem; }
            .sec-heading { margin-bottom: 32px; }
            .value-card { padding: 28px 20px 24px; }
            .value-card__num { font-size: 2rem; }
            .value-grid { gap: 20px; }
            .product-card { padding: 28px 20px 24px; }
            .product-grid { gap: 20px; }
            .product-more { margin-top: 32px; }
            .breadcrumb-sec { padding: 24px 0 32px; }
        }
    </style>
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

    <x-page-hero title="IT × Vision" sub="人と社会の可能性を広げる、自社プロダクト。" variant="launch" />

    {{-- リード文 --}}
    <section class="sec">
        <div class="wrap">
            <p class="lead-text">
                OBFallの自社開発は、「テクノロジーで人生をより豊かにする」という理念をかたちにする取り組みです。<br class="d-none d-md-inline">
                人の生き方や働き方、暮らしの中にある課題を見つめ、<br class="d-none d-md-inline">
                誰もが自分らしく生きられる社会を実現するためのプロダクトを開発しています。
            </p>
        </div>
    </section>

    {{-- 3つの価値 --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Our Values</span>
                <h2 class="sec-heading__title">プロダクト開発で大切にしていること</h2>
            </div>

            <div class="value-grid">

                <article class="value-card">
                    <div class="value-card__num">01</div>
                    <div class="value-card__kicker">Embody</div>
                    <h3 class="value-card__title">人の想いを形にする</h3>
                    <p class="value-card__desc">誰かの「こうありたい」という想いを起点に、テクノロジーで実現へと近づけます。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">02</div>
                    <div class="value-card__kicker">Empathy</div>
                    <h3 class="value-card__title">社会に寄り添うサービスづくり</h3>
                    <p class="value-card__desc">便利さや効率だけでなく、人と人のつながり・安心・挑戦を支える仕組みを届けます。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">03</div>
                    <div class="value-card__kicker">Cocreate</div>
                    <h3 class="value-card__title">共に育てるプロダクト</h3>
                    <p class="value-card__desc">使う人と共に磨き、社会に溶け込む"続いていく価値"を生み出します。</p>
                </article>

            </div>
        </div>
    </section>

    {{-- プロダクト一覧 --}}
    <section class="sec">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Products</span>
                <h2 class="sec-heading__title">実績・事例紹介</h2>
            </div>

            <div class="product-grid">

                {{-- digOn --}}
                <article class="product-card">
                    <img src="../image/digOn_logo.png" alt="digOn ロゴ"
                        class="product-card__logo" loading="lazy">
                    <h3 class="product-card__name">digOn</h3>
                    <p class="product-card__desc">音楽発掘をもっと身近にする音楽アプリ</p>
                </article>

                {{-- ストパス --}}
                <article class="product-card">
                    <img src="../image/store-pass_logo.png" alt="ストパス ロゴ"
                        class="product-card__logo" loading="lazy">
                    <h3 class="product-card__name">ストパス</h3>
                    <p class="product-card__desc">ストア特化の来店・販促パスポート</p>
                </article>

                {{-- 農業向け業務効率化 --}}
                <article class="product-card">
                    <img src="../image/dx_logo.png" alt="農業向け業務効率化 ロゴ"
                        class="product-card__logo" loading="lazy">
                    <h3 class="product-card__name">農業DX</h3>
                    <p class="product-card__desc">農作業と記録の効率化を支援</p>
                    <span class="product-card__badge">開発中</span>
                </article>

            </div>

            <div class="product-more">
                <a class="product-more__link" href="{{ route('achievementsProducts') }}">
                    実績を詳しく見る <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- パンくず --}}
    <div class="breadcrumb-sec">
        <div class="wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">
                    <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('userServicesShow') }}">サービス</a></li>
                    <li class="breadcrumb-item">自社開発</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>

</html>
