@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endpush

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="profile-container">
    {{-- ユーザー情報エリア --}}
    <div class="profile-header">
        <div class="profile-header-inner">
        @if (Auth::user()->profile_image)
            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="プロフィール画像" class="profile-image">
        @else
            <img src="{{ asset('img/default-profile.png') }}" alt="プロフィール画像（デフォルト）" class="profile-image">
        @endif
        <div class="profile-user-info">
        <h2 class="profile-username">{{ Auth::user()->name }}</h2>
        <a href="{{ route('profile.edit') }}" class="edit-profile-button">プロフィールを編集</a>
    </div>
    </div>
    </div>

    {{-- タブ切り替え --}}
    <div class="tab-menu">
        <a href="?page=sell" class="tab-item {{ request('page') === 'sell' ? 'active' : '' }}">出品した商品</a>
        <a href="?page=buy" class="tab-item {{ request('page') === 'buy' ? 'active' : '' }}">購入した商品</a>
    </div>

    {{-- 商品一覧 --}}
    <div class="item-list">
    @forelse ($items ?? [] as $item)
        <div class="item-card">
            @if ($item->images->isNotEmpty())
                @php
                    $imagePath = $item->images->first()->path;
                @endphp

                @if (Str::startsWith($imagePath, 'http'))
                    <img src="{{ $imagePath }}" alt="商品画像" class="item-image">
                @else
                    <img src="{{ asset($imagePath) }}" alt="商品画像" class="item-image">
                @endif
            @endif
            <p class="item-name">{{ $item->name }}</p>
        </div>
    @empty
        <p>表示する商品がありません。</p>
    @endforelse
</div>
</div>
@endsection
