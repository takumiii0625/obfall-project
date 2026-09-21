"use client";

import { useSyncExternalStore } from "react";

const subscribe = () => () => {};
const getClientYear = () => String(new Date().getFullYear());
const getServerYear = () => "";

/**
 * 現行の <script>document.getElementById('year').textContent = new Date().getFullYear()</script> 相当。
 * 現行同様、年はクライアント側で決める（サーバー描画時は空。ISR で固定化されない）。
 */
export default function CurrentYear() {
  const year = useSyncExternalStore(subscribe, getClientYear, getServerYear);
  return <span id="year">{year}</span>;
}
