@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="header">
        <h1 class="subtitle">商品一覧</h1>

        <form action="{{ route('products.index') }}" method="GET">
            <div class="search-form">
                <input type="text" name="search" class="search-input" placeholder="商品名で検索" value="{{ request('search') }}">
                <button type="submit" class="search-button">検索</button>
            </div>

            <div class="sort-form">
                <p class="sort-title">価格順で表示</p>
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="">価格で並べ替え</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>安い順</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順</option>
                </select>
            </div>

            @if(request('sort'))
                <div class="sort-tag">
                    {{ request('sort') == 'asc' ? '安い順' : '高い順' }}
                    <a href="{{ route('products.index', array_merge(request()->except('sort'))) }}">×</a>
                </div>
            @endif
        </form>
        <hr class="line">
    </div>

    <div class="product-list">
        <div class="add-product">
            <a href="{{ route('products.register') }}" class="add-product-button">+ 商品を追加</a>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <div class="product-info">
                        <p>{{ $product->name }}</p>
                        <p>¥{{ number_format($product->price) }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection