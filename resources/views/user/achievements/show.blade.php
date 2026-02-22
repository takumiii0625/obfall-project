<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <title>Achievements | OBFall Inc.</title>

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
            background: var(--bg);
            color: var(--ink);
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

        /* ── カードグリッド ── */
        .srv-grid {
            display: grid;
            gap: 28px;
            grid-template-columns: 1fr;
        }
        @media (min-width: 768px) {
            .srv-grid { grid-template-columns: repeat(3, 1fr); }
        }

        /* ── カード ── */
        .srv-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 40px 36px 32px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            transition: transform .3s ease, box-shadow .3s ease;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
        }
        .srv-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .srv-card__num {
            font-size: 3rem;
            font-weight: 800;
            color: rgba(13,202,240,.12);
            line-height: 1;
            margin-bottom: 8px;
            font-family: var(--font-heading);
        }

        .srv-card__kicker {
            font-size: .75rem;
            letter-spacing: .14em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .srv-card__title {
            font-family: var(--font-heading);
            font-size: clamp(1.35rem, 2.5vw, 1.6rem);
            font-weight: 700;
            margin: 0 0 4px;
            line-height: 1.4;
        }

        .srv-card__en {
            font-size: 1rem;
            color: #94a3b8;
            font-family: var(--font-heading);
            font-style: italic;
            margin-bottom: 16px;
        }

        .srv-card__desc {
            color: var(--muted);
            font-size: .95rem;
            line-height: 1.9;
            margin: 0;
            flex: 1;
        }

        .srv-card__link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--blue);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 600;
            margin-top: 24px;
            align-self: flex-end;
            transition: gap .25s ease;
        }
        .srv-card:hover .srv-card__link { gap: 10px; }

        /* ── パンくず ── */
        .breadcrumb-sec {
            padding: 32px 0 48px;
        }

        /* ── スマホ対応 ── */
        @media (max-width: 767.98px) {
            .sec { padding: 48px 0; }
            .wrap { padding: 0 16px; }
            .lead-text { text-align: left; font-size: .95rem; }
            .srv-card { padding: 28px 20px 24px; }
            .srv-card__num { font-size: 2.2rem; }
            .srv-card__link { margin-top: 16px; }
            .srv-grid { gap: 20px; }
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

    <x-page-hero title="Achievements" sub="ITの力で、人と社会の可能性を広げる。<br>OBFallの挑戦と成果。" variant="chart" />

    {{-- リード文 --}}
    <section class="sec">
        <div class="wrap">
            <p class="lead-text">
                私たちは、「テクノロジーで人生をより豊かにする」という理念のもと、<br class="d-none d-md-inline">
                自社開発・受託開発・脆弱性診断の3つの領域で、<br class="d-none d-md-inline">
                社会や現場の課題を"仕組み"として解決してきました。<br>
                ここで紹介するのは、私たちの手で形にしてきたプロジェクトたち。<br class="d-none d-md-inline">
                どれも、「人」や「社会」に新しい選択肢を生み出すための挑戦です。
            </p>
        </div>
    </section>

    {{-- 実績カード一覧 --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="srv-grid">

                {{-- 01 自社開発 --}}
                <article class="srv-card">
                    <div class="srv-card__num">01</div>
                    <div class="srv-card__kicker">Products</div>
                    <h2 class="srv-card__title">自社開発</h2>
                    <div class="srv-card__en">IT &times; Vision</div>
                    <p class="srv-card__desc">人と社会の可能性を広げる、自社プロダクト。OBFallの想いを、サービスというかたちで届けます。</p>
                    <a class="srv-card__link" href="{{ route('achievementsProducts') }}">詳しく見る <i class="bi bi-arrow-right"></i></a>
                </article>

                {{-- 02 受託開発 --}}
                <article class="srv-card">
                    <div class="srv-card__num">02</div>
                    <div class="srv-card__kicker">Contract Development</div>
                    <h2 class="srv-card__title">受託開発</h2>
                    <div class="srv-card__en">IT &times; Collaboration</div>
                    <p class="srv-card__desc">ともにつくり、ともに前へ。クライアントの想いを汲み取り、共に課題を解決するパートナーとして伴走します。</p>
                    <a class="srv-card__link" href="{{ route('achievementsContract') }}">詳しく見る <i class="bi bi-arrow-right"></i></a>
                </article>

                {{-- 03 脆弱性診断 --}}
                <article class="srv-card">
                    <div class="srv-card__num">03</div>
                    <div class="srv-card__kicker">Security Assessment</div>
                    <h2 class="srv-card__title">脆弱性診断</h2>
                    <div class="srv-card__en">Security &times; Engineering</div>
                    <p class="srv-card__desc">安全は、後付けではなく、設計から。開発と診断をワンストップで行い、信頼できるプロダクトづくりを支えます。</p>
                    <a class="srv-card__link" href="{{ route('achievementsSecurity') }}">詳しく見る <i class="bi bi-arrow-right"></i></a>
                </article>

            </div>
        </div>
    </section>

    {{-- パンくず --}}
    <div class="breadcrumb-sec">
        <div class="wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">
                    <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                    <li class="breadcrumb-item">実績・事例紹介</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>
