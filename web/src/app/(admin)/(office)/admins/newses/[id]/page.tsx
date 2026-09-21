import type { Metadata } from "next";
import Link from "next/link";
import { redirect } from "next/navigation";
import Nl2br from "@/components/office/Nl2br";
import { publishStatusLabel } from "@/lib/news-schema";
import { getOfficeNewsById, resolveImageUrl } from "@/lib/newses";
import { officeNewsEditHref, officeNewsIndexHref, officeNewsIndexHrefWith, readBack } from "@/lib/office-news-links";
import { requireActiveAdmin } from "@/lib/office-session";

export const metadata: Metadata = {
  title: "お知らせ詳細 | OBFall株式会社",
};

function Row({ label, children }: { label: string; children: React.ReactNode }) {
  return (
    <div className="row">
      <label className="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">{label}</label>
      <div className="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">{children}</div>
    </div>
  );
}

function ImageOrNone({ url }: { url: string | null }) {
  const src = resolveImageUrl(url);
  // eslint-disable-next-line @next/next/no-img-element
  return src ? <img src={src} alt="お知らせ画像" width={200} /> : <>なし</>;
}

/**
 * 管理 お知らせ詳細 GET /admins/newses/{id}（§2.3 #36）
 * 現行: office/newses/show.blade.php + OfficeNewsesController@show
 * 存在しなければ一覧へ「お知らせが存在しません。」
 * ※ 現行は画像1が未設定でも <img src=""> を出す（画像2・3は「なし」）。移行後は画像1も「なし」にする（差分）
 */
export default async function OfficeNewsShowPage({ params, searchParams }: PageProps<"/admins/newses/[id]">) {
  await requireActiveAdmin();
  const { id: idParam } = await params;
  const back = readBack((await searchParams).back);
  const id = Number.parseInt(idParam, 10);

  const record = await getOfficeNewsById(id);
  if (!record) {
    redirect(officeNewsIndexHrefWith(back, { error: "notfound" }));
  }

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card">
        <div className="card-body">
          <div className="row">
            <div className="col-12 pt-2">
              <h5 className="card-title">お知らせ詳細</h5>
            </div>
          </div>
          {/* トップライト */}
          <div className="row">
            <div className="col-12 pb-2 text-end">
              <Link href={officeNewsIndexHref(back)} className="btn btn-outline-dark">
                戻る
              </Link>{" "}
              <Link href={officeNewsEditHref(record.id, back)} className="btn btn-warning">
                編集
              </Link>
            </div>
          </div>

          <Row label="ID">{record.id}</Row>
          <Row label="タイトル">{record.title}</Row>
          <Row label="内容">
            <Nl2br text={record.content} />
          </Row>
          <Row label="お知らせ画像1">
            <ImageOrNone url={record.news_image_url_1} />
          </Row>
          <Row label="お知らせ画像2">
            <ImageOrNone url={record.news_image_url_2} />
          </Row>
          <Row label="お知らせ画像3">
            <ImageOrNone url={record.news_image_url_3} />
          </Row>
          <Row label="公開ステータス">{publishStatusLabel(record.status)}</Row>
        </div>
      </div>
    </div>
  );
}
