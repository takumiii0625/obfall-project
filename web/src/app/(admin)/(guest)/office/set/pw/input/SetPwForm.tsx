"use client";

import Link from "next/link";
import { useActionState } from "react";
import OfficeAlert from "@/components/office/OfficeAlert";
import OfficeFormRow from "@/components/office/OfficeFormRow";
import { setPwAction } from "./actions";
import type { SetPwState, SetPwValues } from "./set-pw-state";

type Props = {
  signed: SetPwValues;
};

/** 新パスワード入力フォーム（現行 office/auth/set/pw/input.blade.php の @section('content')） */
export default function SetPwForm({ signed }: Props) {
  const [state, action, pending] = useActionState<SetPwState, FormData>(setPwAction, { values: signed });

  return (
    <div className="container-fluid flex-grow-1 container-p-y">
      <div className="card p-3">
        <div className="card-body">
          <OfficeAlert error={state.error} />
          <div className="row pb-2">
            <div className="col-12">
              <div className="mt-3">
                <div className="text-break w-100">新しいパスワードを入力し、「設定する」をクリックしてください。</div>
              </div>
            </div>
          </div>

          <div className="row">
            <div className="col-12">
              <form action={action} className="form" noValidate>
                <input type="hidden" name="token" value={state.values.token} />
                <input type="hidden" name="expires" value={state.values.expires} />
                <input type="hidden" name="signature" value={state.values.signature} />

                <OfficeFormRow htmlFor="password" label="新パスワード" error={state.fieldErrors?.password}>
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
