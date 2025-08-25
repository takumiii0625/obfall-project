@extends('office/parts/app')

@section('meta')
<title>自社開発詳細 | {{ config('app.name') }}</title>
@endsection

@push('css')

@endpush

@push('head-js')

@endpush

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            {{-- エラー/サクセス メッセージ --}}
            @include ('office/parts/item/alert')
            <div class="row">
                <div class="col-12 pt-2">
                    <h5 class="card-title">自社開発詳細</h5>
                </div>
            </div>
            {{-- トップライト --}}
            <div class="row">
                <div class="col-12 pb-2 text-end">
                    <a href="{{ route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams')) }}" class="btn btn-outline-dark">戻る</a>
                    <a href="{{ route('officeDevelopmentsEditInput', ['id' => $assign['record']->id]) }}" class="btn btn-warning">編集</a>
                </div>
            </div>

            <div class="row">
                <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                    ID
                </label>
                <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    {{ $assign['record']->id }}
                </div>
            </div>

            <div class="row">
                <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                    カテゴリ
                </label>
                <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    {{ $assign['record']->category }}
                </div>
            </div>

            <div class="row">
                <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                    タイトル
                </label>
                <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    {{ $assign['record']->title }}
                </div>
            </div>

            <div class="row">
                <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                    自社開発画像
                </label>
                <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    <img src="{{ asset($assign['record']->inhouse_developments_image_url) }}" alt="自社開発画像" width="200">
                </div>
            </div>

            <div class="row">
                <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                    内容
                </label>
                <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    {!! nl2br(e($assign['record']->content)) !!}
                </div>
            </div>

            <div class="row">
                <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                    自社開発ホームページURL
                </label>
                <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    {{ $assign['record']->inhouse_developments_home_page_url }}
                </div>
            </div>

            <div class="row">
                <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold">
                    公開ステータス
                </label>
                <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                    {{ $assign['publicStatus'][$assign['record']->status] ?? '' }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('body-js')

@endpush