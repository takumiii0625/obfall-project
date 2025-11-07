<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Bootstrap 5 CDN (例) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Philosophy | OBFall Inc.</title>
    <style>
        /* ====== Minimal Design Tokens ====== */
        :root {
            --bg: #ffffff;
            --ink: #1A1A1A;
            --ink-2: #3a3a3a;
            --muted: #6b7785;
            --blue: #1E90FF;
            --blue-weak: #F6FAFD;
            --card: #ffffff;
            --divider: #E7EEF5;
            --radius: 16px;
            --shadow: 0 2px 14px rgba(0, 0, 0, .06);
            --maxw: 1120px;
        }

        .human-rights-policy {
            color: #eef6ff
        }

        html,
        body {
            background: var(--bg);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, "Hiragino Kaku Gothic ProN", "Noto Sans JP", Segoe UI, Roboto, Ubuntu, "Helvetica Neue", "Helvetica", Arial, sans-serif;
            line-height: 1.8;
        }

        h1,
        h2,
        h3 {
            line-height: 1.35;
            margin: 0 0 .5em
        }

        h1 {
            font-size: clamp(28px, 4vw, 100px);
            font-weight: 800;
            color: black;
            font-family: 'Times New Roman', Times, serif;
        }

        h2 {
            font-size: clamp(18px, 2.6vw, 26px);
            font-weight: 700;
            color: var(--blue)
        }

        h3 {
            font-size: clamp(16px, 2.2vw, 22px);
            font-weight: 700
        }

        p {
            margin: .6em 0
        }

        .wrap {
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 20px
        }

        section {
            padding: 80px 0;
            border-top: 1px solid var(--divider)
        }

        .container {
            padding-top: 140px;
        }

        .form-group {
            padding: 10px;
        }

        .alert-danger {
            margin-top: 15px;
            padding: 5px;
        }

        @media (max-width: 767.98px) {
            .container {
                padding-top: 100px;
            }

            .form-group {
                padding: 10px;
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
                    <ul class="mb-0">
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


    <div class="container">
        <h1 class="text-center mt-2 mb-5">お問い合わせ確認</h1>
        <form method="post" action="{{ route('process') }}"> <!-- このrouteの部分はフォームを送信するための適切なルート名に置き換えてください -->
            {{ csrf_field() }}
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">お名前（10文字以内）<span class="badge badge-danger ml-1">必須</span></p>
                <div class="col-sm-8">
                    <p class="form-control-static">{{ $inputs['name'] }}</p>
                    <input type="hidden" name="name" value="{{ $inputs['name'] }}">

                </div>
            </div>

            <div class="form-group row">
                <p class="col-sm-4 col-form-label">メールアドレス<span class="badge badge-danger ml-1">必須</span></p>
                <div class="col-sm-8">
                    <p class="form-control-static">{{ $inputs['email'] }}</p>
                    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
                </div>
            </div>

            <div class="form-group row">
                <p class="col-sm-4 col-form-label">会社名<span class="badge badge-danger ml-1">必須</span></p>
                <div class="col-sm-8">
                    <p class="form-control-static">{{ $inputs['company'] }}</p>
                    <input type="hidden" name="company" value="{{ $inputs['company'] }}">
                </div>
            </div>

            <div class="form-group row">
                <p class="col-sm-4 col-form-label">電話番号</p>
                <div class="col-sm-8">
                    <p class="form-control-static">{{ $inputs['tel'] }}</p>
                    <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
                </div>
            </div>


            <div class="form-group row">
                <p class="col-sm-4 col-form-label">お問い合わせ内容<span class="badge badge-danger ml-1">必須</span></p>
                <div class="col-sm-8">
                    <p class="form-control-static">{{ $inputs['contents'] }}</p>
                    <input type="hidden" name="contents" value="{{ $inputs['contents'] }}">
                </div>
            </div>
            <input type="hidden" name="action" value="submit">

            <div class="s">
                <button type="submit" class="btn btn-primary">送信</button>
                <a href="{{ route('contact') }}" class="btn btn-default">戻る</a> <!-- このrouteの部分はお問い合わせフォームページへ戻るための適切なルート名に置き換えてください -->
            </div>
        </form>
    </div>
    <footer>
        <div class="devwrap d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <!-- PC:左 / SP:一番上（ロゴ＋ページトップへ） -->
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center order-1 order-md-1">
                <img src="./image/logo_OBFall_white.png"
                    class="link logo" onclick="scrollToTop()" alt="OBFall株式会社ロゴ">
            </div>

            <!-- PC:中央 / SP:一番下（住所など） -->
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

            <!-- PC:右 / SP:2番目（お問い合わせボタン） -->
            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center order-2 order-md-3">

            </div>
        </div>
    </footer>
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>

</html>