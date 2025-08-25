<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="https://obfall.com/image/logo_OBFall2.png">
    <title>OBFall株式会社</title>
    <link rel="icon" href="./image/favicon.png" type="image/png">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    <!-- Bootstrap 5 CDN (例) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="top">
        <header class="fadein-first fadein-from-up">
            <div class="wrap">
                <a href="{{ route('indexDev') }}" class="text-dark text-decoration-none ">
                    <div class="logo-container">
                        <img src="./image/logo_OBFall.png" class="link" onclick="scrollToTop()" />
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
        <div class="main-visual ">
            <div class="img-wrap">
                <img src="image/chou.jpg">
                <img src="image/siodomebiru.jpg">
                <img src="image/office4.jpg">
                <img src="image/office1.jpg">
                <img src="image/office2.jpg">
            </div>
        </div>
        <div class="text-container">
            <p class="fadein-scroll fadein-from-down smaller-text custom-line-height">
                <strong class="larger-text">「あなたの、あなたによる、あなたのための」<br>
                    を全てのひとへ</strong><br>
                私たちは皆、人生の主人公です。<br>
                働くことも人生の一部。<br>
                OBFall株式会社は、<br>従来にない新しい会社の形を実現します。
            </p>

        </div>

    </div>

    <main>
        <div id="about" class="service">

            <ul>
                <section class="shinkansen-bg">
                    <div class="container ps-0"> <!-- 左パディングを0 -->
                        <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                            <div class="heading-chip">CONCEPT</div>
                        </h1>
                    </div>
                </section>
                <section class="py-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 左：画像（トリミングなし） --}}
                            <div class="col-md-6">
                                <img
                                    src="{{ asset('image/concept.png') }}"
                                    alt="サービスのイメージ"
                                    class="img-fluid rounded shadow-sm d-block"
                                    style="max-width:100%; height:auto;">
                            </div>

                            {{-- 右：見出し・英字・内容・ボタン --}}
                            <div class="col-md-6">
                                <h2 class="h4 mb-1">企業理念</h2>
                                <div class="text-muted small mb-3">CONCEPT</div>

                                <p class="mb-4">
                                    ここに企業理念の概要テキストを入れます。強みや提供価値、主な機能などを2〜4行で簡潔に。
                                </p>

                                {{-- 遷移ボタン（お好みでどちらか） --}}
                                <a href="{{ route('concept') }}" class="btn btn-dark">
                                    企業理念画面へ <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </ul>

            <ul>
                <section class="shinkansen-bg">
                    <div class="container pe-0"> <!-- 右端に寄せるなら右パディング0 -->
                        <h1 class="fadein-scroll fadein-from-right m-0 text-end">
                            <div class="heading-chip--flip">SERVICE</div>
                        </h1>
                    </div>
                </section>

                <section class="py-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 左：テキスト --}}
                            <div class="col-md-6">
                                <h2 class="h4 mb-1">サービス詳細</h2>
                                <div class="text-muted small mb-3">SERVICE</div>
                                <p class="mb-4">
                                    ここにサービス詳細の概要テキストを入れます。強みや提供価値、主な機能などを2〜4行で簡潔に。
                                </p>
                                <a href="{{ route('userServicesShow') }}" class="btn btn-dark">
                                    サービス詳細画面へ <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>

                            {{-- 右：画像（トリミングなし） --}}
                            <div class="col-md-6">
                                <img src="{{ asset('image/service.png') }}"
                                    alt="サービスのイメージ"
                                    class="img-fluid rounded shadow-sm d-block"
                                    style="max-width:100%;height:auto;">
                            </div>
                        </div>
                    </div>
                </section>
            </ul>



            <ul>
                <section class="shinkansen-bg">
                    <div class="container pe-0"> <!-- 右端に寄せるなら右パディング0 -->
                        <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                            <div class="heading-chip">ABOUT US</div>
                        </h1>
                    </div>
                </section>

                <section class="py-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 右：画像（トリミングなし） --}}
                            <div class="col-md-6">
                                <img src="{{ asset('image/aboutus.png') }}"
                                    alt="サービスのイメージ"
                                    class="img-fluid rounded shadow-sm d-block"
                                    style="max-width:100%;height:auto;">
                            </div>
                            {{-- 左：テキスト --}}
                            <div class="col-md-6">
                                <h2 class="h4 mb-1">会社概要</h2>
                                <div class="text-muted small mb-3">ABOUT US</div>
                                <p class="mb-4">
                                    ここに会社概要の概要テキストを入れます。強みや提供価値、主な機能などを2〜4行で簡潔に。
                                </p>
                                <a href="{{ route('aboutus') }}" class="btn btn-dark">
                                    会社概要画面へ <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>


                        </div>
                    </div>
                </section>

            </ul>

            <ul>
                <section class="shinkansen-bg">
                    <div class="container ps-0"> <!-- 左パディングを0 -->
                        <h1 class="fadein-scroll fadein-from-right m-0 text-end">
                            <div class="heading-chip--flip">NEWS</div>
                        </h1>
                    </div>
                </section>
                <section class="py-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <h2 class="h4 mb-1">最新情報</h2>
                                <div class="text-muted small mb-3">NEWS</div>

                                <p class="mb-4">
                                    ここに最新情報の概要テキストを入れます。強みや提供価値、主な機能などを2〜4行で簡潔に。
                                </p>

                            </div>
                            <div class="col-md-6">
                                <div class="recruit-jobs fadein-scroll fadein-from-down">
                                    <div class="d-flex flex-column justify-content-center w-100">
                                        <button id="toggleNewsBtn" class="text-muted text-end small btn btn-link btn-sm text-primary text-decoration-none p-0">
                                            もっと見る >
                                        </button>
                                    </div>

                                    <div class="bg-white">
                                        @php $visibleCount = 3; @endphp
                                        @forelse ($assign['news'] as $index => $record)
                                        <div class="border-bottom news-item {{ $index >= $visibleCount ? 'd-none' : '' }}">
                                            <a href="{{ route('userNewsShow', ['id' => $record->id]) }}"
                                                class="d-flex text-decoration-none text-dark mb-3 mt-3">

                                                <div class="d-flex w-100 align-items-center">
                                                    <div class="flex-grow-1 text-truncate pe-3">
                                                        {{ $record->title }}
                                                    </div>
                                                    <time class="text-muted small flex-shrink-0">
                                                        {{ $record->created_at_fmt }}
                                                    </time>
                                                </div>

                                            </a>
                                        </div>

                                        @empty
                                        <p class="m-0 py-2">お知らせはまだありません。</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>


                            {{-- 右：見出し・英字・内容・ボタン --}}

                        </div>
                    </div>
                </section>
            </ul>

            <ul>
                <section class="shinkansen-bg">
                    <div class="container ps-0"> <!-- 左パディングを0 -->
                        <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                            <div class="heading-chip">RECRUIT</div>
                        </h1>
                    </div>
                </section>
                <section class="py-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 左：画像（トリミングなし） --}}
                            <div class="col-md-6">
                                <img
                                    src="{{ asset('image/recruit.png') }}"
                                    alt="サービスのイメージ"
                                    class="img-fluid rounded shadow-sm d-block"
                                    style="max-width:100%; height:auto;">
                            </div>

                            {{-- 右：見出し・英字・内容・ボタン --}}
                            <div class="col-md-6">
                                <h2 class="h4 mb-1">採用情報</h2>
                                <div class="text-muted small mb-3">RECRUIT</div>

                                <p class="mb-4">
                                    ここに採用情報の概要テキストを入れます。強みや提供価値、主な機能などを2〜4行で簡潔に。
                                </p>

                                {{-- 遷移ボタン（お好みでどちらか） --}}
                                <a href="https://obfall-recruit.com/" class="btn btn-dark" target="_blank" rel="noopener noreferrer">
                                    採用情報画面へ <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </ul>

            <ul>
                <section class="shinkansen-bg">
                    <div class="container pe-0"> <!-- 右端に寄せるなら右パディング0 -->
                        <h1 class="fadein-scroll fadein-from-right m-0 text-end">
                            <div class="heading-chip--flip">CONTUCT</div>
                        </h1>
                    </div>
                </section>

                <section class="py-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 左：テキスト --}}
                            <div class="col-md-6">
                                <h2 class="h4 mb-1">お問い合わせ</h2>
                                <div class="text-muted small mb-3">CONTUCT</div>
                                <p class="mb-4">
                                    ここにお問い合わせの概要テキストを入れます。強みや提供価値、主な機能などを2〜4行で簡潔に。
                                </p>
                                <a href="https://obfall.com/contact" class="btn btn-dark" target="_blank" rel="noopener noreferrer">
                                    お問い合わせ画面へ <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>

                            {{-- 右：画像（トリミングなし） --}}
                            <div class="col-md-6">
                                <img src="{{ asset('image/contuct.png') }}"
                                    alt="サービスのイメージ"
                                    class="img-fluid rounded shadow-sm d-block"
                                    style="max-width:100%;height:auto;">
                            </div>
                        </div>
                    </div>
                </section>
            </ul>
        </div>

        <a href="#" class="back-to-top" style="display: none;">▲</a>

    </main>
    <footer>
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


</html>


<script>
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }

    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });

        $('.back-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
    });
</script>