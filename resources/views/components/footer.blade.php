<footer>
    <div class="devwrap d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
        <!-- PC:左 / SP:一番上（ロゴ＋ページトップへ） -->
        <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center order-1 order-md-1">
            <img src="../image/logo_OBFall_white.png"
                class="link logo" onclick="scrollToTop()" alt="OBFall株式会社ロゴ">
        </div>

        <!-- PC:中央 / SP:一番下（住所など） -->
        <div class="footer-left col-12 col-md-4 order-3 order-md-2 text-center text-md-start">
            <p>
                〒105-0022<br>
                東京都港区海岸1-2-3&nbsp;&nbsp;汐留芝離宮ビルディング 21F<br>
                TEL:03-5403-5904<br>
                <a href="{{ url('/human-rights-policy') }}" target="_blank" class="human-rights-policy">
                    人権に関する基本方針と社内相談窓口
                </a>
            </p>

        </div>

        <!-- PC:右 / SP:2番目（お問い合わせボタン） -->
        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center order-2 order-md-3">
            <a href="{{ route('contact') }}" class="link-button" target="_blank" rel="noopener noreferrer">
                お問い合わせはこちら <i class="fa-solid fa-circle-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</footer>