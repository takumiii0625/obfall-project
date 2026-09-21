"use client";

import { useEffect, useState, useTransition, type ReactNode } from "react";
import Breadcrumb from "@/components/Breadcrumb";
import PrivacyPolicyText from "@/components/PrivacyPolicyText";
import Turnstile from "@/components/Turnstile";
import {
  EMPTY_CONTACT_VALUES,
  validateContact,
  type ContactErrors,
  type ContactField,
  type ContactFormValues,
} from "@/lib/contact-schema";
import { submitContact } from "./actions";

type Step = "input" | "confirm";

type Props = {
  /** 入力ステップのヒーロー（サーバーで描画した PageHero） */
  heroInput: ReactNode;
  /** 確認ステップのヒーロー */
  heroConfirm: ReactNode;
  /** Turnstile のサイトキー（未設定ならウィジェットを出さない） */
  turnstileSiteKey?: string;
};

const TITLE_INPUT = "Contact | OBFall Inc.";
const TITLE_CONFIRM = "お問い合わせ確認 | OBFall Inc.";

/**
 * お問い合わせ 入力（#15）→ 確認（#16）。
 *
 * 現行は GET /contact（入力）→ POST /confirm（確認）→ POST /process → /complete の遷移で、
 * 「戻る」は withInput() で入力値を復元する。/confirm は POST 専用で直接開けないため、
 * 移行後は /contact 内のステップ切替（React state）で再現し、入力値はそのまま保持する。
 * バリデーションは共有 Zod スキーマでクライアント側で行い、送信時に Server Action で再検証する。
 * スパム対策（現行には無い。docs/移行方針.md）: 確認ステップの Turnstile + 入力ステップのハニーポット。
 */
export default function ContactForm({ heroInput, heroConfirm, turnstileSiteKey }: Props) {
  const [step, setStep] = useState<Step>("input");
  const [values, setValues] = useState<ContactFormValues>(EMPTY_CONTACT_VALUES);
  const [errors, setErrors] = useState<ContactErrors>({});
  /** 項目に紐づかないエラー（Turnstile 失敗・送信失敗）。確認ステップ上に出す */
  const [formError, setFormError] = useState<string | null>(null);
  const [honeypot, setHoneypot] = useState("");
  const [turnstileToken, setTurnstileToken] = useState<string | null>(null);
  const [pending, startTransition] = useTransition();

  // 現行は画面ごとに <title> が異なる
  useEffect(() => {
    document.title = step === "input" ? TITLE_INPUT : TITLE_CONFIRM;
  }, [step]);

  const update = <K extends keyof ContactFormValues>(key: K, value: ContactFormValues[K]) =>
    setValues((prev) => ({ ...prev, [key]: value }));

  const goConfirm = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const result = validateContact(values);
    if (!result.ok) {
      setErrors(result.errors);
      return;
    }
    setErrors({});
    setStep("confirm");
    window.scrollTo({ top: 0 });
  };

  const goBack = () => {
    setFormError(null);
    setTurnstileToken(null);
    setStep("input");
    window.scrollTo({ top: 0 });
  };

  const submit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    setFormError(null);
    startTransition(async () => {
      // 成功時は Server Action 内で redirect("/complete") される
      const result = await submitContact(values, { turnstileToken, honeypot });
      if (!result || result.ok) return;
      if (result.errors) {
        setErrors(result.errors);
        setStep("input");
        window.scrollTo({ top: 0 });
        return;
      }
      // Turnstile 失敗・送信失敗: 確認ステップに留まり、トークンは取り直す
      setFormError(result.formError ?? "送信に失敗しました。時間をおいて再度お試しください。");
      setTurnstileToken(null);
    });
  };

  const fieldError = (field: ContactField) =>
    errors[field] ? <p className="alert alert-danger">{errors[field]}</p> : null;

  if (step === "confirm") {
    return (
      <>
        {heroConfirm}
        <section className="sec">
          <div className="wrap">
            <div className="confirm-card">
              <form method="post" onSubmit={submit}>
                <div className="confirm-item">
                  <div className="confirm-item__label">
                    お名前（10文字以内）<span className="badge">必須</span>
                  </div>
                  <p className="confirm-item__value">{values.name}</p>
                </div>

                <div className="confirm-item">
                  <div className="confirm-item__label">
                    メールアドレス<span className="badge">必須</span>
                  </div>
                  <p className="confirm-item__value">{values.email}</p>
                </div>

                <div className="confirm-item">
                  <div className="confirm-item__label">
                    会社名<span className="badge">必須</span>
                  </div>
                  <p className="confirm-item__value">{values.company}</p>
                </div>

                <div className="confirm-item">
                  <div className="confirm-item__label">電話番号</div>
                  <p className="confirm-item__value">{values.tel}</p>
                </div>

                <div className="confirm-item">
                  <div className="confirm-item__label">
                    お問い合わせ内容<span className="badge">必須</span>
                  </div>
                  {/* 現行どおり改行は保持しない（white-space 指定なし） */}
                  <p className="confirm-item__value">{values.contents}</p>
                </div>

                <input type="hidden" name="action" value="submit" />

                {turnstileSiteKey ? (
                  <Turnstile
                    key={formError ?? "turnstile"}
                    siteKey={turnstileSiteKey}
                    onToken={setTurnstileToken}
                    className="d-flex justify-content-center mt-4"
                  />
                ) : null}

                {formError ? (
                  <p className="alert alert-danger text-center mt-3" role="alert">
                    {formError}
                  </p>
                ) : null}

                <div className="confirm-actions">
                  <button type="button" className="btn-back" onClick={goBack} disabled={pending}>
                    戻る
                  </button>
                  <button
                    type="submit"
                    className="btn btn-primary"
                    disabled={pending || (!!turnstileSiteKey && !turnstileToken)}
                  >
                    {pending ? "送信中…" : "送信"}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </section>

        <div className="breadcrumb-sec">
          <div className="wrap">
            <Breadcrumb current="確認" parents={[{ label: "お問い合わせ", href: "/contact" }]} />
          </div>
        </div>
      </>
    );
  }

  return (
    <>
      {heroInput}
      {/* 現行は <form> が .form-card 内で開始し、プライバシーポリシー節の同意チェック・送信ボタンまで
          （閉じタグ位置がずれたまま）続いている。React では両セクションを1つの <form> で包んで同じ関連付けにする */}
      <form method="post" onSubmit={goConfirm} noValidate>
        {/* フォーム */}
        <section className="sec">
          <div className="wrap">
            <div className="form-card">
              <div className="form-group row">
                <label className="col-sm-4 col-form-label" htmlFor="name">
                  お名前（10文字以内）<span className="badge">必須</span>
                </label>
                <div className="col-sm-8">
                  <input
                    type="text"
                    className="form-control"
                    id="name"
                    name="name"
                    placeholder="お名前をご記入ください"
                    value={values.name}
                    onChange={(e) => update("name", e.target.value)}
                  />
                </div>
                {fieldError("name")}
              </div>

              <div className="form-group row">
                <label className="col-sm-4 col-form-label" htmlFor="email">
                  メールアドレス<span className="badge">必須</span>
                </label>
                <div className="col-sm-8">
                  <input
                    type="email"
                    className="form-control"
                    id="email"
                    name="email"
                    placeholder="例：○○○○@○○○○.com"
                    value={values.email}
                    onChange={(e) => update("email", e.target.value)}
                  />
                </div>
                {fieldError("email")}
              </div>

              <div className="form-group row">
                <label className="col-sm-4 col-form-label" htmlFor="company">
                  会社名<span className="badge">必須</span>
                </label>
                <div className="col-sm-8">
                  <input
                    type="text"
                    className="form-control"
                    id="company"
                    name="company"
                    placeholder="例：○○○○株式会社"
                    value={values.company}
                    onChange={(e) => update("company", e.target.value)}
                  />
                </div>
                {fieldError("company")}
              </div>

              <div className="form-group row">
                <label className="col-sm-4 col-form-label" htmlFor="tel">
                  電話番号
                </label>
                <div className="col-sm-8">
                  <input
                    type="tel"
                    className="form-control"
                    id="tel"
                    name="tel"
                    placeholder="例: 03-1234-5678"
                    value={values.tel}
                    onChange={(e) => update("tel", e.target.value)}
                  />
                </div>
                {fieldError("tel")}
              </div>

              <div className="form-group row">
                <label className="col-sm-4 col-form-label" htmlFor="contents">
                  お問い合わせ内容<span className="badge">必須</span>
                </label>
                <div className="col-sm-8">
                  <textarea
                    className="form-control"
                    id="contents"
                    name="contents"
                    rows={4}
                    placeholder="お問い合わせ内容をご記入ください"
                    value={values.contents}
                    onChange={(e) => update("contents", e.target.value)}
                  ></textarea>
                </div>
                {fieldError("contents")}
              </div>

              {/* ハニーポット: 人には見えない欄。bot が埋めたら Server Action 側で送信せずに完了画面へ */}
              <div className="hp-field" aria-hidden="true">
                <label htmlFor="website">Website</label>
                <input
                  type="text"
                  id="website"
                  name="website"
                  tabIndex={-1}
                  autoComplete="off"
                  value={honeypot}
                  onChange={(e) => setHoneypot(e.target.value)}
                />
              </div>
            </div>
          </div>
        </section>

        {/* プライバシーポリシー */}
        <section className="sec sec--alt">
          <div className="wrap">
            <div className="privacy-box">
              <h4>プライバシーポリシー</h4>
              <PrivacyPolicyText />
            </div>

            <div className="privacy-agree">
              <div className="form-check">
                <input
                  className="form-check-input"
                  type="checkbox"
                  name="privacy_agree"
                  id="privacy_agree"
                  checked={values.privacy_agree}
                  onChange={(e) => update("privacy_agree", e.target.checked)}
                />
                <label className="form-check-label" htmlFor="privacy_agree">
                  プライバシーポリシーに同意します。
                </label>
              </div>
              {errors.privacy_agree ? (
                <p className="alert alert-danger" style={{ display: "inline-block", marginTop: 8 }}>
                  {errors.privacy_agree}
                </p>
              ) : null}
            </div>

            <div className="form-submit">
              <button type="submit" className="btn btn-primary">
                確認画面へ
              </button>
            </div>
          </div>
        </section>
      </form>

      {/* パンくず */}
      <div className="breadcrumb-sec">
        <div className="wrap">
          <Breadcrumb current="お問い合わせ" />
        </div>
      </div>
    </>
  );
}
