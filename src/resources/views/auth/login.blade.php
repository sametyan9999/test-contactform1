@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-page">
    <h1 class="login-title">Login</h1>

    <div class="login-wrapper">
        {{-- ログインフォーム --}}
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            {{-- メールアドレス --}}
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <div class="input-wrapper">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                </div>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- パスワード --}}
            <div class="form-group">
                <label for="password">パスワード</label>
                <div class="input-wrapper">
                    <input id="password" type="password" name="password" placeholder="例: coachtechno6">
                </div>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- ボタン --}}
            <div class="form-actions">
                <button type="submit" class="btn-login">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection