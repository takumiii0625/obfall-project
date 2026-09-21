import Link from "next/link";
import type { ReactNode } from "react";

type Props = {
  title: string;
  children: ReactNode;
};

/**
 * 認証系の完了画面（現行 office/auth/**\/complete.blade.php）。見出し + 文言 + 「ログイン」ボタン。
 * 現行の <p><div>…</div></p> という入れ子は React では描画できないため <p> → <div class="mt-3"> に置き換える（見た目同等）。
 */
export default function OfficeCompleteCard({ title, children }: Props) {
  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card p-3">
        <div className="card-body">
          <div className="row">
            <div className="col-12 pt-2">
              <h5 className="card-title">{title}</h5>

              <div className="row pb-2">
                <div className="col-12">
                  <div className="mt-3">
                    <div className="text-break w-100">{children}</div>
                  </div>
                </div>
              </div>

              <div className="row">
                <div className="col-auto pb-2">
                  <Link href="/office/login" className="btn btn-primary">
                    ログイン
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
