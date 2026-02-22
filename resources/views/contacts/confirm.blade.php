<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>お問い合わせ確認 | OBFall Inc.</title>
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
        .sec--alt { background: var(--bg-alt); }

        /* ── 確認カード ── */
        .confirm-card {
            max-width: 760px;
            margin: 0 auto;
            background: var(--card);
            border-radius: var(--radius);
            padding: 48px 40px;
            box-shadow: var(--shadow);
        }
        @media (max-width: 767.98px) {
            .confirm-card { padding: 28px 20px; }
        }

        .confirm-item {
            padding: 16px 0;
            border-bottom: 1px solid var(--line);
        }
        .confirm-item:last-of-type {
            border-bottom: none;
        }

        .confirm-item__label {
            font-weight: 600;
            font-size: .9rem;
            color: var(--muted);
            margin-bottom: 4px;
        }
        .confirm-item__label .badge {
            background: #e53e3e;
            color: #fff;
            font-size: .65rem;
            padding: 2px 6px;
            border-radius: 4px;
            margin-left: 6px;
            vertical-align: middle;
        }

        .confirm-item__value {
            font-size: 1rem;
            margin: 0;
        }

        /* ── ボタン ── */
        .confirm-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin-top: 36px;
            flex-wrap: wrap;
        }

        .confirm-actions .btn-primary {
            background: var(--blue);
            border: none;
            border-radius: 99px;
            padding: 12px 36px;
            font-size: .95rem;
            font-weight: 600;
            transition: background .25s ease, transform .2s ease;
        }
        .confirm-actions .btn-primary:hover {
            background: #1e3a5f;
            transform: translateY(-2px);
        }

        .confirm-actions .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            text-decoration: none;
            font-size: .95rem;
            font-weight: 600;
            padding: 12px 28px;
            border: 2px solid var(--line);
            border-radius: 99px;
            transition: border-color .25s ease, color .25s ease;
        }
        .confirm-actions .btn-back:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        /* ── パンくず ── */
        .breadcrumb-sec {
            padding: 32px 0 48px;
        }

        /* ── スマホ対応 ── */
        @media (max-width: 767.98px) {
            .sec { padding: 48px 0; }
            .wrap { padding: 0 16px; }
            .confirm-actions { gap: 12px; }
            .confirm-actions .btn-primary { padding: 10px 28px; font-size: .9rem; }
            .confirm-actions .btn-back { padding: 10px 20px; font-size: .9rem; }
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

    <x-page-hero title="Confirm" sub="入力内容をご確認ください。" variant="mail" />

    <section class="sec">
        <div class="wrap">
            <div class="confirm-card">
                <form method="post" action="{{ route('process') }}">
                    {{ csrf_field() }}

                    <div class="confirm-item">
                        <div class="confirm-item__label">お名前（10文字以内）<span class="badge">必須</span></div>
                        <p class="confirm-item__value">{{ $inputs['name'] }}</p>
                        <input type="hidden" name="name" value="{{ $inputs['name'] }}">
                    </div>

                    <div class="confirm-item">
                        <div class="confirm-item__label">メールアドレス<span class="badge">必須</span></div>
                        <p class="confirm-item__value">{{ $inputs['email'] }}</p>
                        <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                    </div>

                    <div class="confirm-item">
                        <div class="confirm-item__label">会社名<span class="badge">必須</span></div>
                        <p class="confirm-item__value">{{ $inputs['company'] }}</p>
                        <input type="hidden" name="company" value="{{ $inputs['company'] }}">
                    </div>

                    <div class="confirm-item">
                        <div class="confirm-item__label">電話番号</div>
                        <p class="confirm-item__value">{{ $inputs['tel'] }}</p>
                        <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
                    </div>

                    <div class="confirm-item">
                        <div class="confirm-item__label">お問い合わせ内容<span class="badge">必須</span></div>
                        <p class="confirm-item__value">{{ $inputs['contents'] }}</p>
                        <input type="hidden" name="contents" value="{{ $inputs['contents'] }}">
                    </div>

                    <input type="hidden" name="action" value="submit">

                    <div class="confirm-actions">
                        <a href="{{ route('contact') }}" class="btn-back">戻る</a>
                        <button type="submit" class="btn btn-primary">送信</button>
                    </div>
                </form>
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
                    <li class="breadcrumb-item">確認</li>
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
