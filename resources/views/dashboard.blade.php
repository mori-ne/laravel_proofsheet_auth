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
    <link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css">

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
        <div class="flex flex-row items-stretch min-h-screen">

            <aside class="flex-none bg-white p-6 w-60 border-neutral-300 border-r">
                {{-- メインメニュー --}}
                <div class="mb-8">
                    <h3 class="font-bold text-lg mb-3">メインメニュー</h3>
                    <ul>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-package-bold"></i>
                                <a class="block text-gray-500" href="{{ route('dashboard') }}">ダッシュボード</a>
                            </div>
                        </li>
                    </ul>
                </div>
                {{-- 管理者項目 --}}
                <div class="mb-8">
                    <h3 class="font-bold text-lg mb-3">管理者項目</h3>
                    <ul>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-box-filing-bold"></i>
                                <a class="block text-gray-500" href="{{ route('projects.index') }}">プロジェクト管理</a>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-plus-clipboard-bold"></i>
                                <a class="block text-gray-500" href="{{ route('forms.index') }}">フォーム管理</a>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-write-book-bold"></i>
                                <a class="block text-gray-300" href="#">入力項目管理</a>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-envelope-bold"></i>
                                <a class="block text-gray-300" href="#">メール管理</a>
                            </div>
                        </li>
                    </ul>
                </div>
                {{-- 投稿者項目 --}}
                <div class="mb-8">
                    <h3 class="font-bold text-lg mb-3">投稿者項目</h3>
                    <ul>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-list-bold"></i>
                                <a class="block text-gray-300" href="#">投稿一覧</a>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-account-bold"></i>
                                <a class="block text-gray-300" href="#">アカウント管理</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </aside>

            <main class="w-full">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>

                <div class="p-6 w-2/3 mx-auto">

                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">ダッシュボード</h4>
                        <p class="text-gray-500 text-sm"></p>
                    </div>

                    {{--  --}}
                    <div
                        class="text-gray-600 text-sm w-full py-16 px-32 text-center border-dashed rounded-lg border-2 border-gray-300">
                        まだ何もないです...
                    </div>
                    {{--  --}}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
