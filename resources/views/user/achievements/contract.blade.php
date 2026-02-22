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
    <title>受託開発実績 | OBFall Inc.</title>

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

        /* ── 実績カード ── */
        .achievement-card {
            background: var(--card);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .achievement-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .achievement-card__inner {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        @media (min-width: 768px) {
            .achievement-card__inner {
                flex-direction: row;
            }
            .achievement-card__inner--reverse {
                flex-direction: row-reverse;
            }
        }

        .achievement-card__visual {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: var(--bg-alt);
            min-height: 200px;
        }
        @media (min-width: 768px) {
            .achievement-card__visual {
                flex: 0 0 320px;
            }
        }

        .achievement-card__logo {
            max-width: 160px;
            height: auto;
            object-fit: contain;
            border-radius: 12px;
        }

        .achievement-card__body {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }

        .achievement-card__name {
            font-family: var(--font-heading);
            font-size: clamp(1.3rem, 2.5vw, 1.6rem);
            font-weight: 700;
            margin: 0 0 12px;
            line-height: 1.4;
        }

        .achievement-card__desc {
            color: var(--muted);
            font-size: .95rem;
            line-height: 1.9;
            margin: 0 0 24px;
        }

        .achievement-card__link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--blue);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 600;
            transition: gap .25s ease;
        }
        .achievement-card__link:hover { gap: 10px; }

        /* ── カード間のスペース ── */
        .achievement-list {
            display: flex;
            flex-direction: column;
            gap: 36px;
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
            .achievement-card__body { padding: 28px 20px; }
            .achievement-card__visual { padding: 28px 20px; min-height: 160px; }
            .achievement-card__logo { max-width: 120px; }
            .achievement-list { gap: 24px; }
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

    <x-page-hero title="Contract Development" sub="ともにつくり、ともに前へ。<br>クライアントの想いを汲み取り、共に課題を解決するパートナーとして。" variant="connect" />

    {{-- リード文 --}}
    <section class="sec">
        <div class="wrap">
            <p class="lead-text">
                OBFallの受託開発は、「作る」ことを目的とせず、「価値を生み出す」ことを目的とする開発です。<br>
                Webサービス、アプリケーション、業務システムなど多様な開発に対応しながら、<br class="d-none d-md-inline">
                企画から設計・デザイン・実装・セキュリティ診断まで一貫した体制で提供しています。<br>
                クライアントと同じ目線で課題を見つめ、長く続く価値を共に育てていきます。
            </p>
        </div>
    </section>

    {{-- 実績一覧 --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Projects</span>
                <h2 class="sec-heading__title">プロジェクト紹介</h2>
            </div>

            <div class="achievement-list">

                {{-- CareerLog --}}
                <article class="achievement-card">
                    <div class="achievement-card__inner">
                        <div class="achievement-card__visual">
                            <img src="../image/careerlog_logo.png" alt="CareerLog ロゴ"
                                class="achievement-card__logo" loading="lazy">
                        </div>
                        <div class="achievement-card__body">
                            <h3 class="achievement-card__name">CareerLog（キャリアログ）</h3>
                            <p class="achievement-card__desc">
                                キャリアログは、社会人が業界・職種の経験者に1対1で相談できるOB/OG訪問サービス。
                                登録不要で今すぐOBを検索でき、実体験に基づくアドバイスで転職やキャリアの不安を解消し、自分だけの進路設計を後押しします。
                            </p>
                            <a class="achievement-card__link" href="https://career-log.com/" target="_blank">
                                CareerLog公式サイト <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                {{-- NoaChoice --}}
                <article class="achievement-card">
                    <div class="achievement-card__inner achievement-card__inner--reverse">
                        <div class="achievement-card__visual">
                            <img src="../image/NoaChoice_logo.jpg" alt="NoaChoice ロゴ"
                                class="achievement-card__logo" loading="lazy">
                        </div>
                        <div class="achievement-card__body">
                            <h3 class="achievement-card__name">NoaChoice（ノアチョイス）</h3>
                            <p class="achievement-card__desc">
                                結婚式準備の"探す・比べる・決める"をオンラインで完結できるブライダルECサイトです。
                                ドレス・タキシード・和装・ジュエリー・ペーパーアイテム・引出物まで、厳選アイテムを適正価格でお届け。
                                サイズガイドと試着キット、パーソナルサポートで、初めての方でも安心してお選びいただけます。
                            </p>
                            <a class="achievement-card__link" href="https://noa-choice.com/" target="_blank">
                                NoaChoice公式サイト <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
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
                    <li class="breadcrumb-item"><a href="{{ route('achievements') }}">実績・事例紹介</a></li>
                    <li class="breadcrumb-item">受託開発</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>
