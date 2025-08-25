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

<body>
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
                <strong class="larger-text">Service</strong><br>
            </p>

        </div>

    </div>
    <main class="">
        <div class="vision" id="service">
            <div class="wrap">
                <h1 class="fadein-scroll fadein-from-up"><span>SES事業</span></h1>
                <h2 class="fadein-scroll fadein-from-down">
                    OBFallのSESでは、<br class="br-sp" />
                    <div class="strong-point">
                        <p class="catch">フリーランスと会社員のいいとこ取り</p>
                    </div>
                    をしている従業員で構成されているため、他社との差別化を実現しています。
                </h2>
                <ul class="fadein-scroll fadein-from-down">
                    <li>
                        <p class="catch">
                            <br class="br-sp" />パフォーマンス
                        </p>
                        <p class="sub">エンジニアのモチベーションを第一として客先業務に従事するため、主体的な姿勢を持った高いパフォーマンスをお約束します。</p>
                    </li>
                    <li>
                        <p class="catch">
                            <br class="br-sp" />報酬形態
                        <p class="sub">会社員でありながらフリーランスエンジニアに近い報酬形態をとっているため、人材の差別化が図れます。</p>
                    </li>
                    <li>
                        <p class="catch"><br class="br-sp" />採用、育成</p>
                        <p class="sub">スキル面のみならず質の高いエンジニアを採用、育成しているため、費用対効果の高い価値提供を実現いたします。</p>
                    </li>
                </ul>
            </div>
        </div>
        {{--自社開発--}}
        <div class="recruit mt-4" id="recruit">
            <div class="wrap">
                <h1 class="fadein-scroll fadein-from-up"><span>自社開発</span></h1>

                <div class="recruit-jobs fadein-scroll fadein-from-down">
                    {{-- ▼ 3列グリッド --}}
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse ($assign['inhouse_developments'] as $record)
                        <div class="col">
                            <a href="{{ $record->inhouse_developments_home_page_url }}"
                                class="card h-100 text-decoration-none text-reset"
                                target="_blank" rel="noopener">

                                <div class="card-body d-flex flex-column">
                                    <div class="text-center text-muted mb-1">{{ $record->category }}</div>
                                </div>

                                {{-- 画像：中央配置＋トリミングなし --}}
                                @if ($record->inhouse_developments_image_url)
                                <div class="d-flex align-items-center justify-content-center px-3 pb-3"
                                    style="height: 200px;"> {{-- 高さはお好みで --}}
                                    <img src="{{ asset($record->inhouse_developments_image_url) }}"
                                        alt="自社開発画像"
                                        class="img-fluid"
                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                </div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-2">{{ $record->title }}</h5>
                                    <p class="card-text mb-0 text-muted"
                                        style="display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;">
                                        {{ $record->content }}
                                    </p>
                                </div>
                            </a>

                        </div>
                        @empty
                        <div class="col">
                            <p class="mb-0">自社開発はまだありません。</p>
                        </div>
                        @endforelse
                    </div>
                    {{-- ▲ 3列グリッド --}}
                </div>
            </div>
        </div>


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


<style>
    /* スマホ表示用のスタイル */
    @media (max-width: 767px) {
        .fs-7 {
            font-size: 3px;
        }

    }
</style>