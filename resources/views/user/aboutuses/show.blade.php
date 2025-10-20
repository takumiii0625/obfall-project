<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="https://obfall.com/image/logo_OBFall2.png">
    <title>OBFall株式会社</title>
    <link rel="icon" href="../image/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <!-- Bootstrap 5 CDN (例) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
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

        .human-rights-policy {
            color: #eef6ff
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

        .sub_aboutus {
            font-size: 1.260rem;
            line-height: 1.3;
            margin: 0 0 .5rem;
        }


        @media (max-width:480px) {
            .hero .wrap {
                position: relative;
                z-index: 1;
                padding: clamp(48px, 33vw, 160px) 10px 0;
            }
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
                font-size: 1.270rem;
                line-height: 1.3;
                margin: 0 0 .5rem;
            }

            .sub_aboutus {
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


        .hero .lead {
            margin-top: 1rem;
            max-width: 60ch;
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
                        <div class="title" onclick="scrollToTop()">OBFall株式会社</div>
                    </div>
                </a>
                <nav class="nav-01">
                    <ul>
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
    <!-- ===== Hero ===== -->
    <section class="hero">
        <div class="wrap">
            <div class="title">
                <h1>私たちOBFall株式会社について</h1>
                <div class="sub">About US</div>
            </div>
            <p class="lead">会社情報をご紹介いたします。</p>
        </div>
    </section>
    <main class="py-5">

        <div class="about" id="company">
            <div class="wrap">
                <h1 class=""><span>私たちOBFall株式会社について</span></h1>

                <div class="" style="background-color: #ffffff; width: 87%; padding: 10px 10px; margin: auto;     margin-bottom: 100px;">

                    <p class="sub_aboutus">
                        私たちOBFall株式会社の社名の由来は、リンカーンの有名なゲティスバーグ演説、独立宣言の以下3つの頭文字からきています。<br class=" br-sp" />
                        <strong class="highlight">「government &nbsp;<strong class="letter">o</strong>f the people, <strong class="letter">b</strong>y the people,<strong class="letter">f</strong>or the people(人民の、人民による、人民のための政治)」</strong><br>
                        私たちが行うのは政治ではありませんが、会社員にも、役割や評価など多くのものに囚われ100%のパフォーマンスを発揮できていない人がいるように感じます。
                        私たちOBFall株式会社は、3つの柱をもって新しい会社の形に挑戦し、働く全ての人が自由に、高いパフォーマンスを発揮できる社会を創ることを宣言いたします。
                    </p>
                </div>

                <div class="about-content-inner-wrap">
                    <ul class="fadein-scroll fadein-from-up">
                        <li>
                            <p class="about-head">会社名</p>
                            <p class="about-data">OBFall株式会社</p>
                        </li>
                        <li>
                            <p class="about-head">代表取締役</p>
                            <p class="about-data">上遠野　博紀</p>
                        </li>
                        <li>
                            <p class="about-head">所在地</p>
                            <p class="about-data">〒105-0022<br>東京都港区海岸1-2-3<br>汐留芝離宮ビルディング 21F<br>
                            </p>
                        </li>
                        <li>
                            <p class="about-head">電話番号</p>
                            <p class="about-data">03-5403-5904<br>
                            </p>
                        </li>
                        <li>
                            <p class="about-head">設立</p>
                            <p class="about-data">2021年8月4日<br>
                            </p>
                        </li>
                        <li>
                            <p class="about-head">資本金</p>
                            <p class="about-data">100万円</p>
                        </li>
                        <li>
                            <p class="about-head">取引先銀行</p>
                            <p class="about-data">みずほ銀行</p>
                        </li>

                    </ul>
                    <img class="fadein-scroll fadein-from-down" src="../image/siodomebiru.jpg">
                </div>
            </div>
            <div class="wrap">
                <a class="other fadein-scroll fadein-from-left" href="https://obfall.itszai.jp/achievements/34" target="_blank" rel="noopener noreferrer">採用サイトはこちら　<i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

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


<style>
    /* スマホ表示用のスタイル */
    @media (max-width: 767px) {
        .fs-7 {
            font-size: 3px;
        }

    }
</style>