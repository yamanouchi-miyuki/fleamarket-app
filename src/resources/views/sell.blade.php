@extends('layouts.app')

@section('content')
<div class="sell-container">
    <h2 class="sell-title">商品を出品</h2>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="sell-form">
        @csrf

        {{-- 商品画像 --}}
        <div class="form-section image-upload">
            <label for="image" class="sell-form label">商品画像</label>
            <input type="file" name="image" id="image" class="form-input">
            @error('image')
                <p class="error-message">{{ $message }}</p>
            @enderror
            <img id="preview-image" src="#" alt="プレビュー画像" style="display:none; max-width: 50%; margin-top: 10px;">
        </div>

        {{-- 商品詳細 --}}
        <div class="form-section detail-section">
            <label class="form-label">商品詳細</label>

            {{-- カテゴリー --}}
            <div class="category-list">
                <label class="sell-form label">カテゴリー</label>
                <div class="checkbox-group">
                    @foreach($categories as $category)
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="category-{{ $category->id }}" class="category-checkbox">
                        <label for="category-{{ $category->id }}" class="category-label">{{ $category->name }}</label>
                    @endforeach
                </div>
                @error('category_ids')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            {{-- 商品の状態 --}}
            <div class="form-group">
                <label for="condition" class="form-label">商品の状態</label>
                <select name="condition" id="condition" class="form-select">
                    <option value="">選択してください</option>
                    <option value="良好">良好</option>
                    <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="状態が悪い">状態が悪い</option>
                </select>
                @error('condition')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 商品名と説明 --}}
        <div class="form-section">
            <label class="form-label">商品名と説明</label>
        </div>

        <div class="form-group">
            <label for="name" class="form-label">商品名</label>
            <input type="text" name="name" id="name" class="form-input">
            @error('name')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="brand_name" class="form-label">ブランド名</label>
            <input type="text" name="brand_name" id="brand_name" class="form-input">
        </div>

        <div class="form-group">
            <label for="description" class="form-label">商品の説明</label>
            <textarea name="description" id="description" rows="4" class="form-textarea"></textarea>
            @error('description')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 販売価格 --}}
        <div class="form-group">
            <label for="price" class="form-label">販売価格</label>
            <input type="number" name="price" id="price" min="0" class="form-input">
            @error('price')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 出品ボタン --}}
        <div class="form-group">
            <button type="submit" class="submit-btn">出品する</button>
        </div>
    </form>
</div>
<script>
    document.getElementById('image').addEventListener('change', function (e) {
        const preview = document.getElementById('preview-image');
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                preview.src = event.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
