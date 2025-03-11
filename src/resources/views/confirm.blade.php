@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('header')
<div class="header-container"></div>
@endsection

@section('content')
<div class="subtitle-container">
    <h2 class="subtitle">Confirm</h2>
</div>

<div class="container">
    <form class="form" action="/thanks" method="post">
        @csrf
        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th>お名前</th>
                <td class="confirm-table__text">
                    <input type="text" name="name"
                        value="{{ ($contact['last_name'] ?? '') . '　' . ($contact['first_name'] ?? '') }}" readonly />
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}" />
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}" />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th>性別</th>
                <td class="confirm-table__text">
                    <input type="text" name="gender"
                        value="{{ $contact['gender'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th>メールアドレス</th>
                <td class="confirm-table__text">
                    <input type="text" name="email" value="{{ $contact['email'] ?? '' }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th>電話番号</th>
                <td class="confirm-table__text">
                    <input type="text" name="tell"
                        value="{{ ($contact['phone1'] ?? '') . '-' . ($contact['phone2'] ?? '') . '-' . ($contact['phone3'] ?? '') }}" readonly />
                    <input type="hidden" name="phone1" value="{{ $contact['phone1'] ?? '' }}" />
                    <input type="hidden" name="phone2" value="{{ $contact['phone2'] ?? '' }}" />
                    <input type="hidden" name="phone3" value="{{ $contact['phone3'] ?? '' }}" />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th>住所</th>
                <td class="confirm-table__text">
                    <input type="text" name="address" value="{{ $contact['address'] ?? '' }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th>建物名</th>
                <td class="confirm-table__text">
                    <input type="text" name="building" value="{{ $contact['building'] ?? '' }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th>お問い合わせの種類</th>
                <td class="confirm-table__text">
                    <input type="text" name="inquiry_type" value="{{ $contact['inquiry_type'] ?? '' }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th>お問い合わせ内容</th>
                <td class="confirm-table__text">
                    <textarea name="detail" readonly>{{ $contact['detail'] ?? '' }}</textarea>
                </td>
            </tr>
        </table>

        <div class="button-container">
            <button class="submit-btn" type="submit">送信</button>
            <button class="edit-btn" type="button" onclick="history.back();">修正</button>
        </div>
    </form>
</div>

@endsection