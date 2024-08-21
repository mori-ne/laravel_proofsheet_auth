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
use App\Mail\PostUserRegisterCompliteMail;
use App\Mail\PostUserEditNameMail;
use Illuminate\Support\Facades\Hash;
use App\Models\Input;

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

        // ログインしている、かつPostUserのDBのuuidとRequestのuuidが一致していたらリダイレクト
        if (Auth::guard('postuser')->check() && Auth::guard('postuser')->user()->uuid == $uuid) {
            return redirect()->route('postuser.dashboard', ['uuid' => $uuid]);
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
        // log
        Log::info(Auth::guard('postuser')->user());
        Log::info($uuid);

        $postuseruuid = Auth::guard('postuser')->user()->uuid;
        if ($uuid !== $postuseruuid) {
            return redirect()->route('postuser.index', ['uuid' => $uuid]);
            // abort(404, 'フォームが見つかりません');
        }

        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();

        // statusが非公開なら404ページへ
        if (!$project->status) {
            abort(404, 'フォームが見つかりません');
        }

        return view('postuser.auth.dashboard', ['uuid' => $uuid, 'project' => $project]);
    }


    public function logout($uuid, Request $request)
    {
        Auth::guard('postuser')->logout();
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


    public function store($uuid, PostUserRegisterRequest $request)
    {
        $validated = $request->validated();
        // dd($validated, $request);

        // トランザクション処理
        DB::beginTransaction();

        try {
            Log::info('ユーザー作成開始');

            // 新しいユーザーを作成
            $user = PostUser::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'affiliate' => $validated['affiliate'],
                'zipcode' => $validated['zipcode'],
                'address_country' => $validated['address_country'],
                'address_city' => $validated['address_city'],
                'address_etc' => $validated['address_etc'],
                'password' => Hash::make($validated['password']),
                'uuid' => $uuid,
                'email' => $validated['email'],
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('ユーザー作成完了');

            // PrePostUserの削除
            $prepostuser = PrePostUser::where('email', $validated['email'])->first();
            if ($prepostuser) {
                PrePostUser::destroy($prepostuser->id);
                Log::info('PrePostUser削除完了');
            }

            // トランザクションのコミット
            DB::commit();
            Log::info('トランザクションコミット完了');

            // 新規登録されたユーザーでpostuserガードを使用してログイン (セッション発行)
            Auth::guard('postuser')->login($user);
            Log::info('ユーザーのログイン完了');

            // メール送信
            $project = Project::where('uuid', $uuid)->firstOrFail();
            Mail::to($request->email)->send(new PostUserRegisterCompliteMail($request->email, $uuid, $project->project_name));
            Log::info('メール送信完了');
        } catch (\Exception $e) {
            Log::error('エラー発生: ' . $e->getMessage());
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'ユーザー登録に失敗しました。もう一度お試しください。']);
        }

        // 成功した場合のリダイレクト
        return redirect()->route('postuser.dashboard', $uuid)->with('status', '新規登録が完了しました！');
    }

    public function create($uuid, $id)
    {
        $inputs = Input::with('form.project')->where('form_id', $id)->first();
        $inputComponents = json_decode($inputs->inputs);
        // dd($uuid, $id, $input->inputs);
        return view('postuser.auth.inputComponent', ['inputs' => $inputs, 'uuid' => $uuid, 'project' => $inputs->form->project, 'inputComponents' => $inputComponents]);
    }

    public function edit($uuid, $id)
    {
        dd($uuid, $id);
    }

    public function account($uuid)
    {
        $project = Project::with('forms')->where('uuid', $uuid)->firstOrFail();
        return view('postuser.auth.account', ['uuid' => $uuid, 'project' => $project]);
    }

    public function accountEditName($uuid, Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'affiliate' => 'required|string|max:255',
            'zipcode' => 'required|string|size:7',
            'address_country' => 'required|string|max:10',
            'address_city' => 'required|string',
            'address_etc' => 'nullable|string|nullable',
        ]);

        // 認証ユーザー情報を取得
        $user = Auth::guard('postuser')->user();
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        // トランザクション処理
        DB::beginTransaction();

        try {
            Log::info('ユーザー情報更新開始');

            $user->first_name = $validated['first_name'];
            $user->last_name = $validated['last_name'];
            $user->affiliate = $validated['affiliate'];
            $user->zipcode = $validated['zipcode'];
            $user->address_country = $validated['address_country'];
            $user->address_city = $validated['address_city'];
            $user->address_etc = $validated['address_etc'];
            $user->save();

            // トランザクションのコミット
            DB::commit();
            Log::info('トランザクションコミット完了');


            // メール送信
            $project = Project::where('uuid', $uuid)->firstOrFail();
            $email = Auth::guard('postuser')->user()->email;

            Mail::to($email)->send(new PostUserEditNameMail($project->project_name, $email, $project->uuid));
            Log::info('メール送信完了');

            return redirect()->back()->with('status', '氏名・施設情報を更新しました');
        } catch (\Exception $e) {
            Log::error('エラー発生: ' . $e->getMessage());
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => '更新に失敗しました。もう一度お試しください。']);
        }
    }


    public function accountEditMail($uuid, Request $request)
    {
        // 生存しているメールかどうか認証させる
        dd($request, $uuid);
    }

    public function accountEditPassword($uuid, Request $request)
    {
        // 更新処理
        dd($request, $uuid);
    }

    public function accountEditDelete($uuid, Request $request)
    {
        // 更新処理
        dd($request, $uuid);
    }
}
