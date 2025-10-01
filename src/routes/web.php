<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 📨 お問い合わせフォーム
Route::get('/', [ContactController::class, 'create'])->name('contacts.create');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/back', [ContactController::class, 'back'])->name('contacts.back');
Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');

// 誤って GET /confirm に来たら入力ページへリダイレクト
Route::get('/confirm', function () {
    return redirect()->route('contacts.create');
});

// 🔧 管理画面（ログイン必須にする）
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/contacts/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/contacts/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

// 🔑 ログイン & ユーザー登録
// Fortify が自動で以下のルートを提供しているので、ここに追加で書く必要はありません。
// - /login (GET, POST)
// - /register (GET, POST)
// FortifyServiceProvider で loginView / registerView を設定すれば OK。