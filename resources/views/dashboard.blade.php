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
                    {{--  --}}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
