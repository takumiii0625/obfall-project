@extends('office/parts/app')

@section('meta')
<title>自社開発登録完了 | {{ config('app.name') }}</title>
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
                    <h5 class="card-title">自社開発登録完了</h5>

                    <div class="row pb-2">
                        <div class="col-12">
                            <p class="mt-3">
                            <div class="text-break w-100">自社開発を登録しました。</div>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-auto pb-2">
                            <a href="{{ route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams')) }}" class="btn btn-primary">自社開発一覧</a>
                        </div>

                        <div class="col-auto pb-2">
                            <a href="{{ route('officeDevelopmentsCreateInput') }}" class="btn btn-primary">引き続き自社開発を登録する</a>
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