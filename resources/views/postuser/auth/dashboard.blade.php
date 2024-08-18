@extends('postuser.layouts.master')
@section('title', 'ダッシュボード | ' . $project->project_name)
@section('content')


    <div class="w-full">

        <div class="mb-6 rounded-md border bg-neutral-200 p-4 text-sm text-neutral-500">
            <p>■ アカウントの変更はページ下部のマイアカウントの「アカウント編集」より操作できます。</p>
            <p>■ パスワードの変更はページ下部のマイアカウントの「パスワード変更」より操作できます。</p>
            <p>■ 機能説明はコチラ</p>
            <p>■ To edit your account, please click the “Edit Account” below.</p>
            <p>■ To change your password, please click the “Change Password” below.</p>
            <p>■ How to use this page (only in Japanese)</p>
        </div>
        <div class="h-full rounded-md border-0 bg-white p-6 shadow-md shadow-neutral-100">
            @foreach ($project->forms as $form)
                <div class="mb-4 flex flex-row gap-4 border-b border-neutral-300 pb-3 last:mb-0 last:border-0 last:pb-0">
                    {{-- 1 --}}
                    <p class="text-md text-neutral-400">{{ $form->id }}</p>
                    {{-- 2 --}}
                    <div class="flex flex-col">
                        <p class="text-lg font-bold">{{ $form->form_name }}</p>
                        <p class="text-sm">{{ $form->form_description }}</p>
                    </div>
                    {{-- 3 --}}
                    <div class="ml-auto flex flex-row gap-2">
                        <a href="{{ route('postuser.create', ['uuid' => $form->project->uuid, 'id' => $form->id]) }}" class="h-8 rounded-md border px-2 py-1">投稿する</a>
                        <a href="{{ route('postuser.edit', ['uuid' => $form->project->uuid, 'id' => $form->id]) }}" class="h-8 rounded-md border px-2 py-1">編集する</a>
                        <button class="h-8 rounded-md border px-2 py-1" type="submit">削除</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
