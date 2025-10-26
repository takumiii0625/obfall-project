<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="icon" href="./image/favicon.png" type=image/png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OBFall株式会社</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="http://me.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=0D8Mqiyl_Gou1VCfi3p6E4jV-8lqhliW549_OZVyLQ-Y5LDQcDLkF41bPrE6rSydcSX9vDs0gdEXpRWcSKBw-Q" charset="UTF-8"></script>
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>



    <div class="contact-logo1">
        <div class="contact-logo">

            <img src="./image/logo_OBFall.png" class="link" />
            <a href="{{ url('/') }}">
                <div class="title">OBFall株式会社</div>
            </a>

        </div>

    </div>
    <div class="container">



        @yield('content')
    </div>

</body>




</html>
<footer>
    <div class="wrap">
        <div class="footer-left">

            <p>
                〒105-0022<br>
                東京都港区海岸1-2-3&nbsp;&nbsp;汐留芝離宮ビルディング 21F<br>
                TEL:03-5403-5904
            </p>
            <small>&copy; OBFall株式会社</small>
        </div>

    </div>

</footer>