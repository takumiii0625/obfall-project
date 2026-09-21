import type { ReactNode } from "react";
import OfficeNavbar from "@/components/office/OfficeNavbar";
import OfficeScripts from "@/components/office/OfficeScripts";
import OfficeSideMenu from "@/components/office/OfficeSideMenu";
import { requireActiveAdmin } from "@/lib/office-session";

/**
 * ログイン後の管理レイアウト（現行 office/parts/app.blade.php のログイン後ブロック）。
 * サイドメニュー + ヘッダー + content-wrapper。毎リクエスト requireActiveAdmin() で有効性を確認する。
 * Sneat の JS は OfficeScripts がハイドレーション後に現行と同じ順序で読み込む（理由はそちらのコメント参照）。
 */
export default async function OfficeLayout({ children }: { children: ReactNode }) {
  await requireActiveAdmin();

  return (
    <>
      <div className="layout-wrapper layout-content-navbar">
        <div className="layout-container">
          <OfficeSideMenu />
          <div className="layout-page">
            <OfficeNavbar />
            <div className="content-wrapper">
              {children}
              <div className="content-backdrop fade"></div>
            </div>
          </div>
        </div>
        {/* Overlay */}
        <div className="layout-overlay layout-menu-toggle"></div>
      </div>
      <OfficeScripts />
    </>
  );
}
