@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-container">
    <div class="left-section">
        <img src="{{ asset('storage/' . $product->product_images[0]->path) }}" alt="商品画像" class="product-image">
        <h2>{{ $product->name }}</h2>
        <p class="price">¥{{ number_format($product->price) }}</p>

        <form action="{{ route('purchase.store', ['item_id' => $product->id]) }}" method="POST">
            @csrf
            <div class="section">
                <label for="payment_method">支払い方法</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="">選択してください</option>
                    <option value="コンビニ払い">コンビニ払い</option>
                    <option value="カード払い">カード払い</option>
                </select>
            </div>

            <div class="section">
                <label>配送先</label>
                <p>〒 {{ $address->postal_code }}</p>
                <p>{{ $address->address }} {{ $address->building }}</p>
                <a href="{{ route('purchase.address.edit', ['item_id' => $product->id]) }}" class="edit-link">変更する</a>
            </div>

            <button type="submit" class="purchase-button">購入する</button>
        </form>
    </div>

    <div class="right-section">
        <div class="summary">
            <p>商品代金</p>
            <p class="price">¥{{ number_format($product->price) }}</p>
        </div>
        <div class="summary">
            <p>支払い方法</p>
            <p id="summary-method">未選択</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('payment_method').addEventListener('change', function () {
        document.getElementById('summary-method').textContent = this.value;
    });
</script>
@endsection