'use strict';

$(function () {

    var scroll = 0;

    /*  メインビジュアルの切り替え */
    $('.img-wrap img:nth-child(n+2)').hide();
    setInterval(function () {
        $(".img-wrap img:first-child").fadeOut(2000);
        $(".img-wrap img:nth-child(2)").fadeIn(2000);
        $(".img-wrap img:first-child").appendTo(".img-wrap");
    }, 4000);

    /* フェードイン */
    /* メインビジュアル */
    $('.top p').addClass('fadein-active01');
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



