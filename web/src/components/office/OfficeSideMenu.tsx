import Link from "next/link";

/**
 * サイドメニュー（現行 office/parts/side.blade.php）。
 * 開閉（.layout-menu-toggle）は Sneat の menu.js / main.js が担当する。
 */
export default function OfficeSideMenu() {
  return (
    <aside id="layout-menu" className="layout-menu menu-vertical menu bg-menu-theme">
      <div className="app-brand pt-3">
        <Link href="/admins/newses" className="app-brand-link">
          <span className="app-brand-logo">
            {/* eslint-disable-next-line @next/next/no-img-element */}
            <img src="/image/logo_OBFall.png" alt="ロゴ" height="20px" />
          </span>
        </Link>

        <a href="#" className="layout-menu-toggle menu-link text-large ms-auto">
          <i className="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
      </div>

      <div className="menu-inner-shadow"></div>

      <ul className="menu-inner py-1 ps">
        {/* ホーム */}
        <li className="menu-item">
          <Link href="/" className="menu-link">
            <i className="menu-icon tf-icons bx bx-home"></i>
            <div className="text-truncate">ホームページ</div>
          </Link>
        </li>

        {/* 自社開発一覧 */}
        <li className="menu-item">
          <Link href="/inhouse_developments" className="menu-link">
            <i className="menu-icon tf-icons bx bx-list-ul"></i>
            <div className="text-truncate">自社開発一覧</div>
          </Link>
        </li>

        {/* お知らせ */}
        <li className="menu-item">
          <Link href="/admins/newses" className="menu-link">
            <i className="menu-icon tf-icons bx bx-news"></i>
            <div className="text-truncate">お知らせ一覧</div>
          </Link>
        </li>

        {/* ログアウト */}
        <li className="menu-item">
          {/* ログアウトは Route Handler（route.ts）へのフルページ遷移なので <Link> にしない。
              公開側の 404 用キャッチオールがあるため lint がページへのリンクと誤認する */}
          {/* eslint-disable-next-line @next/next/no-html-link-for-pages */}
          <a href="/office/logout" className="menu-link">
            <i className="menu-icon tf-icons bx bx-log-out"></i>
            <div className="text-truncate">ログアウト</div>
          </a>
        </li>
      </ul>
    </aside>
  );
}
