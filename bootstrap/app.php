<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ログインしていないときにトップページへリダイレクトする
        // $middleware->redirectGuestsTo(function (Request $request) {
        //     if (request()->routeIs('postuser.*')) {
        //         return $request->expectsJson() ? null : route('postuser.login');
        //     }
        //     return $request->expectsJson() ? null : route('postuser.auth');
        // });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
