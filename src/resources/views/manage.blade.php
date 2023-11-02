@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/manage.css') }}">
@endsection

@section('contents')
<div class="manage">
    <div class="manager-register">
        <form action="/manager-register" method="post">
            @csrf
            <h3>店長登録</h3>
            @if(session('manager-register__message'))
            <p class="manager-register__message">{{ session('manager-register__message')}}</p>
            @endif
            <table class="form__shop-manager">
                <tr>
                    <th>店長名</th>
                    <th>メールアドレス</th>
                    <th>パスワード</th>
                    <th>パスワード確認用</th>
                </tr>
                <tr>
                    <td><input type="text" name="name" value="{{ old('name') }}" placeholder="Username"></td>
                    <td><input type="email" name="email" value="{{ old('email') }}" placeholder="Email"></td>
                    <td><input type="password" name="password" value="{{ old('password') }}" placeholder="Password"></td>
                    <td><input type="password" name="password_confirmation" value="{{ old('password') }}" placeholder="確認用"></td>
                </tr>
                <tr>
                    <td class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </td>
                    <td class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </td>
                    <td class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </td>
                </tr>
            </table>
            <div class="form__manager-button">
                <button class="form__manager-submit" type="submit">店長登録</button>
            </div>
        </form>
    </div>
    <div class="store-manage">
        <div class="store-register">
            <form action="/store-register" method="post">
                @csrf
                <h3>店舗登録</h3>
                @if(session('store-register__message'))
                <p class="store-register__message">{{ session('store-register__message')}}</p>
                @endif
                <div class="form__store-content1">
                    <div class="form__content">
                        <span class="form__content-ttl">店名</span>
                        <input type="text" class="store__name" name="store_name" value="{{ old('store_name') }}">
                    </div>
                    <div class="form__error">
                        @error('store_name')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="form__content">
                        <span class="form__content-ttl">エリア</span>
                        <input type="text" class="store__area" name="area" value="{{ old('area') }}">
                    </div>
                    <div class="form__error">
                        @error('area')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="form__content">
                        <span class="form__content-ttl">ジャンル</span>
                        <input type="text" class="store__genre" name="genre" value="{{ old('genre') }}">
                    </div>
                    <div class="form__error">
                        @error('genre')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__store-content2">
                    <div class="form__content">
                        <span class="form__content-ttl">概要</span>
                        <textarea class="store__overview" name="overview">{{ old('overview') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('overview')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="form__content">
                        <span class="form__content-ttl">店舗画像</span>
                        <input type="file" class="store__picture" name="picture"><img src="{{ asset('/public/img/') }}">
                    </div>
                </div>
                <div class="form__store-button">
                    <button class="form__store-submit" type="submit">店舗登録</button>
                </div>
            </form>
        </div>
        <div class="store-list">
            <div class="store-list__tag">
                <h3>店舗一覧</h3>
                <div class="page-link">
                    {{ $shops->links()}}
                </div>
                <div class="store-list__right">
                    <form class="store-search" action="/search2" method="get">
                        @csrf
                        <div class="store-list__search-card">
                            <div class="store-list__search-area">
                                <select name="area_keyword">
                                    <option value="">All area</option>
                                    @foreach($areas as $area)
                                    <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="store-list__search-genre">
                                <select name="genre_keyword">
                                    <option value="">All genre</option>
                                    @foreach($genres as $genre)
                                    <option value="{{ $genre['genre'] }}">{{ $genre['genre'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="store-list__search-text">
                                <button class="store-list__search-button" type="submit">
                                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill:lightgray">
                                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                                    </svg>
                                </button>
                                <input type="text" name="text_keyword" placeholder="Search...">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if(session('store-update__message'))
            <p class="store-update__message">{{ session('store-update__message')}}</p>
            @endif
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                <li class="store-update__error">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <table class="store-list__tbl">
                <tr>
                    <th>ID</th>
                    <th>店名</th>
                    <th>エリア</th>
                    <th>ジャンル</th>
                    <th>概要</th>
                    <th>画像</th>
                </tr>
                @foreach($shops as $shop)
                <tr>
                    <form class="store-update" action="/store-update/{{ $shop['id'] }}" method="post">
                        @csrf
                        @method('PATCH')
                        <td>{{ $shop['id'] }}</td>
                        <input type="hidden" name="id" value="{{ $shop['id'] }}">
                        <td width="100px"><input type="text" name="store_name" value="{{ $shop['store_name'] }}"></td>
                        <td width="100px"><input type="text" name="area" value="{{ $shop['area'] }}"></td>
                        <td width="100px"><input type="text" name="genre" value="{{ $shop['genre'] }}"></td>
                        <td width="600px"><textarea name="overview">{{ $shop['overview'] }}</textarea></td>
                        <td width="100px"><input type="text" name="picture" value="{{ $shop['picture'] }}"></td>
                        <td><button class="store-update__button" type="submit">更新</button></td>
                        <td><a class="store-reservation" href="/store-reservation">予約情報</a></td>
                    </form>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection