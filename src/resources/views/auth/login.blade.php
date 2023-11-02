@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('contents')
<form class="form__login" action="/login" method="post">
    @csrf
    <div class="form__login-card">
        <span class="form__login-title">Login</span>
        <div class="form__login-contents">
            <div class="form__login-email">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="form__login-password">
                <input type="password" name="password" value="{{ old('password') }}" placeholder="Password">
            </div>
            <div class="form__error">
                @error('password')
                {{ @message }}
                @enderror
            </div>
            <div class="form__login-button">
                <button class="form__login-submit" type="submit">ログイン</button>
            </div>
        </div>
    </div>
</form>
@endsection