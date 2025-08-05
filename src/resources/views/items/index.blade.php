@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
    {{-- タブ（おすすめ／マイリスト） --}}
    <div class="tab-bar">
        <a href="{{ url('/') }}" class="{{ request('page') !== 'mylist' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ url('/?page=mylist') }}" class="{{ request('page') === 'mylist' ? 'active' : '' }}">マイリスト</a>
    </div>

    {{-- 商品一覧 --}}
    <div class="items-container">
        @foreach($items as $item)
        @if($item->user_id == Auth::id())
        @continue
        @endif
            <div class="item-card">
                <a href="{{ route('items.show', $item->id) }}">
                    <div class="item-image-wrapper">
                        <img src="{{ $item->images->first()->path ?? '' }}" alt="商品画像">
                        @if ($item->is_sold)
                            <span class="sold-label">sold</span>
                        @endif
                    </div>
                    <p>{{ $item->name }}</p>
                </a>
            </div>
        @endforeach
    </div>
@endsection
