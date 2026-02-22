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
    <title>自社開発実績 | OBFall Inc.</title>

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

        .achievement-card__badge {
            display: inline-block;
            font-size: .72rem;
            font-weight: 600;
            color: var(--blue);
            background: var(--blue-light);
            padding: 3px 10px;
            border-radius: 99px;
            margin-bottom: 16px;
            align-self: flex-start;
        }

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

    <x-page-hero title="Products" sub="人と社会の可能性を広げる、自社プロダクト。<br>OBFallの想いを、サービスというかたちで届ける。" variant="launch" />

    {{-- リード文 --}}
    <section class="sec">
        <div class="wrap">
            <p class="lead-text">
                OBFallの自社開発は、社会の"まだ満たされていないニーズ"に焦点をあて、<br class="d-none d-md-inline">
                「テクノロジーで人生をより豊かにする」という理念を実践する取り組みです。<br>
                便利さよりも、"人がより自分らしく生きられる仕組み"を目指し、<br class="d-none d-md-inline">
                発想から企画、開発、運用まですべて自社で行っています。
            </p>
        </div>
    </section>

    {{-- プロダクト一覧 --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Our Products</span>
                <h2 class="sec-heading__title">プロダクト紹介</h2>
            </div>

            <div class="achievement-list">

                {{-- digOn --}}
                <article class="achievement-card">
                    <div class="achievement-card__inner">
                        <div class="achievement-card__visual">
                            <img src="../image/digOn_logo.png" alt="digOn ロゴ"
                                class="achievement-card__logo" loading="lazy">
                        </div>
                        <div class="achievement-card__body">
                            <h3 class="achievement-card__name">digOn（ディグオン）</h3>
                            <p class="achievement-card__desc">
                                音楽と人の感性をつなぐ、新しい発見体験。
                                音楽との出会いをもっと自由に、もっと感覚的に。
                                Flutter × Firebase × Webで構築された、クロスプラットフォーム対応の音楽アプリ。
                                再生履歴・レコメンド・お気に入り管理など、ユーザー体験を重視したUIを設計。
                            </p>
                            <a class="achievement-card__link" href="https://dig-on.com/" target="_blank">
                                digOn公式サイト <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                {{-- ストパス --}}
                <article class="achievement-card">
                    <div class="achievement-card__inner achievement-card__inner--reverse">
                        <div class="achievement-card__visual">
                            <img src="../image/store-pass_logo.png" alt="ストパス ロゴ"
                                class="achievement-card__logo" loading="lazy">
                        </div>
                        <div class="achievement-card__body">
                            <h3 class="achievement-card__name">ストパス（Store-Pass）</h3>
                            <p class="achievement-card__desc">
                                店舗とユーザーをつなぐ共通特典アプリ。
                                月額無料で、ユーザーは加盟店舗全体で特典を利用可能。
                                「店舗をまたぐ特典利用」「垣根を超えた顧客体験」を実現するアプリとして開発。
                                加盟店の情報表示や特典管理を統合し、地域の活性化を支える仕組みを提供しています。
                            </p>
                            <a class="achievement-card__link" href="https://store-pass.com" target="_blank">
                                Store-Pass公式サイト <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>

                {{-- 農業DX --}}
                <article class="achievement-card">
                    <div class="achievement-card__inner">
                        <div class="achievement-card__visual">
                            <img src="../image/dx_logo.png" alt="農業向け業務効率化 ロゴ"
                                class="achievement-card__logo" loading="lazy">
                        </div>
                        <div class="achievement-card__body">
                            <span class="achievement-card__badge">開発中</span>
                            <h3 class="achievement-card__name">未来共創DX支援事業</h3>
                            <p class="achievement-card__desc">
                                地域と人に寄り添うパートナーとして、デジタルの力で課題を解決し、お客様と共に新たな価値を生み出すことを目指しています。
                                飲食・小売・農業など、多様な現場と対話を重ね、「現場のリアルな声」を大切にした、"本当に使える"仕組みづくりを進めています。
                                現在は、農家の方々の販売・業務効率化を支援するECプラットフォームの開発を推進中です。
                            </p>
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
                    <li class="breadcrumb-item">自社開発</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>
