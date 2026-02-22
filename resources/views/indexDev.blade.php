<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="https://obfall.com/image/logo_OBFall2.png">
    <title>OBFall株式会社</title>
    <link rel="icon" href="./image/favicon.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+JP:wght@400;500;600;700&family=Noto+Serif+JP:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        <div class="hero-section">
            {{-- 動く図形の背景 --}}
            <div class="hero-shapes" aria-hidden="true">
                <svg class="hero-svg" viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <radialGradient id="hg-radial" cx="50%" cy="45%" r="55%">
                            <stop offset="0%" stop-color="#0b6674" stop-opacity="0.25" />
                            <stop offset="100%" stop-color="#03272e" stop-opacity="0" />
                        </radialGradient>
                        <radialGradient id="hg-pulse" cx="50%" cy="50%" r="50%">
                            <stop offset="0%" stop-color="#0dcaf0" stop-opacity="0.3" />
                            <stop offset="100%" stop-color="#0dcaf0" stop-opacity="0" />
                        </radialGradient>
                        <filter id="glow">
                            <feGaussianBlur stdDeviation="2" result="blur" />
                            <feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge>
                        </filter>
                        <filter id="glow-strong">
                            <feGaussianBlur stdDeviation="4" result="blur" />
                            <feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge>
                        </filter>
                    </defs>

                    {{-- 中央の放射グロー --}}
                    <circle cx="600" cy="360" r="350" fill="url(#hg-radial)" />

                    {{-- レーダーパルス（中央から放射） --}}
                    <circle class="hero-radar" cx="600" cy="380" r="80" fill="none" stroke="#0dcaf0" stroke-width="1" opacity="0" />
                    <circle class="hero-radar hero-radar--2" cx="600" cy="380" r="80" fill="none" stroke="#0dcaf0" stroke-width="1" opacity="0" />
                    <circle class="hero-radar hero-radar--3" cx="600" cy="380" r="80" fill="none" stroke="#0dcaf0" stroke-width="1" opacity="0" />

                    {{-- パーティクルネットワーク —— ノード --}}
                    <g filter="url(#glow)">
                        {{-- 主要ノード（明るい） --}}
                        <circle class="hero-node hero-node--lg" cx="600" cy="380" r="4" fill="#22d3ee" opacity="0.9" />
                        <circle class="hero-node hero-node--lg" cx="420" cy="280" r="3.5" fill="#22d3ee" opacity="0.8" />
                        <circle class="hero-node hero-node--lg" cx="780" cy="300" r="3.5" fill="#22d3ee" opacity="0.8" />
                        <circle class="hero-node hero-node--lg" cx="500" cy="500" r="3" fill="#22d3ee" opacity="0.7" />
                        <circle class="hero-node hero-node--lg" cx="720" cy="480" r="3" fill="#22d3ee" opacity="0.7" />
                        <circle class="hero-node hero-node--lg" cx="300" cy="400" r="3" fill="#22d3ee" opacity="0.6" />
                        <circle class="hero-node hero-node--lg" cx="900" cy="380" r="3" fill="#22d3ee" opacity="0.6" />
                    </g>

                    {{-- 準主要ノード --}}
                    <circle class="hero-node" cx="180" cy="200" r="2.5" fill="#67e8f9" opacity="0.5" />
                    <circle class="hero-node" cx="350" cy="150" r="2" fill="#67e8f9" opacity="0.4" />
                    <circle class="hero-node" cx="550" cy="180" r="2.5" fill="#67e8f9" opacity="0.45" />
                    <circle class="hero-node" cx="850" cy="180" r="2" fill="#67e8f9" opacity="0.4" />
                    <circle class="hero-node" cx="1020" cy="250" r="2.5" fill="#67e8f9" opacity="0.45" />
                    <circle class="hero-node" cx="1080" cy="450" r="2" fill="#67e8f9" opacity="0.4" />
                    <circle class="hero-node" cx="150" cy="550" r="2" fill="#67e8f9" opacity="0.35" />
                    <circle class="hero-node" cx="1000" cy="600" r="2.5" fill="#67e8f9" opacity="0.4" />
                    <circle class="hero-node" cx="400" cy="620" r="2" fill="#67e8f9" opacity="0.35" />
                    <circle class="hero-node" cx="680" cy="650" r="2" fill="#67e8f9" opacity="0.35" />
                    <circle class="hero-node" cx="250" cy="320" r="2" fill="#67e8f9" opacity="0.4" />
                    <circle class="hero-node" cx="950" cy="520" r="2" fill="#67e8f9" opacity="0.35" />
                    <circle class="hero-node" cx="100" cy="400" r="1.5" fill="#67e8f9" opacity="0.3" />
                    <circle class="hero-node" cx="1150" cy="350" r="1.5" fill="#67e8f9" opacity="0.3" />

                    {{-- ネットワーク接続線 --}}
                    <g stroke="#0dcaf0" stroke-width="0.8" fill="none">
                        {{-- 中央ハブから放射 --}}
                        <line class="hero-line" x1="600" y1="380" x2="420" y2="280" opacity="0.2" />
                        <line class="hero-line" x1="600" y1="380" x2="780" y2="300" opacity="0.2" />
                        <line class="hero-line" x1="600" y1="380" x2="500" y2="500" opacity="0.18" />
                        <line class="hero-line" x1="600" y1="380" x2="720" y2="480" opacity="0.18" />
                        <line class="hero-line" x1="600" y1="380" x2="300" y2="400" opacity="0.12" />
                        <line class="hero-line" x1="600" y1="380" x2="900" y2="380" opacity="0.12" />
                        {{-- 第2層 --}}
                        <line class="hero-line" x1="420" y1="280" x2="350" y2="150" opacity="0.12" />
                        <line class="hero-line" x1="420" y1="280" x2="250" y2="320" opacity="0.1" />
                        <line class="hero-line" x1="420" y1="280" x2="550" y2="180" opacity="0.12" />
                        <line class="hero-line" x1="780" y1="300" x2="850" y2="180" opacity="0.12" />
                        <line class="hero-line" x1="780" y1="300" x2="1020" y2="250" opacity="0.1" />
                        <line class="hero-line" x1="900" y1="380" x2="1080" y2="450" opacity="0.1" />
                        <line class="hero-line" x1="900" y1="380" x2="1020" y2="250" opacity="0.1" />
                        <line class="hero-line" x1="300" y1="400" x2="180" y2="200" opacity="0.08" />
                        <line class="hero-line" x1="300" y1="400" x2="150" y2="550" opacity="0.08" />
                        <line class="hero-line" x1="500" y1="500" x2="400" y2="620" opacity="0.08" />
                        <line class="hero-line" x1="720" y1="480" x2="680" y2="650" opacity="0.08" />
                        <line class="hero-line" x1="720" y1="480" x2="950" y2="520" opacity="0.1" />
                        <line class="hero-line" x1="950" y1="520" x2="1000" y2="600" opacity="0.08" />
                        <line class="hero-line" x1="1080" y1="450" x2="1150" y2="350" opacity="0.08" />
                        {{-- クロスリンク --}}
                        <line class="hero-line" x1="420" y1="280" x2="500" y2="500" opacity="0.08" />
                        <line class="hero-line" x1="780" y1="300" x2="720" y2="480" opacity="0.08" />
                        <line class="hero-line" x1="550" y1="180" x2="850" y2="180" opacity="0.06" />
                        <line class="hero-line" x1="250" y1="320" x2="180" y2="200" opacity="0.06" />
                    </g>

                    {{-- データパケット（線上を移動する光点） --}}
                    <circle class="hero-packet" cx="0" cy="0" r="2" fill="#22d3ee" opacity="0.8" filter="url(#glow)">
                        <animateMotion dur="4s" repeatCount="indefinite" path="M600,380 L420,280 L350,150" />
                    </circle>
                    <circle class="hero-packet" cx="0" cy="0" r="2" fill="#22d3ee" opacity="0.7" filter="url(#glow)">
                        <animateMotion dur="3.5s" repeatCount="indefinite" path="M600,380 L780,300 L1020,250" begin="1s" />
                    </circle>
                    <circle class="hero-packet" cx="0" cy="0" r="1.5" fill="#22d3ee" opacity="0.6" filter="url(#glow)">
                        <animateMotion dur="5s" repeatCount="indefinite" path="M600,380 L500,500 L400,620" begin="2s" />
                    </circle>
                    <circle class="hero-packet" cx="0" cy="0" r="1.5" fill="#22d3ee" opacity="0.6" filter="url(#glow)">
                        <animateMotion dur="4.5s" repeatCount="indefinite" path="M600,380 L900,380 L1080,450 L1150,350" begin="0.5s" />
                    </circle>
                    <circle class="hero-packet" cx="0" cy="0" r="1.5" fill="#22d3ee" opacity="0.5" filter="url(#glow)">
                        <animateMotion dur="5.5s" repeatCount="indefinite" path="M600,380 L300,400 L150,550" begin="3s" />
                    </circle>

                    {{-- 回路トレース --}}
                    <g class="hero-circuit" fill="none" stroke="#0dcaf0" stroke-width="1">
                        <polyline points="0,280 100,280 130,250 220,250" opacity="0.1" />
                        <polyline points="980,520 1050,520 1080,490 1200,490" opacity="0.08" />
                        <polyline points="0,650 60,650 90,620 160,620" opacity="0.06" />
                        <polyline points="1040,150 1100,150 1130,120 1200,120" opacity="0.08" />
                    </g>

                    {{-- 浮遊テックテキスト --}}
                    <text class="hero-code" x="60" y="140" fill="#0dcaf0" opacity="0.08" font-family="'Courier New',monospace" font-size="11">const future = await</text>
                    <text class="hero-code" x="980" y="680" fill="#0dcaf0" opacity="0.07" font-family="'Courier New',monospace" font-size="11">deploy(vision)</text>
                    <text class="hero-code" x="70" y="700" fill="#0dcaf0" opacity="0.06" font-family="'Courier New',monospace" font-size="10">import &#123; innovation &#125;</text>
                    <text class="hero-code" x="900" y="100" fill="#0dcaf0" opacity="0.06" font-family="'Courier New',monospace" font-size="10">// connect people</text>
                </svg>
            </div>
            {{-- テキスト --}}
            <div class="hero-content">
                <strong class="hero-title char-anim" data-anim="char">「あなたの、あなたによる、あなたのための」</strong>
                <strong class="hero-title hero-title--sub char-anim" data-anim="char">を全てのひとへ</strong>
                <p class="hero-sub anim-fade-up" data-anim="fade-up">
                    私たちは皆、人生の主人公です。働くことも人生の一部。<br>
                    OBFall株式会社は、従来にない新しい会社の形を実現します。
                </p>
                <div class="anim-fade-up" data-anim="fade-up">
                    <a href="{{ route('philosophy') }}" class="top-link-button shadow">
                        企業理念はこちら <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <main>
        <div id="about" class="service pt-4">
            <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                <div class="heading-chip">SERVICE</div>
            </h1>
            <div class="section-block">
                <section class="section-spacing">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6 order-2 order-md-1 section-shape">
                                <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="grad-s1" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#4a7ab5" stop-opacity="0.25" />
                                            <stop offset="100%" stop-color="#0dcaf0" stop-opacity="0.15" />
                                        </linearGradient>
                                        <linearGradient id="grad-s2" x1="100%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#1a365d" stop-opacity="0.2" />
                                            <stop offset="100%" stop-color="#4a7ab5" stop-opacity="0.1" />
                                        </linearGradient>
                                        <linearGradient id="grad-s3" x1="50%" y1="0%" x2="50%" y2="100%">
                                            <stop offset="0%" stop-color="#0dcaf0" stop-opacity="0.3" />
                                            <stop offset="100%" stop-color="#1e3a5f" stop-opacity="0.05" />
                                        </linearGradient>
                                    </defs>
                                    <circle class="shape-circle-1" cx="180" cy="160" r="120" fill="url(#grad-s1)" />
                                    <circle class="shape-circle-2" cx="230" cy="200" r="100" fill="url(#grad-s2)" />
                                    <circle class="shape-circle-3" cx="200" cy="240" r="80" fill="url(#grad-s3)" />
                                </svg>
                            </div>
                            <div class="col-md-6 order-1 order-md-2">
                                <div class="text-muted small mb-1 text-end text-md-start anim-fade-up" data-anim="fade-up">サービス</div>
                                <h2 class="h4 mb-3 text-container maintitle text-end text-md-start anim-line" data-anim="line">SERVICE</h2>
                                <p class="mb-4 anim-fade-up" data-anim="fade-up">
                                    ITの力で、人と社会の可能性を広げる。<br>
                                    自社開発・受託開発・脆弱性診断・SESの4つの事業を通じて、人々の人生をより豊かにします。
                                </p>
                                <a href="{{ route('userServicesShow') }}" class="link-button shadow anim-fade-up" data-anim="fade-up">
                                    サービス詳細画面へ <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <h1 class="fadein-scroll fadein-from-right m-0 text-end">
                <div class="heading-chip--flip">ACHIEVEMENTS</div>
            </h1>
            <div class="section-block">
                <section class="section-spacing">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6">
                                <div class="text-muted small mb-1 anim-fade-up" data-anim="fade-up">実績・事例紹介</div>
                                <h2 class="h4 maintitle text-container mb-3 anim-line" data-anim="line">ACHIEVEMENTS</h2>
                                <p class="mb-4 anim-fade-up" data-anim="fade-up">
                                    ITの可能性を、実績で証明する。<br>
                                    自社開発・受託開発・SES・脆弱性診断の4つの領域で、<br> "つくる・支える・守る"を軸に、課題解決に挑んでいます。
                                </p>
                                <a href="{{ route('achievements') }}" class="link-button shadow anim-fade-up" data-anim="fade-up" target="_blank" rel="noopener noreferrer">
                                    実績・事例紹介 <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                </a>
                            </div>
                            <div class="col-md-6 section-shape">
                                <svg viewBox="0 0 400 350" xmlns="http://www.w3.org/2000/svg">
                                    <line data-from="a" data-to="b" x1="80" y1="80" x2="200" y2="50" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <line data-from="a" data-to="c" x1="80" y1="80" x2="160" y2="180" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <line data-from="b" data-to="d" x1="200" y1="50" x2="320" y2="100" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <line data-from="b" data-to="c" x1="200" y1="50" x2="160" y2="180" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <line data-from="c" data-to="e" x1="160" y1="180" x2="280" y2="200" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <line data-from="d" data-to="e" x1="320" y1="100" x2="280" y2="200" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <line data-from="c" data-to="f" x1="160" y1="180" x2="100" y2="280" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <line data-from="e" data-to="g" x1="280" y1="200" x2="340" y2="290" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <line data-from="f" data-to="g" x1="100" y1="280" x2="340" y2="290" stroke="#4a7ab5" stroke-width="1.5" opacity="0.3" />
                                    <circle class="net-node" data-node="a" cx="80"  cy="80"  r="8"  fill="#0dcaf0" opacity="0.6" />
                                    <circle class="net-node" data-node="b" cx="200" cy="50"  r="10" fill="#4a7ab5" opacity="0.7" />
                                    <circle class="net-node" data-node="c" cx="160" cy="180" r="12" fill="#0dcaf0" opacity="0.8" />
                                    <circle class="net-node" data-node="d" cx="320" cy="100" r="7"  fill="#1a365d" opacity="0.5" />
                                    <circle class="net-node" data-node="e" cx="280" cy="200" r="9"  fill="#4a7ab5" opacity="0.6" />
                                    <circle class="net-node" data-node="f" cx="100" cy="280" r="8"  fill="#1e3a5f" opacity="0.5" />
                                    <circle class="net-node" data-node="g" cx="340" cy="290" r="11" fill="#0dcaf0" opacity="0.7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                <div class="heading-chip">ABOUT US</div>
            </h1>
            <div class="section-block">
                <section class="section-spacing">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-5 order-2 order-md-1">
                                <div class="about-card">
                                    <div class="about-card__main">
                                        <img src="{{ asset('image/about_us2.jpg') }}" alt="オフィスの様子">
                                    </div>
                                    <div class="about-card__sub">
                                        <img src="{{ asset('image/about_us1.jpg') }}" alt="チームの様子">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 order-2 order-md-1"></div>
                            <div class="col-md-6 order-1 order-md-2">
                                <div class="text-muted small mb-1 text-end text-md-start anim-fade-up" data-anim="fade-up">会社概要</div>
                                <h2 class="h4 mb-3 text-container text-end text-md-start maintitle anim-line" data-anim="line">ABOUT US</h2>
                                <p class="mb-4 anim-fade-up" data-anim="fade-up">
                                    会社情報をご紹介いたします。<br>
                                    OBFall株式会社は、ITの力で社会課題の解決を図り、
                                    人と社会の可能性を広げる企業として成長を続けてまいります。
                                </p>
                                <a href="{{ route('aboutus') }}" class="link-button shadow anim-fade-up" data-anim="fade-up">
                                    会社概要画面へ <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <h1 class="fadein-scroll fadein-from-right m-0 text-end">
                <div class="heading-chip--flip">NEWS</div>
            </h1>
            <div class="section-block">
                <section class="section-spacing">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-12">
                                <div class="text-muted small mb-1 anim-fade-up" data-anim="fade-up">新着情報</div>
                                <h2 class="h4 mb-3 text-container maintitle anim-line" data-anim="line">NEWS</h2>
                            </div>
                            <div class="col-12">
                                <div class="achievements-jobs fadein-scroll fadein-from-down">
                                    <div class="row g-3 align-items-start">
                                        <div class="col-12 col-md-3">
                                            <div class="d-grid d-md-block">
                                                <a href="{{ route('userNewsIndex') }}" class="link-button shadow">
                                                    新着情報 <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                                </a>
                                            </div>
                                        </div>
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
                                                        <div class="ratio ratio-1x1 flex-shrink-0 me-3" style="width:72px;">
                                                            <img src="{{ $imgSrc }}" alt="{{ $record->title }}"
                                                                class="w-100 h-100 rounded shadow-sm" style="object-fit:cover;" loading="lazy">
                                                        </div>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <h1 class="fadein-scroll fadein-from-left m-0 text-start">
                <div class="heading-chip">RECRUIT</div>
            </h1>
            <div class="section-block">
                <section class="section-spacing">
                    <div class="container">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-6 order-2 order-md-1 section-shape">
                                <svg viewBox="0 0 400 350" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="grad-blob" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#4a7ab5" stop-opacity="0.35" />
                                            <stop offset="50%" stop-color="#0dcaf0" stop-opacity="0.2" />
                                            <stop offset="100%" stop-color="#1a365d" stop-opacity="0.1" />
                                        </linearGradient>
                                        <linearGradient id="grad-blob2" x1="100%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="#1e3a5f" stop-opacity="0.15" />
                                            <stop offset="100%" stop-color="#4a7ab5" stop-opacity="0.25" />
                                        </linearGradient>
                                    </defs>
                                    <path class="shape-blob" d="M220,100 C280,40 350,80 340,160 C330,240 260,280 200,260 C140,240 80,200 80,140 C80,80 160,160 220,100Z" fill="url(#grad-blob)" />
                                    <path class="shape-blob" d="M180,120 C240,60 310,110 300,170 C290,230 230,260 180,250 C130,240 90,190 100,140 C110,90 120,180 180,120Z" fill="url(#grad-blob2)" style="animation-delay: -5s;" />
                                </svg>
                            </div>
                            <div class="col-md-6 order-1 order-md-2">
                                <div class="text-muted small mb-1 text-end text-md-start anim-fade-up" data-anim="fade-up">採用情報</div>
                                <h2 class="h4 mb-3 text-container text-end text-md-start maintitle anim-line" data-anim="line">RECRUIT</h2>
                                <p class="mb-4 anim-fade-up" data-anim="fade-up">
                                    あなたの、あなたによる、あなたのための場所で。<br>
                                    私たちは、働くことを人生の一部として誇れる舞台をつくります。<br>
                                    OBFallでの挑戦が、あなたの成長と物語を彩りますように。
                                </p>
                                <a href="https://obfall-recruit.com/" class="link-button shadow anim-fade-up" data-anim="fade-up" target="_blank">
                                    採用情報 <i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </main>
    <section class="ending" aria-label="closing">
        <div class="wrap">
            <p class="ending__tagline char-anim" data-anim="char">of you, by you, for all.</p>
            <p class="ending__message anim-fade-up" data-anim="fade-up">あなたの、あなたによる、あなたのための。</p>
            <p class="ending__message anim-fade-up" data-anim="fade-up">その想いから、すべての人の未来へ。</p>
        </div>
    </section>
    <x-footer />

    <style>
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

        .about-card {
            position: relative;
            padding-bottom: 30px;
        }

        .about-card__main {
            position: relative;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-1);
            aspect-ratio: 4 / 3;
        }

        .about-card__main img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .about-card__sub {
            position: absolute;
            right: -50px;
            bottom: -46px;
            width: min(65%, 500px);
            aspect-ratio: 3 / 2;
            border-radius: calc(var(--radius-xl) - 4px);
            box-shadow: var(--shadow-2);
            background: #fff;
        }

        .about-card__sub img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: inherit;
        }

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

        /* セクション余白 */
        .section-spacing {
            padding: 40px 0 60px;
        }
        @media (min-width: 768px) {
            .section-spacing {
                padding: 80px 0 100px;
            }
        }

        .section-block {
            display: flex;
            align-items: center;
            min-height: 340px;
        }
        .section-block > section {
            width: 100%;
        }

        /* レーダーパルス */
        .hero-radar {
            animation: hero-radar-expand 4s ease-out infinite;
        }
        .hero-radar--2 { animation-delay: 1.33s; }
        .hero-radar--3 { animation-delay: 2.66s; }
        @keyframes hero-radar-expand {
            0%   { r: 0; opacity: 0.3; stroke-width: 2; }
            100% { r: 300; opacity: 0; stroke-width: 0.5; }
        }

        /* ノード発光 */
        .hero-node {
            animation: hero-node-glow 3s ease-in-out infinite;
        }
        .hero-node:nth-child(2n) { animation-delay: 0.4s; }
        .hero-node:nth-child(3n) { animation-delay: 0.8s; }
        .hero-node:nth-child(5n) { animation-delay: 1.2s; }
        .hero-node:nth-child(7n) { animation-delay: 1.6s; }
        @keyframes hero-node-glow {
            0%, 100% { opacity: 0.3; }
            50%      { opacity: 0.8; }
        }
        .hero-node--lg {
            animation: hero-node-glow-lg 2.5s ease-in-out infinite;
        }
        @keyframes hero-node-glow-lg {
            0%, 100% { opacity: 0.5; }
            50%      { opacity: 1; }
        }

        /* コードテキスト浮遊 */
        .hero-code {
            animation: hero-code-float 10s ease-in-out infinite;
        }
        .hero-code:nth-of-type(2) { animation-delay: 2.5s; }
        .hero-code:nth-of-type(3) { animation-delay: 5s; }
        .hero-code:nth-of-type(4) { animation-delay: 7.5s; }
        @keyframes hero-code-float {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-8px); }
        }

        /* 回路トレース */
        .hero-circuit polyline {
            stroke-dasharray: 8 12;
            animation: hero-trace 3s linear infinite;
        }
        .hero-circuit polyline:nth-child(2) { animation-delay: 0.75s; animation-direction: reverse; }
        .hero-circuit polyline:nth-child(3) { animation-delay: 1.5s; }
        .hero-circuit polyline:nth-child(4) { animation-delay: 2.25s; animation-direction: reverse; }
        @keyframes hero-trace {
            0%   { stroke-dashoffset: 0; }
            100% { stroke-dashoffset: -40; }
        }

        /* ネットワーク線の呼吸 */
        .hero-line {
            animation: hero-line-breathe 5s ease-in-out infinite;
        }
        .hero-line:nth-child(2n) { animation-delay: 0.5s; }
        .hero-line:nth-child(3n) { animation-delay: 1s; }
        .hero-line:nth-child(5n) { animation-delay: 2s; }
        @keyframes hero-line-breathe {
            0%, 100% { opacity: 0.08; }
            50%      { opacity: 0.2; }
        }

        /* Ending セクション */
        .ending {
            padding: 140px 0;
            background-color: var(--premium-bg-alt);
            text-align: center;
        }
        .ending__tagline {
            font-style: italic;
            font-size: 14px;
            margin-bottom: .5rem;
            color: var(--premium-accent);
            letter-spacing: 0.15em;
        }
        .ending__message {
            margin-top: 0;
            font-size: 15px;
            color: var(--premium-gray);
            letter-spacing: 0.05em;
        }
    </style>

    <script src="{{ asset('js/main.js') }}" defer></script>
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
</body>

</html>