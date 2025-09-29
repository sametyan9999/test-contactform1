@extends('layouts.app')

@section('css')
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Admin</h1>

    {{-- フィルター（横一列配置） --}}
    <form action="{{ route('admin.index') }}" method="GET" class="filters-form">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

        <select name="gender">
            <option value="" disabled {{ request('gender') === null || request('gender') === '' ? 'selected' : '' }}>性別</option>
            <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
        </select>

        <select name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <input type="date" name="date" value="{{ request('date') }}">

        <button type="submit" class="btn btn-search">検索</button>
        <a href="{{ route('admin.index') }}" class="btn btn-reset">リセット</a>
    </form>

    {{-- 上部バー（エクスポート＋ページネーション） --}}
    <div class="topbar">
        <div class="topbar-left">
            <a href="{{ route('admin.export', request()->all()) }}" class="btn btn-export">エクスポート</a>
        </div>
        <div class="pagination-top">
            {{ $contacts->appends(request()->all())->links('pagination::bootstrap-4') }}
        </div>
    </div>

    {{-- 一覧テーブル --}}
    <table class="contact-table">
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
            @forelse($contacts as $contact)
                <tr>
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>
                        @if($contact->gender == 1) 男性
                        @elseif($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content ?? '' }}</td>
                    <td>
                        <button class="btn btn-detail" data-id="{{ $contact->id }}">詳細</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">データがありません</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- モーダル --}}
<div id="modal" class="modal hidden">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <div id="modal-body"><!-- Ajaxで差し込み --></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const modalBody = document.getElementById("modal-body");
    const closeBtn = document.querySelector(".modal-close");

    document.querySelectorAll(".btn-detail").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            fetch(`/admin/contacts/${id}`)
                .then(res => res.json())
                .then(data => {
                    modalBody.innerHTML = `
                        <h2 class="modal-title">詳細</h2>
                        <dl class="detail-list">
                          <div><dt>お名前</dt><dd>${data.last_name} ${data.first_name}</dd></div>
                          <div><dt>性別</dt><dd>${data.gender == 1 ? "男性" : (data.gender == 2 ? "女性" : "その他")}</dd></div>
                          <div><dt>メールアドレス</dt><dd>${data.email}</dd></div>
                          <div><dt>電話番号</dt><dd>${data.tel ?? ""}</dd></div>
                          <div><dt>住所</dt><dd>${data.address ?? ""}</dd></div>
                          <div><dt>建物名</dt><dd>${data.building ?? ""}</dd></div>
                          <div><dt>お問い合わせの種類</dt><dd>${data.category?.content ?? ""}</dd></div>
                          <div><dt>お問い合わせ内容</dt><dd>${data.detail ?? ""}</dd></div>
                        </dl>
                        <form method="POST" action="/admin/contacts/${data.id}" class="delete-form">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-delete">削除</button>
                        </form>
                    `;
                    modal.classList.remove("hidden");
                });
        });
    });

    closeBtn.addEventListener("click", () => modal.classList.add("hidden"));
    modal.addEventListener("click", (e) => { if (e.target === modal) modal.classList.add("hidden"); });
});
</script>
@endsection