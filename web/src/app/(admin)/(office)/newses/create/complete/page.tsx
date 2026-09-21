import type { Metadata } from "next";
import Link from "next/link";
import { officeNewsCreateHref, officeNewsIndexHref, readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";

export const metadata: Metadata = {
  title: "お知らせ登録完了 | OBFall株式会社",
};

/**
 * お知らせ登録完了 GET /newses/create/complete（§2.3 #40）
 * 現行: office/newses/create/complete.blade.php
 */
export default async function OfficeNewsCreateCompletePage({ searchParams }: PageProps<"/newses/create/complete">) {
  await requireActiveAdmin();
  const back = readBack((await searchParams).back);
  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card">
        <div className="card-body">
          <div className="row">
            <div className="col-12 pt-2">
              <h5 className="card-title">お知らせ登録完了</h5>

              <div className="row pb-2">
                <div className="col-12">
                  <div className="mt-3">
                    <div className="text-break w-100">お知らせを登録しました。</div>
                  </div>
                </div>
              </div>

              <div className="row">
                <div className="col-auto pb-2">
                  <Link href={officeNewsIndexHref(back)} className="btn btn-primary">
                    お知らせ一覧
                  </Link>
                </div>
                <div className="col-auto pb-2">
                  <Link href={officeNewsCreateHref(back)} className="btn btn-primary">
                    引き続きお知らせを登録する
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
