@extends('postuser.layouts.master')
@section('title', 'アカウント新規登録 | ' . $project->project_name)
@section('content')


    <div class="mx-auto max-w-2xl py-10">

        <div class="mb-8">
            <h1 class="mb-4 text-lg font-bold">アカウント新規登録</h1>
        </div>

        <div class="rounded border-0 bg-white p-10 shadow-md shadow-neutral-200">
            <div class="mb-8 rounded border border-green-300 bg-green-100 px-3 py-3 text-green-600">
                認証メールを送信しました。
            </div>
            <p class="mb-8 text-neutral-700">
                入力したメールアドレスに認証メールを送信しました。<br>
                メールから「メールを認証」ボタンを押し、認証を完了させてください。
            </p>

            {{-- resend --}}
            <form action="{{ route('postuser.verifymailsignup', $uuid) }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type='submit' class='mx-auto flex w-64 items-center justify-center rounded-sm bg-neutral-800 px-4 py-2.5 text-sm font-bold text-white focus:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 active:bg-neutral-900'>認証メールを再送信
                </button>
            </form>
        </div>
    </div>

@endsection
