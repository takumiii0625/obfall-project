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
            font-size: clamp(28px, 4vw, 40px)
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
                <h1>ともにつくり、ともに前へ。</h1>
                <div class="sub">IT × Collaboration</div>
            </div>
            <p class="lead">同じ目線で課題に向き合うパートナーとして、Webサービスやアプリを共創。機能だけでなく、安心まで届ける開発体制で伴走します。</p>
        </div>
    </section>
    <main class="wrap">


        <section aria-label="pillars" class="grid two">
            <article class="card">
                <h3><i class="bi bi-search"></i> 本質をともに見つめる</h3>
                <p>課題を「作ること」ではなく「解決すること」として捉え、事業背景を深く理解して長期的な成長を見据えます。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-palette"></i> デザインと技術の融合</h3>
                <p>使いやすさ・伝わりやすさ・拡張性を意識し、UI/UX・機能・パフォーマンスのすべてで“心地よい体験”を設計。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-shield-check"></i> 安心まで届ける開発体制</h3>
                <p>開発後に<strong>脆弱性診断</strong>を実施。見た目や機能だけでなく、安全性まで一貫して担保し、「安心して使い続けられる」未来を届けます。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-people-fill"></i> 長く続く関係を築く</h3>

                <p>納品して終わりではなく、成長と変化に寄り添う伴走型の開発。改善提案とサポートを継続します。</p>
            </article>
        </section>

        <section aria-label="reasons" class="grid two">
            <article class="card">
                <h3><i class="bi bi-chat-dots"></i> 共創の姿勢</h3>
                <p>クライアントのビジョンを共有し、同じチームとして挑戦。成功を「価値の創出」として捉えます。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-gear-fill"></i> 一貫した技術力と体制</h3>
                <p>企画〜設計・デザイン・開発・診断までワンストップ。社内連携で品質・スピード・安心を両立します。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-graph-up-arrow"></i> 成長を支える開発文化</h3>
                <p>自社開発・SESで培った知見を循環させ、プロジェクトごとに新しい価値を生み出します。</p>
            </article>
        </section>


        <section aria-label="cta">
            <!-- あてこみ指示：UIモックやプロトタイピングの画像1枚 -->
            <p class="note">画像差し込み：/images/contract_ui_mock.jpg</p>
            <p><a class="more" href="/achievements#contract">実績を見る <i class="bi bi-arrow-right-circle-fill"></i></a></p>
            <p><a class="cta" href="{{ route('contact') }}">お問い合わせ　<i class="bi bi-arrow-right-circle-fill"></i></a></p>
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