type Props = {
  /** 位置・サイズ・色（線は currentColor） */
  className?: string;
  /** 線の太さの倍率。小さく表示するときは大きくして、線が細くなりすぎないようにする */
  strokeScale?: number;
  viewBox?: string;
  preserveAspectRatio?: string;
};

/**
 * 翅脈の入った蝶の線画（design/stitch/top.html の Butterfly Venation）。
 * トップのヒーロー背景と、企業理念「理念と社名の由来」で使う。
 */
export default function ButterflyVenation({ className, strokeScale = 1, viewBox = "0 0 1200 900", preserveAspectRatio = "xMidYMid slice" }: Props) {
  const w = (n: number) => n * strokeScale;
  return (
    <svg className={className} fill="none" stroke="currentColor" viewBox={viewBox} preserveAspectRatio={preserveAspectRatio} xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M 600,450 C 420,180 200,80 50,160 C -40,210 20,430 180,520 C 320,600 480,510 600,450 Z" strokeOpacity="0.7" strokeWidth={w(1.2)} />
      <path d="M 600,450 C 500,280 320,200 120,230" strokeOpacity="0.5" strokeWidth={w(0.8)} />
      <path d="M 520,380 C 410,290 280,260 140,310" strokeOpacity="0.4" strokeWidth={w(0.7)} />
      <path d="M 450,420 C 360,370 260,360 160,430" strokeOpacity="0.4" strokeWidth={w(0.7)} />
      <path d="M 600,450 C 470,550 310,680 140,640 C 60,620 90,520 220,480" strokeOpacity="0.5" strokeWidth={w(0.8)} />
      <path d="M 600,450 C 780,180 1000,80 1150,160 C 1240,210 1180,430 1020,520 C 880,600 720,510 600,450 Z" strokeOpacity="0.7" strokeWidth={w(1.2)} />
      <path d="M 600,450 C 700,280 880,200 1080,230" strokeOpacity="0.5" strokeWidth={w(0.8)} />
      <path d="M 680,380 C 790,290 920,260 1060,310" strokeOpacity="0.4" strokeWidth={w(0.7)} />
      <path d="M 750,420 C 840,370 940,360 1040,430" strokeOpacity="0.4" strokeWidth={w(0.7)} />
      <path d="M 600,450 C 730,550 890,680 1060,640 C 1140,620 1110,520 980,480" strokeOpacity="0.5" strokeWidth={w(0.8)} />
      <path d="M 600,120 L 600,780" strokeOpacity="0.2" strokeDasharray={`${w(3)} ${w(6)}`} strokeWidth={w(1)} />
    </svg>
  );
}
