@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-container">
    <h2 class="admin">{{ __('Admin') }}</h2>
</div>
<div class="container">

    <form method="GET" action="{{ route('admin.index') }}">
        <input type="text" name="search" placeholder="名前やメールアドレスを入力してください" value="{{ request('search') }}">
        <!-- <input type="checkbox" name="exact_match" {{ request('exact_match') ? 'checked' : '' }}> 完全一致 -->

        <!-- <input type="text" name="email" placeholder="メールアドレス" value="{{ request('email') }}"> -->

        <select name="gender">
            <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>性別</option>
            <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
            <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
            <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id">
            <option value="all" {{ request('category_id') == 'all' ? 'selected' : '' }}>お問い合わせの種類</option>
            <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
            <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
            <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
            <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
            <option value="5" {{ request('category_id') == '5' ? 'selected' : '' }}>その他</option>
        </select>

        <input type="date" name="date" value="{{ request('date') }}">

        <button type="submit">検索</button>
        <button type="reset" onclick="window.location='{{ route('admin.index') }}'">リセット</button>
    </form>

    <table class="table mt-3">
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>
                @if($contact->gender == 1)
                    男性
                @elseif($contact->gender == 2)
                    女性
                @else
                    その他
                @endif
            </td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->name }}</td>
            <td><a href="{{ route('admin.show', $contact->id) }}">詳細</a></td>
        </tr>
        @endforeach
    </table>

    {{ $contacts->links() }}
</div>
@endsection
