@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class = "subtitle">商品一覧</h1>

    <!-- 検索フォーム -->
    <form action="{{ route('products.index') }}" method="GET">
        <input type="text" name="search" placeholder="商品名で検索" value="{{ request('search') }}">
        <button type="submit">検索</button>
    </form>

    <!-- 価格ソート -->
    <form action="{{ route('products.index') }}" method="GET">
        <select name="sort" onchange="this.form.submit()">
            <option value="">価格で並べ替え</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>安い順</option>
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順</option>
        </select>
    </form>

    <!-- 商品一覧 -->
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <h2>{{ $product->name }}</h2>
                <p>¥{{ number_format($product->price) }}</p>
            </div>
        @endforeach
    </div>

    <!-- ページネーション -->
    <div class="pagination">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
