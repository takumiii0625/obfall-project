"use client";

import { useEffect } from "react";

/**
 * スクロールで画面に入った要素をフェードインさせる（旧トップ components/top/TopEffects.tsx の
 * 「[data-anim] を IntersectionObserver（threshold 0.15）で is-visible にする」部分を流用）。UI は持たない。
 *
 * 対象は `.reveal` を付けた要素。見た目は redesign.css の `.reveal` / `.reveal.is-visible`。
 *
 * JS 無効・読み込み遅延への配慮（旧実装からの変更点）:
 * - CSS は `html.js-reveal .reveal` にだけ opacity: 0 を当てる。このコンポーネントがマウントして
 *   <html> に js-reveal を付けるまでは全要素が表示されたままなので、JS が動かなくても非表示のまま残らない
 * - マウント時点で既に画面内にある要素は、隠す前に is-visible を付けてちらつきを防ぐ
 * - prefers-reduced-motion の場合は全要素に即 is-visible（CSS 側でも transition を無効化）
 * - スクロール位置を動かす処理は持たない（scroll-snap・スクロールの乗っ取りはしない）
 */
export default function RevealOnScroll() {
  useEffect(() => {
    const els = Array.from(document.querySelectorAll<HTMLElement>(".reveal"));
    if (els.length === 0) return;

    const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reducedMotion) {
      els.forEach((el) => el.classList.add("is-visible"));
      return;
    }

    // 既に画面内にあるものは先に表示扱いにしてから、隠す側のクラスを <html> に付ける
    const vh = window.innerHeight;
    els.forEach((el) => {
      const r = el.getBoundingClientRect();
      if (r.top < vh && r.bottom > 0) el.classList.add("is-visible");
    });
    document.documentElement.classList.add("js-reveal");

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15 },
    );
    els.forEach((el) => {
      if (!el.classList.contains("is-visible")) observer.observe(el);
    });

    return () => {
      observer.disconnect();
      document.documentElement.classList.remove("js-reveal");
    };
  }, []);

  return null;
}
