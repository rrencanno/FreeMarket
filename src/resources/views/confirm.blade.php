@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')

<div class="container">
    <h2>Confirm</h2>

    <form class="form" action="/contacts" method="post">
        @csrf
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th>お名前</th>
                <td class="confirm-table__text">
                    <input type="text" name="name"
                        value="{{ ($contact['first_name'] ?? '') . '　' . ($contact['last_name'] ?? '') }}" readonly />
                    <input type="hidden" name="first_name" value="{{ $contact['first_name'] ?? '' }}" />
                    <input type="hidden" name="last_name" value="{{ $contact['last_name'] ?? '' }}" />
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


<!-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ確認</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>
<body>

    <div class="container">
        <h1>FashionablyLate</h1>
        <h2>Confirm</h2>

        <form class="form" action="/contacts" method="post">
            @csrf
            <table class="confirm-table">
                <tr class="confirm-table__row">
                    <th>お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" name="name" value="{{ $contact['first_name'] . ' ' . $contact['last_name'] }}" readonly />
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" />
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th>性別</th>
                    <td class="confirm-table__text">
                        <input type="text" name="gender" value="{{ $contact['gender'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th>メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="text" name="email" value="{{ $contact['email'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th>電話番号</th>
                    <td class="confirm-table__text">
                        <input type="text" name="tell" value="{{ $contact['phone1'] . '-' . $contact['phone2'] . '-' . $contact['phone3'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th>住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th>建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th>お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="text" name="inquiry_type" value="{{ $contact['inquiry_type'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th>お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                    </td>
                </tr>
            </table>

            <div class="button-container">
                <button class="submit-btn" type="submit">送信</button>
                <button class="edit-btn">修正</button>
            </div>
        </form>
    </div>

</body>
</html> -->
