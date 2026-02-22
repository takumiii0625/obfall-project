'use strict';

$(function () {

    var scroll = 0;

    /* フェードイン */
    $('header').addClass('fadein-active02');

    /* メインビジュアル以下 */
    $(window).scroll(function () {
        $('.fadein-scroll').each(function () {
            var elemPos = $(this).offset().top,
                windowHeight = $(window).height();
            scroll = $(window).scrollTop();

            if (scroll > elemPos - windowHeight) {
                $(this).addClass('fadein-active01');
            }

            if (scroll > elemPos + $(this).height() || scroll < elemPos - windowHeight) {
                $(this).removeClass('fadein-active01');
            }
        });
    });

    /* ハンバーガーメニュー */
    $('.hamburger').on('click', function () {
        $('.nav-02').toggleClass('nav-02-active');
        $(this).toggleClass('close');
    });

    /* オーバーレイクリックでメニューを閉じる */
    $(document).on('click', function (e) {
        if ($('.nav-02').hasClass('nav-02-active') &&
            !$(e.target).closest('.nav-02 ul, .hamburger').length) {
            $('.nav-02').removeClass('nav-02-active');
            $('.hamburger').removeClass('close');
        }
    });


    $(function () {
        $('a[href^="#"]').click(function () {
            let speed = 500;
            let href = $(this).attr("href");
            let target = $(href == "#" || href == "" ? 'html' : href);
            let position = target.offset().top;
            $("html, body").animate({ scrollTop: position }, speed, "swing");
            return false;
        });
    });

});

/* ========================================
   スクロールアニメーション（IntersectionObserver）
   ======================================== */
document.addEventListener('DOMContentLoaded', function () {
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* --- 1文字ずつ出現 [data-anim="char"] --- */
    document.querySelectorAll('[data-anim="char"]').forEach(function (el) {
        var text = el.textContent;
        el.textContent = '';
        el.setAttribute('aria-label', text);
        for (var i = 0; i < text.length; i++) {
            var span = document.createElement('span');
            span.textContent = text[i];
            span.className = 'char-span';
            span.style.setProperty('--i', i);
            if (text[i] === ' ') span.innerHTML = '&nbsp;';
            el.appendChild(span);
        }
    });

    if (!reducedMotion) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('[data-anim]').forEach(function (el) {
            observer.observe(el);
        });

        /* ヒーローの char-anim は即時発火 */
        setTimeout(function () {
            document.querySelectorAll('.hero-content .char-anim').forEach(function (el) {
                el.classList.add('is-visible');
            });
            document.querySelectorAll('.hero-content .anim-fade-up').forEach(function (el) {
                el.classList.add('is-visible');
            });
        }, 500);
    } else {
        document.querySelectorAll('[data-anim]').forEach(function (el) {
            el.classList.add('is-visible');
        });
    }
});

/* ========================================
   SVG図形アニメーション（ネットワーク図のノード移動）
   ======================================== */
document.addEventListener('DOMContentLoaded', function () {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    document.querySelectorAll('.net-node').forEach(function (circle) {
        var ox = parseFloat(circle.getAttribute('cx'));
        var oy = parseFloat(circle.getAttribute('cy'));
        var speed = 0.3 + Math.random() * 0.5;
        var angle = Math.random() * Math.PI * 2;
        var radius = 8 + Math.random() * 12;

        (function animate() {
            angle += 0.008 * speed;
            var nx = ox + Math.cos(angle) * radius;
            var ny = oy + Math.sin(angle) * radius;
            circle.setAttribute('cx', nx);
            circle.setAttribute('cy', ny);

            /* 接続線を更新 */
            var id = circle.getAttribute('data-node');
            if (id) {
                var svg = circle.closest('svg');
                svg.querySelectorAll('line[data-from="' + id + '"]').forEach(function (l) {
                    l.setAttribute('x1', nx); l.setAttribute('y1', ny);
                });
                svg.querySelectorAll('line[data-to="' + id + '"]').forEach(function (l) {
                    l.setAttribute('x2', nx); l.setAttribute('y2', ny);
                });
            }
            requestAnimationFrame(animate);
        })();
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggleNewsBtn');
    let expanded = false;

    // ✅ ボタンが存在する場合のみ処理を続ける
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            const newsItems = document.querySelectorAll('.news-item');

            if (!expanded) {
                // もっと見る → 全表示
                newsItems.forEach(el => el.classList.remove('d-none'));
                toggleBtn.textContent = '閉じる';
                expanded = true;
            } else {
                // 閉じる → 最初の3件だけ表示
                newsItems.forEach((el, index) => {
                    el.classList.toggle('d-none', index >= 3);
                });
                toggleBtn.textContent = 'もっと見る >';
                expanded = false;
            }
        });
    }
});



