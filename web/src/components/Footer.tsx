"use client";

import Link from "next/link";

/**
 * 共通フッター（現行 components/footer.blade.php の移植）
 * ロゴクリックでページトップへスムーススクロール（現行の scrollToTop()）
 * 問い合わせ系3画面（contact / confirm / complete）は独自フッターで右列の
 * 「お問い合わせはこちら」ボタンが無い（列 div は空のまま残る）→ showContactButton={false}
 */
type Props = {
  showContactButton?: boolean;
};

export default function Footer({ showContactButton = true }: Props = {}) {
  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  return (
    <footer>
      <div className="devwrap d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
        {/* PC:左 / SP:一番上（ロゴ＋ページトップへ） */}
        <div className="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center order-1 order-md-1">
          {/* eslint-disable-next-line @next/next/no-img-element */}
          <img
            src="/image/logo_OBFall_white.png"
            className="link logo"
            onClick={scrollToTop}
            alt="OBFall株式会社ロゴ"
          />
        </div>

        {/* PC:中央 / SP:一番下（住所など） */}
        <div className="footer-left col-12 col-md-4 order-3 order-md-2 text-center text-md-start">
          <p>
            〒105-0022
            <br />
            東京都港区海岸1-2-3&nbsp;&nbsp;汐留芝離宮ビルディング 21F
            <br />
            TEL:03-5403-5904
            <br />
            <Link href="/human-rights-policy" target="_blank" className="human-rights-policy">
              人権に関する基本方針と社内相談窓口
            </Link>
          </p>
        </div>

        {/* PC:右 / SP:2番目（お問い合わせボタン） */}
        <div className="col-12 col-md-4 d-flex justify-content-center align-items-center order-2 order-md-3">
          {showContactButton ? (
            <Link href="/contact" className="link-button" target="_blank" rel="noopener noreferrer">
              お問い合わせはこちら <i className="fa-solid fa-circle-arrow-right ms-1"></i>
            </Link>
          ) : null}
        </div>
      </div>
    </footer>
  );
}
