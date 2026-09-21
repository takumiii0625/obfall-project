"use client";

import type { FormEvent } from "react";

type Props = {
  /** id をバインド済みの Server Action */
  action: (formData: FormData) => void | Promise<void>;
};

/**
 * 一覧の削除ボタン（現行 office/{newses,inhouse_developments}/index.blade.php の <form onsubmit="return confirmDelete()">）。
 * お知らせ・自社開発で共用。現行 script.js の confirmDelete() と同じ文言で window.confirm する。
 */
export default function DeleteRowButton({ action }: Props) {
  const onSubmit = (e: FormEvent<HTMLFormElement>) => {
    if (!window.confirm("本当に削除しますか？")) e.preventDefault();
  };
  return (
    <form action={action} className="d-inline" onSubmit={onSubmit}>
      <button type="submit" className="btn btn-sm btn-icon btn-outline-danger me-2" title="削除">
        <i className="bx bx-xs bxs-trash-alt"></i>
      </button>
    </form>
  );
}
