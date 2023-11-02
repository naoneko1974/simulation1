<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <label class="header__menu" for="pop-up"></label>
            <input type="checkbox" id="pop-up">
            <div class="overlay">
                <div class="window">
                    <label class="window-close" for="pop-up">×</label>
                    <div class="link">
                        <a class="link-home" href="/">Home</a>
                        @if(Auth::check())
                        <form action="/logout" method="post">
                            <button class="link-logout" type="submit">Logout</button>
                        </form>
                        <a class="link-mypage" href="/mypage">Mypage</a>
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
        </div>
    </header>

    <main>
        @yield('contents')
    </main>
</body>

</html>