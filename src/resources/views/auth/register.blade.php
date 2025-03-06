@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header')
<div class="header-container">
    <form class="login-form" action="/login" method="post">
        @csrf
        <button type="submit" class="login-button">login</button>
    </form>
</div>
@endsection

@section('content')
<div class="register-container">
    <h2 class="register">{{ __('Register') }}</h2>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="name">お名前</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <p class="form__error">{{ $message }}</p>
                @enderror

                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="form__error">{{ $message }}</p>
                @enderror

                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}">
                @error('password')
                    <p class="form__error">{{ $message }}</p>
                @enderror

                <label for="password_confirmation">パスワード（確認）</label>
                <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                    <p class="form__error">{{ $message }}</p>
                @enderror

                <input type="hidden" id="is_admin" name="is_admin" value="1">

                <button type="submit">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection
