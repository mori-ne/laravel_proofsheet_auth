<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PostUser;
use App\Models\PrePostUser;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\PostuserLoginRequest;
use App\Http\Requests\VerifyMailSignupRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PrePostUserTokenMail;
use App\Http\Requests\PostUserRegisterRequest;

class PostUserController extends Controller
{
    public function index($uuid)
    {
        Log::info($uuid);
        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();

        // statusが非公開なら404ページへ
        if (!$project->status) {
            abort(404, 'フォームが見つかりません');
        }


        return view('postuser.login', ['uuid' => $uuid, 'project' => $project]);
    }


    public function login($uuid, PostUserLoginRequest $request): RedirectResponse
    {
        $postUser = PostUser::where('uuid', $uuid)->first();

        // URLのuuidがpost_usersテーブルに存在するか確認
        if (!$postUser) {
            return back()->withErrors([
                'uuid' => ['無効なUUIDです。'],
            ]);
        }

        // 検証されたUUIDを使用して認証
        $credentials = $request->only('email', 'password');
        $credentials['uuid'] = $uuid;

        if ($request->authenticate($credentials)) {
            // 必須パラメータ uuid を追加
            return redirect()->route('postuser.dashboard', ['uuid' => $uuid])->with([
                'status' => 'ログインしました。',
            ]);
        }

        // 認証に失敗した場合の処理も追加しておくと良いかも
        return back()->withErrors([
            'credentials' => ['認証に失敗しました。'],
        ]);
    }


    public function dashboard($uuid)
    {
        Log::info(Auth::guard('postuser')->user());
        Log::info($uuid);
        $postuseruuid = Auth::guard('postuser')->user()->uuid;
        if ($uuid !== $postuseruuid) {
            abort(404, 'フォームが見つかりません');
        }

        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();
        return view('postuser.auth.dashboard', ['uuid' => $uuid, 'project' => $project]);
    }


    public function logout($uuid, Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('postuser.index', ['uuid' => $uuid])->with(['status' => 'ログアウトしました']);
    }


    public function signup($uuid)
    {
        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();
        return view('postuser.signup', ['uuid' => $uuid, 'project' => $project]);
    }


    public function verifyMailSignup($uuid, VerifyMailSignupRequest $request)
    {
        // getでリクエストが来た場合、404エラーを返す

        // 指定されたメールアドレスとUUIDが既に登録されているかを確認
        $emailExists = PostUser::where('email', $request->email)
            ->where('uuid', $uuid)
            ->exists();

        // すでに登録されている
        if ($emailExists) {
            return redirect()->route('postuser.signup', $uuid)->with(['error' => '※入力したメールアドレスはすでに登録されています']);
        }

        // すでに認証メールが送信されている
        $sended = PrePostUser::where('email', $request->email)->where('uuid', $uuid)->exists();
        if ($sended) {
            // 前のトークン付きテーブルを削除
            PrePostUser::where('email', $request->email)->where('uuid', $uuid)->delete();
        }

        // トークン生成
        $token = Str::random(16);

        // 登録
        DB::table('pre_postuser')->insert([
            'email' => $request->email,
            'token' => $token,
            'uuid' => $uuid,
            'date' => now(),
        ]);

        // プロジェクト情報を取得
        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();

        // メール送信
        Mail::to($request->email)->send(new PrePostUserTokenMail($request->email, $uuid, $token, $project->project_name));

        // sendcomplete ビューを表示
        return view('postuser.sendcomplete', ['uuid' => $uuid, 'project' => $project, 'email' => $request->email]);
    }


    // uuidとtokenの検証
    public function verifiedMailSignup($uuid, $token)
    {
        $verified = PrePostUser::where('token', $token)->where('uuid', $uuid)->first();
        // prepostuserと合致しない
        if ($verified == null) {
            Log::info('トークン:' . $token . 'が間違っています');
            return abort(404, 'トークン合致エラー');
        }

        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();
        return view('postuser.register', ['email' => $verified->email, 'project' => $project, 'uuid' => $uuid]);
    }


    // 登録処理
    public function register($uuid, PostUserRegisterRequest $request)
    {
        dd($request, $uuid);
    }
}
