@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<form action="{{ url('/products/' . $product->id . '/update') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a> ＞ {{ $product->name }}
    </div>
    <div class="container">
        <div class="container-img">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            <input type="file" name="image">
            <div class="form-error">
                @error('image')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="container-info">
            <label>商品名</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力" class="placeholder-gray">
            <div class="form-error">
                @error('name')
                    {{ $message }}
                @enderror
            </div>

            <label>値段</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力" class="placeholder-gray">
            <div class="form-error">
                @error('price')
                    {{ $message }}
                @enderror
            </div>

            <label>季節</label>
            @foreach($seasons as $season)
                <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                {{ old('seasons', $product->seasons->pluck('id')->toArray()) !== null && in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                    {{ $season->name }}
            @endforeach
            <div class="form-error">
                @error('seasons')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="container-description">
        <label>商品説明</label>
        <textarea name="description" placeholder="商品の説明を入力" class="placeholder-gray">{{ old('description', $product->description) }}</textarea>
        <div class="form-error">
            @error('description')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="container-buttons">
        <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
        <button type="submit" class="btn-save">変更を保存</button>
    </div>
</form>

    <form action="{{ url('/products/' . $product->id . '/delete') }}" method="POST" class="form-delete">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">
            <img src="{{ asset('storage/delete-icon.png') }}" alt="削除" width="40">
        </button>
    </form>
    @endsection