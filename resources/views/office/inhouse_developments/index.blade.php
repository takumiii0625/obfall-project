@extends('office/parts/app')

@section('meta')
<title>自社開発一覧 | {{ config('app.name') }}</title>
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
                <div class="col-6 pt-2">
                    <h5 class="card-title">自社開発一覧</h5>
                </div>
                <div class="col-6 pt-2 text-end">
                    <a href="{{ route('officeDevelopmentsCreateInput') }}" class="btn btn-primary">登録</a>
                </div>
            </div>

            {{-- 検索条件 --}}
            <div class="row">
                <div class="col-12 mb-4 order-0">
                    <div class="accordion mt-3" id="accordionSearchArea">
                        <div class="card p-3 accordion-item {{ request()->accordion ? 'active' : '' }}">
                            <div class="row">
                                <h2 class="accordion-header" id="headingSearch">
                                    <button type="button" class="p-0 text-warning accordion-button {{ request()->accordion ? '' : 'collapsed' }}" data-bs-toggle="collapse" data-bs-target="#collapseSearch" aria-expanded="{{ request()->accordion ? 'true' : 'false' }}" aria-controls="collapseSearch">
                                        検索条件
                                    </button>
                                </h2>
                            </div>
                            <form method="GET" action="" class="">
                                <input type="hidden" name="accordion" value="{{ request()->accordion }}">
                                <input type="hidden" name="per_page" value="{{ $assign['per_page'] }}">
                                <div id="collapseSearch" class="accordion-collapse collapse {{ request()->accordion ? 'show' : '' }}" aria-labelledby="headingSearch" data-bs-parent="#accordionSearchArea">
                                    <div class="accordion-body p-0">
                                        <div class="row">

                                            <div class="col-6 col-md-3 pt-2">
                                                <label class="form-label" for="title" role="button">タイトル</label>
                                                <input type="text" name="title" value="{{ $assign['input']['title'] ?? null }}" class="form-control" id="title">
                                            </div>

                                            <div class="col-6 col-md-3 pt-2">
                                                <label class="form-label" for="content" role="button">内容</label>
                                                <input type="text" name="content" value="{{ $assign['input']['content'] ?? null }}" class="form-control" id="content">
                                            </div>

                                            <div class="col-6 col-md-3 pt-2">
                                                <label class="form-label" for="status" role="button">公開ステータス</label>
                                                <div class="d-flex flex-wrap">
                                                    @foreach($assign['publicStatus'] as $key => $value)
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="checkbox" name="status[]" id="status_{{ $key }}" value="{{ $key }}"
                                                            @if(in_array($key, $assign['input']['status'] ?? [])) checked @endif>
                                                        <label class="form-check-label" for="status_{{ $key }}">
                                                            {{ $value }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success w-100 text-white rounded-2 mt-3 py-1 form">検索する</button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="{{ route('officeDevelopmentsIndex') }}" class="btn btn-outline-dark w-100 rounded-2 mt-3 py-1">検索条件をクリアする</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    {{-- ページャー --}}
                    <div class="row mt-4 align-items-center">
                        <div class="col-md-6 text-start">
                            該当件数 : {{ number_format($assign['records']->total()) }}件
                        </div>
                        <div class="col-md-6 text-end">
                            <label for="per_page" class="me-2">表示件数 : </label>
                            <select name="per_page" id="perPage" class="form-select d-inline w-auto">
                                @foreach($assign['perPages'] as $label)
                                <option value="{{ $label }}" @if($assign['per_page']==$label) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            {{ $assign['records']->appends(request()->query())->links('office/parts/item/pagination') }}
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-black">
                                    <th scope="col" class="text-white fw-bold py-2">ID</th>
                                    <th scope="col" class="text-white fw-bold py-2">カテゴリ</th>
                                    <th scope="col" class="text-white fw-bold py-2">タイトル</th>
                                    <th scope="col" class="text-white fw-bold py-2">内容</th>
                                    <th scope="col" class="text-white fw-bold py-2">公開ステータス</th>
                                    <th scope="col" class="text-white fw-bold py-2">登録日</th>
                                    <th scope="col" class="text-center text-white fw-bold py-2">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($assign['records'] as $index => $record)
                                <tr class="{{ $record->status == 0 ? 'bg-lighter' : '' }}">
                                    <td class="py-2">
                                        {{ number_format($record->id) }}
                                    </td>
                                    <td class="py-2">
                                        {{ $record->category }}
                                    </td>
                                    <td class="py-2">
                                        {{ $record->title }}
                                    </td>
                                    <td class="py-2">
                                        {!! nl2br(e($record->content)) !!}
                                    </td>
                                    <td class="py-2">
                                        {{ $assign['publicStatus'][$record->status] ?? '' }}
                                    </td>
                                    <td class="py-2">
                                        {{ $record->created_at_fmt }}
                                    </td>

                                    <td class="text-center py-2">

                                        <a href="{{ route('officeDevelopmentsShow', ['id' => $record->id]) }}" class="btn btn-sm btn-icon btn-outline-info me-2" title="詳細">
                                            <i class="bx bx-xs bx-info-square"></i>
                                        </a>
                                        <a href="{{ route('officeDevelopmentsEditInput', ['id' => $record->id]) }}" class="btn btn-sm btn-icon btn-outline-warning me-2" title="編集">
                                            <i class="bx bx-xs bxs-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ App\Libraries\Utils::urlToPath(route('officeDevelopmentsDeleteExecute', ['id' => $record->id])) }}" enctype="multipart/form-data" class="d-inline" onsubmit="return confirmDelete()">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-danger me-2" title="削除"><i class="bx bx-xs bxs-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        データがありません。
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            該当件数 : {{ number_format($assign['records']->total()) }}件
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            {{-- ページャー --}}
                            {{ $assign['records']->appends(request()->query())->links('office/parts/item/pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection