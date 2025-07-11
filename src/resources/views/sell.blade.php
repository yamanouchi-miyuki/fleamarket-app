@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="title">商品を出品</h2>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品画像 --}}
        <div class="form-section" style="width: 680px; height: 186px;">
            <label for="image">商品画像</label>
            <input type="file" name="image" id="image">
        </div>

        {{-- 商品詳細 --}}
        <div class="form-section" style="width: 680px; height: 477px;">
            <label>商品詳細</label>

            {{-- カテゴリー --}}
            <div class="categories">
                <label>カテゴリー</label><br>
                @foreach($categories as $category)
                    <label>
                        <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                        {{ $category->name }}<
                    </label>
                @endforeach
            </div>

            {{-- 商品の状態 --}}
            <div>
                <label for="condition">商品の状態</label>
                <select name="condition" id="condition">
                    <option value="">選択してください</option>
                    <option value="新品">新品</option>
                    <option value="未使用に近い">未使用に近い</option>
                    <option value="目立った傷なし">目立った傷なし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="傷や汚れあり">傷や汚れあり</option>
                </select>
            </div>
        </div>

        {{-- 商品名と説明 --}}
        <div style="width: 680px; height: 46px;"><label>商品名と説明</label></div>

        <div style="width: 680px; height: 81px;">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name">
        </div>

        <div style="width: 680px; height: 81px;">
            <label for="brand_name">ブランド名</label>
            <input type="text" name="brand_name" id="brand_name">
        </div>

        <div style="width: 680px; height: 161px;">
            <label for="description">商品の説明</label>
            <textarea name="description" id="description" rows="4"></textarea>
        </div>

        {{-- 販売価格 --}}
        <div style="width: 680px; height: 81px;">
            <label for="price">販売価格</label>
            <input type="number" name="price" id="price" min="0">
        </div>

        {{-- 出品ボタン --}}
        <div style="width: 680px; height: 60px;">
            <button type="submit" class="submit-btn">出品する</button>
        </div>
    </form>
</div>
@endsection
