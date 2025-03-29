<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <main>
        <div class="login-container">
            <h2 class="title">PiGLy</h2>
            <h3 class="subtitle">ログイン</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror

                <button type="submit">ログイン</button>
            </form>

            <a href="{{ url('/register/step1') }}">アカウント作成はこちら</a>
        </div>
    </main>
</body>

</html>