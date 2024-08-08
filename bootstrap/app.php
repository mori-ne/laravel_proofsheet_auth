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

        //     $uuid = $request->uuid;
        //     if ($request->routeIs('postuser.{uuid}.*')) {
        //         return route('postuser.login');
        //     }

        //     return route('login');
        // });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
