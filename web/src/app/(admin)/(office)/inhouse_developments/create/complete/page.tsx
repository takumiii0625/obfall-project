import type { Metadata } from "next";
import Link from "next/link";
import { officeDevelopmentCreateHref, officeDevelopmentsIndexHref } from "@/lib/office-development-links";
import { readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";

export const metadata: Metadata = {
  title: "自社開発登録完了 | OBFall株式会社",
};

/** 自社開発登録完了 GET /inhouse_developments/create/complete（§2.3 #51） */
export default async function OfficeDevelopmentCreateCompletePage({ searchParams }: PageProps<"/inhouse_developments/create/complete">) {
  await requireActiveAdmin();
  const back = readBack((await searchParams).back);
  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card">
        <div className="card-body">
          <div className="row">
            <div className="col-12 pt-2">
              <h5 className="card-title">自社開発登録完了</h5>
              <div className="row pb-2">
                <div className="col-12">
                  <div className="mt-3">
                    <div className="text-break w-100">自社開発を登録しました。</div>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-auto pb-2">
                  <Link href={officeDevelopmentsIndexHref(back)} className="btn btn-primary">
                    自社開発一覧
                  </Link>
                </div>
                <div className="col-auto pb-2">
                  <Link href={officeDevelopmentCreateHref(back)} className="btn btn-primary">
                    引き続き自社開発を登録する
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
