<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Bootstrap 5 CDN (例) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Philosophy | OBFall Inc.</title>
    <style>
        /* ====== Minimal Design Tokens ====== */
        :root {
            --bg: #ffffff;
            --ink: #1A1A1A;
            --ink-2: #3a3a3a;
            --muted: #6b7785;
            --blue: #1E90FF;
            --blue-weak: #F6FAFD;
            --card: #ffffff;
            --divider: #E7EEF5;
            --radius: 16px;
            --shadow: 0 2px 14px rgba(0, 0, 0, .06);
            --maxw: 1120px;
        }

        .human-rights-policy {
            color: #eef6ff
        }

        html,
        body {
            background: var(--bg);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, "Hiragino Kaku Gothic ProN", "Noto Sans JP", Segoe UI, Roboto, Ubuntu, "Helvetica Neue", "Helvetica", Arial, sans-serif;
            line-height: 1.8;
        }

        h1,
        h2,
        h3 {
            line-height: 1.35;
            margin: 0 0 .5em
        }

        h1 {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 800;
            color: black;
            font-family: 'Times New Roman', Times, serif;
        }

        h2 {
            font-size: clamp(18px, 2.6vw, 26px);
            font-weight: 700;
            color: var(--blue)
        }

        h3 {
            font-size: clamp(16px, 2.2vw, 22px);
            font-weight: 700
        }

        p {
            margin: .6em 0
        }

        .wrap {
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 20px
        }

        section {
            padding: 80px 0;
            border-top: 1px solid var(--divider)
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
            padding: clamp(48px, 8vw, 120px) 16px;
        }


        .hero .title h1 {
            line-height: 1.3;
            margin: 0 0 .5rem;
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

            .hero .wrap {
                position: relative;
                z-index: 1;
                padding: clamp(48px, 8vw, 160px) 10px;
            }

            .hero .title h1 {
                font-size: 1.070rem;
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

        .grid {
            display: grid;
            gap: 28px
        }

        @media (min-width:960px) {
            .grid-2 {
                grid-template-columns: 1.1fr 1.4fr
            }
        }

        .card {
            background: var(--card);
            border: 1px solid var(--divider);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 28px
        }

        .muted {
            color: var(--muted)
        }

        .values {
            display: grid;
            gap: 20px
        }

        @media (min-width:860px) {
            .values {
                grid-template-columns: repeat(3, 1fr)
            }
        }

        .value {
            padding: 24px;
            border: 1px solid var(--divider);
            border-radius: 14px;
            background: #fff
        }

        .value h4 {
            margin: 0 0 .4rem;
            font-size: 18px
        }

        .kicker {
            letter-spacing: .12em;
            text-transform: uppercase;
            font-weight: 700;
            color: var(--blue);
            font-size: 13px;
            margin-bottom: .6rem
        }

        .message {
            background: #fff;
            border: 1px solid var(--divider);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 36px
        }

        .origin {
            background: var(--blue-weak);
            border: 1px solid var(--divider);
            border-radius: var(--radius);
            padding: 28px
        }

        .origin .bar {
            border-left: 4px solid var(--blue);
            padding-left: 16px
        }

        .ending {
            text-align: center;
            color: var(--muted)
        }

        .vis-img {
            aspect-ratio: 16/10;
            background: #e9f2fc;
            border: 1px dashed #bcd3f5;
            border-radius: 12px
        }

        .vis-caption {
            font-size: 12px;
            color: #708297;
            margin-top: 6px
        }

        a.btn {
            display: inline-block;
            background: var(--blue);
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 10px;
            margin-top: 18px
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
                <h1 class="">あなたの、あなたによる、あなたのためのを、<br>すべての人へ。</h1>
                <div class="sub">Philosophy</div>
            </div>
            <p class="lead">テクノロジーの力で、人と社会の可能性をひらく。<br>透明感と誠実さを大切にする私たちの理念ページです。</p>
        </div>
    </section>


    <!-- ===== Vision ===== -->
    <section id="vision">
        <div class="wrap grid grid-2">
            <figure>
                <!-- 置き換え：ビジョン用の象徴画像 -->
                <div class="vis-img" aria-label="Vision key visual"></div>
                <figcaption class="vis-caption">※ビジョン象徴イメージ（後で差し替え）</figcaption>
            </figure>
            <div class="card">
                <div class="kicker">Vision</div>
                <h2>「あなたの、あなたによる、あなたのための」をすべての人へ。</h2>
                <p>テクノロジーの力で、人と社会の可能性を広げ、誰もが自分らしく生き、挑戦できる未来を目指します。</p>
            </div>
        </div>
    </section>

    <!-- ===== Mission ===== -->
    <section id="mission" style="background:var(--blue-weak);border-top:none">
        <div class="wrap">
            <div class="card" style="background:#fff">
                <div class="kicker">Mission</div>
                <h2 style="color:var(--ink)">働くすべての人が、自分自身のために、自由にそして熱意を持って働ける社会をつくっていきます。</h2>
                <p>その実現のために、私たちはテクノロジーを通じて、挑戦する人と組織を支え、“つくる・支える・守る”という3つの軸で、社会に新しい価値を届け続けます。</p>
            </div>
        </div>
    </section>

    <!-- ===== Core Values ===== -->
    <section id="values">
        <div class="wrap">
            <div class="kicker">Core Values</div>
            <h2>3つの柱</h2>
            <div class="values">
                <div class="value">
                    <h4>理念採用</h4>
                    <p class="muted">共感を軸に、人と組織をつなぐ。理念に共鳴する仲間とともに、価値ある未来を創ります。</p>
                </div>
                <div class="value">
                    <h4>ES＝CS</h4>
                    <p class="muted">働く人の幸福が、顧客の満足を生む。社員満足と顧客満足の両立を通じて、持続的な成長を目指します。</p>
                </div>
                <div class="value">
                    <h4>Growth &amp; Challenge</h4>
                    <p class="muted">一人ひとりが自らの成長に挑み、変化を恐れず前へ。挑戦を後押しする文化を大切にします。</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Message ===== -->
    <section id="message">
        <div class="wrap">
            <div class="message">
                <div class="kicker">Message</div>
                <h3 style="margin-top:.2rem">人と社会が、ともに成長できる世界へ。</h3>
                <p>OBFallは、ITの力で“人”と“社会”が共に成長できる世界を目指しています。働くことが、あなたの人生を豊かにする体験であってほしい。その想いを胸に、私たちは挑戦を続けていきます。</p>
            </div>
        </div>
    </section>

    <!-- ===== Origin ===== -->
    <section id="origin">
        <div class="wrap">
            <div class="origin">
                <div class="bar">
                    <div class="kicker">Origin of Our Philosophy</div>
                    <h3>理念と社名の由来</h3>
                    <p>「あなたの、あなたによる、あなたのための」という言葉は、アメリカ第16代大統領エイブラハム・リンカーンの演説に由来しています。社名 <strong>OBFall</strong> は、その演説に登場する “of the people, by the people, for the people” に、<strong>“すべての人へ（all）”</strong> という想いを込めて名づけました。OBFallは、テクノロジーの力で、すべての人に可能性を届ける企業でありたいと考えています。</p>
                </div>
            </div>
        </div>
    </section>


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