<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->redirectGuestsTo(function (Request $request) {
        // $uuid = $request->route('uuid'); // ルートパラメータからuuidを取得
        // return $request->is('{uuid}*') ? route('postuser.index', ['uuid' => $uuid]) : route('postuser.index');
        // });


        //MiddlewareのRedirectIfAuthenticatedに書いてたもの
        // if (Auth::guard('postuser')->check()) {
        //     return route('postuser.dashboard');
        // }
        // return route('postuser.index');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
