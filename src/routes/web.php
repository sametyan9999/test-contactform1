<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// お問い合わせフォーム入力ページ
Route::get('/', [ContactController::class, 'create'])->name('contacts.create');

// お問い合わせフォーム確認ページ（POSTのみ）
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');

// 確認画面→修正（フォームに戻してold()を復元）
Route::post('/back', [ContactController::class, 'back'])->name('contacts.back');

// データ保存（確認画面から送信）
Route::post('/store', [ContactController::class, 'store'])->name('contacts.store');

// サンクスページ
Route::get('/thanks', [ContactController::class, 'thanks'])->name('contacts.thanks');

// 誤って GET /confirm に来たら入力ページへ
Route::get('/confirm', function () { return redirect()->route('contacts.create'); });

// 管理画面（中身は後で実装）
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// /register と /login は後で実装