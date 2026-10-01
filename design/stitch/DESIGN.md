---
name: Clarity & Cyan Tech Corporate
colors:
  surface: '#faf8ff'
  surface-dim: '#d2d9f4'
  surface-bright: '#faf8ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f3ff'
  surface-container: '#eaedff'
  surface-container-high: '#e2e7ff'
  surface-container-highest: '#dae2fd'
  on-surface: '#131b2e'
  on-surface-variant: '#3e4851'
  inverse-surface: '#283044'
  inverse-on-surface: '#eef0ff'
  outline: '#6f7882'
  outline-variant: '#bec8d2'
  surface-tint: '#006494'
  primary: '#006494'
  on-primary: '#ffffff'
  primary-container: '#009fe8'
  on-primary-container: '#00324d'
  inverse-primary: '#8ecdff'
  secondary: '#1261a3'
  on-secondary: '#ffffff'
  secondary-container: '#7ab7ff'
  on-secondary-container: '#00477d'
  tertiary: '#006687'
  on-tertiary: '#ffffff'
  tertiary-container: '#00a2d3'
  on-tertiary-container: '#003345'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#cbe6ff'
  primary-fixed-dim: '#8ecdff'
  on-primary-fixed: '#001e30'
  on-primary-fixed-variant: '#004b71'
  secondary-fixed: '#d2e4ff'
  secondary-fixed-dim: '#a1c9ff'
  on-secondary-fixed: '#001c37'
  on-secondary-fixed-variant: '#00487f'
  tertiary-fixed: '#c0e8ff'
  tertiary-fixed-dim: '#71d2ff'
  on-tertiary-fixed: '#001e2b'
  on-tertiary-fixed-variant: '#004d66'
  background: '#faf8ff'
  on-background: '#131b2e'
  surface-variant: '#dae2fd'
typography:
  # 実装（web/src/app/(redesign)/redesign.css + layout.tsx の next/font）に合わせて 2026-10-01 更新。
  # 書体は design/stitch/*.html で実際に使われているものを正とする
  serif-jp:
    fontFamily: Shippori Mincho B1
    use: 和文の見出し（h1〜h3、キャッチコピー）
    weights: ['400', '700']
  sans-jp:
    fontFamily: Zen Kaku Gothic New
    use: 和文の本文・UI
    weights: ['400', '500', '700']
    baseSize: 14px / 24px
  latin:
    fontFamily: EB Garamond
    use: 英字（ロゴ、ナビ、英字ラベル、背景の大きな英字、日付）
    weights: ['400', '600']
rounded:
  # HTML（tailwind.config の borderRadius）を正とする。Tailwind v4 の既定値と同じなので実装では上書きしない
  DEFAULT: 0.25rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  gutter: 1.5rem
  gutter-mobile: 1rem
  margin: 2.5rem
  margin-mobile: 1.25rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2.5rem
  space-2xl: 4rem
  space-3xl: 6rem
---

## Brand & Style

This design system expresses a forward-looking, reliable, and deeply human modern corporate identity for technology, software development, and digital consultancy. Driven by clear cyan, deep maritime blues, and crystalline whites, the tone embodies intelligence, technical precision, and refreshing clarity.

> **実装メモ（2026-10-01）**: 本書の装飾に関する記載（グラスモーフィズム、すりガラスの背景、光るぼかし、ネットワークの点と線、半透明の円の重なり）は採用しない。見た目は design/stitch/*.html を正とし、本書と HTML が食い違う場合は常に HTML を優先する。採用している装飾は、青のグラデーション帯、翅の線のモチーフ、蝶の SVG、セクション背景の大きな英字（bleed word）、薄い影のカード。

### Design Movement & Aesthetic
- **Editorial Corporate Modernism:** Clean structural geometry anchored by high-contrast serif typography and generous whitespace, with magazine-like asymmetric layouts and large bleed lettering.
- **Tone & Persona:** Intellectual, reassuring, ambitious, and crystalline. The interface feels lightweight and luminous without sacrificing enterprise rigor and institutional trustworthiness.
- **Visual Tenets:**
  - *Luminance & Depth:* Rich cyan-to-cerulean gradients layered with frosted surfaces and delicate lines evoke modern network intelligence.
  - *Clarity & Air:* Generous whitespace paired with icy-blue neutral surfaces prevents visual fatigue and directs focus effortlessly.
  - *Humanity & Sharpness:* Crisp geometric titles paired with natural, high-legibility body type to ensure personal engagement alongside architectural professionalism.

## Colors

The color palette centers on radiant cyan and deep ocean blues, grounded by deep slate navy instead of pure black for editorial authority.

### Palette Architecture
- **Primary (`#009fe8` / Cyan Blue):** The signature vibrant hue for primary interactive elements, active highlights, key CTA gradients, and glowing accents.
- **Secondary (`#005a9c` / Deep Maritime):** Used for solid contrast CTAs, enterprise authority indicators, dark header backgrounds, and deep focal boundaries.
- **Tertiary (`#00c4ff` / Luminous Azure):** An ethereal highlight tone utilized for network nodes, link underlines, gradient edge stops, and decorative luminous blur spots.
- **Neutral Core (`#0f172a` Slate Charcoal):** High-readability primary text tone, providing warm depth compared to harsh pitch black. Secondary text rests comfortably in `#334155` (Slate Gray) and tertiary in `#64748b`.
- **Surfaces & Backgrounds:**
  - Base White: `#ffffff` for clean modular cards and editorial content strips.
  - Icy Canvas: `#f4fafd` to `#eef8fc` for alternating section backings, subtle containers, and atmospheric breathing zones.
  - Hero Deep Gradient: Soft transition from deep teal-cyan (`#002b49`) through vibrant ocean azure (`#0077b6`) to vivid cyan (`#009fe8`).

## Typography

書体は HTML で実際に使われているものを正とする（Plus Jakarta Sans / Inter は使わない）。

- **和文の見出し:** *Shippori Mincho B1*（400 / 700）。h1〜h3、キャッチコピー、「つくる・支える・守る」などの大きな和文。見出し下に短いアクセント線（`2px` × `48px`、primary または secondary）。
- **和文の本文:** *Zen Kaku Gothic New*（400 / 500 / 700）。基本 14px / 24px、リード文は 15〜16px / 行間 2.1。
- **英字:** *EB Garamond*（400 / 600）。ロゴ「OBFall」、グローバルナビ（小文字→大文字、字間広め）、英字ラベル、セクション背景の大きな英字（bleed word）、日付。
- **読み込み:** next/font でセルフホストし、使うウェイトのみ。和文 2 書体は unicode-range 分割のため preload しない。

## Layout & Spacing

A disciplined 12-column responsive fluid grid governs desktop viewports, scaling to 8 columns on tablet and 4 columns on mobile devices.

### Section Cadence & Rhythms
- **Vertical Spacing:** Generous breathing room (`space-2xl` to `space-3xl`) between major content sections creates an airy, luxurious, and uncluttered reading flow that allows architectural imagery and network illustrations to resonate.
- **Alternating Layout Structure:** Two-column section patterns rhythmically alternate between text blocks and abstract organic/network shapes, maintaining visual momentum down the page.
- **Max Content Bounds:** Desktop content reaches an optimal reading width of `1180px` centered within outer fluid margins.
- **Responsive Adaptations:**
  - *Desktop (≥1024px):* Split asymmetric compositions, staggered illustrations, fixed multi-column footers.
  - *Tablet (768px - 1023px):* 8 columns, reduced outer margin to `2rem`, compressed vertical padding.
  - *Mobile (<768px):* Linear single-column stack, graphic assets placed above or integrated seamlessly behind textual descriptions with reduced spacing (`space-xl`).

## Elevation & Depth

Visual hierarchy leverages crisp surface layering, ethereal cyan-tinted atmospheric glows, and precise low-contrast outlines rather than heavy murky drop shadows.

### Elevation Tiers
1. **Level 0 (Base Canvas):** `surface` (#faf8ff) / `surface-container-lowest` (#ffffff) / `surface-container-low` (#f2f3ff) をセクションごとに交互に使う。
2. **Level 1 (Cards):** `rounded-xl` + `shadow-sm`（hover で `shadow-md`）。枠線は付けない。
3. **Level 2 (Navigation):** 固定ヘッダーは `surface` 85% + `backdrop-blur` と薄い影（`0 1px 8px rgba(0,0,0,0.04)`）。すりガラス表現はこの 1 箇所のみ（HTML どおり）。
4. **Hero / Title Band:** 青のグラデーション（#003254 → #004e8c → #00a6ff、下層は on-background → primary → secondary）に翅の線のモチーフを 20〜25% の不透明度で重ねる。光るぼかし・半透明の円・ネットワークの点は使わない。

## Shapes

The design system incorporates a refined medium-rounded geometric language (`roundedness: 2` / base `8px`), balancing contemporary digital softness with structural corporate authority.

### Geometry Specifications
- **Interactive Buttons & Controls:** Formed with full pill curvature (`9999px`) or refined `8px` rounded rectangles for crisp precision. Small action pills and tag badges carry pill radii for approachability.
- **Cards, Modals & Containers:** Standardized at `12px` to `16px` radius (`rounded-lg`), giving content surfaces a clean, welcoming containment without feeling toy-like.
- **Decorative & Graphic Metaphors:** Organic circular lenses, overlapping liquid blurs, and interconnected polygonal nodes echo the corporate motif of interconnectivity, agility, and human harmony.

## Components

### Buttons
- **Primary Solid:** Dark navy (`#0f172a`) or solid ocean cyan (`#009fe8`) base, white text, fully rounded pill (`border-radius: 9999px`) or `8px` radius. Includes a circular trailing icon indicator (e.g., arrow inside a white or cyan circle).
- **Secondary Ghost / Outline:** Transparent background, `1.5px` border in `#009fe8` with hover tint fill `rgba(0, 159, 232, 0.05)`, text in `#0077b6`.
- **Hero Inverse Button:** Dark obsidian background (`#0f172a`) or glass surface (`rgba(255, 255, 255, 0.15)`) with crisp white typography and smooth subtle expansion on hover.

### Section Headers with Cyan Accent
- Two-tier typography: small uppercase Japanese/English context label (e.g., `サービス` / `SERVICE`) in `#009fe8` or `#334155`.
- Bold English title with an architectural cyan underline (`height: 2px; width: 48px; background: #009fe8`) sitting directly below.

### Cards
- **Feature & Service Cards:** Pure `#ffffff` background with hairline cyan border (`1px solid #e2f1fb`). Generous padding (`space-xl`), soft lift on hover with intensified cyan glow shadow (`0 12px 32px rgba(0, 159, 232, 0.12)`).
- **News / Achievement List Cards:** Minimalist divider-based lists (`border-bottom: 1px solid #eef2f6`), featuring date stamps in muted slate, category chips in light cyan tint, and link arrow indicators.

### Form Inputs & Checkboxes
- **Text Inputs:** Clean `#ffffff` fill with `1px solid #cbd5e1` resting state, transitioning on focus to `#009fe8` with an ambient glow ring (`box-shadow: 0 0 0 3px rgba(0, 159, 232, 0.15)`).
- **Checkboxes & Radios:** `20px` touch target with `#009fe8` active fill, crisp white check mark, and `4px` corner radius.

### Decorative Motifs
- **蝶（Butterfly）:** セクション境界に置く小さな SVG（`components/redesign/Butterfly.tsx`）。線色は `text-*`、翅の塗りと胴体色は props。
- **Bleed Word:** セクション背景に EB Garamond の大きな英字（SERVICE / ACHIEVEMENTS / ABOUT US / NEWS / RECRUIT）を `surface-container` 系の薄い色で敷く。`pointer-events-none` + `select-none`。
- **翅の線:** ヒーローと下層タイトル帯の背景に細い曲線を低い不透明度で重ねる。
- 半透明の円の重なりやネットワーク図は使わない。