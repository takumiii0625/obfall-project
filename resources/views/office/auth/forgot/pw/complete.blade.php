@extends('office/parts/app')

@section('meta')
<title>パスワードを忘れたら | {{ config('app.name') }}</title>
@endsection

@push('css')

@endpush

@push('head-js')

@endpush

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">
    <div class="card p-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12 pt-2">
                    <h5 class="card-title">設定メール送信完了</h5>

                    <div class="row pb-2">
                        <div class="col-12">
                            <p class="mt-3">
                            <div class="text-break w-100">
                                パスワード設定用のメールを送信しました。<br>
                                パスワードの設定を行ってください。
                            </div>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-auto pb-2">
                            <a href="{{ route('officeLoginInput') }}" class="btn btn-primary">ログイン</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('body-js')

@endpush