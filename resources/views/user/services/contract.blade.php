<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <title>受託開発（Contract Development） | OBFall Inc.</title>
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

        /* ── 価値カード（横並び） ── */
        .value-grid {
            display: grid;
            gap: 28px;
            grid-template-columns: 1fr;
        }
        @media (min-width: 768px) {
            .value-grid--2 { grid-template-columns: repeat(2, 1fr); }
            .value-grid--3 { grid-template-columns: repeat(3, 1fr); }
            .value-grid--4 { grid-template-columns: repeat(2, 1fr); }
        }

        .value-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 36px 32px 32px;
            box-shadow: var(--shadow);
            transition: transform .3s ease, box-shadow .3s ease;
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
            margin-bottom: 16px;
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

        /* ── プロダクトグリッド ── */
        .product-grid {
            display: grid;
            gap: 28px;
            grid-template-columns: 1fr;
        }
        @media (min-width: 768px) {
            .product-grid { grid-template-columns: repeat(2, 1fr); }
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

    <x-page-hero title="IT × Collaboration" sub="ともにつくり、ともに前へ。<br>クライアントの想いを汲み取り、共に課題を解決するパートナーとして。" variant="connect" />

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

    {{-- 大切にしていること --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Our Approach</span>
                <h2 class="sec-heading__title">受託開発で大切にしていること</h2>
            </div>

            <div class="value-grid value-grid--4">

                <article class="value-card">
                    <div class="value-card__num">01</div>
                    <div class="value-card__kicker">Insight</div>
                    <h3 class="value-card__title">本質をともに見つめる</h3>
                    <p class="value-card__desc">課題を「作ること」ではなく「解決すること」として捉え、共に考え抜く。クライアントの想いや事業の背景を深く理解し、長期的な成長を見据えた開発を行います。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">02</div>
                    <div class="value-card__kicker">Synthesis</div>
                    <h3 class="value-card__title">デザインと技術の融合</h3>
                    <p class="value-card__desc">使いやすさ・伝わりやすさ・拡張性を意識し、想いをかたちに。UI/UX・機能性・パフォーマンスのすべてで"心地よく使われる体験"を設計します。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">03</div>
                    <div class="value-card__kicker">Reliability</div>
                    <h3 class="value-card__title">安心まで届ける開発体制</h3>
                    <p class="value-card__desc">開発後には、自社のセキュリティチームによる脆弱性診断を実施。見た目や機能だけでなく、安全性まで一貫して担保できることが私たちの強みです。「創って終わり」ではなく、「安心して使い続けられる」未来を届けます。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">04</div>
                    <div class="value-card__kicker">Partnership</div>
                    <h3 class="value-card__title">長く続く関係を築く</h3>
                    <p class="value-card__desc">納品して終わりではなく、成長と変化に寄り添う"伴走型"の開発を大切に。プロダクトの成長を共に見届けながら、技術支援・改善提案を継続的に行います。</p>
                </article>

            </div>
        </div>
    </section>

    {{-- 選ばれる理由 --}}
    <section class="sec">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Why Us</span>
                <h2 class="sec-heading__title">選ばれる理由</h2>
            </div>

            <div class="value-grid value-grid--3">

                <article class="value-card">
                    <div class="value-card__num">01</div>
                    <div class="value-card__kicker">Cocreation</div>
                    <h3 class="value-card__title">共創の姿勢</h3>
                    <p class="value-card__desc">単なる受託ではなく、クライアントのビジョンを共有し、同じチームとして挑む。プロジェクトの成功を「成果物の完成」ではなく「価値の創出」として捉えます。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">02</div>
                    <div class="value-card__kicker">Consistency</div>
                    <h3 class="value-card__title">一貫した技術力と体制</h3>
                    <p class="value-card__desc">企画から設計・デザイン・開発・診断までをワンストップで対応。社内のエンジニア・デザイナー・セキュリティチームが密に連携し、品質・スピード・安心をすべて両立させます。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">03</div>
                    <div class="value-card__kicker">Empowerment</div>
                    <h3 class="value-card__title">成長を支える開発文化</h3>
                    <p class="value-card__desc">自社開発・SESで培ったノウハウを常にアップデートし、プロジェクトごとに新しい価値を生み出す仕組みを持っています。開発を通じて、人も、企業も、社会も前へ進むことを目指します。</p>
                </article>

            </div>
        </div>
    </section>

    {{-- 実績紹介 --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Works</span>
                <h2 class="sec-heading__title">実績・事例紹介</h2>
            </div>

            <div class="product-grid">

                <article class="product-card">
                    <img src="../image/careerlog_logo.png" alt="CareerLog ロゴ"
                        class="product-card__logo" loading="lazy">
                    <h3 class="product-card__name">CareerLog</h3>
                    <p class="product-card__desc">社会人向けOB/OG訪問サービス</p>
                </article>

                <article class="product-card">
                    <img src="../image/NoaChoice_logo.jpg" alt="NoaChoice ロゴ"
                        class="product-card__logo" loading="lazy">
                    <h3 class="product-card__name">NoaChoice</h3>
                    <p class="product-card__desc">ブライダルECサイト</p>
                </article>

            </div>

            <div class="product-more">
                <a class="product-more__link" href="{{ route('achievementsContract') }}">
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
                    <li class="breadcrumb-item">受託開発</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>
