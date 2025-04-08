@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.show.css') }}">
@endsection

@section('content')
<div class="item-detail">
    <div class="item-left">
        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300x300?text=商品画像' }}" alt="商品画像">
    </div>

    <div class="item-right">
        <h2>{{ $product->name }}</h2>
        <p class="brand">{{ $product->brand }}</p>
        <p class="price">&yen;{{ number_format($product->price) }} <span class="tax-in">(税込)</span></p>

        <div class="action-icons">
            <form action="{{ route('favorite.toggle', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="icon-btn">
                    @if($product->isFavoritedBy(Auth::user()))
                        ★
                    @else
                        ☆
                    @endif
                </button>
                <span>{{ $product->favorites->count() }}</span>
            </form>
            <span>💬 {{ $product->comments->count() }}</span>
        </div>

        <a href="{{ route('purchase.show', $product->id) }}" class="buy-btn">購入手続きへ</a>

        <div class="description">
            <h3>商品説明</h3>
            <p>{{ $product->description }}</p>
        </div>

        <div class="info">
            <h3>商品の情報</h3>
            <p>カテゴリー：
                @foreach($product->categories as $category)
                    <span class="tag">{{ $category->name }}</span>
                @endforeach
            </p>
            <p>商品の状態：{{ $product->condition }}</p>
        </div>

        <div class="comments">
            <h3>コメント({{ $product->comments->count() }})</h3>
            @foreach($product->comments as $comment)
                <div class="comment">
                    <img src="{{ $comment->user->profile_image ?? 'https://via.placeholder.com/40' }}" alt="user" class="icon">
                    <div>
                        <p class="username">{{ $comment->user->name }}</p>
                        <p class="body">{{ $comment->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('comment.store', $product->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="body">商品へのコメント</label>
                <textarea name="body" id="body" rows="4">{{ old('body') }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="comment-submit">コメントを送信する</button>
        </form>
    </div>
</div>
@endsection