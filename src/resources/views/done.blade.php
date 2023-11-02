@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('contents')
<div class="form__done">
    <div class="form__done-card">
        <h3 class="form__done-title">ご予約ありがとうございます</h3>
        <a class="form__done-submit" href="/" >戻る</a>
    </div>
</div>
@endsection