/**
 * グローバルナビの項目。
 * 現行 header.blade.php（PC: nav-01）と各ビューの nav-02（SP ドロワー）で同一の5項目。
 * href は現行 routes/web.php のパスに合わせる。
 */
export type NavItem = {
  label: string;
  href: string;
  /** CONTACT のみ別タブ */
  newTab?: boolean;
};

export const NAV_ITEMS: NavItem[] = [
  { label: "PHILOSOPHY", href: "/philosophy" },
  { label: "SERVICE", href: "/service" },
  { label: "ACHIEVEMENTS", href: "/achievements" },
  { label: "ABOUT US", href: "/aboutus" },
  { label: "CONTACT", href: "/contact", newTab: true },
];
