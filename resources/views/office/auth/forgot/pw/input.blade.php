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
                {{-- エラー/サクセス メッセージ --}}
                @include ('office/parts/item/alert')
                <div class="row pb-2">
                    <div class="col-12">
                        <p class="mt-3">
                            <div class="text-break w-100">
                                登録されたメールアドレスを入力してください。<br>
                                パスワード設定のご案内メールをお送りします。
                            </div>
                        </p>
                    </div>
                </div>

                {{-- フォーム表示 --}}
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ App\Libraries\Utils::urlToPath(route('officeForgotPwExecute')) }}" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold" for="email" role="button">
                                    メールアドレス
                                </label>
                                <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                    <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control">
                                </div>
                                @error ('email')
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <div class="alert alert-danger mt-0 p-1 form-text" role="alert">{{ $message }}</div>
                                    </div>
                                @enderror
                            </div>

                            {{-- 進むボタン --}}
                            <div class="my-3">
                                <button type="submit" class="btn btn-success d-grid w-100 text-white text-break" id="submit">送信する</button>
                            </div>

                            {{-- 戻るボタン --}}
                            <div class="my-3">
                                <a href="{{ route('officeLoginInput') }}" class="text-break btn btn-outline-dark col-12 mb-0">ログインページに戻る</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('body-js')

@endpush
