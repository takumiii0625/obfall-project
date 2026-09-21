import type { LoginFieldErrors } from "@/lib/office-auth-schema";

/**
 * ログインフォームの state（useActionState 用）。
 * ※ "use server" ファイル（actions.ts）からは async 関数以外を export できないため、型と初期値はここに置く
 */
export type LoginState = {
  /** 項目ごとの検証エラー（現行 @error） */
  fieldErrors?: LoginFieldErrors;
  /** 画面上部のエラー（現行 withError） */
  error?: string | null;
  /** 再表示用（現行 old('email')。パスワードは戻さない） */
  email: string;
  /**
   * ログイン成功時の遷移先。redirect()（ソフト遷移）ではなく LoginForm が window.location で
   * フルページ遷移する。管理レイアウトの Sneat JS（menu.js / main.js）は読み込み時に #layout-menu を
   * 初期化するため、クライアント遷移で差し込まれても実行されない（React は client render の <script> を実行しない）
   */
  redirectTo?: string;
};

export const LOGIN_INITIAL_STATE: LoginState = { email: "" };
