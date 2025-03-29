<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/step2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <main>
        <div class="register-container">
            <h1 class="title">PiGLy</h1>
            <h2 class="subtitle">新規会員登録</h2>
            <p class="description">STEP2 体重データの入力</p>

            <form action="{{ route('register.step2.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="current_weight">現在の体重</label>
                    <div class="weight">
                        <input type="text" name="current_weight" id="current_weight" placeholder="現在の体重を入力" value="{{ old('current_weight') }}">
                        <span>kg</span>
                    </div>
                    @error('current_weight')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="target_weight">目標の体重</label>
                    <div class="weight">
                        <input type="text" name="target_weight" id="target_weight" placeholder="目標の体重を入力" value="{{ old('target_weight') }}">
                        <span>kg</span>
                    </div>
                    @error('target_weight')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="submit-button">アカウント作成</button>
            </form>
        </div>
    </main>
</body>

</html>

