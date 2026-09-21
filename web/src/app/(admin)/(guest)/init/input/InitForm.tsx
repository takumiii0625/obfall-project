"use client";

import Link from "next/link";
import { useActionState } from "react";
import OfficeAlert from "@/components/office/OfficeAlert";
import OfficeFormRow from "@/components/office/OfficeFormRow";
import { initAction } from "./actions";
import { INIT_INITIAL_STATE, type InitState } from "./init-state";

/** 初期アカウント設定フォーム（現行 office/auth/init/input.blade.php の @section('content')） */
export default function InitForm() {
  const [state, action, pending] = useActionState<InitState, FormData>(initAction, INIT_INITIAL_STATE);

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card p-3">
        <div className="card-body">
          <OfficeAlert error={state.error} />
          <div className="row pb-2">
            <div className="col-12">
              <div className="mt-3">
                <div className="text-break w-100">管理者情報を入力し、「設定する」をクリックしてください。</div>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-12">
              <form action={action} className="form" noValidate>
                <OfficeFormRow htmlFor="name" label="氏名" required error={state.fieldErrors?.name}>
                  <input type="text" name="name" defaultValue={state.values.name} id="name" className="form-control" />
                </OfficeFormRow>

                <OfficeFormRow htmlFor="email" label="メールアドレス" required error={state.fieldErrors?.email}>
                  <input type="email" name="email" defaultValue={state.values.email} id="email" className="form-control" />
                </OfficeFormRow>

                <OfficeFormRow htmlFor="password" label="新パスワード" required error={state.fieldErrors?.password}>
                  <input
                    type="password"
                    name="password"
                    defaultValue=""
                    id="password"
                    className="form-control"
                    autoCapitalize="off"
                    autoComplete="new-password"
                  />
                </OfficeFormRow>

                <div className="my-3">
                  <button type="submit" className="btn btn-success d-grid w-100 text-white text-break" id="submit" disabled={pending}>
                    設定する
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
