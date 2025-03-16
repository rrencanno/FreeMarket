@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<form action="{{ url('/products/' . $product->id . '/update') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="container">
        <div class="container-img">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <input type="file" name="image">
            @error('image')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="container-info">
            <label>商品名</label>
            <input type="text" name="name" value="{{ $product->name }}" placeholder="商品名を入力" class="placeholder-gray">
            @error('name')
                <p>{{ $message }}</p>
            @enderror

            <label>値段</label>
            <input type="number" name="price" value="{{ $product->price }}" placeholder="値段を入力" class="placeholder-gray">
            @error('price')
                <p>{{ $message }}</p>
            @enderror

            <label>季節</label>
            @foreach($seasons as $season)
                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                    {{ $product->seasons->contains($season->id) ? 'checked' : '' }}> {{ $season->name }}
            @endforeach
            @error('seasons')
                <p>{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="container-description">
        <label>商品説明</label>
        <textarea name="description" placeholder="商品の説明を入力" class="placeholder-gray">{{ $product->description }}</textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror
    </div>

        <a href="{{ route('products.index') }}">戻る</a>
        <button type="submit">変更を保存</button>
</form>

    <form action="{{ url('/products/' . $product->id . '/delete') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
    @endsection


<!-- <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" placeholder="商品名を入力">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="price">値段</label>
            <input type="number" name="price" id="price" value="{{ $product->price }}" placeholder="値段を入力">
            @error('price')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>季節</label>
            @foreach($seasons as $season)
                <label>
                    <input type="checkbox" name="season[]" value="{{ $season->id }}" {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>{{ $season->name }}
                </label>
            @endforeach
            @error('season')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="description">商品説明</label>
            <textarea name="description" id="description" placeholder="商品説明を入力">{{ $product->description }}</textarea>
            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="image">商品画像</label>
            <input type="file" name="image" id="image">
            @error('image')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">変更を保存</button>
        <a href="{{ route('products.index') }}">戻る</a>
    </form>
    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form> -->