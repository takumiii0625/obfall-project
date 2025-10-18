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

    <title>SES（技術支援） | OBFall Inc.</title>
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
                <div class="sub">IT × Team</div>
                <h1>人が輝く現場を、技術で支える。</h1>
                <p class="lead">エンジニアが力を発揮できる環境を整え、技術とチームの両面から現場を支援。「人」と「組織」がともに成長する関係を築くことが、OBFallのSESです。</p>
                <!-- あてこみ指示：ヒーロー画像：チームのミーティング写真 or オンライン会議のスクリーンショット -->
                <img class="hero-img" src="/images/ses_hero.jpg" alt="SESのイメージ">
            </div>
        </section>
        <section aria-label="overview">
            <h2>私たちの想い</h2>
            <p>人が主役の現場を、もっと誇れる場所に。単なる人材支援ではなく、共に挑み、共に成長するパートナーとして並走します。</p>
            <h2>サービス概要</h2>
            <p>適切なエンジニアを配置し、開発・運用・保守などを支援。配属後も継続的なフォローと学習支援で、長期的な関係と高品質な成果を両立します。</p>
        </section>

        <section aria-label="reasons" class="grid two">
            <article class="card">
                <h3>💡 “人”を中心とした関係づくり</h3>
                <p>スキルだけでなく価値観やキャリアを理解し、企業と人が共に成長できる“関係”を設計します。</p>
            </article>
            <article class="card">
                <h3>🤝 継続的な伴走と成長支援</h3>
                <p>定期面談・スキル共有・勉強会などで、技術力と人間力の両面から成長を支援します。</p>
            </article>
            <article class="card">
                <h3>🛠️ 現場で磨かれる技術力</h3>
                <p>自社開発・受託開発で培った実践知をSESにも還元。提案力と課題解決力で現場に“成長と信頼”をもたらします。</p>
            </article>
        </section>

        <section aria-label="cta">
            <!-- あてこみ指示：勉強会や1on1面談の様子が伝わる写真1枚 -->
            <p class="note">画像差し込み：/images/ses_meetup.jpg</p>
            <p><a class="cta" href="/contact?type=ses">お問い合わせ</a></p>
        </section>
    </main>
    <footer class="wrap"><small>© OBFall Inc.</small></footer>
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>


</html>