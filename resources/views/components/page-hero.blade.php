@props(['title', 'sub' => '', 'variant' => 'default'])

<section class="page-hero">
    <div class="page-hero__shapes" aria-hidden="true">
        <svg viewBox="0 0 1200 500" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <radialGradient id="pg-glow" cx="50%" cy="50%" r="55%">
                    <stop offset="0%" stop-color="#0b6674" stop-opacity="0.2" />
                    <stop offset="100%" stop-color="#03272e" stop-opacity="0" />
                </radialGradient>
                <filter id="pg-blur">
                    <feGaussianBlur stdDeviation="2" result="b" />
                    <feMerge><feMergeNode in="b" /><feMergeNode in="SourceGraphic" /></feMerge>
                </filter>
            </defs>

            <circle cx="600" cy="250" r="280" fill="url(#pg-glow)" />

            @switch($variant)

            {{-- ■ Philosophy — 神経ネットワーク --}}
            @case('neural')
                <g stroke="#0dcaf0" stroke-width="0.6" fill="none" opacity="0.12">
                    <path d="M600,250 Q500,180 400,200" /><path d="M600,250 Q700,180 800,200" />
                    <path d="M600,250 Q550,340 450,360" /><path d="M600,250 Q650,340 750,360" />
                    <path d="M400,200 Q300,160 200,180" /><path d="M400,200 Q350,280 300,340" />
                    <path d="M800,200 Q900,160 1000,180" /><path d="M800,200 Q850,280 900,340" />
                    <path d="M450,360 Q380,400 300,420" /><path d="M750,360 Q820,400 900,420" />
                    <path d="M200,180 Q150,120 100,100" /><path d="M1000,180 Q1050,120 1100,100" />
                    <path d="M300,340 Q220,380 150,400" /><path d="M900,340 Q980,380 1050,400" />
                </g>
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="600" cy="250" r="5" fill="#22d3ee" opacity="0.8" />
                    <circle class="ph-node" cx="400" cy="200" r="3.5" fill="#22d3ee" opacity="0.6" />
                    <circle class="ph-node" cx="800" cy="200" r="3.5" fill="#22d3ee" opacity="0.6" />
                    <circle class="ph-node" cx="450" cy="360" r="3" fill="#22d3ee" opacity="0.5" />
                    <circle class="ph-node" cx="750" cy="360" r="3" fill="#22d3ee" opacity="0.5" />
                    <circle class="ph-node" cx="200" cy="180" r="2.5" fill="#67e8f9" opacity="0.4" />
                    <circle class="ph-node" cx="1000" cy="180" r="2.5" fill="#67e8f9" opacity="0.4" />
                    <circle class="ph-node" cx="300" cy="340" r="2.5" fill="#67e8f9" opacity="0.4" />
                    <circle class="ph-node" cx="900" cy="340" r="2.5" fill="#67e8f9" opacity="0.4" />
                    <circle class="ph-node" cx="100" cy="100" r="2" fill="#67e8f9" opacity="0.3" />
                    <circle class="ph-node" cx="1100" cy="100" r="2" fill="#67e8f9" opacity="0.3" />
                    <circle class="ph-node" cx="300" cy="420" r="2" fill="#67e8f9" opacity="0.3" />
                    <circle class="ph-node" cx="900" cy="420" r="2" fill="#67e8f9" opacity="0.3" />
                    <circle class="ph-node" cx="150" cy="400" r="2" fill="#67e8f9" opacity="0.25" />
                    <circle class="ph-node" cx="1050" cy="400" r="2" fill="#67e8f9" opacity="0.25" />
                </g>
                <circle class="hero-shape hero-shape--5" cx="600" cy="250" r="30" fill="none" stroke="#0dcaf0" stroke-width="0.8" opacity="0.15" />
                @break

            {{-- ■ Service — ヘキサゴングリッド --}}
            @case('hexgrid')
                @php
                    $hexes = [
                        [200,120],[340,120],[480,120],[620,120],[760,120],[900,120],[1040,120],
                        [130,220],[270,220],[410,220],[550,220],[690,220],[830,220],[970,220],[1100,220],
                        [200,320],[340,320],[480,320],[620,320],[760,320],[900,320],[1040,320],
                        [130,420],[270,420],[410,420],[550,420],[690,420],[830,420],[970,420],[1100,420],
                    ];
                @endphp
                @foreach($hexes as $i => $h)
                    @php $o = 0.04 + (($i % 5) * 0.02); @endphp
                    <polygon points="{{ $h[0]-26 }},{{ $h[1] }} {{ $h[0]-13 }},{{ $h[1]-22 }} {{ $h[0]+13 }},{{ $h[1]-22 }} {{ $h[0]+26 }},{{ $h[1] }} {{ $h[0]+13 }},{{ $h[1]+22 }} {{ $h[0]-13 }},{{ $h[1]+22 }}"
                        fill="none" stroke="#0dcaf0" stroke-width="0.8" opacity="{{ $o }}" />
                @endforeach
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="550" cy="220" r="4" fill="#22d3ee" opacity="0.7" />
                    <circle class="ph-node" cx="690" cy="220" r="3" fill="#22d3ee" opacity="0.5" />
                    <circle class="ph-node" cx="620" cy="320" r="3.5" fill="#22d3ee" opacity="0.6" />
                    <circle class="ph-node" cx="480" cy="320" r="2.5" fill="#67e8f9" opacity="0.4" />
                    <circle class="ph-node" cx="760" cy="320" r="2.5" fill="#67e8f9" opacity="0.4" />
                </g>
                @break

            {{-- ■ Products / 自社開発 — ロケット軌道 --}}
            @case('launch')
                <g stroke="#0dcaf0" fill="none">
                    <path d="M200,450 Q400,300 600,200 Q800,100 1050,50" stroke-width="1.5" opacity="0.12" stroke-dasharray="6 8" class="hero-shape hero-shape--1" />
                    <path d="M150,480 Q380,320 600,230 Q820,140 1080,80" stroke-width="1" opacity="0.08" stroke-dasharray="4 10" />
                    <path d="M250,430 Q420,280 580,180 Q780,80 1020,30" stroke-width="1" opacity="0.06" />
                </g>
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="600" cy="200" r="5" fill="#22d3ee" opacity="0.8" />
                    <circle class="ph-node" cx="400" cy="310" r="3" fill="#22d3ee" opacity="0.5" />
                    <circle class="ph-node" cx="800" cy="120" r="3" fill="#22d3ee" opacity="0.5" />
                    <circle class="ph-node" cx="1050" cy="50" r="4" fill="#22d3ee" opacity="0.7" />
                </g>
                <circle class="ph-node" cx="300" cy="380" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="500" cy="250" r="2" fill="#67e8f9" opacity="0.35" />
                <circle class="ph-node" cx="700" cy="160" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="900" cy="85" r="2" fill="#67e8f9" opacity="0.3" />
                <polygon points="1050,30 1060,50 1050,70 1040,50" fill="#22d3ee" opacity="0.3" class="hero-shape hero-shape--4" />
                @break

            {{-- ■ Contract / 受託 — パズル接続 --}}
            @case('connect')
                <g stroke="#0dcaf0" stroke-width="0.8" fill="none">
                    <line x1="100" y1="250" x2="500" y2="250" opacity="0.1" />
                    <line x1="700" y1="250" x2="1100" y2="250" opacity="0.1" />
                    <line x1="400" y1="100" x2="400" y2="400" opacity="0.08" />
                    <line x1="800" y1="100" x2="800" y2="400" opacity="0.08" />
                </g>
                <g filter="url(#pg-blur)">
                    <rect x="480" y="210" width="80" height="80" rx="12" fill="none" stroke="#0dcaf0" stroke-width="1.5" opacity="0.2" class="hero-shape hero-shape--5" />
                    <rect x="640" y="210" width="80" height="80" rx="12" fill="none" stroke="#0dcaf0" stroke-width="1.5" opacity="0.2" class="hero-shape hero-shape--5" />
                </g>
                <circle class="ph-node" cx="520" cy="250" r="4" fill="#22d3ee" opacity="0.7" />
                <circle class="ph-node" cx="680" cy="250" r="4" fill="#22d3ee" opacity="0.7" />
                <line x1="560" y1="250" x2="640" y2="250" stroke="#22d3ee" stroke-width="2" opacity="0.3" stroke-dasharray="4 4" class="hero-shape hero-shape--7" />
                <circle class="ph-node" cx="200" cy="250" r="2.5" fill="#67e8f9" opacity="0.4" />
                <circle class="ph-node" cx="1000" cy="250" r="2.5" fill="#67e8f9" opacity="0.4" />
                <circle class="ph-node" cx="400" cy="150" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="800" cy="150" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="400" cy="350" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="800" cy="350" r="2" fill="#67e8f9" opacity="0.3" />
                <g stroke="#0dcaf0" stroke-width="0.6" fill="none" opacity="0.08">
                    <line x1="200" y1="250" x2="480" y2="250" /><line x1="720" y1="250" x2="1000" y2="250" />
                    <line x1="400" y1="150" x2="520" y2="210" /><line x1="800" y1="150" x2="680" y2="210" />
                </g>
                @break

            {{-- ■ Security — シールド＋レーダー --}}
            @case('shield')
                <g fill="none" stroke="#0dcaf0" stroke-width="0.8">
                    <circle cx="600" cy="250" r="60" opacity="0.1" />
                    <circle cx="600" cy="250" r="120" opacity="0.07" />
                    <circle cx="600" cy="250" r="180" opacity="0.05" />
                    <circle cx="600" cy="250" r="240" opacity="0.04" />
                </g>
                <path d="M600,140 L660,180 L660,280 Q660,340 600,370 Q540,340 540,280 L540,180 Z"
                    fill="none" stroke="#22d3ee" stroke-width="1.5" opacity="0.2" class="hero-shape hero-shape--5" />
                <line x1="600" y1="250" x2="780" y2="150" stroke="#0dcaf0" stroke-width="1" opacity="0.1" class="hero-shape hero-shape--4">
                    <animateTransform attributeName="transform" type="rotate" from="0 600 250" to="360 600 250" dur="12s" repeatCount="indefinite" />
                </line>
                <circle cx="780" cy="150" r="3" fill="#22d3ee" opacity="0.5">
                    <animateTransform attributeName="transform" type="rotate" from="0 600 250" to="360 600 250" dur="12s" repeatCount="indefinite" />
                </circle>
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="600" cy="250" r="4" fill="#22d3ee" opacity="0.8" />
                </g>
                <circle class="ph-node" cx="200" cy="150" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="1000" cy="350" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="350" cy="400" r="2" fill="#67e8f9" opacity="0.25" />
                <circle class="ph-node" cx="850" cy="100" r="2" fill="#67e8f9" opacity="0.25" />
                @break

            {{-- ■ SES / Team — 星座コンステレーション --}}
            @case('constellation')
                <g stroke="#0dcaf0" stroke-width="0.6" fill="none" opacity="0.1">
                    <line x1="300" y1="180" x2="450" y2="220" /><line x1="450" y1="220" x2="600" y2="160" />
                    <line x1="600" y1="160" x2="750" y2="220" /><line x1="750" y1="220" x2="900" y2="180" />
                    <line x1="450" y1="220" x2="500" y2="320" /><line x1="750" y1="220" x2="700" y2="320" />
                    <line x1="500" y1="320" x2="600" y2="360" /><line x1="700" y1="320" x2="600" y2="360" />
                    <line x1="300" y1="180" x2="200" y2="280" /><line x1="900" y1="180" x2="1000" y2="280" />
                    <line x1="200" y1="280" x2="300" y2="380" /><line x1="1000" y1="280" x2="900" y2="380" />
                    <line x1="300" y1="380" x2="500" y2="320" /><line x1="900" y1="380" x2="700" y2="320" />
                    <line x1="600" y1="360" x2="600" y2="440" />
                </g>
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="600" cy="160" r="4.5" fill="#22d3ee" opacity="0.8" />
                    <circle class="ph-node" cx="600" cy="360" r="4" fill="#22d3ee" opacity="0.7" />
                    <circle class="ph-node" cx="450" cy="220" r="3.5" fill="#22d3ee" opacity="0.6" />
                    <circle class="ph-node" cx="750" cy="220" r="3.5" fill="#22d3ee" opacity="0.6" />
                </g>
                <circle class="ph-node" cx="300" cy="180" r="3" fill="#22d3ee" opacity="0.5" />
                <circle class="ph-node" cx="900" cy="180" r="3" fill="#22d3ee" opacity="0.5" />
                <circle class="ph-node" cx="500" cy="320" r="3" fill="#67e8f9" opacity="0.45" />
                <circle class="ph-node" cx="700" cy="320" r="3" fill="#67e8f9" opacity="0.45" />
                <circle class="ph-node" cx="200" cy="280" r="2.5" fill="#67e8f9" opacity="0.35" />
                <circle class="ph-node" cx="1000" cy="280" r="2.5" fill="#67e8f9" opacity="0.35" />
                <circle class="ph-node" cx="300" cy="380" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="900" cy="380" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="600" cy="440" r="2" fill="#67e8f9" opacity="0.3" />
                @break

            {{-- ■ Achievements — 上昇チャート --}}
            @case('chart')
                <g stroke="#0dcaf0" fill="none">
                    <line x1="150" y1="420" x2="1050" y2="420" stroke-width="0.8" opacity="0.1" />
                    <line x1="150" y1="420" x2="150" y2="80" stroke-width="0.8" opacity="0.1" />
                </g>
                <polyline points="200,380 350,350 500,300 650,220 800,180 950,120"
                    fill="none" stroke="#22d3ee" stroke-width="1.5" opacity="0.2" stroke-dasharray="6 4" class="hero-shape hero-shape--1" />
                <polygon points="200,420 200,380 350,350 500,300 650,220 800,180 950,120 950,420"
                    fill="#0dcaf0" opacity="0.03" />
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="200" cy="380" r="3" fill="#22d3ee" opacity="0.6" />
                    <circle class="ph-node" cx="350" cy="350" r="3" fill="#22d3ee" opacity="0.6" />
                    <circle class="ph-node" cx="500" cy="300" r="3.5" fill="#22d3ee" opacity="0.7" />
                    <circle class="ph-node" cx="650" cy="220" r="3.5" fill="#22d3ee" opacity="0.7" />
                    <circle class="ph-node" cx="800" cy="180" r="4" fill="#22d3ee" opacity="0.8" />
                    <circle class="ph-node" cx="950" cy="120" r="4.5" fill="#22d3ee" opacity="0.9" />
                </g>
                <g stroke="#0dcaf0" stroke-width="0.5" opacity="0.06">
                    <line x1="200" y1="380" x2="200" y2="420" /><line x1="350" y1="350" x2="350" y2="420" />
                    <line x1="500" y1="300" x2="500" y2="420" /><line x1="650" y1="220" x2="650" y2="420" />
                    <line x1="800" y1="180" x2="800" y2="420" /><line x1="950" y1="120" x2="950" y2="420" />
                </g>
                @break

            {{-- ■ About Us — ビル/構造体 --}}
            @case('structure')
                <g stroke="#0dcaf0" fill="none" stroke-width="0.8">
                    <rect x="520" y="140" width="160" height="280" rx="4" opacity="0.1" />
                    <rect x="360" y="220" width="120" height="200" rx="4" opacity="0.08" />
                    <rect x="720" y="200" width="130" height="220" rx="4" opacity="0.08" />
                    <rect x="230" y="300" width="100" height="120" rx="4" opacity="0.06" />
                    <rect x="880" y="280" width="110" height="140" rx="4" opacity="0.06" />
                </g>
                <g fill="#0dcaf0" opacity="0.06">
                    <rect x="540" y="160" width="30" height="20" rx="2" />
                    <rect x="590" y="160" width="30" height="20" rx="2" />
                    <rect x="630" y="160" width="30" height="20" rx="2" />
                    <rect x="540" y="200" width="30" height="20" rx="2" />
                    <rect x="590" y="200" width="30" height="20" rx="2" />
                    <rect x="630" y="200" width="30" height="20" rx="2" />
                    <rect x="540" y="240" width="30" height="20" rx="2" />
                    <rect x="590" y="240" width="30" height="20" rx="2" />
                    <rect x="630" y="240" width="30" height="20" rx="2" />
                </g>
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="600" cy="280" r="4" fill="#22d3ee" opacity="0.7" />
                    <circle class="ph-node" cx="420" cy="320" r="3" fill="#22d3ee" opacity="0.5" />
                    <circle class="ph-node" cx="785" cy="310" r="3" fill="#22d3ee" opacity="0.5" />
                </g>
                <circle class="ph-node" cx="280" cy="360" r="2" fill="#67e8f9" opacity="0.3" />
                <circle class="ph-node" cx="935" cy="350" r="2" fill="#67e8f9" opacity="0.3" />
                <line x1="100" y1="420" x2="1100" y2="420" stroke="#0dcaf0" stroke-width="0.8" opacity="0.08" />
                @break

            {{-- ■ News — 放送波 --}}
            @case('wave')
                <g fill="none" stroke="#0dcaf0" stroke-width="0.8">
                    <circle cx="200" cy="250" r="40" opacity="0.12" class="hero-shape hero-shape--5" />
                    <circle cx="200" cy="250" r="80" opacity="0.08" />
                    <circle cx="200" cy="250" r="130" opacity="0.06" />
                    <circle cx="200" cy="250" r="190" opacity="0.04" />
                    <circle cx="200" cy="250" r="260" opacity="0.03" />
                </g>
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="200" cy="250" r="5" fill="#22d3ee" opacity="0.8" />
                </g>
                <g stroke="#0dcaf0" stroke-width="0.6" fill="none" opacity="0.08">
                    <line x1="360" y1="180" x2="500" y2="180" /><line x1="500" y1="180" x2="530" y2="200" />
                    <line x1="360" y1="220" x2="600" y2="220" /><line x1="600" y1="220" x2="640" y2="240" />
                    <line x1="360" y1="260" x2="700" y2="260" /><line x1="700" y1="260" x2="750" y2="280" />
                    <line x1="360" y1="300" x2="550" y2="300" /><line x1="550" y1="300" x2="580" y2="320" />
                </g>
                <circle class="ph-node" cx="530" cy="200" r="2" fill="#67e8f9" opacity="0.4" />
                <circle class="ph-node" cx="640" cy="240" r="2" fill="#67e8f9" opacity="0.35" />
                <circle class="ph-node" cx="750" cy="280" r="2.5" fill="#67e8f9" opacity="0.4" />
                <circle class="ph-node" cx="580" cy="320" r="2" fill="#67e8f9" opacity="0.35" />
                <circle class="ph-node" cx="900" cy="200" r="2" fill="#67e8f9" opacity="0.25" />
                <circle class="ph-node" cx="1000" cy="300" r="2" fill="#67e8f9" opacity="0.25" />
                @break

            {{-- ■ Contact — メッセージバブル --}}
            @case('mail')
                <g fill="none" stroke="#0dcaf0" stroke-width="1">
                    <rect x="420" y="160" width="200" height="140" rx="16" opacity="0.12" />
                    <polyline points="420,165 520,240 620,165" opacity="0.1" />
                </g>
                <g fill="none" stroke="#0dcaf0" stroke-width="0.8">
                    <rect x="680" y="240" width="160" height="110" rx="14" opacity="0.08" />
                    <polyline points="680,245 760,300 840,245" opacity="0.07" />
                </g>
                <g fill="none" stroke="#0dcaf0" stroke-width="0.6">
                    <rect x="260" y="280" width="130" height="90" rx="12" opacity="0.06" />
                    <polyline points="260,285 325,330 390,285" opacity="0.05" />
                </g>
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="520" cy="230" r="4" fill="#22d3ee" opacity="0.7" />
                    <circle class="ph-node" cx="760" cy="295" r="3" fill="#22d3ee" opacity="0.5" />
                </g>
                <circle class="ph-node" cx="325" cy="325" r="2.5" fill="#67e8f9" opacity="0.4" />
                <g stroke="#0dcaf0" stroke-width="0.5" fill="none" opacity="0.06">
                    <line x1="620" y1="230" x2="680" y2="270" />
                    <line x1="390" y1="320" x2="420" y2="280" />
                </g>
                <circle class="ph-node" cx="150" cy="180" r="2" fill="#67e8f9" opacity="0.2" />
                <circle class="ph-node" cx="1000" cy="200" r="2" fill="#67e8f9" opacity="0.2" />
                <circle class="ph-node" cx="950" cy="380" r="2" fill="#67e8f9" opacity="0.2" />
                @break

            {{-- ■ デフォルト — パーティクル --}}
            @default
                <g stroke="#0dcaf0" stroke-width="0.6" fill="none" opacity="0.1">
                    <line x1="300" y1="150" x2="500" y2="200" /><line x1="500" y1="200" x2="700" y2="170" />
                    <line x1="700" y1="170" x2="900" y2="230" /><line x1="500" y1="200" x2="600" y2="320" />
                    <line x1="700" y1="170" x2="600" y2="320" /><line x1="600" y1="320" x2="800" y2="380" />
                    <line x1="300" y1="150" x2="200" y2="280" /><line x1="900" y1="230" x2="1000" y2="350" />
                </g>
                <g filter="url(#pg-blur)">
                    <circle class="ph-node" cx="500" cy="200" r="4" fill="#22d3ee" opacity="0.7" />
                    <circle class="ph-node" cx="700" cy="170" r="4" fill="#22d3ee" opacity="0.7" />
                    <circle class="ph-node" cx="600" cy="320" r="3.5" fill="#22d3ee" opacity="0.6" />
                </g>
                <circle class="ph-node" cx="300" cy="150" r="3" fill="#67e8f9" opacity="0.5" />
                <circle class="ph-node" cx="900" cy="230" r="3" fill="#67e8f9" opacity="0.5" />
                <circle class="ph-node" cx="800" cy="380" r="2.5" fill="#67e8f9" opacity="0.4" />
                <circle class="ph-node" cx="200" cy="280" r="2.5" fill="#67e8f9" opacity="0.35" />
                <circle class="ph-node" cx="1000" cy="350" r="2.5" fill="#67e8f9" opacity="0.35" />

            @endswitch
        </svg>
    </div>
    <div class="page-hero__content">
        <h1>{{ $title }}</h1>
        @if($sub)
            <div class="page-hero__sub">{!! $sub !!}</div>
        @endif
    </div>
</section>
