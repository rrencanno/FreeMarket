@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
<div class="header-container">
    <form class="logout-form" action="/logout" method="post">
        @csrf
        <button type="submit" class="logout-button">logout</button>
    </form>
</div>
@endsection

@section('content')
<div class="admin-container">
    <h2 class="admin">{{ __('Admin') }}</h2>
</div>
<div class="container">

    <form class="form" method="GET" action="{{ route('admin.index') }}">
        <input type="text" name="search" placeholder="名前やメールアドレスを入力してください" value="{{ request('search') }}">
        <!-- <input type="checkbox" name="exact_match" {{ request('exact_match') ? 'checked' : '' }}> 完全一致 -->

        <!-- <input type="text" name="email" placeholder="メールアドレス" value="{{ request('email') }}"> -->

        <select name="gender">
            <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>性別</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="inquiry_type">
            <!-- <option value="all" {{ request('category_id') == 'all' ? 'selected' : '' }}>お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
            @endforeach -->
            <option value="all" {{ request('inquiry_type') == 'all' ? 'selected' : '' }}>お問い合わせの種類</option>
            <option value="商品のお届けについて" {{ request('inquiry_type') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
            <option value="商品の交換について" {{ request('inquiry_type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
            <option value="商品トラブル" {{ request('inquiry_type') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
            <option value="ショップへのお問い合わせ" {{ request('inquiry_type') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
            <option value="その他" {{ request('inquiry_type') == 'その他' ? 'selected' : '' }}>その他</option>
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
            <td>{{ $contact->inquiry_type }}</td>
            <td>
                <!-- モーダルを開くためのリンク -->
                <a href="{{ route('admin.show', $contact->id) }}">詳細</a>
            </td>

            <!-- モーダルウィンドウ -->
            <!-- <div id="modal-{{ $contact->id }}" class="modal">
                <div class="modal-content">
                    <a href="#" class="close">&times;</a>

                    <h2>お問い合わせ詳細</h2>
                    <p><strong>お名前:</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
                    <p><strong>性別:</strong> {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</p>
                    <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
                    <p><strong>電話番号:</strong> {{ $contact->tell }}</p>
                    <p><strong>住所:</strong> {{ $contact->address }}</p>
                    <p><strong>建物名:</strong> {{ $contact->building }}</p>
                    <p><strong>お問い合わせの種類:</strong> {{ $contact->category->name }}</p>
                    <p><strong>お問い合わせ内容:</strong> {{ $contact->detail }}</p>

                    <form method="POST" action="{{ route('admin.destroy', $contact->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">削除</button>
                    </form>
                </div>
            </div> -->
        </tr>
        @endforeach
    </table>

    {{ $contacts->links() }}
</div>
@endsection
