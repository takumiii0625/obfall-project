import Link from "next/link";
import ArrowIcon from "./ArrowIcon";

/**
 * リデザイン版の共通フッター（design/stitch/aboutus.html のフッターを参考）。
 * 文言は既存 components/Footer.tsx（現行 footer.blade.php）のもの + 「© OBFall Inc.」のみ。
 * リンクの開き方（人権方針・問い合わせは別タブ）は既存フッターに合わせる。
 * 問い合わせ系の画面は既存どおり「お問い合わせはこちら」ボタンを出さない（showContactButton={false}）。
 */
export default function Footer({ showContactButton = true }: { showContactButton?: boolean } = {}) {
  return (
    <footer className="mt-space-3xl w-full bg-surface-container-low shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
      <div className="wrap py-space-2xl">
        <div className="flex flex-col items-start justify-between gap-space-xl border-b border-surface-container-highest pb-space-xl lg:flex-row lg:items-center">
          <div className="space-y-space-sm">
            <Link href="/" className="inline-flex items-center gap-space-xs" aria-label="OBFall株式会社 トップ">
              <span className="font-latin text-[22px] font-bold tracking-tight text-on-surface">OBFall</span>
              <span className="inline-block h-2.5 w-2.5 translate-y-0.5 rounded-full bg-primary-container" aria-hidden="true" />
            </Link>
            <p className="text-sm leading-relaxed text-on-surface-variant">
              〒105-0022
              <br />
              東京都港区海岸1-2-3&nbsp;&nbsp;汐留芝離宮ビルディング 21F
              <br />
              <span className="font-medium text-on-surface">TEL:03-5403-5904</span>
            </p>
          </div>

          <div className="flex w-full flex-col items-stretch gap-space-md sm:flex-row sm:items-center lg:w-auto">
            <Link
              href="/human-rights-policy"
              target="_blank"
              className="text-xs text-on-surface-variant underline-offset-4 transition-colors hover:text-primary hover:underline"
            >
              人権に関する基本方針と社内相談窓口
            </Link>
            {showContactButton ? (
              <Link
                href="/contact"
                target="_blank"
                rel="noopener noreferrer"
                className="inline-flex items-center justify-center gap-space-sm rounded-full bg-on-surface px-space-lg py-space-sm text-sm font-medium text-on-secondary transition-all hover:bg-secondary"
              >
                <span>お問い合わせはこちら</span>
                <ArrowIcon className="h-[18px] w-[18px]" />
              </Link>
            ) : null}
          </div>
        </div>

        <div className="flex items-center justify-start pt-space-lg">
          <p className="font-latin text-xs text-outline">© OBFall Inc.</p>
        </div>
      </div>
    </footer>
  );
}
