<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <title>脆弱性診断（Vulnerability Assessment） | OBFall Inc.</title>
    <style>
        :root {
            --ink: #1a1a1a;
            --muted: #5a6978;
            --blue: #0dcaf0;
            --blue-light: rgba(13,202,240,.08);
            --bg: #fff;
            --bg-alt: #f8fafc;
            --card: #fff;
            --line: #e2e8f0;
            --radius: 16px;
            --shadow: 0 4px 24px rgba(0,0,0,.06);
            --shadow-hover: 0 12px 40px rgba(0,0,0,.10);
            --maxw: 1100px;
            --font-heading: "Times New Roman", "Noto Serif JP", Georgia, serif;
        }

        .human-rights-policy { color: #eef6ff }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--bg);
            font-family: -apple-system, BlinkMacSystemFont, "Noto Sans JP", "Segoe UI", Roboto, Arial, sans-serif;
            line-height: 1.8;
        }

        .wrap {
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ── セクション ── */
        .sec { padding: 80px 0; }
        .sec--alt { background: var(--bg-alt); }

        /* ── リード文 ── */
        .lead-text {
            font-size: clamp(1rem, 1.8vw, 1.18rem);
            max-width: 720px;
            line-height: 2;
            color: #444;
            margin: 0 auto;
            text-align: center;
        }

        /* ── セクション見出し ── */
        .sec-heading {
            text-align: center;
            margin-bottom: 48px;
        }
        .sec-heading__kicker {
            display: block;
            font-size: .75rem;
            letter-spacing: .14em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .sec-heading__title {
            font-family: var(--font-heading);
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 700;
            margin: 0;
            line-height: 1.4;
        }

        /* ── 価値カード ── */
        .value-grid {
            display: grid;
            gap: 28px;
            grid-template-columns: 1fr;
        }
        @media (min-width: 768px) {
            .value-grid--2 { grid-template-columns: repeat(2, 1fr); }
            .value-grid--4 { grid-template-columns: repeat(2, 1fr); }
        }

        .value-card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 36px 32px 32px;
            box-shadow: var(--shadow);
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .value-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .value-card__num {
            font-size: 2.5rem;
            font-weight: 800;
            color: rgba(13,202,240,.12);
            line-height: 1;
            margin-bottom: 8px;
            font-family: var(--font-heading);
        }

        .value-card__kicker {
            font-size: .75rem;
            letter-spacing: .14em;
            color: var(--blue);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .value-card__title {
            font-family: var(--font-heading);
            font-size: clamp(1.15rem, 2vw, 1.35rem);
            font-weight: 700;
            margin: 0 0 12px;
            line-height: 1.5;
        }

        .value-card__desc {
            color: var(--muted);
            font-size: .92rem;
            line-height: 1.9;
            margin: 0;
        }

        /* ── 診断対象リスト ── */
        .target-list {
            display: grid;
            gap: 16px;
            grid-template-columns: 1fr;
            max-width: 720px;
            margin: 0 auto;
        }
        @media (min-width: 600px) {
            .target-list { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 900px) {
            .target-list { grid-template-columns: repeat(3, 1fr); }
        }

        .target-item {
            background: var(--card);
            border-radius: 12px;
            padding: 20px 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,.04);
            font-size: .95rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .target-item i {
            color: var(--blue);
            font-size: 1rem;
        }

        /* ── パンくず ── */
        .breadcrumb-sec {
            padding: 32px 0 48px;
        }

        /* ── スマホ対応 ── */
        @media (max-width: 767.98px) {
            .sec { padding: 48px 0; }
            .wrap { padding: 0 16px; }
            .lead-text { text-align: left; font-size: .95rem; }
            .sec-heading { margin-bottom: 32px; }
            .value-card { padding: 28px 20px 24px; }
            .value-card__num { font-size: 2rem; }
            .value-grid { gap: 20px; }
            .target-item { padding: 16px 18px; font-size: .88rem; }
            .breadcrumb-sec { padding: 24px 0 32px; }
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

    <x-page-hero title="Security × Engineering" sub="安全は、後付けではなく、設計から。" variant="shield" />

    {{-- リード文 --}}
    <section class="sec">
        <div class="wrap">
            <p class="lead-text">
                私たちは、「開発を理解するセキュリティ専門チーム」として、<br class="d-none d-md-inline">
                Webアプリ・モバイルアプリ・APIなどの脆弱性診断を提供しています。<br>
                開発現場の構造を理解したうえで"攻撃者の視点"からリスクを特定し、<br class="d-none d-md-inline">
                再現性のある改善提案を通じて、プロダクトを安全に前進させます。
            </p>
        </div>
    </section>

    {{-- 大切にしていること --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Our Approach</span>
                <h2 class="sec-heading__title">脆弱性診断で大切にしていること</h2>
            </div>

            <div class="value-grid value-grid--4">

                <article class="value-card">
                    <div class="value-card__num">01</div>
                    <div class="value-card__kicker">Integrity</div>
                    <h3 class="value-card__title">開発を知る診断チーム</h3>
                    <p class="value-card__desc">私たちは自社でシステム開発も行うエンジニア集団です。実装の意図や設計思想を踏まえたうえで診断を行うため、「なぜその脆弱性が生まれたのか」「どう修正すべきか」まで踏み込んだ支援が可能です。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">02</div>
                    <div class="value-card__kicker">Tactics</div>
                    <h3 class="value-card__title">攻撃者の視点からの実践的アプローチ</h3>
                    <p class="value-card__desc">ツール検査だけでなく、手動検証を中心とした実戦型診断を実施。入力値検証・認証認可・情報漏洩・セッション管理・設定不備など、実際の攻撃手法をシミュレーションし、ビジネスリスクを可視化します。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">03</div>
                    <div class="value-card__kicker">Integration</div>
                    <h3 class="value-card__title">開発と診断のワンストップ体制</h3>
                    <p class="value-card__desc">開発フェーズからセキュリティを設計に組み込み、受託開発・SESチームと連携して脆弱性を未然に防止。診断結果は再発防止策や運用ガイドラインにまで落とし込みます。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">04</div>
                    <div class="value-card__kicker">Precision</div>
                    <h3 class="value-card__title">再現性と改善を重視したレポート</h3>
                    <p class="value-card__desc">検出結果を「開発者が理解し、すぐ行動できる形」で提示。リスク説明と修正手順をセットで提供し、診断が"一過性の報告"で終わらないよう支援します。</p>
                </article>

            </div>
        </div>
    </section>

    {{-- 診断対象 --}}
    <section class="sec">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Scope</span>
                <h2 class="sec-heading__title">診断対象</h2>
            </div>

            <div class="target-list">
                <div class="target-item"><i class="bi bi-globe"></i> Webアプリ（Laravel, Rails, Node.js など）</div>
                <div class="target-item"><i class="bi bi-phone"></i> モバイルアプリ（iOS / Android / Flutter）</div>
                <div class="target-item"><i class="bi bi-diagram-3"></i> API / GraphQL / 外部連携</div>
                <div class="target-item"><i class="bi bi-gear"></i> 管理画面・社内システム</div>
                <div class="target-item"><i class="bi bi-cloud"></i> クラウド設定診断（GCP / AWS）</div>
            </div>
        </div>
    </section>

    {{-- 選ばれる理由 --}}
    <section class="sec sec--alt">
        <div class="wrap">
            <div class="sec-heading">
                <span class="sec-heading__kicker">Why Us</span>
                <h2 class="sec-heading__title">選ばれる理由</h2>
            </div>

            <div class="value-grid value-grid--4">

                <article class="value-card">
                    <div class="value-card__num">01</div>
                    <div class="value-card__kicker">Integrate</div>
                    <h3 class="value-card__title">開発と診断を一社完結</h3>
                    <p class="value-card__desc">「外部に委託せず、開発と診断を自社で行う」ため、情報漏洩リスクが低く、開発者との連携スピードも圧倒的。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">02</div>
                    <div class="value-card__kicker">Validation</div>
                    <h3 class="value-card__title">実践経験に基づく検証</h3>
                    <p class="value-card__desc">診断員は全員が現役エンジニア。脆弱性の発生要因をコード・構成レベルで分析し、修正コストを最小限に抑える提案を行います。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">03</div>
                    <div class="value-card__kicker">Partnership</div>
                    <h3 class="value-card__title">伴走型セキュリティ支援</h3>
                    <p class="value-card__desc">診断後も改修支援・再診断・運用設計までサポート。「脆弱性をなくすこと」ではなく「安全に成長し続けること」を目指します。</p>
                </article>

                <article class="value-card">
                    <div class="value-card__num">04</div>
                    <div class="value-card__kicker">Flexibility</div>
                    <h3 class="value-card__title">コストと柔軟性のバランス</h3>
                    <p class="value-card__desc">大手セキュリティベンダーのような高額コストや硬直的な体制ではなく、「必要な範囲を、最適なコストで」診断する柔軟なプランをご提案します。中間コストを省き、開発者が直接対応することで、品質とスピードを両立させた現実的なセキュリティ対策を実現します。</p>
                </article>

            </div>
        </div>
    </section>

    {{-- パンくず --}}
    <div class="breadcrumb-sec">
        <div class="wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">
                    <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('userServicesShow') }}">サービス</a></li>
                    <li class="breadcrumb-item">脆弱性診断</li>
                </ol>
            </nav>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/main.js') }}" defer></script>
</body>

</html>
