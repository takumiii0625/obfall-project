<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Philosophy | OBFall Inc.</title>
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

        html, body {
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

        /* ── ステートメントカード（Vision / Mission） ── */
        .statement {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        .statement__kicker {
            display: block;
            font-size: .75rem;
            letter-spacing: .14em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 12px;
        }
        .statement__title {
            font-family: var(--font-heading);
            font-size: clamp(1.4rem, 3vw, 2rem);
            font-weight: 700;
            margin: 0 0 20px;
            line-height: 1.5;
        }
        .statement__body {
            font-size: clamp(1rem, 1.8vw, 1.15rem);
            line-height: 2;
            color: #444;
            margin: 0;
        }

        /* ── 3つの柱カード ── */
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

        /* ── メッセージ ── */
        .message-box {
            max-width: 800px;
            margin: 0 auto;
            background: var(--card);
            border-radius: var(--radius);
            padding: 48px 40px;
            box-shadow: var(--shadow);
            text-align: center;
        }
        .message-box__kicker {
            display: block;
            font-size: .75rem;
            letter-spacing: .14em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 12px;
        }
        .message-box__title {
            font-family: var(--font-heading);
            font-size: clamp(1.3rem, 2.5vw, 1.6rem);
            font-weight: 700;
            margin: 0 0 20px;
            line-height: 1.5;
        }
        .message-box__text {
            font-size: clamp(1rem, 1.8vw, 1.1rem);
            line-height: 2;
            color: #444;
            margin: 0;
        }

        /* ── 由来セクション ── */
        .origin-box {
            max-width: 800px;
            margin: 0 auto;
            background: var(--bg-alt);
            border-radius: var(--radius);
            padding: 40px;
            border-left: 4px solid var(--blue);
        }
        .origin-box__kicker {
            display: block;
            font-size: .75rem;
            letter-spacing: .14em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .origin-box__title {
            font-family: var(--font-heading);
            font-size: clamp(1.2rem, 2vw, 1.4rem);
            font-weight: 700;
            margin: 0 0 16px;
            line-height: 1.5;
        }
        .origin-box__text {
            color: #444;
            font-size: .95rem;
            line-height: 2;
            margin: 0;
        }

        /* ── パンくず ── */
        .breadcrumb-sec {
            padding: 32px 0 48px;
        }

        /* ── スマホ対応 ── */
        @media (max-width: 767.98px) {
            .sec { padding: 48px 0; }
            .wrap { padding: 0 16px; }
            .sec-heading { margin-bottom: 32px; }
            .statement__body { text-align: left; font-size: .95rem; }
            .value-card { padding: 28px 20px 24px; }
            .value-card__num { font-size: 2rem; }
            .value-grid { gap: 20px; }
            .message-box { padding: 32px 20px; }
            .message-box__title { font-size: 1.2rem; }
            .origin-box { padding: 28px 20px; }
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

    <x-page-hero title="Philosophy" sub="「あなたの、あなたによる、あなたのための」<br>をすべての人へ。" variant="neural" />

    {{-- Vision --}}
    <section class="sec">
        <div class="wrap">
            <div class="statement">
                <span class="statement__kicker">Vision</span>
                <h2 class="statement__title">「あなたの、あなたによる、あなたのための」をすべての人へ。</h2>
                <p class="statement__body">
                    テクノロジーの力で、人と社会の可能性を広げ、<br class="d-none d-md-inline">
                    誰もが自分らしく生き、挑戦できる未来を目指します。
                </p>
            </div>
        </div>
    </section>

    {{-- Mission --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="statement">
                <span class="statement__kicker">Mission</span>
                <h2 class="statement__title">働くすべての人が、自分自身のために、<br class="d-none d-md-inline">自由にそして熱意を持って働ける社会をつくっていきます。</h2>
                <p class="statement__body">
                    その実現のために、私たちはテクノロジーを通じて、挑戦する人と組織を支え、<br class="d-none d-md-inline">
                    "つくる・支える・守る"という3つの軸で、社会に新しい価値を届け続けます。
                </p>
            </div>
        </div>
    </section>

    {{-- Core Values --}}
    <section class="sec">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Core Values</span>
                <h2 class="sec-heading__title">3つの柱</h2>
            </div>

            <div class="value-grid">

                <article class="value-card">
                    <div class="value-card__num">01</div>
                    <div class="value-card__kicker">Principle</div>
                    <h3 class="value-card__title">理念採用</h3>
                    <p class="value-card__desc">共感を軸に、人と組織をつなぐ。理念に共鳴する仲間とともに、価値ある未来を創ります。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">02</div>
                    <div class="value-card__kicker">Satisfaction</div>
                    <h3 class="value-card__title">ES＝CS</h3>
                    <p class="value-card__desc">働く人の幸福が、顧客の満足を生む。社員満足と顧客満足の両立を通じて、持続的な成長を目指します。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">03</div>
                    <div class="value-card__kicker">Growth &amp; Challenge</div>
                    <h3 class="value-card__title">成長と挑戦</h3>
                    <p class="value-card__desc">一人ひとりが自らの成長に挑み、変化を恐れず前へ。挑戦を後押しする文化を大切にします。</p>
                </article>

            </div>
        </div>
    </section>

    {{-- Message --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="message-box">
                <span class="message-box__kicker">Message</span>
                <h2 class="message-box__title">人と社会が、ともに成長できる世界へ。</h2>
                <p class="message-box__text">
                    OBFallは、ITの力で"人"と"社会"が共に成長できる世界を目指しています。<br>
                    働くことが、あなたの人生を豊かにする体験であってほしい。<br class="d-none d-md-inline">
                    その想いを胸に、私たちは挑戦を続けていきます。
                </p>
            </div>
        </div>
    </section>

    {{-- Origin --}}
    <section class="sec">
        <div class="wrap">
            <div class="origin-box">
                <span class="origin-box__kicker">Origin of Our Philosophy</span>
                <h3 class="origin-box__title">理念と社名の由来</h3>
                <p class="origin-box__text">
                    「あなたの、あなたによる、あなたのための」という言葉は、アメリカ第16代大統領エイブラハム・リンカーンの演説に由来しています。
                    社名 <strong>OBFall</strong> は、その演説に登場する "of the people, by the people, for the people" に、<strong>"すべての人へ（all）"</strong> という想いを込めて名づけました。
                    OBFallは、テクノロジーの力で、すべての人に可能性を届ける企業でありたいと考えています。
                </p>
            </div>
        </div>
    </section>

    {{-- パンくず --}}
    <div class="breadcrumb-sec">
        <div class="wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">
                    <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                    <li class="breadcrumb-item">企業理念</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>

</html>
