@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>Weight Log</h1>

    <form method="POST" action="{{ route('weight_logs.update', $weightLog->id) }}">
        @csrf
        @method('PUT')

        <label>日付</label>
        <input type="date" name="date" value="{{ $weightLog->date }}">
        @error('date')<p class="error">{{ $message }}</p>@enderror

        <label>体重</label>
        <div class="weight">
            <input type="number" step="0.1" name="weight" value="{{ $weightLog->weight }}">
            <span>kg</span>
        </div>
        @error('weight')<p class="error">{{ $message }}</p>@enderror

        <label>摂取カロリー</label>
        <div class="calories">
            <input type="number" name="calories" value="{{ $weightLog->calories }}">
            <span>cal</span>
        </div>
        @error('calories')<p class="error">{{ $message }}</p>@enderror

        <label>運動時間</label>
        <input type="time" name="exercise_time" value="{{ $weightLog->exercise_time }}">
        @error('exercise_time')<p class="error">{{ $message }}</p>@enderror

        <label>運動内容</label>
        <textarea name="exercise_content" placeholder="運動内容を追加">{{ $weightLog->exercise_content }}</textarea>
        @error('exercise_content')<p class="error">{{ $message }}</p>@enderror

        <div class="buttons">
            <a href="{{ route('weight_logs.index') }}" class="back-btn">戻る</a>
            <button type="submit" class="update-btn">更新</button>
            <form method="POST" action="{{ route('weight_logs.destroy', $weightLog->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">
                    <img src="{{ asset('storage/delete-icon.png') }}" alt="削除">
                </button>
            </form>
        </div>
    </form>
</div>
@endsection
