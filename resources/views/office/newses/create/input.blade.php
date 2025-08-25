@extends('office/parts/app')

@section('meta')
<title>お知らせ登録 | {{ config('app.name') }}</title>
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
                    <h5 class="card-title">お知らせ登録</h5>
                </div>
            </div>

            {{-- フォーム表示 --}}
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ App\Libraries\Utils::urlToPath(route('officeNewsCreateConfirm')) }}" class="form" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold" for="title" role="button">
                                <span class="text-danger">※&nbsp;</span> タイトル
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control">
                            </div>
                            @error ('title')
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger mt-0 p-1 form-text" role="alert">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold" for="news_image_url_1" role="button">
                                お知らせ画像1
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-start flex-column pt-0 pb-2 py-md-2 fs-6">
                                <input type="file" name="news_image_url_1" id="news_image_url_1" class="form-control mb-2" accept="image/*" onchange="previewImage(event)">
                                <div class="mb-2">
                                    @if (!empty($assign['news_image_url_1']))
                                    <img id="imagePreview" src="{{ asset($assign['news_image_url_1']) }}" alt="お知らせ画像" width="200">
                                    <input type="hidden" name="news_image_url_1" value="{{ $assign['news_image_url_1'] }}">
                                    @endif
                                </div>
                            </div>
                            @error ('news_image_url_1')
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger mt-0 p-1 form-text" role="alert">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold" for="news_image_url_2" role="button">
                                お知らせ画像2
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-start flex-column pt-0 pb-2 py-md-2 fs-6">
                                <input type="file" name="news_image_url_2" id="news_image_url_2" class="form-control mb-2" accept="image/*" onchange="previewImage(event)">
                                <div class="mb-2">
                                    @if (!empty($assign['news_image_url_2']))
                                    <img id="imagePreview2" src="{{ asset($assign['news_image_url_2']) }}" alt="お知らせ画像" width="200">
                                    <input type="hidden" name="news_image_url_2" value="{{ $assign['news_image_url_2'] }}">
                                    @endif
                                </div>
                            </div>
                            @error ('news_image_url_2')
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger mt-0 p-1 form-text" role="alert">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold" for="news_image_url_2" role="button">
                                お知らせ画像3
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-start flex-column pt-0 pb-2 py-md-2 fs-6">
                                <input type="file" name="news_image_url_3" id="news_image_url_3" class="form-control mb-2" accept="image/*" onchange="previewImage(event)">
                                <div class="mb-2">
                                    @if (!empty($assign['news_image_url_3']))
                                    <img id="imagePreview3" src="{{ asset($assign['news_image_url_3']) }}" alt="お知らせ画像" width="200">
                                    <input type="hidden" name="news_image_url_3" value="{{ $assign['news_image_url_3'] }}">
                                    @endif
                                </div>
                            </div>
                            @error ('news_image_url_3')
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger mt-0 p-1 form-text" role="alert">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold" for="content" role="button">
                                <span class="text-danger">※&nbsp;</span> 内容
                            </label>
                            <div class="col-md-8 form-text d-flex align-items-center pt-0 pb-2 py-md-2 fs-6">
                                <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') }}</textarea>
                            </div>
                            @error ('content')
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger mt-0 p-1 form-text" role="alert">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>






                        <div class="row">
                            <label class="col-md-3 col-form-label d-flex align-items-center pt-2 pb-0 py-md-2 fs-6 fw-bold" for="status" role="button">
                                <span class="text-danger">※&nbsp;</span> 公開ステータス
                            </label>
                            <div class="col-md-8 form-text d-flex flex-column align-items-start pt-0 pb-2 py-md-2">
                                <select name="status" id="status" class="form-control">
                                    <option value="">未選択</option>
                                    @foreach ($assign['publicStatus'] as $key => $status)
                                    <option value="{{ $key }}" @selected($key==old('status'))>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('status')
                            <div class="col-md-3"></div>
                            <div class="col-md-8">
                                <div class="alert alert-danger mt-0 p-1 form-text" role="alert">{{ $message }}</div>
                            </div>
                            @enderror
                        </div>


                        {{-- 進むボタン --}}
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success d-grid w-100 text-white text-break" id="submit">確認する</button>
                        </div>

                        {{-- 戻るボタン --}}
                        <div class="my-3">
                            <a href="{{ route('officeNewsIndex', session('officeNewsIndexSearchParams')) }}" class="text-break btn btn-outline-dark col-12 mb-0">前のページに戻る</a>
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

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    }
</script>