import type { Metadata } from "next";
import Link from "next/link";
import { redirect } from "next/navigation";
import Nl2br from "@/components/office/Nl2br";
import { getOfficeDevelopmentById } from "@/lib/developments";
import { publishStatusLabel } from "@/lib/news-schema";
import { resolveImageUrl } from "@/lib/newses";
import { officeDevelopmentEditHref, officeDevelopmentsIndexHref, officeDevelopmentsIndexHrefWith } from "@/lib/office-development-links";
import { readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";

export const metadata: Metadata = {
  title: "自社開発詳細 | OBFall株式会社",
};

function Row({ label, children }: { label: string; children: React.ReactNode }) {
  return (
    <div className="row">
      <label className="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">{label}</label>
      <div className="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">{children}</div>
    </div>
  );
}

/**
 * 管理 自社開発詳細 GET /inhouse_developments/{id}（§2.3 #47）
 * 現行: office/inhouse_developments/show.blade.php + OfficeDevelopmentsController@show
 * ※ 現行は画像が未設定でも <img src=""> を出す。移行後は「なし」にする（お知らせと同じ差分）
 */
export default async function OfficeDevelopmentShowPage({ params, searchParams }: PageProps<"/inhouse_developments/[id]">) {
  await requireActiveAdmin();
  const { id: idParam } = await params;
  const back = readBack((await searchParams).back);
  const id = Number.parseInt(idParam, 10);

  const record = await getOfficeDevelopmentById(id);
  if (!record) {
    redirect(officeDevelopmentsIndexHrefWith(back, { error: "notfound" }));
  }
  const image = resolveImageUrl(record.inhouse_developments_image_url);

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card">
        <div className="card-body">
          <div className="row">
            <div className="col-12 pt-2">
              <h5 className="card-title">自社開発詳細</h5>
            </div>
          </div>
          <div className="row">
            <div className="col-12 pb-2 text-end">
              <Link href={officeDevelopmentsIndexHref(back)} className="btn btn-outline-dark">
                戻る
              </Link>{" "}
              <Link href={officeDevelopmentEditHref(record.id, back)} className="btn btn-warning">
                編集
              </Link>
            </div>
          </div>

          <Row label="ID">{record.id}</Row>
          <Row label="カテゴリ">{record.category}</Row>
          <Row label="タイトル">{record.title}</Row>
          <Row label="自社開発画像">
            {/* eslint-disable-next-line @next/next/no-img-element */}
            {image ? <img src={image} alt="自社開発画像" width={200} /> : "なし"}
          </Row>
          <Row label="内容">
            <Nl2br text={record.content} />
          </Row>
          <Row label="自社開発ホームページURL">{record.inhouse_developments_home_page_url}</Row>
          <Row label="公開ステータス">{publishStatusLabel(record.status)}</Row>
        </div>
      </div>
    </div>
  );
}
