"use client";

import { useEffect, useState, useTransition, type ReactNode } from "react";
import PrivacyPolicyText from "@/components/redesign/PrivacyPolicyText";
import Turnstile from "@/components/Turnstile";
import {
  EMPTY_CONTACT_VALUES,
  validateContact,
  type ContactErrors,
  type ContactField,
  type ContactFormValues,
} from "@/lib/contact-schema";
import { submitContact } from "@/app/(site)/contact/actions";

type Step = "input" | "confirm";

type Props = {
  /** 入力ステップのタイトル帯（サーバーで描画した PageHero） */
  heroInput: ReactNode;
  /** 確認ステップのタイトル帯 */
  heroConfirm: ReactNode;
  /** Turnstile のサイトキー（未設定ならウィジェットを出さない） */
  turnstileSiteKey?: string;
};

const TITLE_INPUT = "Contact | OBFall Inc.";
const TITLE_CONFIRM = "お問い合わせ確認 | OBFall Inc.";

const INPUT_CLASS =
  "w-full rounded-lg border border-outline-variant/50 bg-surface-container-lowest px-4 py-3.5 text-base text-on-surface shadow-sm transition-colors placeholder:text-outline focus:border-primary-container focus:outline-none focus:ring-2 focus:ring-primary-container/20";
const ERROR_CLASS = "mt-1 text-sm text-error";

/**
 * お問い合わせ 入力 → 確認（リデザイン版。design/stitch/contact.html を参考）。
 * ロジックは既存 (site)/contact/_legacy/ContactForm.tsx と同じ（Zod 共有スキーマ・Server Action・Turnstile・ハニーポット）。
 * 確認ステップは HTML が無いため入力画面と同じ部品で構成（仮置き）。
 */
export default function ContactForm({ heroInput, heroConfirm, turnstileSiteKey }: Props) {
  const [step, setStep] = useState<Step>("input");
  const [values, setValues] = useState<ContactFormValues>(EMPTY_CONTACT_VALUES);
  const [errors, setErrors] = useState<ContactErrors>({});
  const [formError, setFormError] = useState<string | null>(null);
  const [honeypot, setHoneypot] = useState("");
  const [turnstileToken, setTurnstileToken] = useState<string | null>(null);
  const [pending, startTransition] = useTransition();

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
      const result = await submitContact(values, { turnstileToken, honeypot });
      if (!result || result.ok) return;
      if (result.errors) {
        setErrors(result.errors);
        setStep("input");
        window.scrollTo({ top: 0 });
        return;
      }
      setFormError(result.formError ?? "送信に失敗しました。時間をおいて再度お試しください。");
      setTurnstileToken(null);
    });
  };

  const fieldError = (field: ContactField) =>
    errors[field] ? (
      <p className={ERROR_CLASS} role="alert">
        {errors[field]}
      </p>
    ) : null;

  if (step === "confirm") {
    return (
      <>
        {heroConfirm}
        <div className="wrap py-space-2xl lg:py-space-3xl">
          <div className="mx-auto flex w-full max-w-[720px] flex-col">
            <Statement>入力内容をご確認ください。</Statement>
            <form method="post" onSubmit={submit} className="flex w-full flex-col gap-space-xl">
              <dl className="flex flex-col divide-y divide-outline-variant/40 rounded-lg border border-outline-variant/40 bg-surface-container-lowest shadow-sm">
                <ConfirmRow label="お名前（10文字以内）" required>
                  {values.name}
                </ConfirmRow>
                <ConfirmRow label="メールアドレス" required>
                  {values.email}
                </ConfirmRow>
                <ConfirmRow label="会社名" required>
                  {values.company}
                </ConfirmRow>
                <ConfirmRow label="電話番号">{values.tel}</ConfirmRow>
                <ConfirmRow label="お問い合わせ内容" required>
                  {/* 既存どおり改行は保持しない */}
                  {values.contents}
                </ConfirmRow>
              </dl>
              <input type="hidden" name="action" value="submit" />
              {turnstileSiteKey ? (
                <Turnstile key={formError ?? "turnstile"} siteKey={turnstileSiteKey} onToken={setTurnstileToken} className="flex justify-center" />
              ) : null}
              {formError ? (
                <p className="rounded-lg bg-error-container px-4 py-3 text-center text-sm text-on-error-container" role="alert">
                  {formError}
                </p>
              ) : null}
              <div className="flex flex-col-reverse items-center justify-center gap-space-md sm:flex-row">
                <button
                  type="button"
                  onClick={goBack}
                  disabled={pending}
                  className="inline-flex items-center justify-center rounded-full border border-outline-variant bg-surface-container-lowest px-10 py-3.5 text-sm font-medium text-on-surface-variant transition-colors hover:bg-surface-container-low disabled:opacity-50"
                >
                  戻る
                </button>
                <button
                  type="submit"
                  disabled={pending || (!!turnstileSiteKey && !turnstileToken)}
                  className="inline-flex items-center justify-center rounded-full bg-primary px-10 py-3.5 text-sm font-medium text-on-primary shadow transition-colors hover:bg-secondary disabled:opacity-50"
                >
                  {pending ? "送信中…" : "送信"}
                </button>
              </div>
            </form>
          </div>
        </div>
      </>
    );
  }

  return (
    <>
      {heroInput}
      <div className="wrap py-space-2xl lg:py-space-3xl">
        <div className="mx-auto flex w-full max-w-[720px] flex-col">
          <Statement>お気軽にお問い合わせください。</Statement>
          <form method="post" onSubmit={goConfirm} noValidate className="relative flex w-full flex-col gap-space-xl">
            <Field label="お名前（10文字以内）" htmlFor="name" required error={fieldError("name")}>
              <input
                type="text"
                id="name"
                name="name"
                placeholder="お名前をご記入ください"
                value={values.name}
                onChange={(e) => update("name", e.target.value)}
                className={INPUT_CLASS}
              />
            </Field>
            <Field label="メールアドレス" htmlFor="email" required error={fieldError("email")}>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="例：○○○○@○○○○.com"
                value={values.email}
                onChange={(e) => update("email", e.target.value)}
                className={INPUT_CLASS}
              />
            </Field>
            <Field label="会社名" htmlFor="company" required error={fieldError("company")}>
              <input
                type="text"
                id="company"
                name="company"
                placeholder="例：○○○○株式会社"
                value={values.company}
                onChange={(e) => update("company", e.target.value)}
                className={INPUT_CLASS}
              />
            </Field>
            <Field label="電話番号" htmlFor="tel" error={fieldError("tel")}>
              <input
                type="tel"
                id="tel"
                name="tel"
                placeholder="例：03-1234-5678"
                value={values.tel}
                onChange={(e) => update("tel", e.target.value)}
                className={INPUT_CLASS}
              />
            </Field>
            <Field label="お問い合わせ内容" htmlFor="contents" required error={fieldError("contents")}>
              <textarea
                id="contents"
                name="contents"
                rows={6}
                placeholder="お問い合わせ内容をご記入ください"
                value={values.contents}
                onChange={(e) => update("contents", e.target.value)}
                className={`${INPUT_CLASS} min-h-[160px] resize-y`}
              ></textarea>
            </Field>

            {/* ハニーポット: 人には見えない欄。bot が埋めたら Server Action 側で送信せずに完了画面へ */}
            <div className="absolute -left-[9999px] h-px w-px overflow-hidden opacity-0" aria-hidden="true">
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

            {/* プライバシーポリシー */}
            <div className="mt-4 flex w-full flex-col gap-3">
              <div className="max-h-72 w-full overflow-y-auto rounded-lg border border-outline-variant/40 bg-surface-container-lowest p-5 text-sm leading-relaxed text-on-surface-variant shadow-inner">
                <h3 className="mb-3 font-serif-jp text-base font-bold text-on-surface">プライバシーポリシー</h3>
                <PrivacyPolicyText />
              </div>
              <label className="mt-4 flex items-center justify-center gap-2 text-sm text-on-surface" htmlFor="privacy_agree">
                <input
                  type="checkbox"
                  name="privacy_agree"
                  id="privacy_agree"
                  checked={values.privacy_agree}
                  onChange={(e) => update("privacy_agree", e.target.checked)}
                  className="h-5 w-5 rounded border-outline-variant accent-primary-container"
                />
                <span>プライバシーポリシーに同意します。</span>
              </label>
              {errors.privacy_agree ? (
                <p className={`${ERROR_CLASS} text-center`} role="alert">
                  {errors.privacy_agree}
                </p>
              ) : null}
              <div className="flex w-full justify-center pt-4">
                <button
                  type="submit"
                  className="inline-flex items-center justify-center rounded-full bg-primary px-10 py-3.5 text-sm font-medium text-on-primary shadow transition-colors hover:bg-secondary"
                >
                  確認画面へ
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </>
  );
}

function Statement({ children }: { children: ReactNode }) {
  return (
    <div className="mb-space-2xl flex w-full items-center gap-4 border-l-4 border-primary-container pl-space-md">
      <h2 className="font-serif-jp text-[22px] leading-relaxed font-bold tracking-normal text-on-surface lg:text-2xl">{children}</h2>
    </div>
  );
}

function RequiredBadge() {
  return <span className="rounded bg-error-container px-2 py-0.5 text-[11px] font-medium text-on-error-container">必須</span>;
}

function Field({
  label,
  htmlFor,
  required,
  error,
  children,
}: {
  label: string;
  htmlFor: string;
  required?: boolean;
  error: ReactNode;
  children: ReactNode;
}) {
  return (
    <div className="flex flex-col gap-2">
      <div className="flex items-center justify-between">
        <label className="text-sm font-medium text-on-surface" htmlFor={htmlFor}>
          {label}
        </label>
        {required ? <RequiredBadge /> : null}
      </div>
      {children}
      {error}
    </div>
  );
}

function ConfirmRow({ label, required, children }: { label: string; required?: boolean; children: ReactNode }) {
  return (
    <div className="flex flex-col gap-1 px-5 py-4 md:flex-row md:gap-space-lg">
      <dt className="flex items-center gap-2 text-sm font-medium text-on-surface md:w-48 md:shrink-0">
        {label}
        {required ? <RequiredBadge /> : null}
      </dt>
      <dd className="text-base break-words text-on-surface md:flex-1">{children}</dd>
    </div>
  );
}
