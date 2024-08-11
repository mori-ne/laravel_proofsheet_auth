@extends('postuser.layouts.master')
@section('title', 'ログイン | ' . $project->project_name)
@section('content')


    <div class="w-full">

        <div class="mb-6 rounded-md border bg-gray-200 p-4 text-sm text-gray-500">
            <p>■ アカウントの変更はページ下部のマイアカウントの「アカウント編集」より操作できます。</p>
            <p>■ パスワードの変更はページ下部のマイアカウントの「パスワード変更」より操作できます。</p>
            <p>■ 機能説明はコチラ</p>
            <p>■ To edit your account, please click the “Edit Account” below.</p>
            <p>■ To change your password, please click the “Change Password” below.</p>
            <p>■ How to use this page (only in Japanese)</p>
        </div>
        <div class="h-full rounded-md border border-gray-300 bg-white p-6">
            @foreach ($project->forms as $form)
                <div class="mb-4 flex flex-row gap-4 border-b border-gray-300 pb-3 last:mb-0 last:border-0 last:pb-0">
                    {{-- 1 --}}
                    <p class="text-md text-gray-400">{{ $form->id }}</p>
                    {{-- 2 --}}
                    <div class="flex flex-col">
                        <p class="text-lg font-bold">{{ $form->form_name }}</p>
                        <p class="text-sm">{{ $form->form_description }}</p>
                    </div>
                    {{-- 3 --}}
                    <div class="ml-auto flex flex-row gap-2">
                        <button class="h-8 rounded-md border px-2 py-1" type="submit">投稿する</button>
                        <button class="h-8 rounded-md border px-2 py-1" type="submit">編集する</button>
                        <button class="h-8 rounded-md border px-2 py-1" type="submit">削除</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
