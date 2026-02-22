<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>送信完了 | OBFall Inc.</title>
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
            --maxw: 1100px;
            --font-heading: "Times New Roman", "Noto Serif JP", Georgia, serif;
        }

        .human-rights-policy { color: #eef6ff }

        html, body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
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

        /* ── 完了カード ── */
        .complete-card {
            max-width: 640px;
            margin: 0 auto;
            background: var(--card);
            border-radius: var(--radius);
            padding: 60px 40px;
            box-shadow: var(--shadow);
            text-align: center;
        }
        @media (max-width: 767.98px) {
            .complete-card { padding: 40px 24px; }
        }

        .complete-card__icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--blue-light);
            color: var(--blue);
            font-size: 2rem;
            margin-bottom: 28px;
        }

        .complete-card__title {
            font-family: var(--font-heading);
            font-size: clamp(1.4rem, 3vw, 1.8rem);
            font-weight: 700;
            margin: 0 0 16px;
            line-height: 1.5;
        }

        .complete-card__text {
            font-size: clamp(1rem, 1.8vw, 1.1rem);
            line-height: 2;
            color: #444;
            margin: 0 0 36px;
        }

        .complete-card__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--blue);
            color: #fff;
            text-decoration: none;
            font-size: .95rem;
            font-weight: 600;
            padding: 12px 36px;
            border-radius: 99px;
            transition: background .25s ease, transform .2s ease;
        }
        .complete-card__btn:hover {
            background: #1e3a5f;
            color: #fff;
            transform: translateY(-2px);
        }

        /* ── パンくず ── */
        .breadcrumb-sec {
            padding: 32px 0 48px;
        }

        /* ── スマホ対応 ── */
        @media (max-width: 767.98px) {
            .sec { padding: 48px 0; }
            .wrap { padding: 0 16px; }
            .complete-card__icon { width: 56px; height: 56px; font-size: 1.5rem; margin-bottom: 20px; }
            .complete-card__text { margin-bottom: 28px; }
            .complete-card__btn { padding: 10px 28px; font-size: .9rem; }
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

    <x-page-hero title="Thank You" sub="お問い合わせありがとうございました。" variant="mail" />

    <section class="sec">
        <div class="wrap">
            <div class="complete-card">
                <div class="complete-card__icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h1 class="complete-card__title">送信が完了しました</h1>
                <p class="complete-card__text">
                    お問い合わせいただきありがとうございます。<br>
                    内容を確認のうえ、担当者よりご連絡いたします。
                </p>
                <a href="{{ route('indexDev') }}" class="complete-card__btn">
                    Topに戻る <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- パンくず --}}
    <div class="breadcrumb-sec">
        <div class="wrap">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">
                    <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('contact') }}">お問い合わせ</a></li>
                    <li class="breadcrumb-item">送信完了</li>
                </ol>
            </nav>
        </div>
    </div>

    <footer>
        <div class="devwrap d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center order-1 order-md-1">
                <img src="./image/logo_OBFall_white.png"
                    class="link logo" onclick="scrollToTop()" alt="OBFall株式会社ロゴ">
            </div>
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
            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center order-2 order-md-3">
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>

</html>
