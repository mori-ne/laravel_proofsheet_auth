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
                                <a class="block text-gray-500" href="{{ route('project.index') }}">プロジェクト管理</a>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-plus-clipboard-bold"></i>
                                <a class="block text-gray-500" href="{{ route('form') }}">フォーム管理</a>
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

                <div class="p-6">

                    {{-- title --}}
                    {{-- <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">プロジェクト詳細</h4>
                        <p class="text-gray-500 text-sm">プロジェクトの詳細がここに表示されます</p>
                    </div> --}}

                    {{-- breadcrumb --}}
                    <div class="w-2/3 mx-auto mb-2 border-neutral-300 ">
                        <a href="{{ url()->previous() }}">戻る</a>
                    </div>

                    {{-- detail --}}
                    <div class="w-2/3 mx-auto bg-white border border-neutral-300 rounded-md p-8 mb-3">
                        <div class="flex flex-col gap-2 mb-3">
                            @if ($project->status)
                                {{-- 公開中 --}}
                                <span
                                    class="w-20 h-8 bg-green-600 text-white relative flex items-center justify-center text-sm font-semibold pl-2 pr-2.5 py-1 mb-2 rounded-full">
                                    <svg class="relative w-4 h-4 -translate-x-0.5 opacity-90"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>公開中</span>
                                </span>
                            @else
                                {{-- 非公開 --}}
                                <span
                                    class="w-20 h-8 bg-gray-300 text-white relative flex items-center justify-center text-sm font-semibold pl-2 pr-2.5 py-1 mb-2 rounded-full">
                                    <svg class="relative w-4 h-4 -translate-x-0.5 opacity-90"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>
                                        非公開
                                    </span>
                                </span>
                            @endif


                            <h5 class="text-2xl font-bold leading-none tracking-tight text-neutral-900">
                                {{ $project->project_name }}
                            </h5>
                        </div>
                        <div class="flex items-center">
                            <p class="text-sm text-neutral-500">プロジェクト公開URL：</p>
                            <a class="text-sm text-neutral-900 underline"
                                href="#">https://localhost/forms/{{ $project->uuid }}</a>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center">
                                <p class="text-sm text-neutral-500">投稿期限：</p>
                                <p class="text-sm text-neutral-900">
                                    {{ \Carbon\Carbon::parse($project->is_deadline)->format('Y/m/d') }}
                                </p>
                            </div>
                            <div class="flex items-center">
                                <p class="text-sm text-neutral-500">フォーム数：</p>
                                <p class="text-sm text-neutral-900">null</p>
                            </div>
                        </div>
                        <div>
                            <p>
                                {{ $project->description }}
                            </p>
                        </div>
                        <div class="border p-4">
                            {{ $project->mail_subject }}
                        </div>
                        <div class="border p-4">
                            {{ $project->mail_content }}
                        </div>
                    </div>


                </div>
            </main>
        </div>
    </div>
</body>

</html>
