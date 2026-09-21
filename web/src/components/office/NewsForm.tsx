"use client";

import Link from "next/link";
import { startTransition, useActionState, useEffect, useRef, useState, type ChangeEvent } from "react";
import Nl2br from "@/components/office/Nl2br";
import OfficeAlert from "@/components/office/OfficeAlert";
import OfficeFormRow from "@/components/office/OfficeFormRow";
import type { NewsFormField, NewsFormState, NewsFormValues } from "@/lib/news-form-state";
import {
  IMAGE_SLOTS,
  PUBLISH_STATUS,
  PUBLISH_STATUS_KEYS,
  deleteImageFieldName,
  imageFieldName,
  publishStatusLabel,
  validateImageFile,
  validateNewsFields,
  type ImageSlot,
} from "@/lib/news-schema";
import { officeNewsIndexHref } from "@/lib/office-news-links";

type ImageState = {
  /** 既存画像の表示用 URL（編集のみ） */
  existing: string | null;
  file: File | null;
  /** file のプレビュー（URL.createObjectURL） */
  preview: string | null;
  /** 「この画像を削除する」（編集のみ） */
  remove: boolean;
};

type Props = {
  mode: "create" | "edit";
  /** create: createNewsAction / edit: id をバインド済みの updateNewsAction */
  action: (prev: NewsFormState, formData: FormData) => Promise<NewsFormState>;
  initialState: NewsFormState;
  /** 編集時の既存画像（表示用 URL）。登録時は空 */
  existingImages?: Record<ImageSlot, string | null>;
  /** 一覧のクエリ（戻るリンク用） */
  back: string;
};

type FieldErrors = Partial<Record<NewsFormField, string>>;

const emptyImage = (existing: string | null = null): ImageState => ({ existing, file: null, preview: null, remove: false });

/**
 * お知らせ 登録・編集フォーム（現行 office/newses/{create,edit}/{input,confirm}.blade.php を1コンポーネントに統合）。
 * 入力 → 確認 を React の状態で持ち、「登録する / 編集する」で初めて Server Action に送る（画像もこのとき送る）。
 * 現行は確認画面表示時点で画像を保存していたため、戻る・離脱で画像が残っていた（§3.4）。移行後は残らない。
 * バリデーションは確認へ進む前にクライアントで行い、Server Action でも同じスキーマで再検証する。
 */
export default function NewsForm({ mode, action, initialState, existingImages, back }: Props) {
  const [state, formAction, pending] = useActionState<NewsFormState, FormData>(action, initialState);
  const [step, setStep] = useState<"input" | "confirm">("input");
  const [values, setValues] = useState<NewsFormValues>(initialState.values);
  const [images, setImages] = useState<Record<ImageSlot, ImageState>>({
    1: emptyImage(existingImages?.[1] ?? null),
    2: emptyImage(existingImages?.[2] ?? null),
    3: emptyImage(existingImages?.[3] ?? null),
  });
  const [clientErrors, setClientErrors] = useState<FieldErrors>({});
  const formRef = useRef<HTMLFormElement>(null);

  // Server Action がエラーを返したら入力画面に戻す（現行の withInput + withError 相当）。
  // state が変わった描画中に派生 state を更新する（React 推奨の「レンダー中の setState」パターン）
  const [handledState, setHandledState] = useState(state);
  if (state !== handledState) {
    setHandledState(state);
    if (state.fieldErrors || state.error) setStep("input");
  }

  // プレビュー用 object URL の後始末
  useEffect(() => {
    return () => {
      for (const slot of IMAGE_SLOTS) {
        const p = images[slot].preview;
        if (p) URL.revokeObjectURL(p);
      }
    };
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const fieldErrors: FieldErrors = { ...(state.fieldErrors ?? {}), ...clientErrors };

  const onChangeValue = (key: keyof NewsFormValues) => (e: ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) =>
    setValues((v) => ({ ...v, [key]: e.target.value }));

  const onChangeFile = (slot: ImageSlot) => (e: ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0] ?? null;
    setImages((prev) => {
      if (prev[slot].preview) URL.revokeObjectURL(prev[slot].preview as string);
      return { ...prev, [slot]: { ...prev[slot], file, preview: file ? URL.createObjectURL(file) : null } };
    });
  };

  const onChangeRemove = (slot: ImageSlot) => (e: ChangeEvent<HTMLInputElement>) => {
    const remove = e.target.checked;
    setImages((prev) => ({ ...prev, [slot]: { ...prev[slot], remove } }));
  };

  /** 確認へ（クライアント側検証） */
  const onConfirm = () => {
    const errors: FieldErrors = {};
    const validated = validateNewsFields(values);
    if (!validated.ok) Object.assign(errors, validated.errors);
    for (const slot of IMAGE_SLOTS) {
      const file = images[slot].file;
      if (file) {
        const message = validateImageFile(file);
        if (message) errors[imageFieldName(slot)] = message;
      }
    }
    setClientErrors(errors);
    if (Object.keys(errors).length > 0) return;
    if (validated.ok) setValues(validated.data);
    setStep("confirm");
    window.scrollTo(0, 0);
  };

  /** 実行（Server Action へ送信。画像 File もここで送る） */
  const onExecute = () => {
    const fd = new FormData();
    fd.set("back", back);
    fd.set("title", values.title);
    fd.set("content", values.content);
    fd.set("status", values.status);
    for (const slot of IMAGE_SLOTS) {
      const img = images[slot];
      if (img.file) fd.set(imageFieldName(slot), img.file);
      if (img.remove) fd.set(deleteImageFieldName(slot), "1");
    }
    startTransition(() => formAction(fd));
  };

  /** 確認画面に出す画像（新規ファイル > 既存。削除チェック時は無し） */
  const confirmImage = (slot: ImageSlot): string | null => {
    const img = images[slot];
    if (img.file) return img.preview;
    if (img.remove) return null;
    return img.existing;
  };

  const isEdit = mode === "edit";
  const heading = isEdit ? "お知らせ編集" : "お知らせ登録";

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
                  {/* 現行: 登録確認は「お知らせ名 / お知らせ説明」、編集確認は「タイトル / 内容」 */}
                  <ConfirmRow label={isEdit ? "タイトル" : "お知らせ名"}>{values.title}</ConfirmRow>

                  {IMAGE_SLOTS.map((slot) => {
                    const src = confirmImage(slot);
                    // 現行: 登録確認は画像がある行だけ表示、編集確認は無ければ「なし」
                    if (!isEdit && !src) return null;
                    return (
                      <ConfirmRow label={`お知らせ画像${slot}`} key={slot}>
                        {/* eslint-disable-next-line @next/next/no-img-element */}
                        {src ? <img src={src} alt="お知らせ画像" width={200} /> : "なし"}
                      </ConfirmRow>
                    );
                  })}

                  <ConfirmRow label={isEdit ? "内容" : "お知らせ説明"}>
                    <Nl2br text={values.content} />
                  </ConfirmRow>

                  <ConfirmRow label="公開ステータス">{publishStatusLabel(values.status)}</ConfirmRow>

                  {/* 進むボタン */}
                  <div className="my-3">
                    <button type="submit" className="btn btn-success d-grid w-100 text-white text-break" id="submit" disabled={pending}>
                      {isEdit ? "編集する" : "登録する"}
                    </button>
                  </div>

                  {/* 戻るボタン */}
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
                ref={formRef}
                className="form"
                noValidate
                onSubmit={(e) => {
                  e.preventDefault();
                  onConfirm();
                }}
              >
                <OfficeFormRow htmlFor="title" label="タイトル" required error={fieldErrors.title}>
                  <input type="text" name="title" value={values.title} onChange={onChangeValue("title")} id="title" className="form-control" />
                </OfficeFormRow>

                {IMAGE_SLOTS.map((slot) => {
                  const name = imageFieldName(slot);
                  const img = images[slot];
                  const shown = img.preview ?? img.existing;
                  return (
                    <div className="row" key={slot}>
                      <label
                        className="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold"
                        htmlFor={name}
                        role="button"
                      >
                        お知らせ画像{slot}
                      </label>
                      <div className="col-md-8 form-text d-flex align-items-start flex-column pt-0 pb-2 py-md-2 fs-6">
                        <input type="file" name={name} id={name} className="form-control mb-2" accept="image/*" onChange={onChangeFile(slot)} />
                        <div className="mb-2">
                          {shown ? (
                            // eslint-disable-next-line @next/next/no-img-element
                            <img id={slot === 1 ? "imagePreview" : `imagePreview${slot}`} src={shown} alt="お知らせ画像" width={200} />
                          ) : null}
                          {/* 現行: 編集画面の画像2・3にだけ削除チェックがある */}
                          {isEdit && img.existing && slot !== 1 ? (
                            <div className="form-check mt-2">
                              <input
                                className="form-check-input"
                                type="checkbox"
                                name={deleteImageFieldName(slot)}
                                id={deleteImageFieldName(slot)}
                                value="1"
                                checked={img.remove}
                                onChange={onChangeRemove(slot)}
                              />
                              <label className="form-check-label text-danger" htmlFor={deleteImageFieldName(slot)}>
                                この画像を削除する
                              </label>
                            </div>
                          ) : null}
                        </div>
                      </div>
                      {fieldErrors[name] ? (
                        <>
                          <div className="col-md-3"></div>
                          <div className="col-md-8">
                            <div className="alert alert-danger mt-0 p-1 form-text" role="alert">
                              {fieldErrors[name]}
                            </div>
                          </div>
                        </>
                      ) : null}
                    </div>
                  );
                })}

                <OfficeFormRow htmlFor="content" label="内容" required error={fieldErrors.content}>
                  <textarea name="content" id="content" className="form-control" rows={5} value={values.content} onChange={onChangeValue("content")} />
                </OfficeFormRow>

                <OfficeFormRow htmlFor="status" label="公開ステータス" required error={fieldErrors.status}>
                  <select name="status" id="status" className="form-control" value={values.status} onChange={onChangeValue("status")}>
                    {/* 現行: 登録画面にだけ「未選択」がある */}
                    {!isEdit ? <option value="">未選択</option> : null}
                    {PUBLISH_STATUS_KEYS.map((key) => (
                      <option value={key} key={key}>
                        {PUBLISH_STATUS[key]}
                      </option>
                    ))}
                  </select>
                </OfficeFormRow>

                {/* 進むボタン */}
                <div className="mt-3">
                  <button type="submit" className="btn btn-success d-grid w-100 text-white text-break" id="submit" disabled={pending}>
                    確認する
                  </button>
                </div>

                {/* 戻るボタン */}
                <div className="my-3">
                  <Link href={officeNewsIndexHref(back)} className="text-break btn btn-outline-dark col-12 mb-0">
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
