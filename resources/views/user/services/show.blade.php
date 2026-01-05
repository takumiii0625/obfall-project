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

    <title>Services | OBFall Inc.</title>
    <style>
        :root {
            --ink: #1a1a1a;
            --muted: #657287;
            --blue: #1E90FF;
            --bg: #fff;
            --card: #fff;
            --line: #E7EEF5;
            --radius: 14px;
            --shadow: 0 2px 14px rgba(0, 0, 0, .06);
            --maxw: 1120px;
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
            min-height: 36vh;
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
            margin: 80px 0 .5rem;
            letter-spacing: 0.08em;
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
            background: var(--bg);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, "Noto Sans JP", Segoe UI, Roboto, Arial, sans-serif;
            line-height: 1.8
        }

        .wrap {
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 20px
        }




        .lead {
            color: black;
            max-width: 760px
        }

        .grid {
            display: grid;
            gap: 18px;
            margin: 28px 0 48px
        }

        @media (min-width:900px) {
            .grid {
                grid-template-columns: 1fr 1fr
            }
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px
        }

        .kicker {
            font-size: 12px;
            letter-spacing: .12em;
            color: var(--blue);
            font-weight: 700;

            font-family: serif;
        }

        h2,
        h3 {
            margin: .2rem 0 .4rem
        }

        p {
            margin: .4rem 0 1rem;
            color: var(--muted)
        }



        a.more {
            color: var(--blue);
            text-decoration: none;
            text-align: end;
        }


        .card-title {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            text-align: center;
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


    <!-- ===== Hero ===== -->
    <section class="hero">
        <div class="wrap">
            <div class="title">
                <h1>Service</h1>
                <div class="sub"><br><br><br><br>ITの力で、人と社会の可能性を広げる。<br>　</div>
            </div>
        </div>
    </section>
    <main class="wrap">
        <section aria-label="overview">
            <p><br>自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、テクノロジーで人生をより豊かにします。</p>
        </section>


        <section aria-label="service-cards" class="grid">
            <!-- 自社開発 -->
            <article class="card">
                <div class="kicker">Products</div>
                <div><i class="bi bi-lightbulb-fill"></i>自社開発</div>
                <h3 class="card-title">IT × Vision</h3>
                <br>
                <p>人と社会の可能性を広げる、自社プロダクト。</p>
                <a class="more" href="{{ route('products') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>

            <!-- 受託開発 -->
            <article class="card">
                <div class="kicker">Contract Development</div>
                <div><i class="bi bi-lightbulb-fill"></i>受託開発</div>
                <h3 class="card-title">IT × Collaboration</h3>
                <br>
                <p>ともにつくり、ともに前へ。</p>
                <a class="more" href="{{ route('contract') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>

            <!-- SES -->
            <article class="card">
                <div class="kicker">Team Support</div>
                <div><i class="bi bi-lightbulb-fill"></i>SES</div>
                <h3 class="card-title">IT × Team</h3>
                <br>
                <p>人が輝く現場を、技術で支える。</p>
                <a class="more" href="{{ route('ses') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>

            <!-- 脆弱性診断 -->
            <article class="card">
                <div class="kicker">Security</div>
                <div><i class="bi bi-lightbulb-fill"></i>脆弱性診断</div>
                <h3 class="card-title">Security × Engineering</h3>
                <br>
                <p>安全は、後付けではなく、設計から。</p>
                <a class="more" href="{{ route('security') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>
        </section>
        <nav aria-label="breadcrumb" class="m-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">

                <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                <li class="breadcrumb-item">サービス</a></li>
            </ol>
        </nav>
    </main>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>

</html>