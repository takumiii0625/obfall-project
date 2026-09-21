import type { ReactNode } from "react";

type Props = {
  htmlFor: string;
  label: ReactNode;
  /** 現行 <span class="text-danger">※&nbsp;</span> の必須マーク */
  required?: boolean;
  error?: string | null;
  children: ReactNode;
  /** ラベル行の下に続けて出す要素（「パスワードを忘れたら」リンク等） */
  after?: ReactNode;
};

/**
 * 管理画面の認証系フォームで共通の1行（現行 office/auth/**\/input.blade.php の .row 構造）。
 * col-md-3 ラベル + col-md-8 入力 + @error のアラート。
 */
export default function OfficeFormRow({ htmlFor, label, required, error, children, after }: Props) {
  return (
    <div className="row">
      <label
        className="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold"
        htmlFor={htmlFor}
        role="button"
      >
        {required ? <span className="text-danger">※&nbsp;</span> : null}
        {required ? " " : null}
        {label}
      </label>
      <div className="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">{children}</div>
      {error ? (
        <>
          <div className="col-md-3"></div>
          <div className="col-md-8">
            <div className="alert alert-danger mt-0 p-1 form-text" role="alert">
              {error}
            </div>
          </div>
        </>
      ) : null}
      {after}
    </div>
  );
}
