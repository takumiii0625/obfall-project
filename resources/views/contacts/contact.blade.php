<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Bootstrap 5 CDN (例) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1c70550d95.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Philosophy | OBFall Inc.</title>
    <style>
        /* ====== Minimal Design Tokens ====== */
        :root {
            --bg: #ffffff;
            --ink: #1A1A1A;
            --ink-2: #3a3a3a;
            --muted: #6b7785;
            --blue: #1E90FF;
            --blue-weak: #F6FAFD;
            --card: #ffffff;
            --divider: #E7EEF5;
            --radius: 16px;
            --shadow: 0 2px 14px rgba(0, 0, 0, .06);
            --maxw: 1120px;
        }

        .human-rights-policy {
            color: #eef6ff
        }

        html,
        body {
            background: var(--bg);
            color: var(--ink);
            font-family: -apple-system, BlinkMacSystemFont, "Hiragino Kaku Gothic ProN", "Noto Sans JP", Segoe UI, Roboto, Ubuntu, "Helvetica Neue", "Helvetica", Arial, sans-serif;
            line-height: 1.8;
        }

        h1,
        h2,
        h3 {
            line-height: 1.35;
            margin: 0 0 .5em
        }

        h1 {
            font-size: clamp(28px, 4vw, 100px);
            font-weight: 800;
            color: black;
            font-family: 'Times New Roman', Times, serif;
        }

        h2 {
            font-size: clamp(18px, 2.6vw, 26px);
            font-weight: 700;
            color: var(--blue)
        }

        h3 {
            font-size: clamp(16px, 2.2vw, 22px);
            font-weight: 700
        }

        p {
            margin: .6em 0
        }

        .wrap {
            max-width: var(--maxw);
            margin: 0 auto;
            padding: 0 20px
        }

        section {
            padding: 80px 0;
            border-top: 1px solid var(--divider)
        }

        .container {
            padding-top: 140px;
        }

        .form-group {
            padding: 10px;
        }

        .alert-danger {
            margin-top: 15px;
            padding: 5px;
        }

        @media (max-width: 767.98px) {
            .container {
                padding-top: 100px;
            }

            .form-group {
                padding: 10px;
            }

        }
    </style>
</head>

<body>
    <div class="top">
        <header class="fadein-first fadein-from-up">
            <div class="wrap">
                <a href="{{ route('indexDev') }}" class="text-dark text-decoration-none">
                    <div class="logo-container">
                        <img src="../image/logo_OBFall.png" class="link" onclick="scrollToTop()" />
                    </div>
                </a>
                <nav class="nav-01">
                    <ul>
                        <li class="link text-dark "><a href="{{ route('philosophy') }}" class="text-dark text-decoration-none">PHILOSOPHY</a></li>
                        <li class="link text-dark "><a href="{{ route('userServicesShow') }}" class="text-dark text-decoration-none">SERVICE</a></li>
                        <li class="link text-dark "><a href="{{ route('achievements') }}" class="text-dark text-decoration-none">ACHIEVEMENTS</a></li>
                        <li class="link text-dark "><a href="{{ route('aboutus') }}" class="text-dark text-decoration-none">ABOUT US</a></li>
                        <li class="link text-dark "><a href="{{ route('contact') }}" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTACT</a></li>

                    </ul>
                </nav>
                <div class="hamburger">
                    <span class="bar bar-top"></span>
                    <span class="bar bar-middle"></span>
                    <span class="bar bar-bottom"></span>
                </div>
            </div>
        </header>
        <nav class="nav-02">
            <ul>

                <li class="link text-dark "><a href="{{ route('philosophy') }}" class="text-dark text-decoration-none">PHILOSOPHY</a></li>
                <li class="link text-dark "><a href="{{ route('userServicesShow') }}" class="text-dark text-decoration-none">SERVICE</a></li>
                <li class="link text-dark "><a href="{{ route('achievements') }}" class="text-dark text-decoration-none">ACHIEVEMENTS</a></li>
                <li class="link text-dark "><a href="{{ route('aboutus') }}" class="text-dark text-decoration-none">ABOUT US</a></li>
                <li class="link text-dark "><a href="{{ route('contact') }}" class="text-dark text-decoration-none" target="_blank" rel="noopener noreferrer">CONTACT</a></li>

            </ul>
        </nav>
    </div>

    <div class="container">
        <h1 class="text-center mt-2 mb-5">お問い合わせ</h1>
        <form method="post" action="{{ route('confirm') }}"> <!-- routeの部分は適切なルート名に置き換えてください -->
            {{ csrf_field() }}

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="name">お名前（10文字以内）<span class="badge badge-danger ml-1">必須</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" placeholder="お名前をご記入ください" value="{{ old('name') }}">
                </div>
                @if ($errors->has('name'))
                <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="email">メールアドレス<span class="badge badge-danger ml-1">必須</span></label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="例：○○○○@○○○○.com" value="{{ old('email') }}">
                </div>
                @if ($errors->has('email'))
                <p class="alert alert-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="company">会社名<span class="badge badge-danger ml-1">必須</span></label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="company" name="company" placeholder="例：○○○○株式会社" value="{{ old('company') }}">
                </div>
                @if ($errors->has('company'))
                <p class="alert alert-danger">{{ $errors->first('company') }}</p>
                @endif
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="tel">電話番号</label>
                <div class="col-sm-8">
                    <input type="tel" class="form-control" id="tel" name="tel" placeholder="例: 03-1234-5678" value="{{ old('tel') }}">
                </div>
                @if ($errors->has('tel'))
                <p class="alert alert-danger">{{ $errors->first('tel') }}</p>
                @endif
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="contents">お問い合わせ内容<span class="badge badge-danger ml-1">必須</span></label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="contents" name="contents" rows="4" placeholder="お問い合わせ内容をご記入ください">{{ old('contents') }}</textarea>
                </div>
                @if ($errors->has('contents'))
                <p class="alert alert-danger">{{ $errors->first('contents') }}</p>
                @endif
            </div>

            <div class="c-form__terms">
                <div class="c-form__terms-container">
                    <h4 class="c-form__terms-ttl">プライバシーポリシー</h4>
                    当社（OBFall株式会社　所在地：東京都港区海岸1-2-3　汐留芝離宮ビルディング21F　代表者：上遠野　博紀）は、個人情報の取り扱いについて、以下の通りプライバシーポリシー（以下本ポリシー）を定めます。<br><br>

                    第1条　基本方針<br>
                    当社は、個人情報の取り扱いに対する重要性を認識し、関連法令を遵守するとともに、厳重な管理体制のもとで皆様の個人情報の保護を行います。<br>
                    なお、本ポリシーは、本ウェブサイトで取得する個人情報のみに適用されます。<br><br>

                    第2条　個人情報の定義<br>
                    本ポリシーにおいて「個人情報」とは、個人情報の保護に関する法律第2条1項に定める情報をいいます。また、本ポリシーにおいて「個人データ」とは、個人情報の保護に関する法律第2条6項に定める情報をいい、「個人保有データ」とは個人情報の保護に関する法律第2条7項に定める情報をいいます。<br><br>

                    第3条　個人情報の取得<br>
                    当社は、個人情報を取得する際は、個人情報の保護に関する法律、及びその他の法令を遵守します。個人情報の提供に関しましては、提供者のご判断によるものであり、当社が強要するものではありません。<br><br>

                    第4条　個人情報の利用<br>
                    当社は取得した個人情報を下記目的のために利用いたします。<br><br>

                    1. 採用選考、応募者との連絡、求人者の管理等<br>
                    2. アンケートの実施<br>
                    3. 本ウェブサイトの運営上必要な事項の通知（電子メールによる通知を含むものとします。）<br>
                    4. 各種問い合わせ<br>
                    5. 契約や法律等に基づく権利の行使や義務の履行<br><br>

                    第5条　個人情報の管理<br>
                    当社は皆様からご提供いただいた個人情報を適切かつ慎重に管理し、その漏洩、誤用、改ざん、不正アクセスなどの危険については、必要かつ適切なレベルの安全対策を実施し、個人情報の保護に努めます。<br><br>

                    1. 技術的保護措置<br>
                    外部からの不正アクセスから個人情報を守るための措置（SSLセキュリティの使用、ウイルス対策ソフトウェアの導入等）を実施します。<br>
                    2. 組織的保護措置<br>
                    従業員に対し、定期的に個人情報の管理に関する研修を実施します。<br><br>

                    第6条　SSLセキュリティについて<br>
                    本ウェブサイトの応募者の個人情報に関するページには、第三者に皆様の重要な情報を読み取られたり、改ざんされたりすることを防ぐために、SSLを使用しております。SSL（SecureSocketLayer）とはデータを暗号化して通信するセキュリティ機能です。SSLで暗号化することによって応募者の個人情報をハッカーやクラッカーから守り、安全に情報を送信することができます。<br><br>

                    第7条　クッキー（Cookie）について<br>
                    クッキー（Cookie）は、ウェブサイトが記録を保持する目的で、応募者のコンピュータのハードディスクに送付する小さなテキストファイルです。クッキーを利用すると、応募者の特定のサイトに対する好みに関する情報を記録して、ウェブ利用をより有益なものにできます。<br><br>
                    クッキーにより、ユーザーの使用するコンピューターが特定されますが、ユーザー個人の身元を特定できるわけではありません。利用者の方々は、クッキーの使用について選択することができます。ほとんどのコンピュータのブラウザはクッキーを受け付けられるようにセットされていますが、こうしたクッキーを利用した情報収集に抵抗をお感じでしたら、ご利用のブラウザでクッキーの受け入れを拒否する設定をすることも可能です。ただし、クッキーを拒否した場合、本ウェブサイトのいくつかのサービス・機能が正しく動作しない場合もありますので、予めご了承ください。<br><br>

                    当社のウェブサイトでは、以下のような場合にクッキーを使用することがあります。<br>

                    1. カスタマイズされたサービスを提供するにあたり、利用者が便利にご利用いただけるようにクッキーを使用することがあります。このクッキーは利用者がカスタマイズされたページにアクセスした時、またはログインするときに設定されます。<br>
                    2. 本ウェブサイトの利用者数を計るために使用する場合があります。<br><br>

                    第8条　個人データの第三者への開示<br>
                    当社は、個人データ情報を本人の許可なく他の事業者や個人などの第三者に提供および公開することはありません。ただし、以下に該当する場合はその限りではありません。<br><br>

                    1. 情報提供について本人の同意がある場合<br>
                    2. 官公庁等の公的機関から法令に基づき開示を求められた場合<br>
                    3. 本ウェブサイトの運営に関する業務提携先に対して個人情報を開示する場合。ただし、この場合に開示する情報は必要な範囲のみに限定し、開示先に対して契約等により個人情報の管理を義務付けます。<br><br>

                    第9条　開示、訂正等の手続きについて<br>
                    当社は、ご本人からの法令上開示対象となる保有個人データの開示（第三者提供記録を含む）、利用目的の通知、保有個人データの内容が事実に反する場合等における訂正等、利用停止等及び第三者提供の停止（以下「開示等」という。）のご請求を受付いたします。<br>

                    開示請求を受けた場合は、書面または電磁的記録の提供により、遅滞なくこれを開示します。ただし、開示することにより次のいずれかに該当する場合は、その全部または一部を開示しないこともあり、開示しない決定をした場合や、開示に多額の費用を要する場合等ご本人から指定された開示方法による開示が困難な場合（書面での開示になります）には、その旨を遅滞なく通知します。<br><br>

                    1.ご本人または第三者の生命、身体、財産その他の権利利益を害するおそれがある場合<br>
                    2.当社の業務の適正な実施に著しい支障を及ぼすおそれがある場合<br>
                    3.その他法令に違反することとなる場合<br>
                    4.法令で開示義務が除外されている場合<br><br>

                    手続き方法については以下のように定めます。<br><br>

                    (1)開示等の求めの申し出先<br>
                    必要事項を記載したメールもしくは書面を、末尾記載の窓口にご提出ください。<br><br>

                    (2)ご提出いただくもの<br>
                    ①個人情報利用目的の通知・開示請求書<br>
                    ②個人情報訂正等請求書<br>
                    ③個人情報利用停止等請求書<br>
                    ④本人確認のための書類（運転免許証、パスポートなど）<br>
                    ⑤法定代理人の場合は、上記④に加え、法定代理権があることを確認する書類<br><br>

                    (3)手数料<br>
                    当該ご請求のうち、開示のご請求及び利用目的の通知のご請求につきましては、1回のご請求につき1,000円（税別）の手数料をご負担いただきますので、あらかじめご了承ください。なお郵送でご請求いただく場合は、振込み等により、手数料をいただきます。<br><br>

                    第10条　プライバシーポリシーの制定日及び改定日<br>
                    制定：2022年8月2日<br><br>

                    第11条　免責事項<br>
                    当社Webサイトに掲載されている情報の正確性には万全を期していますが、利用者が当社Webサイトの情報を用いて行う一切の行為に関して、一切の責任を負わないものとします。<br>
                    当社は、利用者が当社Webサイトを利用したことにより生じた利用者の損害及び利用者が第三者に与えた損害に関して、一切の責任を負わないものとします。<br><br>

                    第12条　著作権・肖像権<br>
                    当社Webサイト内の文章や画像、すべてのコンテンツは著作権・肖像権等により保護されています。無断での使用や転用は禁止されています。<br><br>

                    第13条　リンク<br>
                    当社Webサイトへのリンクは、自由に設置していただいて構いません。ただし、Webサイトの内容等によってはリンクの設置をお断りすることがあります。<br><br>

                    第14条　プライバシーポリシーの変更<br>
                    1.本ポリシーの内容は、ユーザーに通知することなく、変更することができるものとします。<br>
                    2.当社が別途定める場合を除いて、変更後のプライバシーポリシーは、本ウェブサイトに掲載したときから効力を生じるものとします。<br><br>


                </div>
            </div>


            <div class="privacy">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="privacy_agree" id="privacy_agree" {{ old('privacy_agree') ? 'checked' : '' }}>
                    <label class="form-check-label" for="privacy_agree">
                        プライバシーポリシーに同意します。
                    </label>
                </div>

            </div>
            @if ($errors->has('privacy_agree'))
            <p class="alert alert-danger">{{ $errors->first('privacy_agree') }}</p>
            @endif

            <div class="s">
                <button type="submit" class="btn btn-primary">確認画面へ</button>

            </div>



        </form>

    </div>
    <nav aria-label="breadcrumb" class="m-3">
        <ol class="breadcrumb" style="--bs-breadcrumb-divider:'＞'; font-size: clamp(.875rem, 1.8vw, 1rem);">

            <li class="breadcrumb-item"><a href="{{ route('indexDev') }}">トップ</a></li>
            <li class="breadcrumb-item">お問い合わせ</a></li>
        </ol>
    </nav>
    <footer>
        <div class="devwrap d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
            <!-- PC:左 / SP:一番上（ロゴ＋ページトップへ） -->
            <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start align-items-center order-1 order-md-1">
                <img src="./image/logo_OBFall_white.png"
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

            </div>
        </div>
    </footer>
    <script src="{{ asset('js/main.js') }}" defer></script>

</body>

</html>