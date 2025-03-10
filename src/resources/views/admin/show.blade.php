@extends('layouts.app')

@section('content')
<div class="container">
    <h2>詳細情報</h2>
    <p><strong>名前:</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
    @php
        if ($contact->gender == 1) {
            $genderText = '男性';
        } elseif ($contact->gender == 2) {
            $genderText = '女性';
        } else {
            $genderText = 'その他';
        }
    @endphp
    <p><strong>性別:</strong> {{ $genderText }}</p>
    <p><strong>メール:</strong> {{ $contact->email }}</p>
    <p><strong>お問い合わせの種類:</strong> {{ $contact->inquiry_type }}</p>
    <p><strong>内容:</strong> {{ $contact->detail }}</p>
    <a href="{{ route('admin.index') }}">戻る</a>
</div>
@endsection
