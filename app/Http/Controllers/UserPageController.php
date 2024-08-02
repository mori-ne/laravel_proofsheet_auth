<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserPageController extends Controller
{
    // ログイン画面呼び出し
    public function showLogin($uuid)
    {
        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();

        // statusが非公開なら404ページへ
        if (!$project->status) {
            abort(404, 'フォームが見つかりません');
        }

        return view('userpage.auth.login', compact('project'));
    }

    // ログイン実行
    public function login($uuid, LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('postuser')->attempt($credentials)) {
            return redirect()->route('userpage.dashboard', $uuid)->with([
                'login_msg' => 'ログインしました。',
            ]);
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    public function show()
    {
        return view('userpage.dashboard');
    }

    public function edit($uuid, string $id)
    {
    }
}
