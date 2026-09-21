"use client";

import Link from "next/link";
import { useActionState, useEffect } from "react";
import OfficeAlert from "@/components/office/OfficeAlert";
import { loginAction } from "./actions";
import { LOGIN_INITIAL_STATE, type LoginState } from "./login-state";

type Props = {
  /** ログアウト直後などのサクセスメッセージ（現行 session('success')） */
  success?: string | null;
};

/**
 * ログインフォーム（現行 office/auth/login/input.blade.php の @section('content')）。
 * 送信は Server Action（loginAction）。成功時は state.redirectTo（/admins/newses）へフルページ遷移する。
 */
export default function LoginForm({ success }: Props) {
  const [state, action, pending] = useActionState<LoginState, FormData>(loginAction, LOGIN_INITIAL_STATE);

  // 成功時はフルページ遷移（現行と同じ。管理レイアウトの Sneat JS を確実に実行させるため）
  useEffect(() => {
    if (state.redirectTo) window.location.assign(state.redirectTo);
  }, [state.redirectTo]);

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card p-3">
        <div className="card-body">
          {/* エラー/サクセス メッセージ */}
          <OfficeAlert success={state.error ? null : success} error={state.error} />
          <div className="row pb-2"></div>
          {/* フォーム表示 */}
          <div className="row">
            <div className="col-12">
              <form action={action} className="form" noValidate>
                <div className="row">
                  <label
                    className="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold"
                    htmlFor="email"
                    role="button"
                  >
                    メールアドレス
                  </label>
                  <div className="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    <input type="email" name="email" defaultValue={state.email} id="email" className="form-control" />
                  </div>
                  {state.fieldErrors?.email ? (
                    <>
                      <div className="col-md-3"></div>
                      <div className="col-md-8">
                        <div className="alert alert-danger mt-0 p-1 form-text" role="alert">
                          {state.fieldErrors.email}
                        </div>
                      </div>
                    </>
                  ) : null}
                </div>

                <div className="row">
                  <label
                    className="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold"
                    htmlFor="password"
                    role="button"
                  >
                    パスワード
                  </label>
                  <div className="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    <input
                      type="password"
                      name="password"
                      defaultValue=""
                      id="password"
                      className="form-control"
                      autoCapitalize="off"
                      autoComplete="new-password"
                    />
                  </div>
                  {state.fieldErrors?.password ? (
                    <>
                      <div className="col-md-3"></div>
                      <div className="col-md-8">
                        <div className="alert alert-danger mt-0 p-1 form-text" role="alert">
                          {state.fieldErrors.password}
                        </div>
                      </div>
                    </>
                  ) : null}
                  <div className="col-md-3"></div>
                  <div className="col-md-8">
                    <p className="fs-small text-break text-end">
                      <Link href="/office/forgot/pw/input">パスワードを忘れたら</Link>
                    </p>
                  </div>
                </div>

                {/* 進むボタン */}
                <div className="my-3">
                  <button
                    type="submit"
                    className="btn btn-success d-grid w-100 text-white text-break"
                    id="submit"
                    disabled={pending || !!state.redirectTo}
                  >
                    ログイン
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
