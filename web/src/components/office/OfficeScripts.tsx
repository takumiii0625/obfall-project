"use client";

import { useEffect } from "react";

/**
 * Sneat テンプレートの JS（jQuery / menu.js / main.js 等）をハイドレーション後に現行と同じ順序で読み込む。
 *
 * 素の <script> を SSR に含めると、React がハイドレーションする前に menu.js / perfect-scrollbar が
 * DOM を書き換え（data-bg-class 付与、.ps__rail-* 追加）てハイドレーション不一致になり、
 * React がツリーを再生成してバインド済みのイベント（サイドメニュー開閉）が失われる。
 * また React はクライアント描画時の <script> を実行しないため、next/script や素の <script> では順序と実行を両立できない。
 *
 * - 読み込みは 1 回だけ（main.js は top-level let を使うため再実行すると SyntaxError）。ログイン直後は
 *   LoginForm がフルページ遷移するので、この効果は管理レイアウトのマウント時に必ず新規に走る
 * - `async = false` で挿入順に実行させる
 * - helpers.js は document.readyState を見て自前で初期化するため遅延読み込みでも動く
 * - 現行が読んでいた extended-ui-perfect-scrollbar.js / pages-account-settings-account.js は
 *   DOMContentLoaded 依存のデモ用（本プロジェクトの要素なし）、google.zip.js / apiKey は未使用のため読まない
 * - 1 本の読み込みに失敗しても後続（main.js）は読む（現行のブラウザ挙動と同じ）
 */
const SCRIPTS = [
  // Helpers（現行は <head>）
  "/backend/vendor/js/helpers.js",
  "/backend/js/config.js",
  // Core JS
  "/backend/vendor/libs/jquery/jquery.js",
  "/backend/vendor/libs/popper/popper.js",
  "/backend/vendor/js/bootstrap.js",
  "/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js",
  "/backend/vendor/libs/hammer/hammer.js",
  "/backend/vendor/js/menu.js",
  // Vendors JS
  "/backend/vendor/libs/apex-charts/apexcharts.js",
  "/backend/vendor/libs/bootstrap/bootstrap-datepicker.min.js",
  "/backend/vendor/libs/bootstrap/bootstrap-datepicker.ja.min.js",
  // masonry.js は現行 public/backend にも存在せず 404 になっていた（§4.2 の参照切れ）ため読まない
  // Original JS
  "/backend/js/script.js",
  // Main JS
  "/backend/js/main.js",
];

declare global {
  interface Window {
    __obfallOfficeScripts?: Promise<void>;
  }
}

function loadScript(src: string): Promise<void> {
  return new Promise((resolve, reject) => {
    const el = document.createElement("script");
    el.src = src;
    el.async = false;
    el.onload = () => resolve();
    el.onerror = () => reject(new Error(`スクリプトの読み込みに失敗: ${src}`));
    document.body.appendChild(el);
  });
}

export default function OfficeScripts() {
  useEffect(() => {
    if (window.__obfallOfficeScripts) return;
    window.__obfallOfficeScripts = (async () => {
      for (const src of SCRIPTS) {
        try {
          await loadScript(src);
        } catch (e) {
          console.error("[office] Sneat JS の読み込みに失敗", e);
        }
      }
    })();
  }, []);
  return null;
}
