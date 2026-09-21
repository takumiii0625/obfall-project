import type { ReactNode } from "react";
import Link from "next/link";

/**
 * 未ログイン時の認証カード（現行 office/parts/app.blade.php の @guest ブロック）。
 * ログイン / 初期設定 / PW 忘れ / PW 設定 / ワンタイムキーの各画面を包む。
 * ※ ロゴ /logo.png は現行でも存在しない（§7.1 の 18）。現行どおりのパスのまま
 */
export default function OfficeAuthShell({ children }: { children: ReactNode }) {
  return (
    <>
      {/* 現行は @guest のときだけ page-auth.css を読む（public/ のベンダー CSS のため <link> で読む） */}
      {/* eslint-disable-next-line @next/next/no-css-tags */}
      <link href="/backend/vendor/css/pages/page-auth.css" rel="stylesheet" precedence="default" />
      <div className="container-xxl">
        <div className="authentication-wrapper authentication-basic container-p-y">
          <div className="authentication-inner">
            <div className="card">
              <div className="app-brand justify-content-center pt-12 pb-2">
                <Link href="/admins/newses" className="app-brand-link gap-2">
                  <span className="app-brand-logo">
                    {/* eslint-disable-next-line @next/next/no-img-element */}
                    <img src="/logo.png" alt="" width={300} />
                  </span>
                </Link>
              </div>
              {children}
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
