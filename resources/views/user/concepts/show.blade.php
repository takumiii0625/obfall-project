<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="https://obfall.com/image/logo_OBFall2.png">
    <title>OBFall株式会社</title>
    <link rel="icon" href="../image/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Bootstrap 5 CDN (例) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="top">
        <header class="fadein-first fadein-from-up">
            <div class="wrap">
                <a href="{{ route('indexDev') }}" class="text-dark text-decoration-none">
                    <div class="logo-container">
                        <img src="../image/logo_OBFall.png" class="link" onclick="scrollToTop()" />
                        <div class="title" onclick="scrollToTop()">OBFall株式会社</div>
                    </div>
                </a>
                <nav class="nav-01">
                    <ul>
                        <li class="link text-dark "><a href="{{ route('concept') }}" class="text-dark text-decoration-none">CONCEPT</a></li>
                        <li class="link text-dark "><a href="{{ route('userServicesShow') }}" class="text-dark text-decoration-none">SERVICE</a></li>
                        <li class="link text-dark "><a href="{{ route('aboutus') }}" class="text-dark text-decoration-none">ABOUT US</a></li>
                        <li class="link text-dark "><a href="https://obfall-recruit.com/" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">RECRUIT</a></li>
                        <li class="link text-dark "><a href="https://obfall.com/contact" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTUCT</a></li>


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
                <li class="link text-dark "><a href="{{ route('concept') }}" class="text-dark text-decoration-none">CONCEPT</a></li>
                <li class="link text-dark "><a href="{{ route('userServicesShow') }}" class="text-dark text-decoration-none">SERVICE</a></li>
                <li class="link text-dark "><a href="{{ route('aboutus') }}" class="text-dark text-decoration-none">ABOUT US</a></li>
                <li class="link text-dark "><a href="https://obfall-recruit.com/" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">RECRUIT</a></li>
                <li class="link text-dark "><a href="https://obfall.com/contact" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTUCT</a></li>

            </ul>
        </nav>
        <div class="main-visual">
            <div class="img-wrap-sub">
                <img src="../image/chou.jpg">
            </div>
        </div>
        <div class="text-container">
            <p class="fadein-scroll fadein-from-down smaller-text custom-line-height">
                <strong class="larger-text">CONCEPT</strong><br>
            </p>

        </div>

    </div>
    <main class="flex-grow-1">

        <div class="vision mb-6" id="service">
            <div class="wrap">
                <h1 class="fadein-scroll fadein-from-up"><span>企業理念</span></h1>
                <h2 class="fadein-scroll fadein-from-down">
                    <br class="br-sp" />
                    <div class="strong-point">
                        <p class="catch">3つの柱</p>
                    </div>

                </h2>
                <ul class="fadein-scroll fadein-from-down">
                    <li>
                        <p class="catch">
                            <br class="br-sp" />理念採用
                        </p>
                        <p class="subtitle">理念に共感するメンバー</p>
                        <p class="sub">
                            ・当事者であるという「あなたの」<br>
                            ・主体的で自立した「あなたによる」<br>
                            ・夢や目標を掲げる「あなたのための」
                        </p>
                    </li>
                    <li>
                        <p class="catch">
                            <br class="br-sp" />ES＝CS
                        </p>
                        <p class="subtitle">従業員満足度＝顧客満足度</p>
                        <p class="sub">
                            ・定量的かつ明確な報酬体系<br>
                            ・OPENな関係の構築<br>
                            ・お客様への価値提供を最大化
                        </p>
                    </li>
                    <li>
                        <p class="catch"><br class="br-sp" />ハイパフォーマンス</p>
                        <p class="subtitle">役割の自由化</p>
                        <p class="sub">
                            ・営業、採用、マネジメントを社内公募<br>
                            ・インセンティブ制の導入<br>
                            ・高いモチベーションを持った人材多数
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="recruit mt-4" id="recruit">
        </div>
    </main>

    <footer class="mt-auto">
        <div class="devwrap">
            <div class="footer-left">
                <p>
                    〒105-0022<br>
                    東京都港区海岸1-2-3&nbsp;&nbsp;汐留芝離宮ビルディング 21F<br>
                    03-5403-5904
                </p>
                <small>&copy; OBFall株式会社</small>
            </div>
        </div>
    </footer>
    <script src="{{ asset('js/main.js') }}" defer></script>


</body>


<style>
    /* スマホ表示用のスタイル */
    @media (max-width: 767px) {
        .fs-7 {
            font-size: 3px;
        }

    }
</style>