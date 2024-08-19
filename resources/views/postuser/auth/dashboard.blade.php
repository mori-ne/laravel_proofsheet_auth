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
            @foreach ($project->forms as $key => $form)
                <div class="mb-4 flex flex-row gap-4 border-b border-neutral-300 pb-3 last:mb-0 last:border-0 last:pb-0">
                    {{-- 1 --}}
                    <p class="text-md w-4 text-right text-neutral-400">{{ $key + 1 }}</p>
                    {{-- 2 --}}
                    <div class="flex w-3/4 flex-col gap-2">
                        <p class="text-xl font-bold">{{ $form->form_name }}</p>
                        <div class="h-32 w-full overflow-y-scroll text-sm text-neutral-400">{!! $form->form_description !!}</div>
                    </div>
                    {{-- 3 --}}
                    <div class="broder-neutral-400 ml-auto flex flex-1 flex-col gap-2 border-l pl-4">
                        <a href="{{ route('postuser.create', ['uuid' => $form->project->uuid, 'id' => $form->id]) }}" class="h-8 rounded-md border px-2 py-1 text-center transition-all hover:bg-neutral-100">投稿／編集する</a>
                        <a href="{{ route('postuser.create', ['uuid' => $form->project->uuid, 'id' => $form->id]) }}" class="h-8 rounded-md border px-2 py-1 text-center transition-all hover:bg-neutral-100">プレビュー</a>
                        <button class="h-8 rounded-md border border-red-200 px-2 py-1 text-red-500 transition-all hover:bg-red-100" type="submit">削除</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
