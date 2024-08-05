<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
// use App\Http\Requests\Auth\PostuserLoginRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PostUserController extends Controller
{
    // ログインページ
    public function index($uuid)
    {
        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();

        // statusが非公開なら404ページへ
        if (!$project->status) {
            abort(404, 'フォームが見つかりません');
        }

        return view('postuser.login', compact('project'));
    }


    public function login(Request $request): RedirectResponse
    {
        // dd($request);
        $credentials = $request->only(['email', 'password', 'uuid']);

        // 認証試行
        if (Auth::guard('postuser')->attempt($credentials)) {
            return redirect()->route('postuser.dashboard', ['uuid' => $request->uuid])->with([
                'login_msg' => 'ログインしました。',
            ]);
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    public function dashboard($uuid)
    {
        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();
        return view('postuser.auth.dashboard', ['uuid' => $uuid, 'project' => $project]);
    }

    public function logout($uuid)
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('postuser.index', ['uuid' => $uuid])->with(['logout_msg' => 'ログアウトしました']);
    }
}
