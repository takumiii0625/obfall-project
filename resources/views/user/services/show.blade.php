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
            font-size: clamp(28px, 4vw, 40px);
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


        h1 {
            margin: 0 0 .4rem;
            font-size: clamp(28px, 4vw, 40px)
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
            padding: 22px
        }

        .kicker {
            font-size: 12px;
            letter-spacing: .12em;
            color: var(--blue);
            font-weight: 700;
            margin-bottom: 6px
        }

        h2,
        h3 {
            margin: .2rem 0 .4rem
        }

        p {
            margin: .4rem 0 1rem;
            color: var(--muted)
        }

        a.btn {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            background: var(--blue);
            color: #fff
        }

        a.more {
            color: var(--blue);
            text-decoration: none
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
                font-size: 1.200rem;
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
        <header class="fadein-first fadein-from-up">
            <div class="wrap">
                <a href="{{ route('indexDev') }}" class="text-dark text-decoration-none">
                    <div class="logo-container">
                        <img src="../image/logo_OBFall.png" class="link" onclick="scrollToTop()" />
                    </div>
                </a>
                <nav class="nav-01">
                    <ul>
                        <li class="link text-dark "><a href="{{ route('philosophy') }}" class="text-dark text-decoration-none">PHILOSOPHY</a></li>
                        <li class="link text-dark "><a href="{{ route('userServicesShow') }}" class="text-dark text-decoration-none">SERVICE</a></li>
                        <li class="link text-dark "><a href="{{ route('achievements') }}" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">ACHIEVEMENTS</a></li>
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
                <li class="link text-dark "><a href="{{ route('achievements') }}" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">ACHIEVEMENTS</a></li>
                <li class="link text-dark "><a href="{{ route('aboutus') }}" class="text-dark text-decoration-none">ABOUT US</a></li>
                <li class="link text-dark "><a href="{{ route('contact') }}" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTACT</a></li>

            </ul>
        </nav>
    </div>


    <!-- ===== Hero ===== -->
    <section class="hero">
        <div class="wrap">
            <div class="title">
                <h1>ITの力で、人と社会の可能性を広げる。</h1>
                <div class="sub">Servise</div>
            </div>
            <p class="lead">自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、テクノロジーで人生をより豊かにします。</p>
        </div>
    </section>
    <main class="wrap">


        <section aria-label="service-cards" class="grid">
            <!-- 自社開発 -->
            <article class="card">
                <div class="kicker">Products</div>
                <h3><i class="bi bi-lightbulb-fill"></i>自社開発<p class="small">（Products）</p>
                </h3>
                <img src="images/service_own.jpg" alt="自社開発のイメージ">
                <p>人の生き方・働き方・暮らしの中にある課題を見つめ、誰もが自分らしく生きられる社会を実現するためのプロダクトを開発。</p>
                <a class="more" href="{{ route('products') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>

            <!-- 受託開発 -->
            <article class="card">
                <div class="kicker">Contract Development</div>
                <h3><i class="bi bi-briefcase-fill"></i> 受託開発<p class="small">（Contract Development）</p>
                </h3>
                <img src="images/service_contract.jpg" alt="受託開発のイメージ">
                <p>同じ目線で課題に向き合うパートナーとして、Web/アプリを共創。機能だけでなく、安心まで届ける開発体制で伴走します。</p>
                <a class="more" href="{{ route('contract') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>

            <!-- SES -->
            <article class="card">
                <div class="kicker">Team Support</div>
                <h3><i class="bi bi-person-check-fill"></i>SES<p class="small">（技術支援）</p>
                </h3>
                <img src="images/service_ses.jpg" alt="SES事業のイメージ">
                <p>エンジニアが最大限力を発揮できる環境を整え、技術とチームの両面から現場を支援。人と組織が共に成長する関係を築きます。</p>
                <a class="more" href="{{ route('ses') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>

            <!-- 脆弱性診断 -->
            <article class="card">
                <div class="kicker">Security</div>
                <h3><i class="bi bi-shield-lock-fill"></i>脆弱性診断<p class="small">（Vulnerability Assessment）</p>
                </h3>
                <img src="images/service_security.jpg" alt="脆弱性診断のイメージ">
                <p>開発を理解するセキュリティチームが、攻撃者の視点でリスクを特定。再現性のある改善提案でプロダクトを安全に前進させます。</p>
                <a class="more" href="{{ route('security') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>
        </section>

        <section aria-label="cta">
            <a class="btn mb-5" href="{{ route('contact') }}">まずは相談する　<i class="bi bi-arrow-right-circle-fill"></i></a>
        </section>

    </main>

    <footer>
        <div class="devwrap">
            <div class="footer-left">
                <p>
                    〒105-0022<br>
                    東京都港区海岸1-2-3&nbsp;&nbsp;汐留芝離宮ビルディング 21F<br>
                    03-5403-5904<br>
                    <a href="{{ url('/human-rights-policy') }}" target="_blank" class="human-rights-policy">
                        人権に関する基本方針と社内相談窓口
                    </a>
                </p>
                <small>&copy; OBFall株式会社</small>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>

</html>