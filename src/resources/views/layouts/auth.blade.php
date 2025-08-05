<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', '認証ページ')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-body">

    {{-- ヘッダー（ロゴのみ） --}}
    <header class="auth-header">
        <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH" class="auth-logo">
    </header>

    {{-- メイン --}}
    <main class="auth-main">
        @yield('content')
    </main>

</body>
</html>
