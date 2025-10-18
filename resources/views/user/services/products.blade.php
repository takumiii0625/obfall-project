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

    <title>自社開発（Products） | OBFall Inc.</title>
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
            background: linear-gradient(180deg, #fff 0%, #F6FAFD 100%);
            border-bottom: 1px solid var(--line)
        }

        h1 {
            margin: 0 0 .4rem;
            font-size: clamp(28px, 4vw, 40px)
        }

        .sub {
            color: var(--blue);
            font-weight: 700;
            letter-spacing: .12em;
            margin-bottom: 6px
        }

        .lead {
            color: var(--muted);
            max-width: 760px
        }

        section {
            padding: 56px 0;
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
                        <li class="link text-dark "><a href="https://obfall.com/contact" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTACT</a></li>

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
                <li class="link text-dark "><a href="https://obfall.com/contact" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTACT</a></li>

            </ul>
        </nav>
    </div>

    <div class="main-visual">
        <div class="img-wrap-sub">
            <img src="../image/chou.jpg">
        </div>
    </div>
    <main class="wrap">

        <section>
            <div class="wrap">
                <div class="sub">IT × Vision</div>
                <h1>人と社会の可能性を広げる、自社プロダクト。</h1>
                <p class="lead">OBFallの自社開発は、「テクノロジーで人生をより豊かにする」という理念をかたちにする取り組みです。</p>
                <!-- あてこみ指示：ヒーロー画像：自社プロダクトUIのコラージュ or 企画・開発風景の写真 -->
                <img class="hero-img" src="/images/products_hero.jpg" alt="自社開発のイメージ">
            </div>
        </section>
        <section aria-label="overview">
            <p>人の生き方や働き方、暮らしの中にある課題を見つめ、誰もが自分らしく生きられる社会を実現するためのプロダクトを開発しています。</p>
        </section>

        <section aria-label="principles" class="grid two">
            <article class="card">
                <h3>🤝 人の想いを形にする</h3>
                <p>誰かの「こうありたい」という想いを起点に、テクノロジーで実現へと近づけます。</p>
            </article>
            <article class="card">
                <h3>🌿 社会に寄り添うサービスづくり</h3>
                <p>便利さや効率だけでなく、人と人のつながり・安心・挑戦を支える仕組みを届けます。</p>
            </article>
            <article class="card">
                <h3>🔁 共に育てるプロダクト</h3>
                <p>使う人と共に磨き、社会に溶け込む“続いていく価値”を生み出します。</p>
            </article>
        </section>

        <section aria-label="products">
            <h2>代表プロダクト</h2>
            <!-- あてこみ指示：各プロダクトのスクリーンショット3枚を横並び（モバイルでは縦積み） -->
            <p class="note">画像差し込み：/images/digon_ui.jpg /images/stpass_ui.jpg /images/agri_ui.jpg</p>
            <ul>
                <li>digOn</li>
                <li>ストパス</li>
                <li>農業向け業務効率化（開発中）</li>
            </ul>
            <p><a class="more" href="/achievements#products">関連プロジェクトを見る →</a></p>
        </section>

        <section aria-label="cta">
            <p><a class="cta" href="/contact?type=products">お問い合わせ</a></p>
        </section>
    </main>
    <footer class="wrap"><small>© OBFall Inc.</small></footer>
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>