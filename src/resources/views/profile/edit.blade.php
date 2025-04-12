@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="profile-container">
    <h2>プロフィール設定</h2>

    <form method="POST" action="{{ route('mypage.profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="profile-image-area">
            @if ($user->image_url)
                <img id="preview" src="{{ asset('storage/' . $user->image_url) }}" alt="プロフィール画像" class="profile-image">
            @else
                <div id="preview" class="profile-placeholder"></div>
            @endif

            <label class="image-select-button">
                画像を選択する
                <input type="file" name="image_url" id="profile_image_input" hidden>
            </label>
            @error('image_url')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-section">
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-section">
            <label>郵便番号</label>
            <input type="text" name="post_code" value="{{ old('post_code', $user->post_code) }}">
            @error('post_code')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-section">
            <label>住所</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}">
            @error('address')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-section">
            <label>建物名</label>
            <input type="text" name="building_name" value="{{ old('building_name', $user->building_name) }}">
            @error('building_name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="submit-button">更新する</button>
    </form>
</div>

@section('js')
<script>
    document.getElementById('profile_image_input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('preview');

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(event) {
                // プレビューがimgでなくdivの場合、imgに差し替える
                if (preview.tagName.toLowerCase() === 'div') {
                    const newImg = document.createElement('img');
                    newImg.src = event.target.result;
                    newImg.className = 'profile-image';
                    newImg.id = 'preview';
                    preview.replaceWith(newImg);
                } else {
                    preview.src = event.target.result;
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection