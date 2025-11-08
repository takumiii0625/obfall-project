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
    <title>Achievements | OBFall Inc.</title>

    <style>
        /* === 基本設定 === */
        body {
            font-family: "Noto Sans JP", sans-serif;
            color: #333;
            line-height: 1.8;
            background: #fafafa;
            margin: 0;
            padding: 0;
        }

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

        section {

            padding: 24px 24px;
        }

        hr {
            border: none;
            border-top: 1px solid #e0e0e0;
            margin: 32px 0;
        }

        /* === 見出し系 === */
        h2 {
            font-size: 1.8rem;
            color: #007acc;
            margin-bottom: 8px;
        }

        h3 {
            font-size: 1.4rem;
            color: #444;
            font-weight: 500;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        h4 {
            font-size: 1.2rem;
            margin-top: 20px;
            color: #007acc;
        }

        .achievement-lead {
            font-weight: 600;
            font-size: 1.3rem;
            color: #222;
        }



        /* === テキスト・段落 === */
        p {
            margin: 0 0 16px 0;
        }

        ul {
            margin: 12px 0 24px 20px;
        }

        ul ul {
            margin-top: 4px;
        }

        strong {
            color: #007acc;
        }

        /* === 画像コンテナ === */
        .image-container {
            margin-top: 24px;
            text-align: center;
        }

        .image-container img {
            width: 60%;
            max-width: 720px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* === ボタンリンク === */
        .link-button {
            display: inline-block;
            padding: 10px 18px;
            background: #007acc;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.95rem;
            transition: background 0.2s;
        }

        .link-button:hover {
            background: #005fa3;
        }

        /* === 各セクション区分 === */
        .section-products {
            background: #ffffff;
            border-left: 6px solid #66b3ff;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .section-contract {
            background: #ffffff;
            border-left: 6px solid #00b894;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .section-security {
            background: #ffffff;
            border-left: 6px solid #ff7675;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        /* === 実績アイテム === */
        .achievement-item {
            margin-bottom: 60px;
        }

        /* === まとめ文 === */
        .summary {
            font-weight: 600;
            text-align: center;
            margin-top: 32px;
            color: #333;
        }

        .hero {
            --hero-img: url('../image/achievements.jpg');

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

        h1 {
            font-size: clamp(28px, 4vw, 100px);
            font-weight: 800;
            color: black;
            font-family: 'Times New Roman', Times, serif;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 22px
        }

        .card-title {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            text-align: center;
        }

        .kicker {
            font-size: 12px;
            letter-spacing: .12em;
            color: var(--blue);
            font-weight: 700;

            font-family: serif;
        }

        .grid {
            display: grid;
            gap: 18px;

        }

        @media (min-width:900px) {
            .grid {
                grid-template-columns: 1fr 1fr
            }
        }

        /* === レスポンシブ === */
        @media (max-width: 768px) {
            h2 {
                font-size: 1.6rem;
            }

            h3 {
                font-size: 1.2rem;
            }

            .link-button {
                width: 100%;
                text-align: center;
            }

            .image-container img {
                max-width: 100%;
            }

            section {

                padding: 10px 16px;
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

        a.more {
            color: var(--blue);
            text-decoration: none;
            text-align: end;
        }

        /* ベース: 縦並び（スマホ） */
        .achievement-content {
            display: flex;
            flex-direction: column;
            align-items: center;

        }

        /* PC版（768px以上）で横並びに */
        @media (min-width: 768px) {
            .achievement-content {
                flex-direction: row;
                align-items: flex-start;
            }

            .achievement-content .text {
                flex: 1;
            }

            .achievement-content .image-container {
                flex: 1;
                text-align: right;
                /* 右寄せ */
            }

            .achievement-content .image-container img {
                max-width: 80%;
                height: auto;
            }
        }

        /* ロゴは常に小さめ。画面幅に応じて 96〜160px で可変 */
        .app-logo {
            width: clamp(96px, 18vw, 160px);
            height: auto;
            display: block;
            margin: 0 0 12px;
            object-fit: contain;
            /* 任意: 少し落ち着いた見た目にするなら
  opacity: .95;
  */
        }

        /* 配置：PCでは左寄せ、スマホでは中央寄せにしたい場合 */
        @media (max-width: 575.98px) {
            .app-logo {
                margin-left: auto;
                margin-right: auto;
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


    <!-- ===== Hero ===== -->
    <section class="hero">
        <div class="wrap">
            <div class="title">
                <h1>Achievements</h1>
                <div class="sub">ITの力で、人と社会の可能性を広げる。<br>OBFallの挑戦と成果。</div>
            </div>
        </div>
    </section>
    <main class="wrap">
        <section aria-label="overview">
            <p>
                私たちは、「テクノロジーで人生をより豊かにする」という理念のもと、
                自社開発・受託開発・脆弱性診断・SESの4つの領域で、
                社会や現場の課題を“仕組み”として解決してきました。<br>
                ここで紹介するのは、私たちの手で形にしてきたプロジェクトたち。<br>
                どれも、「人」や「社会」に新しい選択肢を生み出すための挑戦です。
            </p>
        </section>

        <section aria-label="service-cards" class="grid">
            <!-- 自社開発 -->
            <article class="card">
                <div class="kicker">Products</div>
                <div><i class="bi bi-lightbulb-fill"></i>自社開発</div>
                <h3 class="card-title">IT × Vision</h3>
                <p>人と社会の可能性を広げる、自社プロダクト。<br>
                    OBFallの想いを、サービスというかたちで届けます。</p>
                <a class="more" href="{{ route('achievementsProducts') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>

            <!-- 受託開発 -->
            <article class="card">
                <div class="kicker">Contract Development</div>
                <div><i class="bi bi-lightbulb-fill"></i>受託開発</div>
                <h3 class="card-title">IT × Collaboration</h3>
                <p>ともにつくり、ともに前へ。<br>
                    クライアントの想いを汲み取り、共に課題を解決するパートナーとして伴走します。
                </p>
                <a class="more" href="{{ route('achievementsContract') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>

            <!-- 脆弱性診断 -->
            <article class="card">
                <div class="kicker">Security Assessment</div>
                <div><i class="bi bi-lightbulb-fill"></i>脆弱性診断</div>
                <h3 class="card-title">Security × Engineering</h3>
                <p>安全は、後付けではなく、設計から。<br>
                    開発と診断をワンストップで行い、信頼できるプロダクトづくりを支えます。</p>
                <a class="more" href="{{ route('achievementsSecurity') }}">詳しく見る <i class="bi bi-arrow-right-circle-fill"></i></a>
            </article>
        </section>

        <nav aria-label="breadcrumb" class="m-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">

                <li class="breadcrumb-item"><a style="color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));" href="{{ route('indexDev') }}">トップ</a></li>
                <li class="breadcrumb-item">実績・事例紹介</a></li>
            </ol>
        </nav>

    </main>
    <footer>
        <div class="devwrap d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <!-- PC:左 / SP:一番上（ロゴ＋ページトップへ） -->
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center order-1 order-md-1">
                <img src="./image/logo_OBFall_white.png"
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