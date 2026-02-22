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

    <title>SES（技術支援） | OBFall Inc.</title>
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

        /* ── 価値カード ── */
        .value-grid {
            display: grid;
            gap: 28px;
            grid-template-columns: 1fr;
        }
        @media (min-width: 768px) {
            .value-grid--2 { grid-template-columns: repeat(2, 1fr); }
            .value-grid--3 { grid-template-columns: repeat(3, 1fr); }
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

        /* ── メッセージ ── */
        .message-box {
            max-width: 720px;
            margin: 0 auto;
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
            .value-card { padding: 28px 20px 24px; }
            .value-card__num { font-size: 2rem; }
            .value-grid { gap: 20px; }
            .message-box__title { font-size: 1.2rem; }
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

    <x-page-hero title="IT × Team" sub="人が輝く現場を、技術で支える。" variant="constellation" />

    {{-- リード文 --}}
    <section class="sec">
        <div class="wrap">
            <p class="lead-text">
                エンジニアが力を発揮できる環境を整え、技術とチームの両面から現場を支援。<br>
                「人」と「組織」がともに成長する関係を築くことが、OBFallのSESです。
            </p>
        </div>
    </section>

    {{-- 私たちの想い・サービス概要 --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">About SES</span>
                <h2 class="sec-heading__title">サービスについて</h2>
            </div>

            <div class="value-grid value-grid--2">

                <article class="value-card">
                    <div class="value-card__num">01</div>
                    <div class="value-card__kicker">Vision</div>
                    <h3 class="value-card__title">私たちの想い</h3>
                    <p class="value-card__desc">人が主役の現場を、もっと誇れる場所に。OBFallのSESは、エンジニア一人ひとりが自分らしく力を発揮できる環境をつくることで、企業と人の"成長の循環"を生み出します。単なる人材支援ではなく、共に挑み、共に成長するパートナーとして並走します。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">02</div>
                    <div class="value-card__kicker">Service</div>
                    <h3 class="value-card__title">サービス概要</h3>
                    <p class="value-card__desc">私たちは、クライアントの現場課題に最も適したエンジニアをアサインし、開発・運用・保守などのプロジェクトを技術面とチーム面から支援します。配属後も定期的なフォローやスキルアップ支援を行い、長期的な関係構築と高品質な成果創出を両立します。</p>
                </article>

            </div>
        </div>
    </section>

    {{-- 選ばれる理由 --}}
    <section class="sec">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Why Us</span>
                <h2 class="sec-heading__title">OBFallのSESが選ばれる理由</h2>
            </div>

            <div class="value-grid value-grid--3">

                <article class="value-card">
                    <div class="value-card__num">01</div>
                    <div class="value-card__kicker">Empathy</div>
                    <h3 class="value-card__title">"人"を中心とした関係づくり</h3>
                    <p class="value-card__desc">スキルシートだけでなく、価値観やキャリアビジョンまでを見据え、企業と人が共に成長できる"関係"を設計します。「どんな現場ならその人が最も輝くか」を起点に考え、人とチームの可能性を最大限に引き出します。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">02</div>
                    <div class="value-card__kicker">Growth</div>
                    <h3 class="value-card__title">継続的な伴走と成長支援</h3>
                    <p class="value-card__desc">配属後もチーム単位でフォローし、キャリアアップ・スキル共有・勉強会など人と組織が共に進化する環境を提供します。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">03</div>
                    <div class="value-card__kicker">Craftsmanship</div>
                    <h3 class="value-card__title">現場で磨かれる技術力</h3>
                    <p class="value-card__desc">OBFallでは、自社開発・受託開発を通じて技術を磨き続けています。その実践的な知見と経験が、SESにおいても高い提案力と課題解決力を支えています。現場に"成長と信頼"という価値をもたらすのが、私たちの強みです。</p>
                </article>

            </div>
        </div>
    </section>

    {{-- メッセージ --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="message-box">
                <span class="message-box__kicker">Message</span>
                <h2 class="message-box__title">メッセージ</h2>
                <p class="message-box__text">
                    SESを、"人を送るビジネス"から"人が活きる仕組み"へ。<br>
                    OBFallは、ITの力で働く人と企業の関係をより良くデザインしていきます。
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
                    <li class="breadcrumb-item"><a href="{{ route('userServicesShow') }}">サービス</a></li>
                    <li class="breadcrumb-item">SES</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>
