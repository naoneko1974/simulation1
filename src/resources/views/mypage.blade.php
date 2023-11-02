@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('contents')
<div class="user">
    <p>{{ Auth::user()->name }}さん</p>
</div>
<div class="mypage">
    <div class="reserve">
        <h3 class="form__reserve-ttl">予約状況</h3>
        @if(session('message'))
        <p class="reserve_message">{{ session('message' )}}</p>
        @endif
        @if(!empty($reservations))
        @foreach($reservations as $reservation)
        <div class="form__reserve-card">
            <div class="form__reserve-tag">
                <div class="form__reserve-icon">
                    <svg class="clock-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill:white">
                        <path d="M582-298 440-440v-200h80v167l118 118-56 57ZM440-720v-80h80v80h-80Zm280 280v-80h80v80h-80ZM440-160v-80h80v80h-80ZM160-440v-80h80v80h-80ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                    </svg>
                </div>
                <p>予約{{ $reservation->pivot->id }}</p>
                <label class="form__reserve-cancel" for="cancel__pop-up">×</label>
                <input type="checkbox" id="cancel__pop-up">
                <div class="cancel__overlay">
                    <div class="cancel__window">
                        <p>予約{{ $reservation->pivot->id }}をキャンセルしますか？</p>
                        <div class="cancel__tag">
                            <form action="/delete/{{ $reservation->pivot->id }}" method="post">
                                <input type="hidden" name="id" value="{{ $reservation->pivot->id }}">
                                @csrf
                                @method('DELETE')
                                <button class="reserve__cancel" type="submit">はい</button>
                            </form>
                            <label class="cancel__close" for="cancel__pop-up">いいえ</label>
                        </div>
                    </div>
                </div>
            </div>
            <form class="form__reserve" action="/update/{{ $reservation->pivot->id }}" method="post">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{ $reservation->pivot->id }}">
                <div class="reserve__group">
                    <div class="reserve__group-ttl">
                        <span class="reserve__label-item">Shop</span>
                    </div>
                    <div class="reserve__group-content">
                        <p class="reserve__name">{{ $reservation['store_name'] }}</p>
                    </div>
                </div>
                <div class="reserve__group">
                    <div class="reserve__group-ttl">
                        <span class="reserve__label-item">Date</span>
                    </div>
                    <div class="reserve__group-content">
                        <input type="date" class="reserve__date" name="reserve_date" value="{{ $reservation->pivot->reserve_date }}" required>
                    </div>
                </div>
                <div class="reserve__group">
                    <div class="reserve__group-ttl">
                        <span class="reserve__label-item">Time</span>
                    </div>
                    <div class="reserve__group-content">
                        <input type="time" class="reserve__time" name="reserve_time" min="11:00" max="22:00" value="{{ $reservation->pivot->reserve_time }}" required>
                    </div>
                </div>
                <div class="reserve__group">
                    <div class="reserve__group-ttl">
                        <span class="reserve__label-item">Number</span>
                    </div>
                    <div class="reserve__group-content">
                        <input type="number" class="reserve__number" name="number" min="1" max="100" value="{{ $reservation->pivot->number }}" required>
                    </div>
                </div>
                <div class="reserve__group">
                    <div class="reserve__group-ttl">
                        <span class="reserve__label-item">評価★</span>
                    </div>
                    <div class="reserve__group-content-rate">
                        <label><input type="radio" class="reserve__rate" name="rate" value="0" {{ $reservation->pivot->rate==0 ? 'checked':null }}>0</label>
                        <label><input type="radio" class="reserve__rate" name="rate" value="1" {{ $reservation->pivot->rate==1 ? 'checked':null }}>1</label>
                        <label><input type="radio" class="reserve__rate" name="rate" value="2" {{ $reservation->pivot->rate==2 ? 'checked':null }}>2</label>
                        <label><input type="radio" class="reserve__rate" name="rate" value="3" {{ $reservation->pivot->rate==3 ? 'checked':null }}>3</label>
                        <label><input type="radio" class="reserve__rate" name="rate" value="4" {{ $reservation->pivot->rate==4 ? 'checked':null }}>4</label>
                        <label><input type="radio" class="reserve__rate" name="rate" value="5" {{ $reservation->pivot->rate==5 ? 'checked':null }}>5</label>
                    </div>
                </div>
                <div class="reserve__group">
                    <div class="reserve__group-ttl">
                        <span class="reserve__label-item">コメント</span>
                    </div>
                    <div class="reserve__group-content">
                        <textarea class="reserve__review" name="review">{{ $reservation->pivot->review }}</textarea>
                    </div>
                </div>
                <div class="form__reserve-button">
                    <button class="form__reserve-submit" type="submit">変更</button>
                </div>
            </form>
        </div>
        @endforeach
        @else
        <h3>予約はありません</h3>
        @endif
    </div>
    <div class="favorite">
        <div class="favorite__ttl">
            <h3>お気に入り店舗</h3>
        </div>
        <div class="favorite__list">
            @if(!empty($favorites))
            @foreach($favorites as $favorite)
            <div class="favorite__card">
                <div class="favorite__shop-img">
                    <img src="{{ $favorite['picture'] }}" alt="gazou">
                </div>
                <div class="favorite__shop-name">
                    <input type="text" value="{{ $favorite['store_name'] }}" readonly>
                </div>
                <div class="favorite__shop-hash">
                    ＃<input type="text" class="favorite__shop-area" value="{{ $favorite['area'] }}" readonly>
                    ＃<input type="text" class="favorite__shop-genre" value="{{ $favorite['genre'] }}" readonly>
                </div>
                <div class="favorite__shop-tag">
                    {{ $favorite['shop_id'] }}
                    <a class="favorite__shop-link" href="/detail/{{ $favorite['id'] }}">詳しくみる</a>
                    <div class="favorite__shop-icon">
                        <svg class="favorite__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill:red">
                            <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                        </svg>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection