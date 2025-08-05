@extends('layouts.app')

@section('content')

    {{-- メイン --}}
    <main class="profile-wrapper">
        <h2 class="profile-title">プロフィール設定</h2>

        {{-- フォーム --}}
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

        {{-- プロフィール画像と選択ボタン --}}
        <div class="profile-image-section">
            @if (Auth::user()->profile_image)
                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="プロフィール画像" class="profile-image-preview">
            @else
                <div class="profile-image-placeholder"></div>
            @endif

            <input type="file" name="profile_image" class="profile-image-input">
            @if ($errors->has('profile_image'))
                <p class="error">{{ $errors->first('profile_image') }}</p>
            @endif
        </div>

            <div class="form-group">
                <label for="name" class="form-label">ユーザー名</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="profile-input">
                @if ($errors->has('name'))
                    <p style="color:red;">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="postal_code" class="form-label">郵便番号</label>
                <input type="text" name="postal_code"  value="{{ old('postal_code', Auth::user()->postal_code) }}" class="profile-input">
                @if ($errors->has('postal_code'))
                    <p style="color:red;">{{ $errors->first('postal_code') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="address" class="form-label">住所</label>
                <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}" class="profile-input">
                @if ($errors->has('address'))
                    <p style="color:red;">{{ $errors->first('address') }}</p>
                @endif
            </div>
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="building_name" class="form-label">建物名</label>
                <input type="text" name="building_name" value="{{ old('building_name', Auth::user()->building_name) }}" class="profile-input">
            </div>

            <button type="submit" class="profile-submit">更新する</button>
        </form>
    </main>
    <script>
document.querySelector('.profile-image-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
            const preview = document.querySelector('.profile-image-preview');
            if (preview) {
                preview.src = evt.target.result;
            } else {
                const placeholder = document.querySelector('.profile-image-placeholder');
                const img = document.createElement('img');
                img.src = evt.target.result;
                img.classList.add('profile-image-preview');
                placeholder.replaceWith(img);
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection

