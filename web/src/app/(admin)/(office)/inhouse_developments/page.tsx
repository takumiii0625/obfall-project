import type { Metadata } from "next";
import Link from "next/link";
import DeleteRowButton from "@/components/office/DeleteRowButton";
import Nl2br from "@/components/office/Nl2br";
import OfficeAlert from "@/components/office/OfficeAlert";
import OfficePagination from "@/components/office/OfficePagination";
import { formatJaDate } from "@/lib/dates";
import { searchOfficeDevelopments } from "@/lib/developments";
import { PUBLISH_STATUS, PUBLISH_STATUS_KEYS, publishStatusLabel } from "@/lib/news-schema";
import { OFFICE_PER_PAGE_OPTIONS, normalizeOfficePerPage } from "@/lib/newses";
import {
  OFFICE_DEVELOPMENTS_INDEX,
  officeDevelopmentCreateHref,
  officeDevelopmentEditHref,
  officeDevelopmentShowHref,
} from "@/lib/office-development-links";
import { MSG_DB_ERROR } from "@/lib/office-form-state";
import { requireActiveAdmin } from "@/lib/office-session";
import { paginate } from "@/lib/pagination";
import { deleteDevelopmentAction } from "./actions";

export const metadata: Metadata = {
  title: "自社開発一覧 | OBFall株式会社",
};

const FLASH_SUCCESS: Record<string, string> = { deleted: "削除しました。" };
const FLASH_ERROR: Record<string, string> = { notfound: "自社開発が存在しません。", db: MSG_DB_ERROR };

type Search = Record<string, string | string[] | undefined>;
const first = (v: string | string[] | undefined) => (Array.isArray(v) ? v[0] : v) ?? "";
const list = (v: string | string[] | undefined) => (Array.isArray(v) ? v : v !== undefined ? [v] : []);

/**
 * 管理 自社開発一覧 GET /inhouse_developments（§2.3 #46）
 * 現行: office/inhouse_developments/index.blade.php + OfficeDevelopmentsController@index
 * 構成はお知らせ一覧と同じ（列にカテゴリが加わる）。
 */
export default async function OfficeDevelopmentsIndexPage({ searchParams }: PageProps<"/inhouse_developments">) {
  await requireActiveAdmin();
  const params = (await searchParams) as Search;

  const title = first(params.title);
  const content = first(params.content);
  const statusValues = [...list(params["status[]"]), ...list(params.status)].filter((s) => (PUBLISH_STATUS_KEYS as string[]).includes(s));
  const perPage = normalizeOfficePerPage(first(params.per_page));
  const accordion = first(params.accordion);
  const requestedPage = Number.parseInt(first(params.page) || "1", 10);

  const { rows, total } = await searchOfficeDevelopments(
    { title, content, statuses: statusValues.map(Number) },
    (Math.max(1, requestedPage || 1) - 1) * perPage,
    perPage,
  );
  const pager = paginate(total, perPage, requestedPage);

  const query = new URLSearchParams();
  if (accordion) query.set("accordion", accordion);
  query.set("per_page", String(perPage));
  if (title) query.set("title", title);
  if (content) query.set("content", content);
  for (const s of statusValues) query.append("status[]", s);
  if (pager.currentPage > 1) query.set("page", String(pager.currentPage));
  const back = query.toString();
  const pageHref = (page: number) => {
    const q = new URLSearchParams(query);
    q.set("page", String(page));
    return `${OFFICE_DEVELOPMENTS_INDEX}?${q.toString()}`;
  };

  const success = FLASH_SUCCESS[first(params.deleted) ? "deleted" : ""] ?? null;
  const error = FLASH_ERROR[first(params.error)] ?? null;
  const isOpen = !!accordion;

  const pagerBlock = (
    <div className="row">
      <div className="col-12 text-end">
        <OfficePagination currentPage={pager.currentPage} lastPage={pager.lastPage} pageHref={pageHref} />
      </div>
    </div>
  );

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card">
        <div className="card-body">
          <OfficeAlert success={success} error={error} />

          <div className="row">
            <div className="col-6 pt-2">
              <h5 className="card-title">自社開発一覧</h5>
            </div>
            <div className="col-6 pt-2 text-end">
              <Link href={officeDevelopmentCreateHref(back)} className="btn btn-primary">
                登録
              </Link>
            </div>
          </div>

          {/* 検索条件 */}
          <div className="row">
            <div className="col-12 mb-4 order-0">
              <div className="accordion mt-3" id="accordionSearchArea">
                <div className={`card p-3 accordion-item ${isOpen ? "active" : ""}`}>
                  <div className="row">
                    <h2 className="accordion-header" id="headingSearch">
                      <button
                        type="button"
                        className={`p-0 text-warning accordion-button ${isOpen ? "" : "collapsed"}`}
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseSearch"
                        aria-expanded={isOpen ? "true" : "false"}
                        aria-controls="collapseSearch"
                      >
                        検索条件
                      </button>
                    </h2>
                  </div>
                  <form method="GET" action={OFFICE_DEVELOPMENTS_INDEX}>
                    <input type="hidden" name="accordion" defaultValue={accordion} />
                    <input type="hidden" name="per_page" value={perPage} readOnly />
                    <div
                      id="collapseSearch"
                      className={`accordion-collapse collapse ${isOpen ? "show" : ""}`}
                      aria-labelledby="headingSearch"
                      data-bs-parent="#accordionSearchArea"
                    >
                      <div className="accordion-body p-0">
                        <div className="row">
                          <div className="col-6 col-md-3 pt-2">
                            <label className="form-label" htmlFor="title" role="button">
                              タイトル
                            </label>
                            <input type="text" name="title" defaultValue={title} className="form-control" id="title" />
                          </div>
                          <div className="col-6 col-md-3 pt-2">
                            <label className="form-label" htmlFor="content" role="button">
                              内容
                            </label>
                            <input type="text" name="content" defaultValue={content} className="form-control" id="content" />
                          </div>
                          <div className="col-6 col-md-3 pt-2">
                            <label className="form-label" htmlFor="status" role="button">
                              公開ステータス
                            </label>
                            <div className="d-flex flex-wrap">
                              {PUBLISH_STATUS_KEYS.map((key) => (
                                <div className="form-check me-3" key={key}>
                                  <input
                                    className="form-check-input"
                                    type="checkbox"
                                    name="status[]"
                                    id={`status_${key}`}
                                    value={key}
                                    defaultChecked={statusValues.includes(key)}
                                  />
                                  <label className="form-check-label" htmlFor={`status_${key}`}>
                                    {PUBLISH_STATUS[key]}
                                  </label>
                                </div>
                              ))}
                            </div>
                          </div>
                        </div>
                        <div className="row">
                          <div className="col-12">
                            <button type="submit" className="btn btn-success w-100 text-white rounded-2 mt-3 py-1 form">
                              検索する
                            </button>
                          </div>
                        </div>
                        <div className="row">
                          <div className="col-12">
                            <Link href={OFFICE_DEVELOPMENTS_INDEX} className="btn btn-outline-dark w-100 rounded-2 mt-3 py-1">
                              検索条件をクリアする
                            </Link>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div className="row my-3">
            <div className="col-12">
              <div className="row mt-4 align-items-center">
                <div className="col-md-6 text-start">該当件数 : {pager.total.toLocaleString("ja-JP")}件</div>
                <div className="col-md-6 text-end">
                  <label htmlFor="perPage" className="me-2">
                    表示件数 :{" "}
                  </label>
                  <select name="per_page" id="perPage" className="form-select d-inline w-auto" defaultValue={String(perPage)}>
                    {OFFICE_PER_PAGE_OPTIONS.map((n) => (
                      <option value={n} key={n}>
                        {n}
                      </option>
                    ))}
                  </select>
                </div>
              </div>
              <div className="mt-4">{pagerBlock}</div>

              <div className="table-responsive text-nowrap">
                <table className="table table-bordered">
                  <thead>
                    <tr className="bg-black">
                      {["ID", "カテゴリ", "タイトル", "内容", "公開ステータス", "登録日"].map((h) => (
                        <th scope="col" className="text-white fw-bold py-2" key={h}>
                          {h}
                        </th>
                      ))}
                      <th scope="col" className="text-center text-white fw-bold py-2">
                        操作
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    {rows.length === 0 ? (
                      <tr>
                        {/* 現行は colspan=6（列数 7 と不一致）。移行後は 7 に合わせる */}
                        <td colSpan={7}>データがありません。</td>
                      </tr>
                    ) : (
                      rows.map((record) => (
                        <tr key={record.id} className={record.status === 0 ? "bg-lighter" : ""}>
                          <td className="py-2">{record.id.toLocaleString("ja-JP")}</td>
                          <td className="py-2">{record.category}</td>
                          <td className="py-2">{record.title}</td>
                          <td className="py-2">
                            <Nl2br text={record.content} />
                          </td>
                          <td className="py-2">{publishStatusLabel(record.status)}</td>
                          <td className="py-2">{formatJaDate(record.created_at)}</td>
                          <td className="text-center py-2">
                            <Link
                              href={officeDevelopmentShowHref(record.id, back)}
                              className="btn btn-sm btn-icon btn-outline-info me-2"
                              title="詳細"
                            >
                              <i className="bx bx-xs bx-info-square"></i>
                            </Link>
                            <Link
                              href={officeDevelopmentEditHref(record.id, back)}
                              className="btn btn-sm btn-icon btn-outline-warning me-2"
                              title="編集"
                            >
                              <i className="bx bx-xs bxs-pencil"></i>
                            </Link>
                            <DeleteRowButton action={deleteDevelopmentAction.bind(null, record.id, back)} />
                          </td>
                        </tr>
                      ))
                    )}
                  </tbody>
                </table>
              </div>

              <div className="row mt-4">
                <div className="col-12">該当件数 : {pager.total.toLocaleString("ja-JP")}件</div>
              </div>
              {pagerBlock}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
