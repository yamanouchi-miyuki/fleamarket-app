@extends('layouts.app')

@section('content')
    {{-- タブ（おすすめ／マイリスト） --}}
    <div class="tab-bar">
        <a href="{{ url('/') }}" class="{{ request('page') !== 'mylist' ? 'active' : '' }}">おすすめ</a>
        <a href="{{ url('/?page=mylist') }}" class="{{ request('page') === 'mylist' ? 'active' : '' }}">マイリスト</a>
    </div>

    {{-- 商品一覧 --}}
    <div class="items-container">
        @foreach($items as $item)
            <div class="item-card">
                <a href="{{ route('items.show', $item->id) }}">
                    <img src="{{ $item->images->first()->path ?? '' }}" alt="商品画像">
                    <p>{{ $item->name }}</p>
                </a>
            </div>
        @endforeach
    </div>
@endsection
