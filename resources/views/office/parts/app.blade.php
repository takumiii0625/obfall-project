<!DOCTYPE html>
<html lang="ja" class="light-style layout-compact layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="/" data-template="vertical-menu-template-default">

<head>
    <meta charset="utf-8" />

    {{-- noindex --}}
    <meta name="robots" content="noindex,nofollow,noarchive" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    @yield('meta')

    {{-- Favicon --}}
    <link href="/favicon.ico" rel="icon" type="image/x-icon" />

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    {{-- Icons --}}
    <link href="/backend/vendor/fonts/boxicons.css" rel="stylesheet" />

    {{-- Core CSS --}}
    <link href="/backend/vendor/css/rtl/core.css" rel="stylesheet" class="template-customizer-core-css" />
    <link href="/backend/vendor/css/rtl/theme-default.css" rel="stylesheet" class="template-customizer-theme-css" />

    {{-- Vendors CSS --}}
    <link href="/backend/vendor/libs/bootstrap/bootstrap-datepicker.css" rel="stylesheet" type="text/css">
    <link href="/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" />
    <link href="/backend/vendor/libs/typeahead-js/typeahead.css" rel="stylesheet" />
    <link href="/backend/vendor/libs/apex-charts/apex-charts.css" rel="stylesheet" />

    {{-- Page CSS --}}
    @guest
    <link href="/backend/vendor/css/pages/page-auth.css" rel="stylesheet" />
    @endguest
    @stack ('css')

    {{-- Helpers --}}
    <script src="/backend/vendor/js/helpers.js"></script>
    <script src="/backend/js/config.js"></script>

    {{-- Page JS --}}
    @stack ('head-js')
</head>

<body class="d-flex flex-column h-100">
    @if (! Auth::guard('office')->check())
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="app-brand justify-content-center pt-12 pb-2">
                        <a href="{{ route('officeNewsIndex') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo">
                                <img src="/logo.png" alt="" width="300">
                            </span>
                        </a>
                    </div>
                    {{-- メインコンテンツ --}}
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Auth::guard('office')->check())
    @if (request()->route()->named('*officeMemo*'))
    {{-- メインコンテンツ --}}
    @yield('content')
    @else
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {{-- サイドメニュー --}}
            @include ('office/parts/side')
            <div class="layout-page">
                {{-- ヘッダー --}}
                @include('office/parts/header')
                <div class="content-wrapper">
                    {{-- メインコンテンツ --}}
                    @yield('content')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        {{-- Overlay --}}
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    @endif
    @endif

    {{-- Core JS --}}
    <script src="/backend/vendor/libs/jquery/jquery.js"></script>
    <script src="/backend/vendor/libs/popper/popper.js"></script>
    <script src="/backend/vendor/js/bootstrap.js"></script>
    <script src="/backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/backend/vendor/libs/hammer/hammer.js"></script>
    <script src="/backend/vendor/js/menu.js"></script>

    {{-- Vendors JS --}}
    <script src="/backend/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="/backend/vendor/libs/bootstrap/bootstrap-datepicker.min.js"></script>
    <script src="/backend/vendor/libs/bootstrap/bootstrap-datepicker.ja.min.js"></script>
    <script src="/backend/vendor/libs/masonry/masonry.js"></script>
    <script src="/backend/js/extended-ui-perfect-scrollbar.js"></script>
    <script src="/backend/js/pages-account-settings-account.js"></script>

    {{-- API Key --}}
    <script id="apiKey" data-api-key="{{ config('app.api_key') }}"></script>

    {{-- Google Api --}}
    <script src="/backend/js/google.zip.js" id="googleZipSearch" data-google-api-key=""></script>

    {{-- Original JS --}}
    <script src="/backend/js/script.js"></script>

    {{-- Main JS --}}
    <script src="/backend/js/main.js"></script>

    {{-- Page JS --}}
    @stack('body-js')



</body>

</html>