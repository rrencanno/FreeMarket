@extends('layouts.app')

@section('content')
<div class="container">
    <h2>詳細情報</h2>
    <p><strong>名前:</strong> {{ $contact->name }}</p>
    <p><strong>性別:</strong> {{ $contact->gender }}</p>
    <p><strong>メール:</strong> {{ $contact->email }}</p>
    <p><strong>お問い合わせの種類:</strong> {{ $contact->category->name }}</p>
    <p><strong>内容:</strong> {{ $contact->message }}</p>
    <a href="{{ route('admin.index') }}">戻る</a>
</div>
@endsection
