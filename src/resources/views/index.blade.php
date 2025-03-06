@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<h2>Contact</h2>

<form action="/confirm" method="post" class="contact-form">
    @csrf
    <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
    <div class="form-group">
        <label for="name">お名前 <span class="required">※</span></label>
        <div class="name-fields">
            <input type="text" id="first_name" name="first_name" placeholder="例: 山田" value="{{ old('first_name') }}">
            <input type="text" id="last_name" name="last_name" placeholder="例: 太郎" value="{{ old('last_name') }}">
        </div>
        <div class="form__error-container">
            <div class="form__error">
                <!--バリデーションメッセージ-->
                @error('first_name')
                    {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                <!--バリデーションメッセージ-->
                @error('last_name')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>性別 <span class="required">※</span></label>
        <div class="gender-options">
            <input type="radio" id="male" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>
            <label for="male">男性</label>

            <input type="radio" id="female" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
            <label for="female">女性</label>

            <input type="radio" id="other" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
            <label for="other">その他</label>

            <!-- <input type="radio" id="male" name="gender" value="男性" checked>
            <label for="male">男性</label>
            <input type="radio" id="female" name="gender" value="女性">
            <label for="female">女性</label>
            <input type="radio" id="other" name="gender" value="その他">
            <label for="other">その他</label> -->
        </div>
        <div class="form__error">
            <!--バリデーションメッセージ-->
            @error('gender')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="email">メールアドレス <span class="required">※</span></label>
        <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
    </div>
    <div class="form__error">
        <!--バリデーションメッセージ-->
        @error('email')
            {{ $message }}
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">電話番号 <span class="required">※</span></label>
        <div class="phone-fields">
            <input type="text" id="phone1" name="phone1" placeholder="080" value="{{ old('phone1') }}">
            <span>-</span>
            <input type="text" id="phone2" name="phone2" placeholder="1234" value="{{ old('phone2') }}">
            <span>-</span>
            <input type="text" id="phone3" name="phone3" placeholder="5678" value="{{ old('phone3') }}">
        </div>
        <div class="form__error-container">
            <div class="form__error">
                <!--バリデーションメッセージ-->
                @error('phone1')
                    {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                <!--バリデーションメッセージ-->
                @error('phone2')
                    {{ $message }}
                @enderror
            </div>
            <div class="form__error">
                <!--バリデーションメッセージ-->
                @error('phone3')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="address">住所 <span class="required">※</span></label>
        <input type="text" id="address" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
        <div class="form__error">
            <!--バリデーションメッセージ-->
            @error('address')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="building">建物名</label>
        <input type="text" id="building" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
    </div>

    <div class="form-group">
        <label for="inquiry-type">お問い合わせの種類 <span class="required">※</span></label>
        <select id="inquiry-type" name="inquiry_type">
            <option value="">選択してください</option>
            <option value="商品について">商品について</option>
            <option value="サービスについて">サービスについて</option>
            <option value="その他">その他</option>
        </select>
        <div class="form__error">
            <!--バリデーションメッセージ-->
            @error('inquiry_type')
                {{ $message }}
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="message">お問い合わせ内容 <span class="required">※</span></label>
        <textarea id="message" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        <div class="form__error">
            <!--バリデーションメッセージ-->
            @error('detail')
                {{ $message }}
            @enderror
        </div>
    </div>

    <button type="submit" class="submit-button">確認画面</button>
</form>
@endsection