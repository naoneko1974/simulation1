@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('contents')
<div class="form__thanks">
    <div class="form__thanks-card">
        <h3 class="form__thanks-title">会員登録ありがとうございます</h3>
        <a class="form__thanks-submit" href="/">Topへ</a>
    </div>
</div>
@endsection