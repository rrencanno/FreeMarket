@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="header">
        <h1 class="subtitle">商品一覧</h1>

        <div class="search-form">
            <form action="{{ route('products.index') }}" method="GET">
                <input type="text" name="search" class="search-form_input" placeholder="商品名で検索" value="{{ request('search') }}">
                <button type="submit" class="search-form_button">検索</button>
            </form>
        </div>

        <div class="sort-form">
            <p class="sort-form_title">価格順で表示</p>
            <form action="{{ route('products.index') }}" method="GET">
                <select name="sort" class="sort-form_select">
                    <option value="">価格で並べ替え</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>安い順</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順</option>
                </select>
            </form>
        </div>
    </div>

    <div class="product-list">
        <div class="add-product">
            <a href="{{ route('products.register') }}" class="add-product_button">+ 商品を追加</a>
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

<!-- @section('content')
<div class="container">
    <h1 class = "subtitle">商品一覧</h1> -->

    <!-- 検索フォーム -->
    <!-- <form action="{{ route('products.index') }}" method="GET">
        <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
        <button type="submit">検索</button>
    </form> -->

    <!-- 価格ソート -->
    <!-- <form action="{{ route('products.index') }}" method="GET">
        <select name="sort" onchange="this.form.submit()">
            <option value="">価格で並べ替え</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>安い順</option>
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順</option>
        </select>
    </form> -->

    <!-- 商品一覧 -->
    <!-- <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <h2>{{ $product->name }}</h2>
                <p>¥{{ number_format($product->price) }}</p>
            </div>
        @endforeach
    </div> -->

    <!-- ページネーション -->
    <!-- <div class="pagination">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection -->
