@extends('office/parts/app')

@section('meta')
<title>お知らせ編集完了 | {{ config('app.name') }}</title>
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
                    <h5 class="card-title">お知らせ編集完了</h5>

                    <div class="row pb-2">
                        <div class="col-12">
                            <p class="mt-3">
                            <div class="text-break w-100">お知らせを編集しました。</div>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-auto pb-2">
                            <a href="{{ route('officeNewsIndex', session('officeNewsIndexSearchParams')) }}" class="btn btn-primary">お知らせ一覧</a>
                        </div>

                        <div class="col-auto pb-2">
                            <a href="{{ route('officeNewsShow', ['id' => $assign['id']]) }}" class="btn btn-primary">お知らせ詳細</a>
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