"use client";

import Link from "next/link";
import { startTransition, useActionState, useState, type ChangeEvent } from "react";
import Nl2br from "@/components/office/Nl2br";
import OfficeAlert from "@/components/office/OfficeAlert";
import OfficeFormRow from "@/components/office/OfficeFormRow";
import type { DevelopmentFormField, DevelopmentFormState, DevelopmentFormValues } from "@/lib/development-form-state";
import { DEVELOPMENT_IMAGE_FIELD, validateDevelopmentFields } from "@/lib/development-schema";
import { PUBLISH_STATUS, PUBLISH_STATUS_KEYS, publishStatusLabel, validateImageFile } from "@/lib/news-schema";
import { officeDevelopmentsIndexHref } from "@/lib/office-development-links";

type Props = {
  mode: "create" | "edit";
  action: (prev: DevelopmentFormState, formData: FormData) => Promise<DevelopmentFormState>;
  initialState: DevelopmentFormState;
  /** 編集時の既存画像（表示用 URL） */
  existingImage?: string | null;
  back: string;
};

type FieldErrors = Partial<Record<DevelopmentFormField, string>>;

/**
 * 自社開発 登録・編集フォーム（現行 office/inhouse_developments/{create,edit}/{input,confirm}.blade.php を1コンポーネントに統合）。
 * 構成は NewsForm と同じ。画像は1枚。
 * ※ 現行の編集画面には画像の削除チェックが無い（コントローラは delete_inhouse_developments_image_url を受けるがビューに無い）。
 *   現行どおり出さない（差し替えのみ可。確認事項として報告）
 */
export default function DevelopmentForm({ mode, action, initialState, existingImage = null, back }: Props) {
  const [state, formAction, pending] = useActionState<DevelopmentFormState, FormData>(action, initialState);
  const [step, setStep] = useState<"input" | "confirm">("input");
  const [values, setValues] = useState<DevelopmentFormValues>(initialState.values);
  const [file, setFile] = useState<File | null>(null);
  const [preview, setPreview] = useState<string | null>(null);
  const [clientErrors, setClientErrors] = useState<FieldErrors>({});

  // Server Action がエラーを返したら入力画面に戻す（レンダー中の派生 state 更新）
  const [handledState, setHandledState] = useState(state);
  if (state !== handledState) {
    setHandledState(state);
    if (state.fieldErrors || state.error) setStep("input");
  }

  const fieldErrors: FieldErrors = { ...(state.fieldErrors ?? {}), ...clientErrors };

  const onChangeValue =
    (key: keyof DevelopmentFormValues) => (e: ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) =>
      setValues((v) => ({ ...v, [key]: e.target.value }));

  const onChangeFile = (e: ChangeEvent<HTMLInputElement>) => {
    const next = e.target.files?.[0] ?? null;
    if (preview) URL.revokeObjectURL(preview);
    setFile(next);
    setPreview(next ? URL.createObjectURL(next) : null);
  };

  const onConfirm = () => {
    const errors: FieldErrors = {};
    const validated = validateDevelopmentFields(values);
    if (!validated.ok) Object.assign(errors, validated.errors);
    if (file) {
      const message = validateImageFile(file);
      if (message) errors[DEVELOPMENT_IMAGE_FIELD] = message;
    }
    setClientErrors(errors);
    if (Object.keys(errors).length > 0) return;
    if (validated.ok) setValues(validated.data);
    setStep("confirm");
    window.scrollTo(0, 0);
  };

  const onExecute = () => {
    const fd = new FormData();
    fd.set("back", back);
    for (const [k, v] of Object.entries(values)) fd.set(k, v);
    if (file) fd.set(DEVELOPMENT_IMAGE_FIELD, file);
    startTransition(() => formAction(fd));
  };

  const isEdit = mode === "edit";
  const heading = isEdit ? "自社開発編集" : "自社開発登録";
  const shownImage = preview ?? existingImage;

  if (step === "confirm") {
    return (
      <div className="container-fluid flex-grow-1 container-p-y">
        <div className="card">
          <div className="card-body">
            <div className="row">
              <div className="col-12 pt-2">
                <h5 className="card-title">{heading}確認</h5>
              </div>
            </div>

            <div className="row pt-3">
              <div className="col-12">
                <form
                  className="form"
                  onSubmit={(e) => {
                    e.preventDefault();
                    onExecute();
                  }}
                >
                  <ConfirmRow label="カテゴリ">{values.category}</ConfirmRow>
                  {/* 現行: 登録確認は「自社開発名 / 自社開発説明」、編集確認は「タイトル / 内容」 */}
                  <ConfirmRow label={isEdit ? "タイトル" : "自社開発名"}>{values.title}</ConfirmRow>
                  {/* 現行: 登録確認は画像がある時だけ表示、編集確認は無ければ「なし」 */}
                  {isEdit || shownImage ? (
                    <ConfirmRow label="自社開発画像">
                      {/* eslint-disable-next-line @next/next/no-img-element */}
                      {shownImage ? <img src={shownImage} alt="商品画像" width={200} /> : "なし"}
                    </ConfirmRow>
                  ) : null}
                  <ConfirmRow label={isEdit ? "内容" : "自社開発説明"}>
                    <Nl2br text={values.content} />
                  </ConfirmRow>
                  <ConfirmRow label="自社開発ホームページURL">{values.inhouse_developments_home_page_url}</ConfirmRow>
                  <ConfirmRow label="公開ステータス">{publishStatusLabel(values.status)}</ConfirmRow>

                  <div className="my-3">
                    <button type="submit" className="btn btn-success d-grid w-100 text-white text-break" id="submit" disabled={pending}>
                      {isEdit ? "編集する" : "登録する"}
                    </button>
                  </div>
                  <div className="my-3">
                    <button
                      type="button"
                      className="text-break btn btn-outline-dark col-12 mb-0"
                      disabled={pending}
                      onClick={() => {
                        setStep("input");
                        window.scrollTo(0, 0);
                      }}
                    >
                      前のページに戻る
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card">
        <div className="card-body">
          <OfficeAlert error={state.error} />
          <div className="row">
            <div className="col-12 pt-2">
              <h5 className="card-title">{heading}</h5>
            </div>
          </div>

          <div className="row">
            <div className="col-12">
              <form
                className="form"
                noValidate
                onSubmit={(e) => {
                  e.preventDefault();
                  onConfirm();
                }}
              >
                <OfficeFormRow htmlFor="category" label="カテゴリ" required error={fieldErrors.category}>
                  <input type="text" name="category" value={values.category} onChange={onChangeValue("category")} id="category" className="form-control" />
                </OfficeFormRow>

                <OfficeFormRow htmlFor="title" label="タイトル" required error={fieldErrors.title}>
                  <input type="text" name="title" value={values.title} onChange={onChangeValue("title")} id="title" className="form-control" />
                </OfficeFormRow>

                <div className="row">
                  <label
                    className="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold"
                    htmlFor={DEVELOPMENT_IMAGE_FIELD}
                    role="button"
                  >
                    自社開発画像
                  </label>
                  <div className="col-md-8 form-text d-flex align-items-start flex-column pt-0 pb-2 py-md-2 fs-6">
                    <input
                      type="file"
                      name={DEVELOPMENT_IMAGE_FIELD}
                      id={DEVELOPMENT_IMAGE_FIELD}
                      className="form-control mb-2"
                      accept="image/*"
                      onChange={onChangeFile}
                    />
                    <div className="mb-2">
                      {shownImage ? (
                        // eslint-disable-next-line @next/next/no-img-element
                        <img id="imagePreview" src={shownImage} alt={isEdit ? "商品画像" : "自社開発画像"} width={200} />
                      ) : null}
                    </div>
                  </div>
                  {fieldErrors[DEVELOPMENT_IMAGE_FIELD] ? (
                    <>
                      <div className="col-md-3"></div>
                      <div className="col-md-8">
                        <div className="alert alert-danger mt-0 p-1 form-text" role="alert">
                          {fieldErrors[DEVELOPMENT_IMAGE_FIELD]}
                        </div>
                      </div>
                    </>
                  ) : null}
                </div>

                <OfficeFormRow htmlFor="content" label="内容" required error={fieldErrors.content}>
                  <textarea name="content" id="content" className="form-control" rows={5} value={values.content} onChange={onChangeValue("content")} />
                </OfficeFormRow>

                <OfficeFormRow
                  htmlFor="inhouse_developments_home_page_url"
                  label="自社開発ホームページURL"
                  error={fieldErrors.inhouse_developments_home_page_url}
                >
                  <input
                    type="text"
                    name="inhouse_developments_home_page_url"
                    value={values.inhouse_developments_home_page_url}
                    onChange={onChangeValue("inhouse_developments_home_page_url")}
                    id="inhouse_developments_home_page_url"
                    className="form-control"
                  />
                </OfficeFormRow>

                <OfficeFormRow htmlFor="status" label="公開ステータス" required error={fieldErrors.status}>
                  <select name="status" id="status" className="form-control" value={values.status} onChange={onChangeValue("status")}>
                    {!isEdit ? <option value="">未選択</option> : null}
                    {PUBLISH_STATUS_KEYS.map((key) => (
                      <option value={key} key={key}>
                        {PUBLISH_STATUS[key]}
                      </option>
                    ))}
                  </select>
                </OfficeFormRow>

                <div className="mt-3">
                  <button type="submit" className="btn btn-success d-grid w-100 text-white text-break" id="submit" disabled={pending}>
                    確認する
                  </button>
                </div>
                <div className="my-3">
                  <Link href={officeDevelopmentsIndexHref(back)} className="text-break btn btn-outline-dark col-12 mb-0">
                    前のページに戻る
                  </Link>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

function ConfirmRow({ label, children }: { label: string; children: React.ReactNode }) {
  return (
    <div className="row">
      <label className="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">{label}</label>
      <div className="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">{children}</div>
    </div>
  );
}
