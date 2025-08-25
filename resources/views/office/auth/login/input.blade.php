@extends('office/parts/app')

@section('meta')
<title>ログイン | {{ config('app.name') }}</title>
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
            </div>
            {{-- フォーム表示 --}}
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ App\Libraries\Utils::urlToPath(route('officeLoginExecute')) }}" class="form" enctype="multipart/form-data">
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

                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold" for="password" role="button">
                                パスワード
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                <input type="password" name="password" value="" id="password" class="form-control" autocapitalize="off" autocomplete="new-password">
                            </div>
                            @error ('password')
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger mt-0 p-1 form-text" role="alert">{{ $message }}</div>
                            </div>
                            @enderror
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <p class="fs-small text-break text-end">
                                    <a href="{{ route('officeForgotPwInput') }}">パスワードを忘れたら</a>
                                </p>
                            </div>
                        </div>

                        {{-- 進むボタン --}}
                        <div class="my-3">
                            <button type="submit" class="btn btn-success d-grid w-100 text-white text-break" id="submit">ログイン</button>
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