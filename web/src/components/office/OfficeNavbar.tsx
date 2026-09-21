/**
 * ヘッダー（現行 office/parts/header.blade.php）。
 * XL 未満でだけ表示され、ハンバーガーでサイドメニューを開く。左右メニューは現行でもコメントアウトで空。
 */
export default function OfficeNavbar() {
  return (
    <nav
      className="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme container-fluid d-xl-none"
      id="layout-navbar"
    >
      <div className="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0">
        {/* ハンバーガー */}
        <a className="nav-item nav-link px-0 me-xl-4" href="#">
          <i className="bx bx-menu bx-sm"></i>
        </a>
      </div>
      <div className="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        {/* 左側メニュー（現行は空） */}
        <div className="navbar-nav align-items-center"></div>
        {/* 右側メニュー（現行は空） */}
        <ul className="navbar-nav flex-row align-items-center ms-auto"></ul>
      </div>
    </nav>
  );
}
