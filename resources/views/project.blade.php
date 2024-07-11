<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <div class="flex flex-row items-stretch">

            <aside class="flex-none bg-white p-6 w-72 border-neutral-300 border-r h-screen">
                {{-- メインメニュー --}}
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-3">メインメニュー</h3>
                    <ul>
                        <li><a class="block mb-2 text-gray-500" href="{{ route('dashboard') }}">ダッシュボード</a></li>
                    </ul>
                </div>
                {{-- 管理者項目 --}}
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-3">管理者項目</h3>
                    <ul>
                        <li><a class="block mb-2 text-gray-500" href="{{ route('project') }}">プロジェクト管理</a></li>
                        <li><a class="block mb-2 text-gray-500" href="{{ route('dashboard') }}">フォーム管理</a></li>
                        <li><a class="block mb-2 text-gray-500" href="{{ route('dashboard') }}">入力項目管理</a></li>
                        <li><a class="block mb-2 text-gray-500" href="{{ route('dashboard') }}">メール管理</a></li>
                    </ul>
                </div>
                {{-- 投稿者項目 --}}
                <div class="mb-6">
                    <h3 class="font-bold text-lg mb-3">投稿者項目</h3>
                    <ul>
                        <li><a class="block mb-2 text-gray-500" href="{{ route('dashboard') }}">投稿一覧</a></li>
                        <li><a class="block mb-2 text-gray-500" href="{{ route('dashboard') }}">アカウント管理</a></li>
                    </ul>
                </div>
            </aside>

            <main class="w-full">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>

                <div class="p-6">

                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">プロジェクト管理</h4>
                        <p class="text-gray-500 text-sm">プロジェクトの一覧がここに表示されます</p>
                    </div>

                    <div class="flex justify-between my-3">
                        <div>
                            <form action="#" class="flex gap-2">
                                <input type="text" placeholder="プロジェクトを検索"
                                    class="flex w-60 h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                <button type="button"
                                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border rounded-md text-neutral-500 hover:text-neutral-700 border-neutral-300 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
                                    検索
                                </button>
                            </form>
                        </div>
                        <div>
                            <button type="button"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                                プロジェクトを新規作成
                            </button>
                        </div>
                    </div>


                    {{-- card --}}
                    <div class="w-full bg-white border border-neutral-300 rounded-md p-4">
                        <div class="flex items-center gap-2 mb-3">
                            <span
                                class="bg-green-600 text-white relative flex items-center text-xs font-semibold pl-2 pr-2.5 py-1 rounded-full">
                                <svg class="relative w-3.5 h-3.5 -translate-x-0.5 opacity-90"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>公開中</span>
                            </span>
                            <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">第69回
                                全国肢体不自由児療育研究大会</h5>
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm text-neutral-500">プロジェクト公開URL：</p>
                            <a class="text-sm text-neutral-900 underline"
                                href="#">https://www.proofsheet.jp/fkskanri/%2FxDHw1SPPCExGevGxql8Gg%3D%3DFKS/</a>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center">
                                <p class="text-sm text-neutral-500">投稿期限：</p>
                                <p class="text-sm text-neutral-900">2024/12/31</p>
                            </div>
                            <div class="flex items-center">
                                <p class="text-sm text-neutral-500">フォーム数：</p>
                                <p class="text-sm text-neutral-900">1</p>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
