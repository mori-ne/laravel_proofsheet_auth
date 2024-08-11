@extends('postuser.layouts.master')
@section('title', 'アカウント新規登録 | ' . $project->project_name)
@section('content')


    <div class="mx-auto max-w-xl">

        <div class="mb-8">
            <h1 class="mb-4 text-lg font-bold">アカウント新規登録</h1>
        </div>

        <div class="rounded border border-gray-300 bg-white p-10">
            <div class="mb-6 rounded border border-green-300 bg-green-100 px-2 py-1.5 text-green-600">
                認証メールを送信しました
            </div>
            <p class="mb-8 text-gray-700">
                入力したメールアドレスに認証メールを送信しました。<br>
                メールから「メールを認証」ボタンを押し、認証を完了させてください。
            </p>

            {{-- resend --}}
            <form action="{{ route('postuser.verifymailsignup', $uuid) }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type='submit' class='mx-auto flex items-center justify-center rounded-md bg-gray-800 px-4 py-2.5 text-sm font-bold text-white focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900'>認証メールを再送信
                </button>
            </form>
        </div>
    </div>

@endsection
