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
                <div class="sub">IT × Collaboration</div>
                <h1>ともにつくり、ともに前へ。</h1>
                <p class="lead">同じ目線で課題に向き合うパートナーとして、Webサービスやアプリを共創。機能だけでなく、安心まで届ける開発体制で伴走します。</p>
                <!-- あてこみ指示：ヒーロー画像：要件定義の打合せ風景 or ホワイトボード前の議論 -->
                <img class="hero-img" src="/images/contract_hero.jpg" alt="受託開発のイメージ">
            </div>
        </section>

        <section aria-label="pillars" class="grid two">
            <article class="card">
                <h3>🔍 本質をともに見つめる</h3>
                <p>課題を「作ること」ではなく「解決すること」として捉え、事業背景を深く理解して長期的な成長を見据えます。</p>
            </article>
            <article class="card">
                <h3>🎨 デザインと技術の融合</h3>
                <p>使いやすさ・伝わりやすさ・拡張性を意識し、UI/UX・機能・パフォーマンスのすべてで“心地よい体験”を設計。</p>
            </article>
            <article class="card">
                <h3>🛡️ 安心まで届ける開発体制</h3>
                <p>開発後に<strong>脆弱性診断</strong>を実施。見た目や機能だけでなく、安全性まで一貫して担保し、「安心して使い続けられる」未来を届けます。</p>
            </article>
            <article class="card">
                <h3>🤝 長く続く関係を築く</h3>
                <p>納品して終わりではなく、成長と変化に寄り添う伴走型の開発。改善提案とサポートを継続します。</p>
            </article>
        </section>

        <section aria-label="reasons" class="grid two">
            <article class="card">
                <h3>💬 共創の姿勢</h3>
                <p>クライアントのビジョンを共有し、同じチームとして挑戦。成功を「価値の創出」として捉えます。</p>
            </article>
            <article class="card">
                <h3>⚙️ 一貫した技術力と体制</h3>
                <p>企画〜設計・デザイン・開発・診断までワンストップ。社内連携で品質・スピード・安心を両立します。</p>
            </article>
            <article class="card">
                <h3>🌱 成長を支える開発文化</h3>
                <p>自社開発・SESで培った知見を循環させ、プロジェクトごとに新しい価値を生み出します。</p>
            </article>
        </section>

        <section aria-label="cta">
            <!-- あてこみ指示：UIモックやプロトタイピングの画像1枚 -->
            <p class="note">画像差し込み：/images/contract_ui_mock.jpg</p>
            <p><a class="more" href="/achievements#contract">実績を見る →</a></p>
            <p><a class="cta" href="/contact?type=contract">お問い合わせ</a></p>
        </section>
    </main>
    <footer class="wrap"><small>© OBFall Inc.</small></footer>
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>