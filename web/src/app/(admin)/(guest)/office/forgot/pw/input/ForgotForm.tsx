"use client";

import Link from "next/link";
import { useActionState } from "react";
import OfficeAlert from "@/components/office/OfficeAlert";
import OfficeFormRow from "@/components/office/OfficeFormRow";
import { forgotPwAction } from "./actions";
import { FORGOT_INITIAL_STATE, type ForgotState } from "./forgot-state";

type Props = {
  /** PW 設定 URL が無効・期限切れだったときのメッセージ（現行 session('error')） */
  flashError?: string | null;
};

/** PW 再設定メール送信フォーム（現行 office/auth/forgot/pw/input.blade.php の @section('content')） */
export default function ForgotForm({ flashError }: Props) {
  const [state, action, pending] = useActionState<ForgotState, FormData>(forgotPwAction, FORGOT_INITIAL_STATE);

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card p-3">
        <div className="card-body">
          <OfficeAlert error={state.error ?? flashError} />
          <div className="row pb-2">
            <div className="col-12">
              <div className="mt-3">
                <div className="text-break w-100">
                  登録されたメールアドレスを入力してください。
                  <br />
                  パスワード設定のご案内メールをお送りします。
                </div>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-12">
              <form action={action} className="form" noValidate>
                <OfficeFormRow htmlFor="email" label="メールアドレス" error={state.fieldErrors?.email}>
                  <input type="email" name="email" defaultValue={state.values.email} id="email" className="form-control" />
                </OfficeFormRow>

                <div className="my-3">
                  <button type="submit" className="btn btn-success d-grid w-100 text-white text-break" id="submit" disabled={pending}>
                    送信する
                  </button>
                </div>

                <div className="my-3">
                  <Link href="/office/login" className="text-break btn btn-outline-dark col-12 mb-0">
                    ログインページに戻る
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
