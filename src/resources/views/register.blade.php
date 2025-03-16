@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="title">商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>商品名 <span class="required">必須</span></label>
            <input type="text" name="name" class="form-control" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>値段 <span class="required">必須</span></label>
            <input type="number" name="price" class="form-control" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>商品画像 <span class="required">必須</span></label>
            <input type="file" name="image" class="form-control">
            @error('image')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>季節 <span class="required">必須 (複数選択可)</span></label><br>
            @foreach ($seasons as $season)
                <input type="checkbox" name="seasons[]" value="{{ $season->id }}">
                <label>{{ $season->name }}</label>
            @endforeach
            @error('seasons')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>商品説明 <span class="required">必須</span></label>
            <textarea name="description" class="form-control" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="button-group">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>
</div>
@endsection