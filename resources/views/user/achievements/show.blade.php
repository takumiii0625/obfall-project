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
            margin-top: 40px;
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
            margin: 24px 0;
            text-align: center;
        }

        .image-container img {
            width: 100%;
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
                font-size: 1.090rem;
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

        /* ベース: 縦並び（スマホ） */
        .achievement-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
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
                <h1>ITの力で、人と社会の可能性を広げる。</h1>
                <div class="sub">Achievements</div>
            </div>
            <p class="lead">自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、テクノロジーで人生をより豊かにします。</p>
        </div>
    </section>
    <main class="wrap">

        <!-- 🌍 アチーブメント（Achievements） -->
        <section id="achievements" class="section-achievements">
            <h3 class="achievement-lead">OBFallの挑戦と成果。</h3>
            <hr>
            <p>
                私たちは、「テクノロジーで人生をより豊かにする」という理念のもと、<br>
                自社開発・受託開発・脆弱性診断・SESの4つの領域で、<br>
                社会や現場の課題を“仕組み”として解決してきました。<br><br>
                ここで紹介するのは、私たちの手で形にしてきたプロジェクトたち。<br>
                どれも、「人」や「社会」に新しい選択肢を生み出すための挑戦です。
            </p>
        </section>

        <!-- 💡 自社開発 -->
        <section id="products" class="section-products">
            <h2><i class="bi bi-lightbulb-fill"></i>自社開発（Products）</h2>
            <h3>人と社会の可能性を広げる、自社プロダクト。<br>OBFallの想いを、サービスというかたちで届ける。</h3>
            <hr>
            <p>
                OBFallの自社開発は、<strong>社会の“まだ満たされていないニーズ”</strong>に焦点をあて、<br>
                「テクノロジーで人生をより豊かにする」という理念を実践する取り組みです。<br>
                便利さよりも、“人がより自分らしく生きられる仕組み”を目指し、<br>
                発想から企画、開発、運用まですべて自社で行っています。
            </p>
            <hr>

            <!-- digOn -->
            <article class="achievement-item">
                <div class="achievement-content">
                    <div class="text">
                        <img src="../image/digOn_logo.png" alt="digOnアプリロゴ" class="app-logo" />

                        <h4>digOn（ディグオン）</h4>
                        <p class="lead">
                            音楽と人の感性をつなぐ、新しい発見体験。<br>
                            音楽との出会いをもっと自由に、もっと感覚的に。<br>
                            Flutter × Firebase × Webで構築された、クロスプラットフォーム対応の音楽アプリ。<br>
                            再生履歴・レコメンド・お気に入り管理など、ユーザー体験を重視したUIを設計。
                        </p>
                        <!-- image: digOnアプリのメイン画面 -->
                        <div class="image-container">
                            <img src="images/digon_main.jpg" alt="digOnアプリ画面" />
                        </div>
                        <p><a href="https://dig-on-web.com" target="_blank" class="link-button">🔗 digOn公式サイトを見る</a></p>
                    </div>
                </div>
            </article>

            <hr>

            <!-- Store-Pass -->
            <article class="achievement-item">
                <div class="achievement-content">
                    <div class="text">
                        <img src="../image/store-pass_logo.png" alt="Store-Passアプリロゴ" class="app-logo" />
                        <h4>ストパス（Store-Pass）</h4>
                        <p>
                            店舗とユーザーをつなぐ共通特典アプリ。<br>
                            月額無料で、ユーザーは加盟店舗全体で特典を利用可能。<br>
                            「店舗をまたぐ特典利用」「垣根を超えた顧客体験」を実現するアプリとして開発。
                        </p>
                        <p class="lead">
                            店舗とユーザーを緩やかにつなぎ、来店体験を拡張する共通プラットフォーム。<br>
                            加盟店の情報表示や特典管理を統合し、地域の活性化を支える仕組みを提供しています。
                        </p>
                        <p><a href="https://store-pass.com" target="_blank" class="link-button">🔗 Store-Pass公式サイトを見る</a></p>
                    </div>

                    <div class="image-container">
                        <img src="../image/iphone立体画像.jpg" alt="Store-Passアプリ画面" />
                    </div>
                </div>
            </article>


            <hr>

            <!-- 農家システム -->
            <article class="achievement-item">
                <div class="achievement-content">
                    <div class="text">
                        <h4>🌾 農家向け業務効率化システム（開発中・共同開発）</h4>
                        <p>
                            地域と農業現場に寄り添う、未来をともに作るシステム。<br>
                            地方農家の方々と共同で設計・開発を進める、業務効率化プラットフォーム。<br>
                            現場の課題を直接ヒアリングしながら、“使える”を最優先にした仕組みを構築しています。
                        </p>
                        <!-- image: 農業現場やUIのイメージ -->
                        <div class="image-container">
                            <img src="images/farm_system.jpg" alt="農家向け業務効率化システムイメージ" />
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <!-- 💼 受託開発 -->
        <section id="contract-development" class="section-contract">
            <h2><i class="bi bi-briefcase-fill"></i> 受託開発（Contract Development）</h2>
            <h3>ともにつくり、ともに前へ。<br>クライアントの想いを汲み取り、共に課題を解決するパートナーとして。</h3>
            <hr>
            <p>
                OBFallの受託開発は、「作る」ことを目的とせず、「価値を生み出す」ことを目的とする開発です。<br>
                Webサービス、アプリケーション、業務システムなど多様な開発に対応しながら、<br>
                企画から設計・デザイン・実装・セキュリティ診断まで一貫した体制で提供しています。<br>
                クライアントと同じ目線で課題を見つめ、長く続く価値を共に育てていきます。
            </p>
            <hr>

            <!-- 医療系システム -->
            <article class="achievement-item">
                <h4><i class="bi bi-compass-fill"></i> 開発事例：医療系予約管理システム</h4>
                <p>
                    医療現場の効率化と患者体験の両立を実現。<br>
                    複数クリニックの予約・問診・診療履歴を一元管理できるWebシステムを構築。
                </p>
                <ul>
                    <li><strong>開発技術：</strong>Laravel / Vue.js / MySQL / AWS</li>
                    <li><strong>成果：</strong>
                        <ul>
                            <li>予約対応時間の短縮（前年比35%減）</li>
                            <li>問い合わせ件数の削減、患者満足度の向上</li>
                            <li>UI改善フィードバックの循環化</li>
                        </ul>
                    </li>
                </ul>
                <div class="image-container">
                    <img src="images/medical_system.jpg" alt="医療系予約管理システム画面" />
                </div>
            </article>

            <hr>

            <!-- 不動産マッチング -->
            <article class="achievement-item">
                <h4><i class="bi bi-buildings"></i> 開発事例：不動産マッチングプラットフォーム</h4>
                <p>
                    顧客と物件を最適に結ぶ仕組みを構築。<br>
                    不動産企業の業務フローに合わせたBtoCマッチングシステムを開発。
                </p>
                <ul>
                    <li><strong>開発技術：</strong>Laravel / Nuxt.js / PostgreSQL</li>
                    <li><strong>成果：</strong>
                        <ul>
                            <li>成約率アップ（20%以上改善）</li>
                            <li>顧客データの一元管理による営業効率化</li>
                        </ul>
                    </li>
                </ul>
                <div class="image-container">
                    <img src="images/real_estate_platform.jpg" alt="不動産マッチングプラットフォーム画面" />
                </div>
            </article>
        </section>

        <!-- 🔒 脆弱性診断 -->
        <section id="security" class="section-security">
            <h2><i class="bi bi-shield-lock-fill"></i> 脆弱性診断（Security Assessment）</h2>
            <h3>安全は、後付けではなく、設計から。<br>開発と診断をワンストップで行い、信頼できるプロダクトづくりを支えます。</h3>
            <hr>
            <p>
                OBFallでは、開発現場を理解したエンジニアが脆弱性診断を実施しています。<br>
                システムの構造や業務要件を踏まえたうえで、<br>
                「攻撃者の視点」と「開発者の視点」の両面から現実的なリスクを検証。
            </p>
            <ul>
                <li><strong>医療系予約システム（Laravel / AWS）</strong><br>認証・セッション管理の不備を検出し、改善まで支援。</li>
                <li><strong>不動産マッチングプラットフォーム（Laravel / Nuxt.js）</strong><br>API認証の脆弱性を是正し、再発防止策を実装。</li>
            </ul>
            <div class="image-container">
                <img src="images/security_review.jpg" alt="脆弱性診断の様子" />
            </div>
            <p class="summary">
                診断は“終わり”ではなく“成長のはじまり”。<br>
                開発を理解するセキュリティチームが、安心して使い続けられるプロダクトの実現を支えています。
            </p>
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