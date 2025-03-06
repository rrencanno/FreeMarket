@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
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
<div class="container">
    <h2 class="text-center">Admin</h2>

    <!-- 検索フォーム -->
    <form action="/admin/search" method="get">
        <div class="d-flex gap-2">
            <input type="text" name="name" placeholder="名前" value="{{ request('name') }}">
            <input type="text" name="email" placeholder="メールアドレス" value="{{ request('email') }}">

            <select name="gender">
                <option value="">性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>男性</option>
                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>女性</option>
                <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="inquiry_type">
                <option value="">お問い合わせの種類</option>
                <option value="exchange" {{ request('inquiry_type') == 'exchange' ? 'selected' : '' }}>商品の交換</option>
                <option value="return" {{ request('inquiry_type') == 'return' ? 'selected' : '' }}>商品の返品</option>
            </select>

            <input type="date" name="date" value="{{ request('date') }}">

            <button type="submit">検索</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">リセット</a>
        </div>
    </form>

    <!-- 問い合わせ一覧 -->
    <table class="table mt-3">
        <thead>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->gender === 'male' ? '男性' : ($category->gender === 'female' ? '女性' : 'その他') }}</td>
                <td>{{ $category->email }}</td>
                <td>{{ $category->inquiry_type === 'exchange' ? '商品の交換' : '商品の返品' }}</td>
                <td>
                    <button class="btn btn-primary" onclick="openModal({{ $category->id }})">詳細</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    {{ $categories->links() }}
</div>

<!-- モーダルウィンドウ -->
<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3>お問い合わせ詳細</h3>
        <p id="modal-content"></p>
    </div>
</div>

<script>
    function openModal(id) {
        fetch(`/api/inquiries/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modal-content').innerHTML = `
                    <p><strong>お名前:</strong> ${data.name}</p>
                    <p><strong>性別:</strong> ${data.gender === 'male' ? '男性' : (data.gender === 'female' ? '女性' : 'その他')}</p>
                    <p><strong>メール:</strong> ${data.email}</p>
                    <p><strong>電話番号:</strong> ${data.tell}</p>
                    <p><strong>住所:</strong> ${data.address} ${data.building}</p>
                    <p><strong>お問い合わせ種類:</strong> ${data.inquiry_type === 'exchange' ? '商品の交換' : '商品の返品'}</p>
                    <p><strong>お問い合わせ内容:</strong> ${data.content}</p>
                `;
                document.getElementById('modal').style.display = 'block';
            });
    }

    function closeModal() {
        document.getElementById('modal').style.display = 'none';
    }
</script>

@endsection
