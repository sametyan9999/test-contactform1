@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="form-wrapper">
    <h1 class="form-title">Contact</h1>

    <form action="{{ route('contacts.confirm') }}" method="POST">
        @csrf

        {{-- お名前 --}}
        <div class="form-group">
            <label>お名前 <span class="required">※</span></label>
            <div class="name-inputs">
                <div class="input-box">
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
                    @error('last_name') 
                        <p class="error">{{ $message }}</p> 
                    @enderror
                </div>
                <div class="input-box">
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
                    @error('first_name') 
                        <p class="error">{{ $message }}</p> 
                    @enderror
                </div>
            </div>
        </div>

        {{-- 性別 --}}
        <div class="form-group">
            <label>性別 <span class="required">※</span></label>
            <div class="input-box">
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}> その他</label>
                </div>
                @error('gender') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <label>メールアドレス <span class="required">※</span></label>
            <div class="input-box">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form-group">
            <label>電話番号 <span class="required">※</span></label>
            <div class="input-box">
                <div class="tel-inputs">
                    <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080" maxlength="4">
                    <span>-</span>
                    <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234" maxlength="4">
                    <span>-</span>
                    <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678" maxlength="4">
                </div>
                @if($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                    <p class="error">電話番号を入力してください</p>
                @endif
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form-group">
            <label>住所 <span class="required">※</span></label>
            <div class="input-box">
                <input type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
                @error('address') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- 建物名 --}}
        <div class="form-group">
            <label>建物名</label>
            <div class="input-box">
                <input type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
                @error('building') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form-group">
            <label>お問い合わせの種類 <span class="required">※</span></label>
            <div class="input-box">
                <select name="category_id">
                    <option value="" {{ old('category_id') ? '' : 'selected' }}>選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form-group">
            <label>お問い合わせ内容 <span class="required">※</span></label>
            <div class="input-box">
                <textarea name="detail" placeholder="お問い合わせ内容をご記入ください">{{ old('detail') }}</textarea>
                @error('detail') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- 送信 --}}
        <div class="form-actions">
            <button type="submit" class="btn-submit">確認画面</button>
        </div>
    </form>
</div>
@endsection