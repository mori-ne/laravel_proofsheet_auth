<?php

namespace App\Http\Controllers\Postuser;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\PostUserLoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    // show login
    public function create(): View
    {
        return view('postuser.auth.login');
    }

    // login
    public function store(PostUserLoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('postuser.auth.login'));
    }

    // logout
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('postuser')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('postuser.index');
    }
}
