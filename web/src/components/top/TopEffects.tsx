"use client";

import { useEffect } from "react";

/**
 * トップページの JS 演出（public/js/main.js の移植）。UI は持たない。
 *
 * 1. .fadein-scroll … スクロール時に画面内へ入ったら fadein-active01 を付与／外れたら除去
 *    （現行は jQuery の scroll イベントのみで判定し、読込直後には評価しない。同じ挙動にする）
 * 2. [data-anim] … IntersectionObserver（threshold 0.15）で is-visible を付与。
 *    ヒーロー内の .char-anim / .anim-fade-up は 500ms 後に即時発火。
 *    prefers-reduced-motion の場合は全要素に即 is-visible。
 * 3. .net-node … ACHIEVEMENTS の SVG ノードを円運動させ、data-from / data-to の線を追従させる
 *
 * ※ 現行 main.js の a[href^="#"] スムーススクロールと .back-to-top は
 *    トップの現行マークアップに該当要素が無いため移植していない。
 */
export default function TopEffects() {
  useEffect(() => {
    const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    /* 1. fadein-scroll */
    const onScroll = () => {
      const windowHeight = window.innerHeight;
      const scroll = window.scrollY;
      document.querySelectorAll<HTMLElement>(".fadein-scroll").forEach((el) => {
        const elemPos = el.getBoundingClientRect().top + window.scrollY;
        if (scroll > elemPos - windowHeight) {
          el.classList.add("fadein-active01");
        }
        if (scroll > elemPos + el.offsetHeight || scroll < elemPos - windowHeight) {
          el.classList.remove("fadein-active01");
        }
      });
    };
    window.addEventListener("scroll", onScroll);

    /* 2. IntersectionObserver */
    const animEls = document.querySelectorAll<HTMLElement>("[data-anim]");
    let observer: IntersectionObserver | undefined;
    let heroTimer: number | undefined;
    if (!reducedMotion) {
      observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) entry.target.classList.add("is-visible");
          });
        },
        { threshold: 0.15 },
      );
      animEls.forEach((el) => observer!.observe(el));

      heroTimer = window.setTimeout(() => {
        document
          .querySelectorAll(".hero-content .char-anim, .hero-content .anim-fade-up")
          .forEach((el) => el.classList.add("is-visible"));
      }, 500);
    } else {
      animEls.forEach((el) => el.classList.add("is-visible"));
    }

    /* 3. net-node */
    let raf = 0;
    if (!reducedMotion) {
      const nodes = Array.from(document.querySelectorAll<SVGCircleElement>(".net-node")).map((circle) => {
        const id = circle.getAttribute("data-node");
        const svg = circle.closest("svg");
        return {
          circle,
          ox: parseFloat(circle.getAttribute("cx") ?? "0"),
          oy: parseFloat(circle.getAttribute("cy") ?? "0"),
          speed: 0.3 + Math.random() * 0.5,
          angle: Math.random() * Math.PI * 2,
          radius: 8 + Math.random() * 12,
          fromLines: id && svg ? Array.from(svg.querySelectorAll<SVGLineElement>(`line[data-from="${id}"]`)) : [],
          toLines: id && svg ? Array.from(svg.querySelectorAll<SVGLineElement>(`line[data-to="${id}"]`)) : [],
        };
      });

      const tick = () => {
        nodes.forEach((n) => {
          n.angle += 0.008 * n.speed;
          const nx = n.ox + Math.cos(n.angle) * n.radius;
          const ny = n.oy + Math.sin(n.angle) * n.radius;
          n.circle.setAttribute("cx", String(nx));
          n.circle.setAttribute("cy", String(ny));
          n.fromLines.forEach((l) => {
            l.setAttribute("x1", String(nx));
            l.setAttribute("y1", String(ny));
          });
          n.toLines.forEach((l) => {
            l.setAttribute("x2", String(nx));
            l.setAttribute("y2", String(ny));
          });
        });
        raf = requestAnimationFrame(tick);
      };
      if (nodes.length > 0) raf = requestAnimationFrame(tick);
    }

    return () => {
      window.removeEventListener("scroll", onScroll);
      observer?.disconnect();
      if (heroTimer !== undefined) window.clearTimeout(heroTimer);
      if (raf) cancelAnimationFrame(raf);
    };
  }, []);

  return null;
}
