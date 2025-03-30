@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="goal-container">
        <div class="goal-box">
            <p class="goal-label">目標体重</p>
            <p class="goal-value">{{ $targetWeight }} kg</p>
        </div>
        <div class="goal-box">
            <p class="goal-label">目標まで</p>
            <p class="goal-value">{{ $weightDifference }} kg</p>
        </div>
        <div class="goal-box">
            <p class="goal-label">最新体重</p>
            <p class="goal-value">{{ $latestWeight }} kg</p>
        </div>
    </div>

    {{-- 検索フォーム --}}
    <div class="search-add-container">
        <div class="search-container">
            <form method="GET" action="{{ route('weight_logs.index') }}">
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="search-input">
                <span class="search-separator">~</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="search-input">
                <button type="submit" class="search-button">検索</button>

                @if (request('start_date') || request('end_date'))
                    <a href="{{ route('weight_logs.index') }}" class="reset-button">リセット</a>
                @endif
            </form>
        </div>

        {{-- データ追加ボタン --}}
        <div class="add-data-container">
            <a href="#modal-target" class="add-data-button">データ追加</a>
        </div>
    </div>

    <!-- モーダルウィンドウ -->
<div class="modal" id="modal-target">
    <a href="#" class="modal-overlay"></a>
    <div class="modal__inner">
        <div class="modal__content">
            <h2>Weight Logを追加</h2>
            <form action="{{ route('weight_logs.store') }}" method="post">
                @csrf

                <label for="date">日付 <span class="required">必須</span></label>
                <input type="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}">
                @error('date')<p class="error">{{ $message }}</p>@enderror

                <label for="weight">体重 <span class="required">必須</span></label>
                <input type="text" name="weight" value="{{ old('weight') }}" placeholder="50.0" pattern="^\d{1,4}(\.\d{1})?$">
                @error('weight')<p class="error">{{ $message }}</p>@enderror

                <label for="calories">摂取カロリー <span class="required">必須</span></label>
                <input type="number" name="calories" value="{{ old('calories') }}" placeholder="1200">
                @error('calories')<p class="error">{{ $message }}</p>@enderror

                <label for="exercise_time">運動時間 <span class="required">必須</span></label>
                <input type="time" name="exercise_time" value="{{ old('exercise_time') }}" placeholder="00:00">
                @error('exercise_time')<p class="error">{{ $message }}</p>@enderror

                <label for="exercise_content">運動内容</label>
                <textarea name="exercise_content" maxlength="120" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                @error('exercise_content')<p class="error">{{ $message }}</p>@enderror

                <div class="button-group">
                    <a href="#" class="cancel">戻る</a>
                    <button type="submit" class="register">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>


    {{-- 体重データ一覧 --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weightLogs as $log)
                <tr>
                    <td>{{ $log->date }}</td>
                    <td>{{ $log->weight }} kg</td>
                    <td>{{ $log->calories }} cal</td>
                    <td>{{ $log->exercise_time }}</td>
                    <td>
                        <a href="{{ route('weight_logs.edit', $log->id) }}" class="edit-button">
                            <img src="{{ asset('storage/pencil.png') }}" alt="編集">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="pagination-container">
        {{ $weightLogs->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection