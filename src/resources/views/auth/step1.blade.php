<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/step1.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="register-form">
                <h1>PiGLy</h1>
                <h2>新規会員登録</h2>
                <p>STEP1 アカウント情報の登録</p>

                <form method="POST" action="{{ route('register.step1') }}">
                    @csrf
                    <div>
                        <label for="name">お名前</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="名前を入力">
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email">メールアドレス</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password">パスワード</label>
                        <input type="password" name="password" placeholder="パスワードを入力">
                        @error('password')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit">次に進む</button>
                </form>

                <a href="{{ route('login') }}">ログインはこちら</a>
            </div>
        </div>
    </main>
</body>

</html>

