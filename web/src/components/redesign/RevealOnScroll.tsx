"use client";

import { usePathname } from "next/navigation";
import { useEffect } from "react";

/**
 * スクロールで画面に入った要素をフェードインさせる（旧トップ components/top/TopEffects.tsx の
 * 「[data-anim] を IntersectionObserver（threshold 0.15）で is-visible にする」部分を流用）。UI は持たない。
 * ルートレイアウトに 1 つだけ置き、ページ遷移（pathname の変化）ごとに対象を取り直す。
 *
 * 対象:
 * - `.reveal` を手で付けた要素（トップ）
 * - 自動付与（2026-11-01。トップ以外の全ページ）: <main> 直下の各 section / div（先頭のタイトル帯は除く）の
 *   `.wrap` 直下の要素（1 つの div で包んでいるだけなら 1〜2 段下りる）。直下の要素が 2 つ以上の子を持つグリッド / リストなら、子を 1 つずつ時間差（0.1 秒刻み、最大 0.5 秒）で出す。
 *   <main data-reveal-manual> のページ（トップ）と [data-no-reveal] のブロックは自動付与しない。
 *   自動付与した要素は表示し終えたらクラスを外す（hover 等の transition に遅延が残らないように）
 *
 * 見た目は redesign.css の `.reveal` / `.reveal.is-visible`。
 *
 * JS 無効・読み込み遅延への配慮:
 * - CSS は `html.js-reveal .reveal` にだけ opacity: 0 を当てる。JS が動かなければ常に表示
 * - 対象を決めた時点で既に画面内にある要素は、隠さずに表示扱いにする（ちらつき防止）
 * - prefers-reduced-motion の場合は何もしない（全要素そのまま表示）
 * - スクロール位置を動かす処理は持たない（scroll-snap・スクロールの乗っ取りはしない）
 */
const STAGGER_STEP = 0.1;
const STAGGER_MAX = 0.5;
/** .reveal.is-visible の transition（0.8s）+ 余裕 */
const REVEAL_DURATION_MS = 1000;

function isGroup(el: Element): boolean {
  if (el.children.length < 2) return false;
  if (el.tagName === "UL" || el.tagName === "OL" || el.tagName === "DL") return true;
  return el.classList.contains("grid");
}

/** 自動でフェードインさせる要素と、その遅延（秒）を集める */
function collectAutoTargets(main: HTMLElement): Array<[HTMLElement, number]> {
  const out: Array<[HTMLElement, number]> = [];
  // <main> 直下の section / div（先頭のタイトル帯 PageHero は除く）
  const blocks = (Array.from(main.children) as HTMLElement[]).filter(
    (el, i) => !(i === 0 && el.tagName === "SECTION") && (el.tagName === "SECTION" || el.tagName === "DIV") && !el.hasAttribute("data-no-reveal"),
  );
  for (const block of blocks) {
    let container = block.classList.contains("wrap") ? block : block.querySelector<HTMLElement>(":scope > .wrap");
    if (!container) continue;
    // 中身を 1 つの div で包んでいるだけなら 1 段下りる（会社概要など）
    for (let depth = 0; depth < 2 && container.children.length === 1 && container.firstElementChild?.tagName === "DIV" && !isGroup(container.firstElementChild); depth++) {
      container = container.firstElementChild as HTMLElement;
    }
    for (const child of Array.from(container.children) as HTMLElement[]) {
      if (child.classList.contains("reveal")) continue;
      if (isGroup(child)) {
        (Array.from(child.children) as HTMLElement[]).forEach((g, i) => out.push([g, Math.min(i * STAGGER_STEP, STAGGER_MAX)]));
      } else {
        out.push([child, 0]);
      }
    }
  }
  return out;
}

/** 1 ページ分のフェードインを仕掛ける。戻り値で後片付け */
function setup(main: HTMLElement | null): () => void {
  const auto = main && !main.hasAttribute("data-reveal-manual") ? collectAutoTargets(main) : [];
  const autoEls = new Set<HTMLElement>();
  auto.forEach(([el, delay]) => {
    el.classList.add("reveal", "reveal-auto");
    if (delay) el.style.setProperty("--reveal-delay", `${delay}s`);
    autoEls.add(el);
  });

  const els = Array.from(document.querySelectorAll<HTMLElement>(".reveal"));
  if (els.length === 0) return () => {};

  const timers: number[] = [];
  /** 自動付与した要素は表示し終えたら元に戻す */
  const cleanup = (el: HTMLElement) => {
    if (!autoEls.has(el)) return;
    const delay = parseFloat(el.style.getPropertyValue("--reveal-delay") || "0");
    timers.push(
      window.setTimeout(() => {
        el.classList.remove("reveal", "reveal-auto", "is-visible", "intro-off");
        el.style.removeProperty("--reveal-delay");
      }, REVEAL_DURATION_MS + delay * 1000),
    );
  };
  const show = (el: HTMLElement) => {
    el.classList.add("is-visible");
    cleanup(el);
  };

  // 既に画面内にあるものは先に表示扱いにしてから、隠す側のクラスを <html> に付ける
  const vh = window.innerHeight;
  els.forEach((el) => {
    const r = el.getBoundingClientRect();
    if (r.top < vh && r.bottom > 0) {
      // 画面内: 隠さない。動きは CSS の「開いた直後の動き」（main > … > .wrap > *）に任せる
      el.classList.add("is-visible");
      if (autoEls.has(el)) {
        el.classList.remove("reveal", "reveal-auto", "is-visible", "intro-off");
        el.style.removeProperty("--reveal-delay");
      }
    } else if (autoEls.has(el)) {
      // 画面外: 開いた直後の動きは止め、スクロール時のフェードインに任せる
      el.classList.add("intro-off");
    }
  });
  document.documentElement.classList.add("js-reveal");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          show(entry.target as HTMLElement);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15, rootMargin: "0px 0px -40px 0px" },
  );
  els.forEach((el) => {
    if (el.classList.contains("reveal") && !el.classList.contains("is-visible")) observer.observe(el);
  });

  return () => {
    observer.disconnect();
    timers.forEach((t) => window.clearTimeout(t));
    autoEls.forEach((el) => {
      el.classList.remove("reveal", "reveal-auto", "is-visible", "intro-off");
      el.style.removeProperty("--reveal-delay");
    });
    document.documentElement.classList.remove("js-reveal");
  };
}

export default function RevealOnScroll() {
  const pathname = usePathname();

  useEffect(() => {
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

    // ページ遷移では <main> が差し替わる。差し替わりのタイミングは pathname の変化と一致しないことがあるため、
    // <body> 内の要素の追加・削除を監視して <main> が別の要素になったら仕掛け直す
    let current = document.querySelector<HTMLElement>("main");
    let teardown = setup(current);
    const mo = new MutationObserver(() => {
      const next = document.querySelector<HTMLElement>("main");
      if (next === current) return;
      teardown();
      current = next;
      teardown = setup(current);
    });
    mo.observe(document.body, { childList: true, subtree: true });

    return () => {
      mo.disconnect();
      teardown();
    };
  }, [pathname]);

  return null;
}
