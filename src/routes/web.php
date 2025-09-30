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

// 🔧 管理画面
Route::prefix('admin')->group(function () {
    Route::get('/contacts', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/contacts/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/contacts/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/contacts/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});