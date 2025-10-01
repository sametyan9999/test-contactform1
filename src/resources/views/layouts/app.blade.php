<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'FashionablyLate') }}</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    {{-- ページごとのCSSを読み込む --}}
    @yield('css')
</head>
<body>
<header class="site-header">
    <div class="container">
        <h1 class="logo">FashionablyLate</h1>

        {{-- 🔧 右上のボタン切り替え --}}
        <nav class="header-nav">
            @auth
                {{-- ログイン済みなら logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">logout</button>
                </form>
            @else
                {{-- 未ログインなら login/register の切り替え --}}
                @if (Route::is('login'))
                    <a href="{{ route('register') }}" class="btn-register">register</a>
                @elseif (Route::is('register'))
                    <a href="{{ route('login') }}" class="btn-login">login</a>
                @endif
            @endauth
        </nav>
    </div>
</header>

<main class="site-main">
    <div class="container">
        @yield('content')
    </div>
</main>

{{-- ★ フッター自体を削除（©表記なし） --}}
{{-- <footer class="site-footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} FashionablyLate</p>
    </div>
</footer> --}}

@yield('scripts')
</body>
</html>