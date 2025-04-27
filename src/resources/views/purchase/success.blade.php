@extends('layouts.app')

@section('content')
<div class="container">
    <h2>購入ありがとうございました！</h2>
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <a href="{{ route('top') }}">トップに戻る</a>
</div>
@endsection
