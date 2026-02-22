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
    <title>脆弱性診断実績 | OBFall Inc.</title>

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

        .achievement-card__img {
            max-width: 240px;
            width: 100%;
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
            margin: 0 0 20px;
            line-height: 1.4;
        }

        .achievement-card__desc {
            color: var(--muted);
            font-size: .95rem;
            line-height: 1.9;
            margin: 0;
        }

        /* ── スペック一覧 ── */
        .spec-grid {
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr;
            margin-top: 24px;
        }
        @media (min-width: 600px) {
            .spec-grid { grid-template-columns: 1fr 1fr; }
        }

        .spec-item {
            background: var(--card);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,.04);
        }

        .spec-item__label {
            font-size: .75rem;
            letter-spacing: .1em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .spec-item__value {
            color: var(--ink);
            font-size: .95rem;
            line-height: 1.7;
            margin: 0;
        }

        /* ── カード間のスペース ── */
        .achievement-list {
            display: flex;
            flex-direction: column;
            gap: 36px;
        }

        /* ── まとめ文 ── */
        .closing-text {
            font-size: clamp(1rem, 1.8vw, 1.1rem);
            max-width: 720px;
            line-height: 2;
            color: #444;
            margin: 0 auto;
            text-align: center;
            font-style: italic;
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
            .achievement-card__img { max-width: 180px; }
            .achievement-list { gap: 24px; }
            .spec-grid { gap: 12px; }
            .spec-item { padding: 18px 16px; }
            .closing-text { text-align: left; font-size: .95rem; }
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

    <x-page-hero title="Security Assessment" sub="安全は、後付けではなく、設計から。<br>開発と診断をワンストップで行い、<br>信頼できるプロダクトづくりを支えます。" variant="shield" />

    {{-- リード文 --}}
    <section class="sec">
        <div class="wrap">
            <p class="lead-text">
                OBFallでは、開発現場を理解したエンジニアが脆弱性診断を実施しています。<br>
                システムの構造や業務要件を踏まえたうえで、<br class="d-none d-md-inline">
                「攻撃者の視点」と「開発者の視点」の両面から現実的なリスクを検証。<br>
                単なる報告にとどまらず、修正提案や再発防止まで一貫してサポートしています。
            </p>
        </div>
    </section>

    {{-- 実績紹介 --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Assessment Results</span>
                <h2 class="sec-heading__title">実績紹介</h2>
            </div>

            <div class="achievement-list">
                <article class="achievement-card">
                    <div class="achievement-card__inner">
                        <div class="achievement-card__visual">
                            <img src="../image/security.jpg" alt="脆弱性診断"
                                class="achievement-card__img" loading="lazy">
                        </div>
                        <div class="achievement-card__body">
                            <h3 class="achievement-card__name">Webアプリケーション脆弱性診断</h3>
                            <div class="spec-grid">
                                <div class="spec-item">
                                    <div class="spec-item__label">開発言語</div>
                                    <p class="spec-item__value">JavaScript (Vue.js / React / TypeScript)、Java（Spring Boot）、PHP（Laravel）、Dart（Flutter）</p>
                                </div>
                                <div class="spec-item">
                                    <div class="spec-item__label">診断種別</div>
                                    <p class="spec-item__value">Webアプリケーション診断</p>
                                </div>
                                <div class="spec-item">
                                    <div class="spec-item__label">診断手法</div>
                                    <p class="spec-item__value">ツール（Burp Suite Professional）による自動診断 + 診断作業者による手動診断</p>
                                </div>
                                <div class="spec-item">
                                    <div class="spec-item__label">診断規模</div>
                                    <p class="spec-item__value">約100画面、約500機能</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    {{-- まとめ --}}
    <section class="sec">
        <div class="wrap">
            <p class="closing-text">
                診断は"終わり"ではなく"成長のはじまり"。<br>
                開発を理解するセキュリティチームが、<br class="d-none d-md-inline">
                安心して使い続けられるプロダクトの実現を支えています。
            </p>
        </div>
    </section>

    {{-- パンくず --}}
    <div class="breadcrumb-sec">
        <div class="wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">
                    <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('achievements') }}">実績・事例紹介</a></li>
                    <li class="breadcrumb-item">脆弱性診断</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>
