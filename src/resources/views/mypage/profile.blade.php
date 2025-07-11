<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1515">
    <title>プロフィール設定</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="margin: 0; padding: 0; font-family: sans-serif;">

    {{-- ヘッダー --}}
    <header style="width: 1515px; height: 82px; background-color: black; display: flex; align-items: center; padding-left: 20px;">
        <img src="{{ asset('img/logo.svg') }}" alt="COACHTECH" style="height: 36px;">
        <div style="margin-left: auto; margin-right: 30px;">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               style="color: white; text-decoration: none; margin-right: 20px;">ログアウト</a>
            <a href="{{ route('mypage') }}" style="color: white; text-decoration: none; margin-right: 20px;">マイページ</a>
            <a href="{{ route('sell') }}" style="color: white; text-decoration: none;">出品</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </header>

    {{-- メイン --}}
    <main style="width: 680px; margin: 50px auto; text-align: center;">
        <h2 style="font-size: 24px; margin-bottom: 40px;">プロフィール設定</h2>

        {{-- プロフィール画像と選択ボタン --}}
        <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 40px;">
            <div style="width: 150px; height: 150px; background-color: #ccc; border-radius: 50%; margin-right: 30px;"></div>
            <button style="width: 179px; height: 49px; border: 1px solid red; background-color: white; color: red; font-weight: bold; font-size: 14px;">
                画像を選択する
            </button>
        </div>

        {{-- フォーム --}}
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <input type="text" name="name" placeholder="ユーザー名" value="{{ old('name') }}"
                       style="width: 680px; height: 92px; font-size: 16px; padding-left: 10px;">
                       @if ($errors->has('name'))
                       <p style="color:red;">{{ $errors->first('name') }}</p>
                       @endif
            </div>
            <div style="margin-bottom: 20px;">
                <input type="text" name="postal_code" placeholder="郵便番号" value="{{ old('postal_code') }}"
                       style="width: 680px; height: 92px; font-size: 16px; padding-left: 10px;">
                       @if ($errors->has('postal_code'))
                       <p style="color:red;">{{ $errors->first('postal_code') }}</p>
                       @endif
            </div>
            <div style="margin-bottom: 20px;">
                <input type="text" name="address" placeholder="住所" value="{{ old('address') }}"
                       style="width: 680px; height: 92px; font-size: 16px; padding-left: 10px;">
                       @if ($errors->has('address'))
                       <p style="color:red;">{{ $errors->first('address') }}</p>
                       @endif
            </div>
            <div style="margin-bottom: 30px;">
                <input type="text" name="building_name" placeholder="建物名" value="{{ old('building_name') }}"
                       style="width: 680px; height: 92px; font-size: 16px; padding-left: 10px;">
            </div>

            <button type="submit"
                    style="width: 680px; height: 60px; background-color: #FF5A5A; color: white; font-weight: bold; border: none; font-size: 16px;">
                更新する
            </button>
        </form>
    </main>
</body>
</html>
