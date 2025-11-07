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

    <title>受託開発（Contract Development） | OBFall Inc.</title>
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
            padding: 0 20px;

        }

        header {
            padding: 80px 0 28px;
            background: linear-gradient(180deg, #fff 0%, #F6FAFD 100%);
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

        .grid {
            display: grid;
            gap: 16px
        }

        .two {
            grid-template-columns: 1fr
        }

        .values {

            gap: 20px
        }

        .value {
            padding: 24px;
            border: 1px solid var(--divider);
            border-radius: 14px;
            background: #fff
        }

        @media (min-width:820px) {
            .two {
                grid-template-columns: 1fr 1fr
            }

            .values {
                grid-template-columns: repeat(3, 1fr)
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

        /* ロゴサイズを揃える */
        .product-logo {
            height: 56px;
            /* 必要に応じて 48–72px で調整 */
            width: auto;
            object-fit: contain;
            border-radius: 10px;
            /* ← 角丸 */
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

        .shadow {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px
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
                <h1>IT × Collaboration</h1>
                <div class="sub">ともにつくり、ともに前へ。<br>クライアントの想いを汲み取り、共に課題を解決するパートナーとして。</div>
            </div>
        </div>
    </section>
    <main class="wrap">
        <section aria-label="overview ">
            <p>OBFallの受託開発は、「作る」ことを目的とせず、「価値を生み出す」ことを目的とする開発です。<br>
                Webサービス、アプリケーション、業務システムなど多様な開発に対応しながら、
                企画から設計・デザイン・実装・セキュリティ診断まで一貫した体制で提供しています。<br>
                クライアントと同じ目線で課題を見つめ、長く続く価値を共に育てていきます。</p>
        </section>

        <section id="principles" class="bg-blue-weak py-5">
            <div class="wrap">
                <div class="vstack gap-4"> <!-- ← 縦に積む -->
                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-bullseye" aria-hidden="true"></i>
                            <div class="kicker">INSIGHT</div>
                        </span>
                        <h2 class="principle-title">本質をともに見つめる</h2>
                        <p class="mb-0">誰かの「こうありたい」という想いを起点に、テクノロジーで実現へと近づけます。</p>
                    </article>
                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                            <div class="kicker">SYNTHESIS</div>
                        </span>
                        <h2 class="principle-title">デザインと技術の融合</h2>
                        <p class="mb-0">使いやすさ・伝わりやすさ・拡張性を意識し、UI/UX・機能・パフォーマンスのすべてで“心地よい体験”を設計。</p>
                    </article>

                    <!-- Mission -->
                    <article id="mission" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
                            <div class="kicker">RELIABILITY</div>
                        </span>
                        <h2 class="principle-title">安心まで届ける開発体制</h2>
                        <p class="mb-0">
                        <p>開発後に<strong>脆弱性診断</strong>を実施。見た目や機能だけでなく、安全性まで一貫して担保し、「安心して使い続けられる」未来を届けます。</p>
                    </article>

                    <!-- Values -->
                    <article id="values" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-handshake" aria-hidden="true"></i>
                            <div class="kicker">PARTNERSHIP</div>
                        </span>
                        <h2 class="principle-title">長く続く関係を築く</h2>
                        <p class="mb-0">納品して終わりではなく、成長と変化に寄り添う伴走型の開発。改善提案とサポートを継続します。</p>
                    </article>

                </div>
            </div>
        </section>


        <section id="values">
            <div class="" style="background:var(--blue-weak);border-top:none">
                <section>
                </section>
                <h2 class="my-5">選ばれる理由</h2>

                <section id="principles" class="bg-blue-weak py-5">
                    <div class="wrap">
                        <div class="vstack gap-4"> <!-- ← 縦に積む -->
                            <!-- Vision -->
                            <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                                <span class="icon-badge mb-3"><i class="fa-solid fa-handshake" aria-hidden="true"></i>
                                    <div class="kicker">CO-CREATION</div>
                                </span>
                                <h2 class="principle-title">共創の姿勢</h2>
                                <p class="mb-0">クライアントのビジョンを共有し、同じチームとして挑戦。成功を「価値の創出」として捉えます。</p>
                            </article>
                            <!-- Vision -->
                            <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                                <span class="icon-badge mb-3"><i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                                    <div class="kicker">CONSISTENCY</div>
                                </span>
                                <h2 class="principle-title">一貫した技術力と体制</h2>
                                <p class="mb-0">企画〜設計・デザイン・開発・診断までワンストップ。社内連携で品質・スピード・安心を両立します。</p>
                            </article>

                            <!-- Mission -->
                            <article id="mission" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                                <span class="icon-badge mb-3"><i class="fa-solid fa-chart-line" aria-hidden="true"></i>
                                    <div class="kicker">EMPOWERMENT</div>
                                </span>
                                <h2 class="principle-title">成長を支える開発文化</h2>
                                <p class="mb-0">
                                <p>自社開発・SESで培った知見を循環させ、プロジェクトごとに新しい価値を生み出します。</p>
                            </article>

                        </div>
                    </div>
                </section>
            </div>
        </section>

        <section aria-label="products" class="my-5 shadow">
            <h2 class="h4 mb-3">実績・事例紹介</h2>

            <!-- row-cols-1（SP縦） / row-cols-md-3（MD以上で3列） -->
            <div class="row row-cols-1 row-cols-md-3 g-4">

                <!-- CareerLog -->

                <div class="col">
                    <div class="d-flex flex-column align-items-center text-center h-100 p-3 border rounded-3">
                        <img src="../image/careerlog_logo.png" alt="CareerLog ロゴ"
                            class="product-logo mb-2" loading="lazy">
                        <p class="mb-0">CareerLog</p>
                    </div>
                </div>


                <!-- NoaChoice -->

                <div class="col ">
                    <div class="d-flex flex-column align-items-center text-center h-100 p-3 border rounded-3">
                        <img src="../image/NoaChoice_logo.jpg" alt="NoaChoice ロゴ"
                            class="product-logo mb-2" loading="lazy">
                        <p class="mb-0">NoaChoice</p>
                    </div>
                </div>




            </div>
            <div class="mt-auto text-end">
                <a class="more" href="{{ route('achievementsContract') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </div>
        </section>
        <nav aria-label="breadcrumb" class="m-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">
                <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('userServicesShow') }}">サービス</a></li>
                <li class="breadcrumb-item">受託開発</a></li>
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