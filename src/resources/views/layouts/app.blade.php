<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>COACHTECHフリマ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/items.css') }}">
    <link rel="stylesheet" href="{{ asset('css/items-show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sell.css') }}">
    @stack('styles')
    @yield('css')
</head>
<body>
    <header class="common-header">
        {{-- ロゴ --}}
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg') }}" alt="COACHTECHロゴ" class="common-logo">
        </a>

        {{-- 検索バー --}}
        <form action="{{ url('/') }}" method="GET" class="common-search-form">
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="なにをお探しですか？" class="common-search-input">
        </form>

        {{-- ナビゲーション --}}
        <nav class="common-navigation">
            @auth
                {{-- ログアウト --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="common-logout-button">ログアウト</button>
                </form>
                <a href="{{ route('mypage') }}" class="common-link">マイページ</a>
            @else
                <a href="{{ route('login') }}" class="common-link">ログイン</a>
            @endauth

            {{-- 出品ボタン --}}
            <a href="{{ url('/sell') }}" class="common-sell-button">出品</a>
        </nav>
    </header>

    <main class="common-main">
        @yield('content')
    </main>
</body>
</html>
