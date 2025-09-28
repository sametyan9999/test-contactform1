@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-wrapper">
    <p class="thanks-message">お問い合わせありがとうございました</p>
    <div class="thanks-actions">
        <a href="{{ route('contacts.create') }}" class="btn-home">HOME</a>
    </div>
</div>
@endsection