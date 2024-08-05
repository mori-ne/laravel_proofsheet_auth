<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        // 利用するクッキーをプレフィックスで分ける
        // $path = $request->path();

        // if ($path === '/') {
        //     // ドキュメントルート
        //     config(['session.cookie' => config('session.cookie_user')]);
        // } elseif (preg_match('#^postuser/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/dashboard$#', $path)) {
        //     // postuser/{uuid}/dashboard
        //     config(['session.cookie' => config('session.cookie_postuser')]);
        // }
    }
}
