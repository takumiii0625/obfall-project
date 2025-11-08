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
        <div class="main-visual ">
            <div class="img-wrap">
                <img src="image/about_us2.jpg">
                <img src="image/achievements.jpg">
                <img src="image/recruit.jpg">
            </div>
        </div>
        <div class="text-container">
            <p class="fadein-scroll fadein-from-down smaller-text custom-line-height">
                <strong class="larger-text">「あなたの、あなたによる、あなたのための」<br>
                    を全てのひとへ</strong>
                <br>
                私たちは皆、人生の主人公です。<br>
                働くことも人生の一部。<br>
                OBFall株式会社は、<br>従来にない新しい会社の形を実現します。<br>
                <a href="{{ route('philosophy') }}" class="btn btn-dark shadow">
                    企業理念画面へ <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                </a>
            </p>

        </div>

    </div>

    <main>
        <div id="about" class="service pt-4">

            <ul>
                <section class="shinkansen-bg">
                    <div class="container ps-0"> <!-- 左パディングを0 -->
                        <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                            <div class="heading-chip">SERVICE</div>
                        </h1>
                    </div>
                </section>
                <section class="py-1 py-md-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 左：画像（トリミングなし） --}}
                            <div class="col-md-6 order-2 order-md-1">
                                <img
                                    src="{{ asset('image/service.jpg') }}"
                                    alt="サービスのイメージ"
                                    class="img-fluid rounded shadow-sm d-block"
                                    style="max-width:100%; height:auto;">
                            </div>

                            {{-- 右：見出し・英字・内容・ボタン --}}
                            <div class="col-md-6 order-1 order-md-2">
                                <div class="text-muted small mb-1 text-end text-md-start">サービス</div>
                                <h2 class="h4 mb-3 text-container maintitle text-end text-md-start">SERVICE</h2>


                                <p class="mb-4">
                                    ITの力で、人と社会の可能性を広げる。<br>
                                    自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、人々の人生をより豊かにします。

                                </p>

                                {{-- 遷移ボタン（お好みでどちらか） --}}
                                <a href="{{ route('userServicesShow') }}" class="btn btn-dark shadow">
                                    サービス詳細画面へ <i class="fa-solid fa-circle-arrow-right ms-1"></i>
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
                            <div class="heading-chip--flip">ACHIEVEMENTS</div>
                        </h1>
                    </div>
                </section>

                <section class="py-1 py-md-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 左：テキスト --}}
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">実績・事例紹介</div>
                                <h2 class="h4 maintitle text-container mb-3">ACHIEVEMENTS</h2>

                                <p class="mb-4">
                                    ITの可能性を、実績で証明する。<br>
                                    自社開発・受託開発・SES・脆弱性診断の4つの領域で、<br> “つくる・支える・守る”を軸に、課題解決に挑んでいます。
                                </p>
                                <a href="{{ route('achievements') }}" class="btn btn-dark shadow" target="_blank" rel="noopener noreferrer">
                                    実績・事例紹介 <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                </a>
                            </div>

                            {{-- 右：画像（トリミングなし） --}}
                            <div class="col-md-6">
                                <img src="{{ asset('image/achievements.jpg') }}"
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
                    <div class="container ps-0"> <!-- 左パディングを0 -->
                        <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                            <div class="heading-chip">ABOUT US</div>
                        </h1>
                    </div>
                </section>
                <section class="py-1 py-md-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 左：画像（トリミングなし） --}}
                            <div class="col-md-5 order-2 order-md-1">
                                <div class="about-card"> <!-- 外側ラッパ：重なり全体を管理 -->
                                    <div class="about-card__main"> <!-- 大画像：角丸でクリップ -->
                                        <img src="{{ asset('image/about_us2.jpg') }}" alt="">
                                    </div>

                                    <div class="about-card__sub"> <!-- 小画像：右下にはみ出して重ねる -->
                                        <img src="{{ asset('image/about_us1.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 order-2 order-md-1"></div>


                            {{-- 右：見出し・英字・内容・ボタン --}}
                            <div class="col-md-6 order-1 order-md-2">
                                <div class="text-muted small mb-1 text-end text-md-start">会社概要</div>
                                <h2 class="h4 mb-3 text-container text-end text-md-start maintitle">ABOUT US</h2>


                                <p class="mb-4">
                                    会社情報をご紹介いたします。<br>
                                    OBFall株式会社は、ITの力で社会課題の解決を図り、
                                    人と社会の可能性を広げる企業として成長を続けてまいります。<br>

                                </p>

                                {{-- 遷移ボタン（お好みでどちらか） --}}
                                <a href="{{ route('aboutus') }}" class="btn btn-dark shadow">
                                    会社概要画面へ <i class="fa-solid fa-circle-arrow-right ms-1"></i>
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
                <section class="py-1 py-md-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-12">
                                <div class="text-muted small mb-1">新着情報</div>
                                <h2 class="h4 mb-3 text-container maintitle">NEWS</h2>

                            </div>
                            <div class="col-12">
                                <div class="achievements-jobs fadein-scroll fadein-from-down">

                                    <div class="row g-3 align-items-start">
                                        <!-- 左：新着情報ボタン（SPは全幅、PCは左寄せ） -->
                                        <div class="col-12 col-md-3">
                                            <div class="d-grid d-md-block">
                                                <a href="{{ route('userNewsIndex') }}" class="btn btn-dark shadow">
                                                    新着情報 <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- 右：ニュース一覧（SPでは下に） -->
                                        <div class="col-12 col-md-9">
                                            <div class="bg-white">
                                                @php $visibleCount = 3; @endphp

                                                @forelse ($assign['news'] as $index => $record)
                                                @php
                                                $raw = collect([
                                                $record->news_image_url_1 ?? null,
                                                $record->news_image_url_2 ?? null,
                                                $record->news_image_url_3 ?? null,
                                                ])->first(fn($u) => filled($u));

                                                $imgSrc = $raw
                                                ? (\Illuminate\Support\Str::startsWith($raw, ['http://','https://','/']) ? $raw : asset($raw))
                                                : asset('image/noimg-square.jpg');
                                                @endphp

                                                <div class="border-bottom news-item {{ $index >= $visibleCount ? 'd-none' : '' }}">
                                                    <a href="{{ route('userNewsShow', ['id' => $record->id]) }}"
                                                        class="d-flex text-decoration-none text-dark mb-3 mt-3">

                                                        <!-- サムネ（正方形トリミング） -->
                                                        <div class="ratio ratio-1x1 flex-shrink-0 me-3" style="width:72px;">
                                                            <img src="{{ $imgSrc }}" alt="{{ $record->title }}"
                                                                class="w-100 h-100 rounded shadow-sm" style="object-fit:cover;" loading="lazy">
                                                        </div>

                                                        <!-- タイトル & 日付 -->

                                                        <div class="flex-grow-1">
                                                            <div class="fw-semibold text-truncate" title="{{ $record->title }}">
                                                                {{ $record->title }}
                                                            </div>
                                                            @if($record->created_at_fmt)
                                                            <time class="text-muted small">{{ $record->created_at_fmt }}</time>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                                @empty
                                                <p class="text-muted m-0 p-3">お知らせはありません。</p>
                                                @endforelse

                                                <!-- もっと見る
                                                <div class="d-flex flex-column justify-content-center w-100">
                                                    <button id="toggleNewsBtn"
                                                        class="text-muted text-end small btn btn-link btn-sm text-primary text-decoration-none p-0">
                                                        もっと見る >
                                                    </button>
                                                </div> -->
                                            </div>
                                        </div>
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
                    <div class="container pe-0"> <!-- 右端に寄せるなら右パディング0 -->
                        <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                            <div class="heading-chip">RECRUIT</div>
                        </h1>
                    </div>
                </section>

                <section class="py-1 py-md-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 右：画像（トリミングなし） --}}
                            <div class="col-md-6 order-2 order-md-1">
                                <img src="{{ asset('image/recruit.jpg') }}"
                                    alt="サービスのイメージ"
                                    class="img-fluid rounded shadow-sm d-block"
                                    style="max-width:100%;height:auto;">
                            </div>
                            {{-- 左：テキスト --}}
                            <div class="col-md-6 order-1 order-md-2">
                                <div class="text-muted small mb-1 text-end text-md-start">採用情報</div>
                                <h2 class="h4 mb-3 text-container text-end text-md-start maintitle">RECRUIT</h2>

                                <p class="mb-4">
                                    あなたの、あなたによる、あなたのための場所で。<br>
                                    私たちは、働くことを人生の一部として誇れる舞台をつくります。<br>
                                    OBFallでの挑戦が、あなたの成長と物語を彩りますように。
                                </p>
                                <a href="https://obfall-recruit.com/" class="btn btn-dark shadow" target="_blank">
                                    採用情報 <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </ul>
        </div>

    </main>
    <section class="ending" aria-label="closing">
        <div class="wrap">
            <p style="font-style:italic;font-size:12px;margin-bottom:.3rem">of you, by you, for all.</p>
            <p class="muted small" style="margin-top:0">あなたの、あなたによる、あなたのための。</p>
            <p class="muted small" style="margin-top:0">その想いから、すべての人の未来へ。</p>

            <!-- CTAを置くならここに： <a href="/contact" class="btn">Contact</a> -->
        </div>
    </section>
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
                <a href="{{ route('contact') }}" class="btn btn-dark" target="_blank" rel="noopener noreferrer">
                    お問い合わせ画面へ <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </footer>


    <script src="{{ asset('js/main.js') }}" defer></script>


</body>


</html>
<style>
    :root {
        --ink: #101317;
        --muted: #6a7689;
        --blue: #1E90FF;
        --line: #E7EEF5;
        --panel: #fff;
        --radius: 10px;
        --shadow: 0 2px 14px rgba(0, 0, 0, .06);
        --maxw: 940px
    }

    .shadow {

        border-radius: var(--radius);
        box-shadow: var(--shadow);

    }

    .human-rights-policy {
        color: #eef6ff
    }

    :root {
        --radius-xl: 10px;
        --shadow-1: 0 12px 32px rgba(0, 0, 0, .10);
        --shadow-2: 0 14px 40px rgba(0, 0, 0, .16);
    }

    /* 全体の器（小画像がはみ出す分の余白を確保） */
    .about-card {
        position: relative;
        padding-bottom: 30px;
        /* 小画像が下にはみ出すぶんの逃げ */
    }

    /* 大きい画像 */
    .about-card__main {
        position: relative;
        border-radius: var(--radius-xl);
        overflow: hidden;
        /* 角丸内でクリップ */
        box-shadow: var(--shadow-1);
        aspect-ratio: 4 / 3;
        /* 比率固定で安定 */
    }

    .about-card__main img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* 小さい画像（右下にオーバーラップ） */
    .about-card__sub {
        position: absolute;
        right: -50px;
        /* ちょい外へ */
        bottom: -16px;
        width: min(44%, 340px);
        /* 親幅に対する比率＋上限 */
        aspect-ratio: 3 / 2;
        border-radius: calc(var(--radius-xl) - 4px);
        box-shadow: var(--shadow-2);
        background: #fff;
        /* フチが綺麗に見えるよう白背景 */
    }

    .about-card__sub img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        border-radius: inherit;
    }

    /* モバイル微調整 */
    @media (max-width: 767.98px) {
        .about-card {
            padding-bottom: 80px;
        }

        .about-card__sub {
            right: -10px;
            bottom: -12px;
            width: min(62%, 260px);
        }
    }
</style>

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