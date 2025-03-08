@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header')
<div class="header-container">
    <a href="{{ route('register') }}" class="register-button">register</a>
</div>
@endsection

@section('content')
<div class="login-container">
    <h2 class="subtitle">Login</h2>
</div>
<div class="container">
    <div class="form-container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            <div class="form__error">
                @error('email')
                    {{ $message }}
                @enderror
            </div>

            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="例: coachtech1106">
            <div class="form__error">
                @error('password')
                    {{ $message }}
                @enderror
            </div>

            <button type="submit">ログイン</button>
        </form>
    </div>
</div>
@endsection