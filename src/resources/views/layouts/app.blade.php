<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @yield('css')
</head>
<body>

    <header class="header">
        <div class="header__logo">
            <h1>PiGLy</h1>
        </div>
        <div class="header__buttons">
            <a href="{{ route('weight_logs.target_setting') }}" class="button">
                <i class="fas fa-cog"></i>目標体重設定
            </a>
            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit" class="button">
                    <i class="fas fa-sign-out-alt"></i>ログアウト
                </button>
            </form>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>