<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__left">
                <label class="header__menu" for="pop-up"></label>
                <input type="checkbox" id="pop-up">
                <div class="overlay">
                    <div class="window">
                        <label class="window-close" for="pop-up">×</label>
                        <div class="link">
                            <a class="link-home" href="/">Home</a>
                            @if(Auth::check())
                            <form action="/logout" method="post">
                                @csrf
                                <button class="link-logout" type="submit">Logout</button>
                            </form>
                            @if((Auth::user()->authority)!=3)
                            <a class="link-manage" href="/manage">Manage</a>
                            @else
                            <a class="link-mypage" href="/mypage">Mypage</a>
                            @endif
                            @else
                            <a class="link-register" href="/register">Register</a>
                            <a class="link-login" href="/login">Login</a>
                            @endif
                        </div>
                    </div>
                </div>
                <a class="header__logo" href="/">
                    Rese
                </a>
                @if(Auth::check())
                <div class="user__name">
                    <p>ようこそ、<br />{{ Auth::user()->name }}さん！</p>
                </div>
                @endif
            </div>
            <div class="header__right">
                <form class="header__search" action="/search" method="get">
                    @csrf
                    <div class="header__search-card">
                        <div class="header__search-area">
                            <select name="area_keyword">
                                <option value="">All area</option>
                                @foreach($areas as $area)
                                <option value="{{ $area['area'] }}">{{ $area['area'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="header__search-genre">
                            <select name="genre_keyword">
                                <option value="">All genre</option>
                                @foreach($genres as $genre)
                                <option value="{{ $genre['genre'] }}">{{ $genre['genre'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="header__search-text">
                            <button class="header__search-button" type="submit">
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
    </header>

    <main>
        <div class="form__shop-list">
            @foreach($shops as $shop)
            <div class="form__shop-card">
                <div class="form__shop-img">
                    <img src="{{ $shop['picture'] }}" alt="gazou">
                </div>
                <div class="form__shop-name">
                    <input type="text" value="{{ $shop['store_name'] }}" readonly>
                </div>
                <div class="form__shop-hash">
                    ＃<input type="text" class="form__shop-area" value="{{ $shop['area'] }}" readonly>
                    ＃<input type="text" class="form__shop-genre" value="{{ $shop['genre'] }}" readonly>
                </div>
                <div class="form__shop-tag">
                    <a class="form__shop-link" href="/detail/{{ $shop['id'] }}">詳しくみる</a>
                    <div class="form__shop-favorite">
                        @if(Auth::check())
                        @if($favorites->where('shop_id',$shop['id'])->first())
                        <form action="/unnice/{{ $shop['id'] }}" method="POST">
                            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                            @csrf
                            @method('DELETE')
                            <button class="favorite__submit" type="submit">
                                <svg class="favorite-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill:red">
                                    <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                                </svg>
                            </button>
                        </form>
                        @else
                        <form action="/nice/{{ $shop['id'] }}" method="POST">
                            <input type="hidden" name="shop_id" value="{{ $shop['id'] }}">
                            @csrf
                            <button class="favorite__submit" type="submit">
                                <svg class="favorite-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill:lightgrey">
                                    <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                                </svg>
                            </button>
                        </form>
                        @endif
                        @else
                        <svg class="favorite-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" style="fill:lightgray">
                            <path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z" />
                        </svg>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
</body>

</html>