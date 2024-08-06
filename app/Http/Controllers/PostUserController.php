<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PostUser;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\PostuserLoginRequest;
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


        return view('postuser.login', ['uuid' => $uuid, 'project' => $project]);
    }

    public function login($uuid, PostUserLoginRequest $request): RedirectResponse
    {
        // URLのuuidがpost_usersテーブルに存在するか確認
        $postUser = PostUser::where('uuid', $uuid)->first();

        if (!$postUser) {
            return back()->withErrors([
                'uuid' => ['無効なUUIDです。'],
            ]);
        }

        // 検証されたUUIDを使用して認証
        $credentials = $request->only('email', 'password');
        $credentials['uuid'] = $uuid;

        if ($request->authenticate($credentials)) {
            return redirect()->route('postuser.dashboard', ['uuid' => $uuid])->with([
                'status' => 'ログインしました。',
            ]);
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    public function dashboard($uuid)
    {
        $postuseruuid = Auth::user('postuser')->uuid;
        if ($uuid !== $postuseruuid) {
            abort(404, 'フォームが見つかりません');
        }

        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();
        return view('postuser.auth.dashboard', ['uuid' => $uuid, 'project' => $project]);
    }

    public function logout($uuid)
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('postuser.index', ['uuid' => $uuid])->with(['status' => 'ログアウトしました']);
    }
}
