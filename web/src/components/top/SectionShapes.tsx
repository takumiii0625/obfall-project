/**
 * トップ各セクションの装飾 SVG（indexDev.blade.php の .section-shape 内 <svg> の移植）。
 * ACHIEVEMENTS のノード（.net-node）は TopEffects が cx/cy を動かし、
 * data-from / data-to を持つ線を追従させる。
 */

/** SERVICE: 重なる3つの円（脈動） */
export function ServiceShape() {
  return (
    <svg viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="grad-s1" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stopColor="#4a7ab5" stopOpacity="0.25" />
          <stop offset="100%" stopColor="#0dcaf0" stopOpacity="0.15" />
        </linearGradient>
        <linearGradient id="grad-s2" x1="100%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" stopColor="#1a365d" stopOpacity="0.2" />
          <stop offset="100%" stopColor="#4a7ab5" stopOpacity="0.1" />
        </linearGradient>
        <linearGradient id="grad-s3" x1="50%" y1="0%" x2="50%" y2="100%">
          <stop offset="0%" stopColor="#0dcaf0" stopOpacity="0.3" />
          <stop offset="100%" stopColor="#1e3a5f" stopOpacity="0.05" />
        </linearGradient>
      </defs>
      <circle className="shape-circle-1" cx="180" cy="160" r="120" fill="url(#grad-s1)" />
      <circle className="shape-circle-2" cx="230" cy="200" r="100" fill="url(#grad-s2)" />
      <circle className="shape-circle-3" cx="200" cy="240" r="80" fill="url(#grad-s3)" />
    </svg>
  );
}

/** ACHIEVEMENTS: ネットワーク図（ノードは JS で移動） */
export function AchievementsShape() {
  return (
    <svg viewBox="0 0 400 350" xmlns="http://www.w3.org/2000/svg">
      <line data-from="a" data-to="b" x1="80" y1="80" x2="200" y2="50" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <line data-from="a" data-to="c" x1="80" y1="80" x2="160" y2="180" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <line data-from="b" data-to="d" x1="200" y1="50" x2="320" y2="100" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <line data-from="b" data-to="c" x1="200" y1="50" x2="160" y2="180" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <line data-from="c" data-to="e" x1="160" y1="180" x2="280" y2="200" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <line data-from="d" data-to="e" x1="320" y1="100" x2="280" y2="200" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <line data-from="c" data-to="f" x1="160" y1="180" x2="100" y2="280" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <line data-from="e" data-to="g" x1="280" y1="200" x2="340" y2="290" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <line data-from="f" data-to="g" x1="100" y1="280" x2="340" y2="290" stroke="#4a7ab5" strokeWidth="1.5" opacity="0.3" />
      <circle className="net-node" data-node="a" cx="80" cy="80" r="8" fill="#0dcaf0" opacity="0.6" />
      <circle className="net-node" data-node="b" cx="200" cy="50" r="10" fill="#4a7ab5" opacity="0.7" />
      <circle className="net-node" data-node="c" cx="160" cy="180" r="12" fill="#0dcaf0" opacity="0.8" />
      <circle className="net-node" data-node="d" cx="320" cy="100" r="7" fill="#1a365d" opacity="0.5" />
      <circle className="net-node" data-node="e" cx="280" cy="200" r="9" fill="#4a7ab5" opacity="0.6" />
      <circle className="net-node" data-node="f" cx="100" cy="280" r="8" fill="#1e3a5f" opacity="0.5" />
      <circle className="net-node" data-node="g" cx="340" cy="290" r="11" fill="#0dcaf0" opacity="0.7" />
    </svg>
  );
}

/** RECRUIT: 変形する blob 2枚 */
export function RecruitShape() {
  return (
    <svg viewBox="0 0 400 350" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="grad-blob" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stopColor="#4a7ab5" stopOpacity="0.35" />
          <stop offset="50%" stopColor="#0dcaf0" stopOpacity="0.2" />
          <stop offset="100%" stopColor="#1a365d" stopOpacity="0.1" />
        </linearGradient>
        <linearGradient id="grad-blob2" x1="100%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" stopColor="#1e3a5f" stopOpacity="0.15" />
          <stop offset="100%" stopColor="#4a7ab5" stopOpacity="0.25" />
        </linearGradient>
      </defs>
      <path
        className="shape-blob"
        d="M220,100 C280,40 350,80 340,160 C330,240 260,280 200,260 C140,240 80,200 80,140 C80,80 160,160 220,100Z"
        fill="url(#grad-blob)"
      />
      <path
        className="shape-blob"
        d="M180,120 C240,60 310,110 300,170 C290,230 230,260 180,250 C130,240 90,190 100,140 C110,90 120,180 180,120Z"
        fill="url(#grad-blob2)"
        style={{ animationDelay: "-5s" }}
      />
    </svg>
  );
}
