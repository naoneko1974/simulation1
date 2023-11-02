@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('contents')
<form class="form__register" action="/register" method="post">
    @csrf
    <div class="form__register-card">
        <span class="form__register-title">Registration</span>
        <div class="form__register-contents">
            <div class="form__register-name">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Username">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="form__register-email">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="form__register-password">
                <input type="password" name="password" value="{{ old('password') }}" placeholder="Password">
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <div class="form__register-password">
                <input type="password" name="password_confirmation" value="{{ old('password') }}" placeholder="確認用">
            </div>
            <div class="form__register-button">
                <button class="form__register-submit" type="submit">登録</button>
            </div>
        </div>
    </div>
</form>
@endsection