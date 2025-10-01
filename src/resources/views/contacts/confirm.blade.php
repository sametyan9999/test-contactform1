@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-wrapper">
    <h1 class="confirm-title">Confirm</h1>

    {{-- 本送信用フォーム --}}
    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <table class="confirm-table">
            <tr>
                <th>お名前</th>
                <td>
                    {{ $validated['last_name'] }}　{{ $validated['first_name'] }}
                    <input type="hidden" name="last_name"  value="{{ $validated['last_name'] }}">
                    <input type="hidden" name="first_name" value="{{ $validated['first_name'] }}">
                </td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    @if($validated['gender'] == 1) 男性
                    @elseif($validated['gender'] == 2) 女性
                    @else その他
                    @endif
                    <input type="hidden" name="gender" value="{{ $validated['gender'] }}">
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    {{ $validated['email'] }}
                    <input type="hidden" name="email" value="{{ $validated['email'] }}">
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    {{ $validated['tel1'] }}{{ $validated['tel2'] }}{{ $validated['tel3'] }}
                    <input type="hidden" name="tel1" value="{{ $validated['tel1'] }}">
                    <input type="hidden" name="tel2" value="{{ $validated['tel2'] }}">
                    <input type="hidden" name="tel3" value="{{ $validated['tel3'] }}">
                </td>
            </tr>
            <tr>
                <th>住所</th>
                <td>
                    {{ $validated['address'] }}
                    <input type="hidden" name="address" value="{{ $validated['address'] }}">
                </td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>
                    {{ $validated['building'] ?? '（未入力）' }}
                    <input type="hidden" name="building" value="{{ $validated['building'] ?? '' }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせの種類</th>
                <td>
                    {{ $categoryName }}
                    <input type="hidden" name="category_id" value="{{ $validated['category_id'] }}">
                </td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>
                    {{ $validated['detail'] }}
                    <input type="hidden" name="detail" value="{{ $validated['detail'] }}">
                </td>
            </tr>
        </table>

        <div class="confirm-buttons">
            <button type="submit" class="btn-submit">送信</button>
    </form>

    {{-- 修正用フォーム --}}
    <form action="{{ route('contacts.back') }}" method="POST">
        @csrf
        @foreach($validated as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
            <button type="submit" class="btn-back">修正</button>
        </div>
    </form>
</div>
@endsection