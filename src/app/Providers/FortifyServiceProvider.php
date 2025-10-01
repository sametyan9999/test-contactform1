<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // ログイン画面ビュー
        Fortify::loginView(fn () => view('auth.login'));

        // 登録画面ビュー
        Fortify::registerView(fn () => view('auth.register'));

        // ログイン処理（バリデーション込み）
        Fortify::authenticateUsing(function (Request $request) {
            $credentials = $request->validate([
                'email'    => ['required', 'email'],
                'password' => ['required'],
            ], [
                'email.required'    => 'メールアドレスを入力してください',
                'email.email'       => 'メールアドレスはメール形式で入力してください',
                'password.required' => 'パスワードを入力してください',
            ]);

            if (Auth::attempt($credentials)) {
                return Auth::user();
            }
            return null;
        });

        // ✅ ログイン成功後は必ず /admin にリダイレクト
        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {
                public function toResponse($request)
                {
                    return redirect('/admin'); // ← 修正箇所
                }
            };
        });

        // 新規ユーザー作成クラスのバインド
        $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
    }
}