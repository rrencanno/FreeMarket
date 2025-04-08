<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoachTech</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @yield('css')
</head>
<body>

    <header>
        <div class="logo">
            <h1>COACHTECH</h1>
        </div>
        <div class="header-nav">
            <form method="GET" action="{{ route('top') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="なにをお探しですか？">
                <button type="submit">検索</button>
            </form>
            <a href="{{ route('logout') }}">ログアウト</a>
            <a href="{{ route('mypage') }}">マイページ</a>
            <a href="{{ route('sell') }}">出品</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 COACHTECH</p>
    </footer>

    @yield('js')
</body>

</html>