@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('contents')
<div class="shop__detail">
    <div class="shop__detail-tag">
        <a class="shop__detail-back" href="/">＜</a>
        <div class="shop__detail-name">
            <input type="text" value="{{ $shops['store_name'] }}" readonly>
        </div>
    </div>
    <div class="shop__detail-img">
        <img src="{{ $shops['picture'] }}" alt="gazou">
    </div>
    <div class="shop__detail-hash">
        ＃<input type="text" class="shop__detail-area" value="{{ $shops['area'] }}" readonly>
        ＃<input type="text" class="shop__detail-genre" value="{{ $shops['genre'] }}" readonly>
    </div>
    <div class="shop__detail-overview">
        <p>{{ $shops['overview'] }}</p>
    </div>
    @if(Auth::check())
    <form class="form__reserve" action="/done" method="post">
        @csrf
        <div class="shop__reserve">
            <div class="form__reserve-card">
                <h2 class="form__reserve-title">予約</h2>
                <input type="hidden" name="shop_id" value="{{ $shops['id'] }}">
                <div class="form__reserve-date">
                    <input type="date" name="reserve_date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="form__reserve-time">
                    <input type="time" name="reserve_time" min="11:00" max="22:00" value="17:00" required>
                </div>
                <div class="form__reserve-number">
                    <input type="number" name="number" min="1" max="100" value="1" required>
                </div>
            </div>
            <div class="form__confirm">
                <table class="form__confirm-table">
                    <tr>
                        <td>Shop</tdh=>
                        <td>{{ $shops['store_name'] }}</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>{{ old('reserve_date') }}</td>
                    </tr>
                    @error('reserve_date')
                    <tr>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
                    <tr>
                        <td>Time</td>
                        <td>{{ old('reserve_time') }}</td>
                    </tr>
                    @error('reserve_time')
                    <tr>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
                    <tr>
                        <td>Number</td>
                        <td>{{ old('number') }}人</td>
                    </tr>
                    @error('number')
                    <tr>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
                </table>
            </div>
        </div>
        <div class="form__reserve-button">
            <button class="form__reserve-submit" type="submit">予約する</button>
        </div>
    </form>
    @else
    <h2 class="not-login">ログインしてください</h2>
    @endif
</div>
@endsection