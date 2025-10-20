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

    <title>脆弱性診断（Vulnerability Assessment） | OBFall Inc.</title>
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
            padding: 0 20px
        }

        header {
            padding: 80px 0 28px;
            background: linear-gradient(180deg, #fff 0%, #F0F6FF 100%);
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

        ul {
            margin: .2rem 0 1rem 1.1rem
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

    <section class="hero">
        <div class="wrap">
            <div class="title">
                <h1>安全は、後付けではなく、設計から。</h1>
                <div class="sub">Security × Engineering</div>
            </div>
            <p class="lead">開発を理解するセキュリティ専門チームが、攻撃者の視点でリスクを特定。再現性のある改善提案でプロダクトを安全に前進させます。</p>
        </div>
    </section>
    <main class="wrap">

        <section aria-label="summary">
            <p>Webアプリ・モバイルアプリ・APIなどの脆弱性診断を提供。開発現場の構造を理解したうえで“攻撃者の視点”からリスクを特定し、プロダクトを安全に前進させます。</p>
        </section>

        <section aria-label="strengths" class="grid two">
            <article class="card">
                <h3><i class="bi bi-puzzle-fill"></i> 開発を知る診断チーム</h3>
                <p>実装の意図や設計思想を踏まえて診断。「なぜその脆弱性が生まれたのか」「どう修正すべきか」まで踏み込みます。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-search"></i> 実戦型アプローチ</h3>
                <p>ツール検査＋手動検証で、入力値検証／認証認可／情報漏洩／セッション管理／設定不備などを網羅的に確認。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-diagram-3"></i> ワンストップ体制</h3>
                <p>開発フェーズからセキュリティを設計に組み込み、受託開発・SESと連携して未然に防止。結果は運用ガイドラインに落とし込みます。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-clipboard-check"></i> 再現性のあるレポート</h3>
                <p>「開発者がすぐ動ける」形式でレポート化。リスク説明と修正手順をセットで提供し、一過性で終わらせません。</p>
            </article>
        </section>


        <section aria-label="targets">
            <h2>診断対象</h2>
            <!-- あてこみ指示：各対象を象徴する小アイコン（Web/モバイル/API/社内/クラウド）を横並び -->
            <ul>
                <li>Webアプリ（Laravel, Rails, Node.js など）</li>
                <li>モバイルアプリ（iOS / Android / Flutter）</li>
                <li>API / GraphQL / 外部連携</li>
                <li>管理画面・社内システム</li>
                <li>クラウド設定診断（GCP / AWS）</li>
            </ul>
        </section>

        <section aria-label="reasons" class="grid two">
            <article class="card">
                <h3><i class="bi bi-gear-fill"></i> 開発と診断を一社完結</h3>
                <p>外部委託を抑え、情報漏洩リスクとコミュニケーションコストを低減。開発者との連携スピードも速いのが特長です。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-search"></i> 実践経験に基づく検証</h3>
                <p>診断員は現役エンジニア。コード／構成レベルで原因に迫り、修正コストを最小限に抑える提案を行います。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-shield-check"></i> 伴走型セキュリティ支援</h3>
                <p>改修支援・再診断・運用設計までサポート。「脆弱性をなくす」だけでなく「安全に成長を続ける」ことを目指します。</p>
            </article>

            <article class="card">
                <h3><i class="bi bi-cash-stack"></i> コストと柔軟性のバランス</h3>
                <p>大手のような高額・長納期ではなく、<strong>必要な範囲を最適なコストで</strong>。中間コストを省き、品質とスピードを両立します。</p>
            </article>
        </section>


        <section aria-label="cta">
            <!-- あてこみ指示：レポートのUI断片 or 診断ダッシュボードの静止画 -->
            <p class="note">画像差し込み：/images/security_report.jpg</p>
            <p><a class="more" href="/achievements#security">実績を見る <i class="bi bi-arrow-right-circle-fill"></i></a></p>
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