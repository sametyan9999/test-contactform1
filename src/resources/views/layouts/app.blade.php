<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'FashionablyLate') }}</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    {{-- 共通CSS（フォーム用を既定で読み込み） --}}
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    @yield('css')
</head>
<body>
    <header class="site-header">
        <div class="container">
            <h1 class="logo">FashionablyLate</h1>
        </div>
    </header>

    <main class="site-main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} FashionablyLate</p>
        </div>
    </footer>

    @yield('js')
</body>
</html>