@php
$title = 'お問い合わせ - 確認';
@endphp

@extends('layout')

@section('content')
<h1 class="text-center mt-2 mb-5">お問い合わせ確認</h1>
<div class="container">
    <form method="post" action="{{ route('process') }}"> <!-- このrouteの部分はフォームを送信するための適切なルート名に置き換えてください -->
        {{ csrf_field() }}
        <div class="form-group row">
            <p class="col-sm-4 col-form-label">お名前（10文字以内）<span class="badge badge-danger ml-1">必須</span></p>
            <div class="col-sm-8">
                <p class="form-control-static">{{ $inputs['name'] }}</p>
                <input type="hidden" name="name" value="{{ $inputs['name'] }}">

            </div>
        </div>

        <div class="form-group row">
            <p class="col-sm-4 col-form-label">メールアドレス<span class="badge badge-danger ml-1">必須</span></p>
            <div class="col-sm-8">
                <p class="form-control-static">{{ $inputs['email'] }}</p>
                <input type="hidden" name="email" value="{{ $inputs['email'] }}">
            </div>
        </div>

        <div class="form-group row">
            <p class="col-sm-4 col-form-label">会社名<span class="badge badge-danger ml-1">必須</span></p>
            <div class="col-sm-8">
                <p class="form-control-static">{{ $inputs['company'] }}</p>
                <input type="hidden" name="company" value="{{ $inputs['company'] }}">
            </div>
        </div>

        <div class="form-group row">
            <p class="col-sm-4 col-form-label">電話番号</p>
            <div class="col-sm-8">
                <p class="form-control-static">{{ $inputs['tel'] }}</p>
                <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
            </div>
        </div>


        <div class="form-group row">
            <p class="col-sm-4 col-form-label">お問い合わせ内容<span class="badge badge-danger ml-1">必須</span></p>
            <div class="col-sm-8">
                <p class="form-control-static">{{ $inputs['contents'] }}</p>
                <input type="hidden" name="contents" value="{{ $inputs['contents'] }}">
            </div>
        </div>
        <input type="hidden" name="action" value="submit">

        <div class="s">
            <button type="submit" class="btn btn-primary">送信</button>
            <a href="{{ route('contact') }}" class="btn btn-default">戻る</a> <!-- このrouteの部分はお問い合わせフォームページへ戻るための適切なルート名に置き換えてください -->
        </div>
    </form>
</div>
@endsection