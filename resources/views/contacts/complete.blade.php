@php
$title = 'お問い合わせ確認';
@endphp

@extends('layout')

@section('content')
<h1 class="text-center mt-2 mb-5">お問い合わせありがとうございました。</h1>
<div class="s1">

    <a href="{{ route('contact') }}" class="btn btn-primary">お問い合わせ入力画面に戻る</a>
</div>
@endsection