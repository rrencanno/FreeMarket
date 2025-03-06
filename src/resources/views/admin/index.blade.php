@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>Admin</h2>

    <form method="GET" action="{{ route('admin.index') }}">
        <input type="text" name="name" placeholder="名前やメールアドレスを入力" value="{{ request('name') }}">
        <!-- <input type="checkbox" name="exact_match" {{ request('exact_match') ? 'checked' : '' }}> 完全一致 -->

        <input type="text" name="email" placeholder="メールアドレス" value="{{ request('email') }}">

        <select name="gender">
            <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>性別</option>
            <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
            <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
            <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
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
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->gender }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->name }}</td>
            <td><a href="{{ route('admin.show', $contact->id) }}">詳細</a></td>
        </tr>
        @endforeach
    </table>

    {{ $contacts->links() }}
</div>
@endsection
