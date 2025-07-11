<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1515">
    <title>会員登録画面</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-body">

    {{-- ヘッダー --}}
    <header class="auth-header">
        <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH" class="auth-logo">
    </header>

    {{-- メインコンテンツ --}}
    <main class="auth-main">
        <h2 class="auth-title">会員登録</h2>

        {{-- エラーメッセージ --}}
        @if ($errors->any())
            <ul class="auth-errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <input type="text" name="name" placeholder="ユーザー名" value="{{ old('name') }}" class="auth-input">
            </div>
            <div>
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" class="auth-input">
            </div>
            <div>
                <input type="password" name="password" placeholder="パスワード" class="auth-input">
            </div>
            <div class="auth-input-wrapper">
                <input type="password" name="password_confirmation" placeholder="確認用パスワード" class="auth-input">
            </div>
            <button type="submit" class="auth-submit">登録する</button>
        </form>

        <p class="auth-link">
            <a href="{{ route('login') }}">ログインはこちら</a>
        </p>
    </main>
</body>
</html>
