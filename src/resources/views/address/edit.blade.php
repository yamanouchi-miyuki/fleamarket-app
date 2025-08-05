@extends('layouts.app')

@section('title', '住所の変更')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<main class="address-wrapper">
    <h2 class="address-title">住所の変更</h2>

    <form action="{{ route('address.update', ['item_id' => $item_id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="address-label" for="postal_code">郵便番号</label>
        <input class="address-input" type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code ?? '') }}">

        <label class="address-label" for="address">住所</label>
        <input class="address-input" type="text" id="address" name="address" value="{{ old('address', $user->address ?? '') }}">

        <label class="address-label" for="building_name">建物名</label>
        <input class="address-input" type="text" id="building_name" name="building_name" value="{{ old('building_name', $user->building_name ?? '') }}">

        <button class="address-button" type="submit">更新する</button>
    </form>
</main>
@endsection
