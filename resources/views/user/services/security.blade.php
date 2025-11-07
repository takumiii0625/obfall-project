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

    <title>脆弱性診断（Vulnerability Assessment） | OBFall Inc.</title>
    <style>
        :root {
            --ink: #101317;
            --muted: #6a7689;
            --blue: #1E90FF;
            --line: #E7EEF5;
            --panel: #fff;
            --radius: 14px;
            --maxw: 940px
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
            padding: clamp(48px, 13vw, 120px) 16px 0;
        }

        @media (max-width:480px) {
            .hero .wrap {
                position: relative;
                z-index: 1;
                padding: clamp(48px, 33vw, 160px) 10px 0;
            }
        }


        .hero .title h1 {
            line-height: 1.3;
            margin: 0 0 .5rem;
            color: #111;
        }

        h1 {
            font-size: clamp(28px, 4vw, 100px);
            font-weight: 800;
            color: black;
            font-family: 'Times New Roman', Times, serif;
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

        body {
            margin: 0;
            color: var(--ink);
            background: #fff;
            font-family: -apple-system, BlinkMacSystemFont, "Noto Sans JP", Segoe UI, Roboto, Arial, sans-serif;
            line-height: 1.8
        }

        .wrap {
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 20px
        }

        header {
            padding: 80px 0 28px;
            background: linear-gradient(180deg, #fff 0%, #F0F6FF 100%);
            border-bottom: 1px solid var(--line)
        }

        h1 {
            margin: 0 0 .4rem;
            font-size: clamp(28px, 4vw, 100px)
        }



        .lead {
            color: black;
            max-width: 760px
        }

        section {
            padding: 16px 0;
            border-bottom: 1px solid var(--line)
        }

        h2 {
            margin: 0 0 .4rem;
            font-size: clamp(20px, 3vw, 28px)
        }

        h3 {
            margin: 0 0 .2rem;
            font-size: 20px
        }

        p {
            margin: .4rem 0 1rem
        }

        ul {
            margin: .2rem 0 1rem 1.1rem
        }

        .grid {
            display: grid;
            gap: 16px
        }

        .two {
            grid-template-columns: 1fr
        }

        @media (min-width:820px) {
            .two {
                grid-template-columns: 1fr 1fr
            }
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 22px
        }

        .cta {
            display: inline-block;
            background: var(--blue);
            color: #fff;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 10px
        }

        .more {
            color: var(--blue);
            text-decoration: none
        }

        .note {
            color: var(--muted)
        }

        .hero-img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--line)
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

            .hero .title h1 {
                font-size: 2.000rem;
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

        /* 背景トーン（既存の --blue-weak / --ink を尊重） */
        .bg-blue-weak {
            background: var(--blue-weak);
        }

        /* カードの見た目 */
        .principle-card {
            transition: box-shadow .2s ease, transform .2s ease;
            background: #fff;
        }

        .principle-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, .08);
        }

        /* アイコンのバッジ */
        .icon-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 9999px;
            background: rgba(var(--bs-primary-rgb), .12);
            color: var(--bs-primary);
            font-size: 1.25rem;
        }

        /* タイポ */
        .kicker {
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .08em;
            color: var(--bs-primary);
            margin-bottom: .25rem;
        }

        .principle-title {
            font-size: clamp(1.25rem, 2.2vw, 1.6rem);
            line-height: 1.35;
            margin: 0 0 .5rem;
            color: var(--ink);
        }

        /* スマホ微調整 */
        @media (max-width: 767.98px) {
            .principle-card {
                padding: 1.25rem;
            }

            .icon-badge {
                width: 44px;
                height: 44px;
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    <div class="top">
        <header class="fadein-first fadein-from-up">
            <div class="wrap">
                <a href="{{ route('indexDev') }}" class="text-dark text-decoration-none">
                    <div class="logo-container">
                        <img src="../image/logo_OBFall.png" class="link" onclick="scrollToTop()" />
                    </div>
                </a>
                <nav class="nav-01">
                    <ul class="mb-0">
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
                <h1>Security × Engineering</h1>
                <div class="sub">安全は、後付けではなく、設計から。</div>
            </div>
        </div>
    </section>
    <main class="wrap">

        <section aria-label="overview">
            <p>私たちは、**「開発を理解するセキュリティ専門チーム」**として、
                Webアプリ・モバイルアプリ・APIなどの脆弱性診断を提供しています。<br>
                開発現場の構造を理解したうえで“攻撃者の視点”からリスクを特定し、
                再現性のある改善提案を通じて、プロダクトを安全に前進させます。</p>
        </section>

        <section id="principles" class="bg-blue-weak py-5">
            <div class="wrap">
                <div class="vstack gap-4"> <!-- ← 縦に積む -->
                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="bi bi-puzzle-fill" aria-hidden="true"></i>
                            <div class="kicker">INTRGRITY</div>
                        </span>
                        <h2 class="principle-title">開発を知る診断チーム</h2>
                        <p class="mb-0">私たちは自社でシステム開発も行うエンジニア集団です。<br>
                            実装の意図や設計思想を踏まえたうえで診断を行うため、
                            「なぜその脆弱性が生まれたのか」「どう修正すべきか」まで踏み込んだ支援が可能です。
                        </p>
                    </article>
                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="bi bi-search" aria-hidden="true"></i>
                            <div class="kicker">TACTICS</div>
                        </span>
                        <h2 class="principle-title">攻撃者の視点からの実践的アプローチ</h2>
                        <p class="mb-0">ツール検査だけでなく、手動検証を中心とした実戦型診断を実施。<br>
                            入力値検証・認証認可・情報漏洩・セッション管理・設定不備など、
                            実際の攻撃手法をシミュレーションし、ビジネスリスクを可視化します。</p>
                    </article>

                    <!-- Mission -->
                    <article id="mission" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="bi bi-diagram-3" aria-hidden="true"></i>
                            <div class="kicker">INTEGRATION</div>
                        </span>
                        <h2 class="principle-title">開発と診断のワンストップ体制</h2>
                        <p class="mb-0">
                        <p>開発フェーズからセキュリティを設計に組み込み、
                            受託開発・SESチームと連携して脆弱性を未然に防止。<br>
                            診断結果は再発防止策や運用ガイドラインにまで落とし込みます。</p>
                    </article>

                    <!-- Values -->
                    <article id="values" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="bi bi-clipboard-check" aria-hidden="true"></i>
                            <div class="kicker">PRECISION</div>
                        </span>
                        <h2 class="principle-title">再現性と改善を重視したレポート</h2>
                        <p class="mb-0">検出結果を「開発者が理解し、すぐ行動できる形」で提示。<br>
                            リスク説明と修正手順をセットで提供し、
                            診断が“一過性の報告”で終わらないよう支援します。</p>
                    </article>

                </div>
            </div>
        </section>


        <section id="values">
            <div class="" style="background:var(--blue-weak);border-top:none">
                <h2 class="my-5">診断対象</h2>
                <div class="values">
                    <div class="card mb-4">
                        <p class="muted">
                            ・Webアプリ（Laravel, Rails, Node.js など）<br>
                            ・モバイルアプリ（iOS / Android / Flutter）<br>
                            ・API / GraphQL / 外部連携<br>
                            ・管理画面・社内システム<br>
                            ・クラウド設定診断（GCP / AWS）<br>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="principles" class="bg-blue-weak py-5">
            <div class="" style="background:var(--blue-weak);border-top:none">

                <h2 class="my-5">選ばれる理由</h2>

            </div>
            <div class="wrap">
                <div class="vstack gap-4"> <!-- ← 縦に積む -->
                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="bi bi-puzzle-fill" aria-hidden="true"></i>
                            <div class="kicker">INTEGRATE</div>
                        </span>
                        <h2 class="principle-title">開発と診断を一社完結</h2>
                        <p class="mb-0">「外部に委託せず、開発と診断を自社で行う」ため、
                            情報漏洩リスクが低く、開発者との連携スピードも圧倒的。
                        </p>
                    </article>
                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="bi bi-search" aria-hidden="true"></i>
                            <div class="kicker">VALIDATION</div>
                        </span>
                        <h2 class="principle-title">実践経験に基づく検証</h2>
                        <p class="mb-0">診断員は全員が現役エンジニア。<br>
                            脆弱性の発生要因をコード・構成レベルで分析し、
                            修正コストを最小限に抑える提案を行います。</p>
                    </article>

                    <!-- Mission -->
                    <article id="mission" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="bi bi-diagram-3" aria-hidden="true"></i>
                            <div class="kicker">PARTNERSHIP</div>
                        </span>
                        <h2 class="principle-title">伴走型セキュリティ支援</h2>
                        <p class="mb-0">
                        <p>診断後も改修支援・再診断・運用設計までサポート。<br>
                            「脆弱性をなくすこと」ではなく「安全に成長し続けること」を目指します。</p>

                    </article>

                    <!-- Values -->
                    <article id="values" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="bi bi-clipboard-check" aria-hidden="true"></i>
                            <div class="kicker">FLEXIBILITY</div>
                        </span>
                        <h2 class="principle-title">コストと柔軟性のバランス</h2>
                        <p class="mb-0">大手セキュリティベンダーのような高額コストや硬直的な体制ではなく、
                            「必要な範囲を、最適なコストで」診断する柔軟なプランをご提案します。<br>
                            中間コストを省き、開発者が直接対応することで、
                            品質とスピードを両立させた現実的なセキュリティ対策を実現します。</p>

                    </article>

                </div>
            </div>
        </section>
        <nav aria-label="breadcrumb" class="m-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">

                <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('userServicesShow') }}">サービス</a></li>
                <li class="breadcrumb-item"></a>脆弱性診断</li>
            </ol>
        </nav>
    </main>
    <footer>
        <div class="devwrap d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
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

</html>