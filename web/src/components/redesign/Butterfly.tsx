type Props = {
  /** 外枠（位置・サイズ・回転など）のクラス */
  className?: string;
  /** 翅の塗り */
  fill?: string;
  /** 胴体の線の色 */
  body?: string;
  /** 線の太さ（viewBox 64 基準）。大きく表示するときは細くして、小さい蝶と同じ極細の線に見せる */
  strokeWidth?: number;
  /** true で羽ばたき（翅を左右に開閉）+ ふわふわ漂う動き。CSS は redesign.css の .bf-flap / .bf-float */
  animated?: boolean;
  /** 動きの開始ずれ（秒）。複数の蝶が同時に羽ばたかないようにする */
  delay?: number;
  /** セクション境界に置く蝶用。境界の向こう（後ろ）から出たり隠れたりするよう、上下に大きく漂う（.bf-float-edge） */
  edge?: boolean;
};

/**
 * 蝶のモチーフ（design/stitch/top.html のセクション境界に置かれている SVG）。
 * 線の色は外側の text-* で指定する（stroke="currentColor"）。
 */
export default function Butterfly({ className = "h-12 w-12", fill = "rgba(255,255,255,0.85)", body = "#004e8c", strokeWidth = 1.2, animated = false, delay = 0, edge = false }: Props) {
  const style = animated && delay ? { animationDelay: `-${delay}s` } : undefined;
  return (
    <svg style={style} className={`${className}${animated ? (edge ? " bf-float-edge" : " bf-float") : ""}`} fill="none" stroke="currentColor" viewBox="0 0 64 64" aria-hidden="true">
      <g style={style} className={animated ? "bf-flap" : undefined}>
        <path d="M32 30 C 26 14 10 10 4 18 C -1 24 4 38 18 42 C 28 44 32 36 32 32 Z" fill={fill} strokeWidth={strokeWidth} />
        <path d="M32 30 C 38 14 54 10 60 18 C 65 24 60 38 46 42 C 36 44 32 36 32 32 Z" fill={fill} strokeWidth={strokeWidth} />
        <path d="M32 32 C 24 38 14 48 18 56 C 21 61 28 58 32 46 Z" fill={fill} strokeWidth={strokeWidth} />
        <path d="M32 32 C 40 38 50 48 46 56 C 43 61 36 58 32 46 Z" fill={fill} strokeWidth={strokeWidth} />
      </g>
      <line stroke={body} strokeWidth={strokeWidth + 0.2} x1="32" x2="32" y1="20" y2="48" />
    </svg>
  );
}
