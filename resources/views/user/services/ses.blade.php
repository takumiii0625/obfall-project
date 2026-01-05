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

        .origin {
            background: var(--blue-weak);
            border: 1px solid var(--divider);
            border-radius: var(--radius);
        }

        .origin .bar {
            border-left: 4px solid var(--blue);
            padding-left: 16px
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

    <section class="hero">
        <div class="wrap">
            <div class="title">
                <h1>IT × Team</h1>
                <div class="sub"><br><br><br><br>人が輝く現場を、技術で支える。</div>
            </div>
        </div>
    </section>

    <main class="wrap">
        <section aria-label="overview">
            <p>エンジニアが力を発揮できる環境を整え、技術とチームの両面から現場を支援。「人」と「組織」がともに成長する関係を築くことが、OBFallのSESです。</p>
        </section>

        <section id="principles" class="bg-blue-weak py-5">
            <div class="wrap">
                <div class="vstack gap-4"> <!-- ← 縦に積む -->
                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-handshake" aria-hidden="true"></i>
                            <div class="kicker">VISION</div>
                        </span>
                        <h2 class="principle-title">私たちの想い</h2>
                        <p class="mb-0">人が主役の現場を、もっと誇れる場所に。<br>
                            OBFallのSESは、エンジニア一人ひとりが自分らしく力を発揮できる環境をつくることで、
                            企業と人の“成長の循環”を生み出します。<br>
                            単なる人材支援ではなく、共に挑み、共に成長するパートナーとして並走します。</p>
                    </article>
                    <!-- Vision -->
                    <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                        <span class="icon-badge mb-3"><i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                            <div class="kicker">VISION</div>
                        </span>
                        <h2 class="principle-title">サービス概要</h2>
                        <p class="mb-0">私たちは、クライアントの現場課題に最も適したエンジニアをアサインし、
                            開発・運用・保守などのプロジェクトを技術面とチーム面から支援します。<br>
                            配属後も定期的なフォローやスキルアップ支援を行い、
                            長期的な関係構築と高品質な成果創出を両立します。</p>
                    </article>



                </div>
            </div>
        </section>
        <section id="values">
            <div class="" style="background:var(--blue-weak);border-top:none">

                <h2 class="mt-5">OBFallのSESが選ばれる理由</h2>

                <div id="principles" class="bg-blue-weak py-5">
                    <div class="wrap">
                        <div class="vstack gap-4"> <!-- ← 縦に積む -->
                            <!-- Vision -->
                            <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                                <span class="icon-badge mb-3"><i class="bi bi-person-heart" aria-hidden="true"></i>
                                    <div class="kicker">EMPATHY</div>
                                </span>
                                <h2 class="principle-title">“人”を中心とした関係づくり</h2>
                                <p class="mb-0">スキルシートだけでなく、価値観やキャリアビジョンまでを見据え、
                                    企業と人が共に成長できる“関係”を設計します。<br>
                                    「どんな現場ならその人が最も輝くか」を起点に考え、
                                    人とチームの可能性を最大限に引き出します。</p>
                            </article>
                            <!-- Vision -->
                            <article id="vision" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                                <span class="icon-badge mb-3"><i class="bi bi-people-fill" aria-hidden="true"></i>
                                    <div class="kicker">GROWTH</div>
                                </span>
                                <h2 class="principle-title">継続的な伴走と成長支援</h2>
                                <p class="mb-0">配属後もチーム単位でフォローし、キャリアアップ・スキル共有・勉強会など
                                    人と組織が共に進化する環境を提供します。</p>
                            </article>

                            <!-- Mission -->
                            <article id="mission" class="card principle-card h-100 border-0 shadow-sm rounded-4 p-4">
                                <span class="icon-badge mb-3"><i class="bi bi-tools" aria-hidden="true"></i>
                                    <div class="kicker">CRAFTSMANSHIP</div>
                                </span>
                                <h2 class="principle-title">現場で磨かれる技術力</h2>
                                <p class="mb-0">
                                <p>OBFallでは、自社開発・受託開発を通じて技術を磨き続けています。<br>
                                    その実践的な知見と経験が、SESにおいても高い提案力と課題解決力を支えています。<br>
                                    現場に“成長と信頼”という価値をもたらすのが、私たちの強みです。</p>
                            </article>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="origin">
            <div class="wrap">
                <div class="origin">
                    <div class="bar">
                        <div class="kicker">Message</div>
                        <h3>メッセージ</h3>
                        <p>SESを、“人を送るビジネス”から“人が活きる仕組み”へ。<br>
                            OBFallは、ITの力で働く人と企業の関係をより良くデザインしていきます。</p>
                    </div>
                </div>
            </div>
        </section>
        <nav aria-label="breadcrumb" class="m-3">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">

                <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('userServicesShow') }}">サービス</a></li>
                <li class="breadcrumb-item"></a>SES</li>
            </ol>
        </nav>
    </main>
    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>


</html>