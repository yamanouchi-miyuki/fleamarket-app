@extends('layouts.app')

@section('content')
<div class="item-detail-container">
    <div class="item-detail-content">
        {{-- 商品画像（左） --}}
        <div class="item-detail-image">
            @if ($item->images->isNotEmpty())
                <img src="{{ $item->images->first()->path }}" alt="{{ $item->name }}">
            @else
                <p>画像なし</p>
            @endif
        </div>

        {{-- 商品情報＋コメント（右） --}}
        <div class="item-detail-info">
            {{-- 商品情報（名前、価格など） --}}
            <h2>{{ $item->name }}</h2>
            <p>{{ $item->brand_name ?? 'ブランド情報なし' }}</p>
            <p class="price">¥{{ number_format($item->price) }} <span>（税込）</span></p>

            {{-- いいね・コメント数 --}}
            <div class="item-icons">
                <span>
                    @auth
                        @php $isLiked = $item->likes->contains('user_id', auth()->id()); @endphp
                        @if ($isLiked)
                            <form action="{{ route('unlike') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="like-button gold">★ {{ $item->likes->count() }}</button>
                            </form>
                        @else
                            <form action="{{ route('like') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="like-button">☆ {{ $item->likes->count() }}</button>
                            </form>
                        @endif
                    @else
                        <span class="like-button">☆ {{ $item->likes->count() }}</span>
                    @endauth
                </span>
                <span class="comment-count">💬 {{ $item->comments->count() }}</span>
            </div>

            {{-- 購入ボタン --}}
            <a href="{{ route('purchase.index', ['item' => $item->id]) }}">
                <button class="purchase-button">購入手続きへ</button>
            </a>

            {{-- 商品説明 --}}
            <div class="item-description">
                <h3>商品説明</h3>
                <p>{{ $item->description }}</p>
            </div>

            {{-- 商品情報 --}}
            <div class="item-meta">
                <h3>商品の情報</h3>
                <p>
                    カテゴリ：
                    @foreach ($item->categories as $category)
                        <span class="category-tag">{{ $category->name }}</span>@if (!$loop->last)、@endif
                    @endforeach
                </p>
                <p>商品の状態：{{ $item->condition }}</p>
            </div>

            {{-- コメント --}}
            <div class="comments">
                <h3>コメント（{{ $item->comments->count() }}）</h3>

                @foreach ($item->comments as $comment)
                    <div class="comment">
                        <strong>{{ $comment->user->name }}</strong>
                        <p>{{ $comment->comment }}</p>
                    </div>
                @endforeach

                {{-- 全ユーザーにコメントフォーム表示 --}}
                <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <textarea name="comment" rows="3" placeholder="商品のコメントを書く..." {{ Auth::check() ? '' : 'disabled' }}>{{ old('comment') }}</textarea>
                
                @error('comment')
                    <p class="error">{{ $message }}</p>
                @enderror

                @if(Auth::check())
                    <button type="submit" class="submit-comment">コメントを送信する</button>
                @else
                    <button type="button" class="submit-comment" disabled>ログインしてください</button>
                @endif
                </form>
            </div>
        </div> {{-- item-detail-info（右）おわり --}}
    </div> {{-- item-detail-content（横並び）おわり --}}
</div> {{-- item-detail-container（全体）おわり --}}
@endsection
