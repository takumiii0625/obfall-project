import Link from "next/link";
import CharAnim from "./CharAnim";

/**
 * トップのヒーロー（indexDev.blade.php の .hero-section の移植）。
 * SVG 要素の並び順は nth-child / nth-of-type のアニメ遅延に影響するため現行と同じにする。
 * アニメーション（is-visible 付与）は TopEffects が担当。
 */
export default function HeroSection() {
  return (
    <div className="hero-section">
      {/* 動く図形の背景 */}
      <div className="hero-shapes" aria-hidden="true">
        <svg className="hero-svg" viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <radialGradient id="hg-radial" cx="50%" cy="45%" r="55%">
              <stop offset="0%" stopColor="#0b6674" stopOpacity="0.25" />
              <stop offset="100%" stopColor="#03272e" stopOpacity="0" />
            </radialGradient>
            <radialGradient id="hg-pulse" cx="50%" cy="50%" r="50%">
              <stop offset="0%" stopColor="#0dcaf0" stopOpacity="0.3" />
              <stop offset="100%" stopColor="#0dcaf0" stopOpacity="0" />
            </radialGradient>
            <filter id="glow">
              <feGaussianBlur stdDeviation="2" result="blur" />
              <feMerge>
                <feMergeNode in="blur" />
                <feMergeNode in="SourceGraphic" />
              </feMerge>
            </filter>
            <filter id="glow-strong">
              <feGaussianBlur stdDeviation="4" result="blur" />
              <feMerge>
                <feMergeNode in="blur" />
                <feMergeNode in="SourceGraphic" />
              </feMerge>
            </filter>
          </defs>

          {/* 中央の放射グロー */}
          <circle cx="600" cy="360" r="350" fill="url(#hg-radial)" />

          {/* レーダーパルス（中央から放射） */}
          <circle className="hero-radar" cx="600" cy="380" r="80" fill="none" stroke="#0dcaf0" strokeWidth="1" opacity="0" />
          <circle className="hero-radar hero-radar--2" cx="600" cy="380" r="80" fill="none" stroke="#0dcaf0" strokeWidth="1" opacity="0" />
          <circle className="hero-radar hero-radar--3" cx="600" cy="380" r="80" fill="none" stroke="#0dcaf0" strokeWidth="1" opacity="0" />

          {/* パーティクルネットワーク —— ノード */}
          <g filter="url(#glow)">
            {/* 主要ノード（明るい） */}
            <circle className="hero-node hero-node--lg" cx="600" cy="380" r="4" fill="#22d3ee" opacity="0.9" />
            <circle className="hero-node hero-node--lg" cx="420" cy="280" r="3.5" fill="#22d3ee" opacity="0.8" />
            <circle className="hero-node hero-node--lg" cx="780" cy="300" r="3.5" fill="#22d3ee" opacity="0.8" />
            <circle className="hero-node hero-node--lg" cx="500" cy="500" r="3" fill="#22d3ee" opacity="0.7" />
            <circle className="hero-node hero-node--lg" cx="720" cy="480" r="3" fill="#22d3ee" opacity="0.7" />
            <circle className="hero-node hero-node--lg" cx="300" cy="400" r="3" fill="#22d3ee" opacity="0.6" />
            <circle className="hero-node hero-node--lg" cx="900" cy="380" r="3" fill="#22d3ee" opacity="0.6" />
          </g>

          {/* 準主要ノード */}
          <circle className="hero-node" cx="180" cy="200" r="2.5" fill="#67e8f9" opacity="0.5" />
          <circle className="hero-node" cx="350" cy="150" r="2" fill="#67e8f9" opacity="0.4" />
          <circle className="hero-node" cx="550" cy="180" r="2.5" fill="#67e8f9" opacity="0.45" />
          <circle className="hero-node" cx="850" cy="180" r="2" fill="#67e8f9" opacity="0.4" />
          <circle className="hero-node" cx="1020" cy="250" r="2.5" fill="#67e8f9" opacity="0.45" />
          <circle className="hero-node" cx="1080" cy="450" r="2" fill="#67e8f9" opacity="0.4" />
          <circle className="hero-node" cx="150" cy="550" r="2" fill="#67e8f9" opacity="0.35" />
          <circle className="hero-node" cx="1000" cy="600" r="2.5" fill="#67e8f9" opacity="0.4" />
          <circle className="hero-node" cx="400" cy="620" r="2" fill="#67e8f9" opacity="0.35" />
          <circle className="hero-node" cx="680" cy="650" r="2" fill="#67e8f9" opacity="0.35" />
          <circle className="hero-node" cx="250" cy="320" r="2" fill="#67e8f9" opacity="0.4" />
          <circle className="hero-node" cx="950" cy="520" r="2" fill="#67e8f9" opacity="0.35" />
          <circle className="hero-node" cx="100" cy="400" r="1.5" fill="#67e8f9" opacity="0.3" />
          <circle className="hero-node" cx="1150" cy="350" r="1.5" fill="#67e8f9" opacity="0.3" />

          {/* ネットワーク接続線 */}
          <g stroke="#0dcaf0" strokeWidth="0.8" fill="none">
            {/* 中央ハブから放射 */}
            <line className="hero-line" x1="600" y1="380" x2="420" y2="280" opacity="0.2" />
            <line className="hero-line" x1="600" y1="380" x2="780" y2="300" opacity="0.2" />
            <line className="hero-line" x1="600" y1="380" x2="500" y2="500" opacity="0.18" />
            <line className="hero-line" x1="600" y1="380" x2="720" y2="480" opacity="0.18" />
            <line className="hero-line" x1="600" y1="380" x2="300" y2="400" opacity="0.12" />
            <line className="hero-line" x1="600" y1="380" x2="900" y2="380" opacity="0.12" />
            {/* 第2層 */}
            <line className="hero-line" x1="420" y1="280" x2="350" y2="150" opacity="0.12" />
            <line className="hero-line" x1="420" y1="280" x2="250" y2="320" opacity="0.1" />
            <line className="hero-line" x1="420" y1="280" x2="550" y2="180" opacity="0.12" />
            <line className="hero-line" x1="780" y1="300" x2="850" y2="180" opacity="0.12" />
            <line className="hero-line" x1="780" y1="300" x2="1020" y2="250" opacity="0.1" />
            <line className="hero-line" x1="900" y1="380" x2="1080" y2="450" opacity="0.1" />
            <line className="hero-line" x1="900" y1="380" x2="1020" y2="250" opacity="0.1" />
            <line className="hero-line" x1="300" y1="400" x2="180" y2="200" opacity="0.08" />
            <line className="hero-line" x1="300" y1="400" x2="150" y2="550" opacity="0.08" />
            <line className="hero-line" x1="500" y1="500" x2="400" y2="620" opacity="0.08" />
            <line className="hero-line" x1="720" y1="480" x2="680" y2="650" opacity="0.08" />
            <line className="hero-line" x1="720" y1="480" x2="950" y2="520" opacity="0.1" />
            <line className="hero-line" x1="950" y1="520" x2="1000" y2="600" opacity="0.08" />
            <line className="hero-line" x1="1080" y1="450" x2="1150" y2="350" opacity="0.08" />
            {/* クロスリンク */}
            <line className="hero-line" x1="420" y1="280" x2="500" y2="500" opacity="0.08" />
            <line className="hero-line" x1="780" y1="300" x2="720" y2="480" opacity="0.08" />
            <line className="hero-line" x1="550" y1="180" x2="850" y2="180" opacity="0.06" />
            <line className="hero-line" x1="250" y1="320" x2="180" y2="200" opacity="0.06" />
          </g>

          {/* データパケット（線上を移動する光点） */}
          <circle className="hero-packet" cx="0" cy="0" r="2" fill="#22d3ee" opacity="0.8" filter="url(#glow)">
            <animateMotion dur="4s" repeatCount="indefinite" path="M600,380 L420,280 L350,150" />
          </circle>
          <circle className="hero-packet" cx="0" cy="0" r="2" fill="#22d3ee" opacity="0.7" filter="url(#glow)">
            <animateMotion dur="3.5s" repeatCount="indefinite" path="M600,380 L780,300 L1020,250" begin="1s" />
          </circle>
          <circle className="hero-packet" cx="0" cy="0" r="1.5" fill="#22d3ee" opacity="0.6" filter="url(#glow)">
            <animateMotion dur="5s" repeatCount="indefinite" path="M600,380 L500,500 L400,620" begin="2s" />
          </circle>
          <circle className="hero-packet" cx="0" cy="0" r="1.5" fill="#22d3ee" opacity="0.6" filter="url(#glow)">
            <animateMotion dur="4.5s" repeatCount="indefinite" path="M600,380 L900,380 L1080,450 L1150,350" begin="0.5s" />
          </circle>
          <circle className="hero-packet" cx="0" cy="0" r="1.5" fill="#22d3ee" opacity="0.5" filter="url(#glow)">
            <animateMotion dur="5.5s" repeatCount="indefinite" path="M600,380 L300,400 L150,550" begin="3s" />
          </circle>

          {/* 回路トレース */}
          <g className="hero-circuit" fill="none" stroke="#0dcaf0" strokeWidth="1">
            <polyline points="0,280 100,280 130,250 220,250" opacity="0.1" />
            <polyline points="980,520 1050,520 1080,490 1200,490" opacity="0.08" />
            <polyline points="0,650 60,650 90,620 160,620" opacity="0.06" />
            <polyline points="1040,150 1100,150 1130,120 1200,120" opacity="0.08" />
          </g>

          {/* 浮遊テックテキスト */}
          <text className="hero-code" x="60" y="140" fill="#0dcaf0" opacity="0.08" fontFamily="'Courier New',monospace" fontSize="11">
            const future = await
          </text>
          <text className="hero-code" x="980" y="680" fill="#0dcaf0" opacity="0.07" fontFamily="'Courier New',monospace" fontSize="11">
            deploy(vision)
          </text>
          <text className="hero-code" x="70" y="700" fill="#0dcaf0" opacity="0.06" fontFamily="'Courier New',monospace" fontSize="10">
            {"import { innovation }"}
          </text>
          <text className="hero-code" x="900" y="100" fill="#0dcaf0" opacity="0.06" fontFamily="'Courier New',monospace" fontSize="10">
            {"// connect people"}
          </text>
        </svg>
      </div>

      {/* テキスト */}
      <div className="hero-content">
        <CharAnim as="strong" className="hero-title" text="「あなたの、あなたによる、あなたのための」" />
        <CharAnim as="strong" className="hero-title hero-title--sub" text="を全てのひとへ" />
        <p className="hero-sub anim-fade-up" data-anim="fade-up">
          私たちは皆、人生の主人公です。働くことも人生の一部。
          <br />
          OBFall株式会社は、従来にない新しい会社の形を実現します。
        </p>
        <div className="anim-fade-up" data-anim="fade-up">
          <Link href="/philosophy" className="top-link-button shadow">
            企業理念はこちら <i className="fa-solid fa-circle-arrow-right ms-1"></i>
          </Link>
        </div>
      </div>
    </div>
  );
}
