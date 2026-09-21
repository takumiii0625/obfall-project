"use client";

import Script from "next/script";
import { useCallback, useEffect, useRef } from "react";

type TurnstileApi = {
  render: (el: HTMLElement, opts: Record<string, unknown>) => string;
  remove: (widgetId: string) => void;
  reset: (widgetId: string) => void;
};

declare global {
  interface Window {
    turnstile?: TurnstileApi;
  }
}

type Props = {
  siteKey: string;
  /** トークン取得時（期限切れ・エラー時は null） */
  onToken: (token: string | null) => void;
  className?: string;
};

const SCRIPT_SRC = "https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit";

/**
 * Cloudflare Turnstile ウィジェット（明示レンダリング）。
 * 送信直前の確認ステップに置く（トークンの有効期限は5分のため、入力ステップに置くと確認中に失効しやすい）。
 * サイトキー未設定時は呼び出し側で描画しない。
 */
export default function Turnstile({ siteKey, onToken, className }: Props) {
  const containerRef = useRef<HTMLDivElement>(null);
  const widgetIdRef = useRef<string | null>(null);
  const onTokenRef = useRef(onToken);
  // 最新の onToken を参照する（描画中の ref 更新は禁止のため effect で行う）
  useEffect(() => {
    onTokenRef.current = onToken;
  });

  const render = useCallback(() => {
    if (!containerRef.current || !window.turnstile || widgetIdRef.current) return;
    widgetIdRef.current = window.turnstile.render(containerRef.current, {
      sitekey: siteKey,
      language: "ja",
      callback: (token: string) => onTokenRef.current(token),
      "expired-callback": () => onTokenRef.current(null),
      "error-callback": () => onTokenRef.current(null),
    });
  }, [siteKey]);

  // スクリプトが既に読み込まれている場合（ステップを行き来したとき）は即描画
  useEffect(() => {
    render();
    return () => {
      if (widgetIdRef.current && window.turnstile) {
        window.turnstile.remove(widgetIdRef.current);
        widgetIdRef.current = null;
      }
    };
  }, [render]);

  return (
    <>
      <Script src={SCRIPT_SRC} strategy="afterInteractive" onLoad={render} />
      <div ref={containerRef} className={className} />
    </>
  );
}
