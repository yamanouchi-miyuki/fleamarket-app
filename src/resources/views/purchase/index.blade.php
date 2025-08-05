@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('title', '商品購入')

@section('content')

<form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST">
    @csrf

    <div class="purchase-container"> {{-- ← これが<form>の中に入る --}}

        <!-- 左カラム -->
        <div class="purchase-left">
            <div class="purchase-image-box">
                <div class="purchase-image">
                    <img src="{{ asset($item->images->first()->path ?? 'img/no-image.png') }}" alt="商品画像">
                </div>
                <div class="purchase-name">{{ $item->name }}</div>
                <div class="purchase-price">¥{{ number_format($item->price) }}</div>
            </div>

            <hr class="purchase-divider">

            <div class="purchase-method">
                <h3 class="purchase-label">支払い方法</h3>
                <select id="payment-select" class="purchase-select" name="payment_method">
                    <option disabled selected>選択してください</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード払い">カード払い</option>
                </select>
                @if ($errors->has('payment_method'))
                    <p class="error-message">{{ $errors->first('payment_method') }}</p>
                @endif
            </div>

            <hr class="purchase-divider">

            <div class="purchase-address">
                <h3 class="purchase-label">配送先</h3>
                <p>〒 {{ $user->postal_code ?? '未登録' }}</p>
                <p>{{ $user->address ?? '未登録' }} {{ $user->building_name ?? '' }}</p>
                <a href="{{ route('address.edit', ['item_id' => $item->id]) }}" class="change-address-link">変更する</a>
            </div>
        </div>

        <!-- 右カラム -->
        <div class="purchase-right">
            <div class="purchase-summary">
                <div class="purchase-summary-row">
                    <span>商品代金</span><span>¥{{ number_format($item->price) }}</span>
                </div>
                <div class="purchase-summary-row">
                    <span>支払い方法</span><span id="payment-method-display">未選択</span>
                </div>
            </div>
            <button class="purchase-button">購入する</button>
        </div>
    </div>

{{-- 【修正ポイント②】<form>はここで閉じる --}}
</form>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentSelect = document.getElementById('payment-select');
        const paymentDisplay = document.getElementById('payment-method-display');

        paymentSelect.addEventListener('change', function () {
            paymentDisplay.textContent = paymentSelect.value;
        });
    });
</script>

@endsection
