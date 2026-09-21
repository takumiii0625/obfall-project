import type { Metadata } from "next";
import Link from "next/link";
import { officeNewsIndexHref, officeNewsShowHref, readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";

export const metadata: Metadata = {
  title: "お知らせ編集完了 | OBFall株式会社",
};

/**
 * お知らせ編集完了 GET /newses/{id}/edit/complete（§2.3 #44）
 * 現行: office/newses/edit/complete.blade.php
 */
export default async function OfficeNewsEditCompletePage({ params, searchParams }: PageProps<"/newses/[id]/edit/complete">) {
  await requireActiveAdmin();
  const { id: idParam } = await params;
  const back = readBack((await searchParams).back);
  const id = Number.parseInt(idParam, 10);

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card">
        <div className="card-body">
          <div className="row">
            <div className="col-12 pt-2">
              <h5 className="card-title">お知らせ編集完了</h5>

              <div className="row pb-2">
                <div className="col-12">
                  <div className="mt-3">
                    <div className="text-break w-100">お知らせを編集しました。</div>
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
                  <Link href={officeNewsShowHref(id, back)} className="btn btn-primary">
                    お知らせ詳細
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
