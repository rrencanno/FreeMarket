@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
<div class="container">
    <ul class="tabs">
        <li><a href="/?tab=recommend" class="{{ request('tab') !== 'mylist' ? 'active' : '' }}">おすすめ</a></li>
        <li><a href="/?tab=mylist" class="{{ request('tab') === 'mylist' ? 'active' : '' }}">マイリスト</a></li>
    </ul>

    <div class="product-list">
        @foreach ($products as $product)
        <div class="product-item">
            <a href="{{ route('item_show', $product->id) }}">
                <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像">
            </a>
            <p>{{ $product->name }}</p>

            @if($product->is_sold)
                <div class="sold-out">
                    SOLD
                </div>
            @endif
        </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection