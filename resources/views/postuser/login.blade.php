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

            <div class="border-b border-gray-300 bg-white px-8 py-4">
                <div class="mx-auto max-w-6xl">
                    <h1 class="text-xl font-bold">{{ $project->project_name }}</h1>
                </div>
            </div>

            {{-- flash message --}}
            @if (session('status'))
                <div class="mx-auto flex max-w-6xl flex-col justify-center gap-4 pt-8">
                    <div class="[&>svg]:text-foreground relative w-full rounded-lg border border-transparent bg-green-50 p-4 text-green-600 [&:has(svg)]:pl-11 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4">
                        <svg class="h-5 w-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h5 class="mb-1 font-medium leading-none tracking-tight">{{ session('status') }}</h5>
                    </div>
                </div>
            @endif

            <div class="mx-auto flex max-w-6xl flex-row justify-center gap-4 py-8">

                <div class="w-full">
                    <div class="documentstyle h-full rounded border border-gray-300 bg-white p-6">
                        {!! $project->project_message !!}
                    </div>
                </div>
                <div class="w-96 shrink-0">
                    @error('login')
                        <p class="text-sm text-red-500">※エラーです。</p>
                    @enderror
                    {{-- registerd user --}}
                    <div class="mb-4 rounded border border-gray-300 bg-white p-6">
                        <h3 class="mb-6 border-l-4 border-orange-500 bg-gray-100 px-2 py-1 text-lg font-bold">
                            登録済の方はこちらから
                        </h3>
                        <form action="{{ route('postuser.login', ['uuid' => $project->uuid]) }}" method="POST">
                            @csrf
                            <div class="mb-8">
                                {{-- email --}}
                                <div class="mb-4">
                                    <label class="mb-1 block text-sm" for="email">メールアドレス</label>
                                    <input name="email" class="w-full rounded border border-gray-300" type="text" value="" placeholder="メールアドレス">
                                </div>
                                {{-- password --}}
                                <div class="mb-4">
                                    <label class="mb-1 block text-sm" for="password">パスワード</label>
                                    <input name="password" class="w-full rounded border border-gray-300" type="password" value="" placeholder="パスワード">
                                </div>
                                {{-- uuid --}}
                            </div>
                            <div class="mb-4">
                                <button class="w-full rounded bg-orange-500 py-2 font-bold text-white" type="submit">ログイン</button>
                            </div>
                            <p class="text-center text-sm text-orange-700">
                                <a class="underline" href="#">※パスワードをお忘れの方</a>
                            </p>
                        </form>
                    </div>

                    {{-- new user --}}
                    <div class="mb-4 rounded border border-gray-300 bg-white p-6">
                        <h3 class="mb-6 border-l-4 border-orange-500 bg-gray-100 px-2 py-1 text-lg font-bold">
                            初めてのかたはこちらから
                        </h3>
                        <div class="mb-4">
                            <button class="w-full rounded bg-orange-500 py-2 font-bold text-white" type="submit">新規登録</button>
                        </div>
                    </div>

                    {{-- new user --}}
                    <div class="rounded border border-gray-300 bg-white p-6">
                        <h3 class="mb-2 border-b border-gray-400 pb-1 text-lg font-bold">
                            Proofsheetからのお知らせ
                        </h3>
                        <div class="mb-2">
                            <ul class="list-disc">
                                <li class="ml-4 text-sm text-gray-500">
                                    2024年8月31日 2:00〜4:00にシステムメンテナンスを行います。<br>
                                    それに伴い、上記の時間帯でのサービスを停止させていただきます。
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p class="py-2 text-center text-sm text-gray-400">
                    Created by morine
                </p>
            </div>
        </div>

    </div>
</body>


</html>
