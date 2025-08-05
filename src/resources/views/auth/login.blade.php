@extends('layouts.auth')

@section('title', 'ログイン画面')

@section('content')

    <main class="auth-main">
        <h2 class="auth-title-short">ログイン</h2>

        {{-- エラーメッセージの表示 --}}
        @if ($errors->any())
            <ul class="auth-errors">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" class="auth-input-short">
            </div>
            <div>
                <input type="password" name="password" placeholder="パスワード" class="auth-input-short">
            </div>
            <button type="submit" class="auth-button-short">ログインする</button>
        </form>

        <p class="auth-link">
            <a href="{{ route('register') }}">会員登録はこちら</a>
        </p>
    </main>
@endsection
