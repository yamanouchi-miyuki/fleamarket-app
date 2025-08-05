@extends('layouts.auth')

@section('title', '会員登録画面')

@section('content')
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
@endsection    
