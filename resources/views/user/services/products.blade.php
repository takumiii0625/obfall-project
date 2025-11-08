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
            --ink: #101317;
            --muted: #6a7689;
            --blue: #1E90FF;
            --line: #E7EEF5;
            --panel: #fff;
            --radius: 14px;
            --shadow: 0 2px 14px rgba(0, 0, 0, .06);
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
                <h1>IT × Vision</h1>
                <div class="sub">人と社会の可能性を広げる、自社プロダクト。</div>
            </div>
        </div>
    </section>
    <main class="wrap">

        <section aria-label="overview">
            <p>OBFallの自社開発は、「テクノロジーで人生をより豊かにする」という理念をかたちにする取り組みです。<br>人の生き方や働き方、暮らしの中にある課題を見つめ、誰もが自分らしく生きられる社会を実現するためのプロダクトを開発しています。</p>
        </section>


        <section id="principles" class="bg-blue-weak py-5">
            <div class="wrap">
                <div class="vstack gap-4"> <!-- ← 縦に積む -->

                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-seedling" aria-hidden="true"></i>
                            <div class="kicker">EMBODY</div>
                        </span>
                        <h2 class="principle-title">人の想いを形にする</h2>
                        <p class="mb-0">誰かの「こうありたい」という想いを起点に、テクノロジーで実現へと近づけます。</p>
                    </article>

                    <!-- Mission -->
                    <article id="mission" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-people-group" aria-hidden="true"></i>
                            <div class="kicker">EMPATHY</div>
                        </span>
                        <h2 class="principle-title">社会に寄り添うサービスづくり</h2>
                        <p class="mb-0">便利さや効率だけでなく、人と人のつながり・安心・挑戦を支える仕組みを届けます。</p>
                    </article>

                    <!-- Values -->
                    <article id="values" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-gem" aria-hidden="true"></i>
                            <div class="kicker">COCREATE</div>
                        </span>
                        <h2 class="principle-title">共に育てるプロダクト</h2>
                        <p class="mb-0">使う人と共に磨き、社会に溶け込む“続いていく価値”を生み出します。</p>
                    </article>

                </div>
            </div>
        </section>




        <div aria-label="products" class="my-5 shadow">

            <h2 class="h4 mb-3 ">実績・事例紹介</h2>

            <!-- row-cols-1（SP縦） / row-cols-md-3（MD以上で3列） -->
            <div class="row  row-cols-1 row-cols-md-3 g-4 mb-4">

                <!-- digOn -->

                <div class="col">
                    <div class="d-flex flex-column align-items-center text-center h-100 p-3 border rounded-3">
                        <img src="../image/digOn_logo.png" alt="digOn ロゴ"
                            class="product-logo mb-2" loading="lazy">
                        <p class="mb-0">音楽発掘をもっと身近にする音楽アプリ</p>
                    </div>
                </div>


                <!-- ストパス -->

                <div class="col">
                    <div class="d-flex flex-column align-items-center text-center h-100 p-3 border rounded-3">
                        <img src="../image/store-pass_logo.png" alt="ストパス ロゴ"
                            class="product-logo mb-2" loading="lazy">
                        <p class="mb-0">ストア特化の来店・販促パスポート</p>
                    </div>
                </div>


                <!-- 農業向け業務効率化（開発中） -->

                <div class="col">
                    <div class="d-flex flex-column align-items-center text-center h-100 p-3 border rounded-3">
                        <img src="../image/dx_logo.png" alt="農業向け業務効率化 ロゴ"
                            class="product-logo mb-2" loading="lazy">
                        <p class="mb-0">農作業と記録の効率化を支援（開発中）</p>
                    </div>
                </div>


            </div>
            <div class="mt-auto text-end">
                <a class="more" href="{{ route('achievementsProducts') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </div>
        </div>
        <nav aria-label="breadcrumb" class="m-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">

                <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('userServicesShow') }}">サービス</a></li>
                <li class="breadcrumb-item">自社開発</a></li>
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