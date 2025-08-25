@extends('office/parts/app')

@section('meta')
<title>お知らせ登録確認 | {{ config('app.name') }}</title>
@endsection

@push('css')

@endpush

@push('head-js')

@endpush

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 pt-2">
                    <h5 class="card-title">お知らせ登録確認</h5>
                </div>
            </div>

            {{-- フォーム表示 --}}
            <div class="row pt-3">
                <div class="col-12">
                    <form method="POST" action="{{ App\Libraries\Utils::urlToPath(route('officeNewsCreateExecute')) }}" class="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                                お知らせ名
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                {{ $assign['confirm']['title'] }}
                            </div>
                        </div>

                        @if (isset($assign['confirm']['news_image_url_1']))
                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                                お知らせ画像1
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                <img src="{{ asset($assign['confirm']['news_image_url_1']) }}" alt="お知らせ画像" width="200">
                            </div>
                        </div>
                        @endif

                        @if (isset($assign['confirm']['news_image_url_2']))
                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                                お知らせ画像2
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                <img src="{{ asset($assign['confirm']['news_image_url_2']) }}" alt="お知らせ画像" width="200">
                            </div>
                        </div>
                        @endif

                        @if (isset($assign['confirm']['news_image_url_3']))
                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                                お知らせ画像3
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                <img src="{{ asset($assign['confirm']['news_image_url_3']) }}" alt="お知らせ画像" width="200">
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                                お知らせ説明
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                {!! nl2br(e($assign['confirm']['content'])) !!}
                            </div>
                        </div>




                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                                公開ステータス
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                {{ $assign['confirm']['status'] }}
                            </div>
                        </div>

                        {{-- 進むボタン --}}
                        <div class="my-3">
                            <button type="submit" class="btn btn-success d-grid w-100 text-white text-break" id="submit">登録する</button>
                        </div>

                        {{-- 戻るボタン --}}
                        <div class="my-3">
                            <button type="submit" name="back" value="1" class="text-break btn btn-outline-dark col-12 mb-0">前のページに戻る</button>
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