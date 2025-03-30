@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/target_setting.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="target-setting-box">
        <h2>目標体重設定</h2>

        <form action="{{ route('weight_logs.target_setting.update') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="target_weight" value="{{ old('target_weight', $targetWeight->target_weight ?? '') }}">
                <span>kg</span>
            </div>
            @error('target_weight')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <div class="button-group">
                <a href="{{ route('weight_logs.index') }}" class="button gray">戻る</a>
                <button type="submit" class="button pink">更新</button>
            </div>
        </form>
    </div>
</div>
@endsection
