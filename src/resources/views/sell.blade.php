@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-container">
    <h2>商品の出品</h2>
    <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section">
            <label>商品画像</label>
            <input type="file" name="image">
        </div>

        <div class="form-section">
            <label>商品の状態</label>
            <select name="condition">
                <option value="">選択してください</option>
                <option value="良好">良好</option>
                <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                <option value="状態が悪い">状態が悪い</option>
            </select>
        </div>

        <div class="form-section">
            <label>商品名</label>
            <input type="text" name="name">
        </div>

        <div class="form-section">
            <label>ブランド名</label>
            <input type="text" name="brand">
        </div>

        <div class="form-section">
            <label>商品の説明</label>
            <textarea name="description" rows="4"></textarea>
        </div>

        <div class="form-section">
            <label>販売価格</label>
            <input type="number" name="price">
        </div>

        <button type="submit" class="submit-button">出品する</button>
    </form>
</div>
@endsection