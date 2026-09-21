import type { ReactNode } from "react";
import OfficeAuthShell from "@/components/office/OfficeAuthShell";

/**
 * 未ログイン用ページ（ログイン / 初期設定 / PW 忘れ / PW 設定 / 完了画面）の共通枠。
 * 現行 office/parts/app.blade.php の @guest ブロック（authentication-wrapper の中のカード）。
 */
export default function OfficeGuestLayout({ children }: { children: ReactNode }) {
  return <OfficeAuthShell>{children}</OfficeAuthShell>;
}
