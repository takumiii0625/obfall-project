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
                OBFall株式会社は、<br>従来にない新しい会社の形を実現します。<br>
                <a href="{{ route('philosophy') }}" class="btn btn-dark">
                    企業理念画面へ
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
                                    src="{{ asset('image/obfall_3s.gif') }}"
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
                                    自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、テクノロジーで人生をより豊かにします。

                                </p>

                                {{-- 遷移ボタン（お好みでどちらか） --}}
                                <a href="{{ route('userServicesShow') }}" class="btn btn-dark">
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
                                    自社開発・受託開発・SES・脆弱性診断の4つの領域で、
                                    “つくる・支える・守る”を軸に、テクノロジーで課題解決に挑んでいます。
                                </p>
                                <a href="{{ route('achievements') }}" class="btn btn-dark" target="_blank" rel="noopener noreferrer">
                                    実績・事例紹介 <i class="fa-solid fa-circle-arrow-right ms-1"></i>
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
                            <div class="col-md-6 order-2 order-md-1">
                                <img
                                    src="{{ asset('image/achievements.png') }}"
                                    alt="サービスのイメージ"
                                    class="img-fluid rounded shadow-sm d-block"
                                    style="max-width:100%; height:auto;">
                            </div>

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
                                <a href="{{ route('aboutus') }}" class="btn btn-dark">
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
                                <div class="text-muted small mb-1">最新情報</div>
                                <h2 class="h4 mb-3 text-container maintitle">NEWS</h2>

                            </div>
                            <div class="col-12">
                                <div class="achievements-jobs fadein-scroll fadein-from-down">


                                    <div class="bg-white">
                                        @php $visibleCount = 3; @endphp

                                        @forelse ($assign['news'] as $index => $record)

                                        @php
                                        // 1) 画像の優先順位（1→2→3）
                                        $raw = collect([
                                        $record->news_image_url_1 ?? null,
                                        $record->news_image_url_2 ?? null,
                                        $record->news_image_url_3 ?? null,
                                        ])->first(fn($u) => filled($u));

                                        // 2) 出力URLを正規化
                                        $imgSrc = $raw
                                        ? (\Illuminate\Support\Str::startsWith($raw, ['http://','https://','/'])
                                        ? $raw
                                        : asset($raw)) // 'storage/...' や 'image/...' など相対パス想定
                                        : asset('image/noimg-square.jpg'); // 代替画像（任意）
                                        @endphp

                                        <div class="border-bottom news-item {{ $index >= $visibleCount ? 'd-none' : '' }}">
                                            <a href="{{ route('userNewsShow', ['id' => $record->id]) }}"
                                                class="d-flex text-decoration-none text-dark mb-3 mt-3">

                                                {{-- サムネ（正方形でトリミング） --}}
                                                <div class="ratio ratio-1x1 flex-shrink-0 me-3" style="width:72px;">
                                                    <img src="{{ $imgSrc }}" alt="{{ $record->title }}"
                                                        class="w-100 h-100 rounded shadow-sm" style="object-fit:cover;" loading="lazy">
                                                </div>

                                                {{-- タイトル & 日付 --}}
                                                <div class="d-flex w-100 align-items-center mobile-small">
                                                    <div class="flex-grow-1 pe-3 title-cell" title="{{ $record->title }}">
                                                        {{ $record->title }}
                                                    </div>

                                                    <time class="text-muted small flex-shrink-0">
                                                        {{ $record->created_at_fmt }}
                                                    </time>
                                                </div>
                                            </a>
                                        </div>

                                        @empty
                                        <p class="text-muted">お知らせはありません。</p>
                                        @endforelse
                                        <div class="d-flex flex-column justify-content-center w-100">
                                            <button id="toggleNewsBtn" class="text-muted text-end small btn btn-link btn-sm text-primary text-decoration-none p-0">
                                                もっと見る >
                                            </button>
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
                                <img src="{{ asset('image/aboutus.png') }}"
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
                                <a href="https://obfall-recruit.com/" class="btn btn-dark" target="_blank">
                                    採用情報 <i class="fa-solid fa-circle-arrow-right ms-1"></i>
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
                            <div class="heading-chip--flip">CONTACT</div>
                        </h1>
                    </div>
                </section>

                <section class="py-1 py-md-5">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            {{-- 左：テキスト --}}
                            <div class="col-md-6">
                                <div class="text-muted small mb-1">お問い合わせ</div>
                                <h2 class="h4 mb-3 text-container maintitle">contact</h2>

                                <p class="mb-4">
                                    〒105-0022<br>
                                    東京都港区海岸1-2-3<br>
                                    汐留芝離宮ビルディング21F<br>
                                    📞03-5403-5904<br>
                                </p>

                            </div>

                            {{-- 右：画像（トリミングなし） --}}
                            <div class="col-md-6">
                                <a href="{{ route('contact') }}" class="btn btn-dark" target="_blank" rel="noopener noreferrer">
                                    お問い合わせ画面へ <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </ul>




        </div>

        <a href="#" class="back-to-top" style="display: none;">▲</a>

    </main>
    <section class="ending" aria-label="closing">
        <div class="wrap">
            <p style="font-style:italic;font-size:12px;margin-bottom:.3rem">for all, with all, as one.</p>
            <p class="muted small" style="margin-top:0">すべての人へ、すべての人とともに、ひとつの未来へ。</p>
            <!-- CTAを置くならここに： <a href="/contact" class="btn">Contact</a> -->
        </div>
    </section>
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
<style>
    .human-rights-policy {
        color: #eef6ff
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