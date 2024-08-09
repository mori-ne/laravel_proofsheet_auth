<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PostUserRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // URLパスからuuid取得
        $path = $request->path();
        if (preg_match('/postuser\/([0-9a-fA-F\-]{36})/', $path, $matches)) {
            $uuid = $matches[1];
            // UUIDの処理
            if (Auth::guard('postuser')->check()) {
                return redirect()->route('postuser.index', ['uuid' => $uuid]);
            }
        } else {
            // UUIDが見つからない場合の処理
        }

        if (Auth::guard('web')->check()) {
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
