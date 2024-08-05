<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'postuser') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css">
    <link rel="stylesheet" href="{{ asset('css/documentstyle.css') }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div id="app">


        <div class="min-h-screen bg-gray-100">


            {{-- top bar --}}
            <div class="border-b border-gray-300 bg-white py-4">

                <div class="mx-auto flex max-w-6xl flex-row">

                    {{-- project_name --}}
                    <div class="">
                        <h1 class="text-xl font-bold">{{ $project->project_name }}</h1>
                    </div>

                    {{-- account --}}
                    <div class="ml-auto flex flex-row items-center gap-3">
                        <p class="flex flex-row items-center gap-1">
                            <span class="text-md font-bold">{{ Auth::guard('postuser')->user()->name }}</span>
                            <span class="text-xs text-gray-400">さん</span>
                        </p>
                        <div>
                            <a class="text-sm" href="">アカウント管理</a>
                        </div>
                        <form action="{{ route('postuser.logout', ['uuid' => $project->uuid]) }}" method="POST">
                            @csrf
                            <button class="text-sm text-red-500" type="submit">ログアウト</button>
                        </form>
                    </div>
                </div>


            </div>

            <div class="mx-auto flex max-w-6xl flex-col justify-center gap-4 py-8">

                {{-- flash message --}}
                @if (session('status'))
                    <div class="[&>svg]:text-foreground relative mb-4 w-full rounded-lg border border-transparent bg-green-50 p-4 text-green-600 [&:has(svg)]:pl-11 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4">
                        <svg class="h-5 w-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h5 class="mb-1 font-medium leading-none tracking-tight">{{ session('status') }}</h5>
                    </div>
                @endif

                <div class="w-full">

                    <div class="mb-4 rounded-md border bg-gray-200 p-4 text-sm text-gray-500">
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



            </div>
        </div>
    </div>
</body>

</html>

{{ dd($project->forms) }}
