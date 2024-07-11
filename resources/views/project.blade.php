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
                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">プロジェクト管理</h4>
                        <p class="text-gray-500 text-sm">プロジェクトの一覧がここに表示されます</p>
                    </div>

                    {{-- search and new project --}}
                    <div class="flex justify-between my-3">
                        <div>
                            <form action="#" class="flex gap-2">
                                <input type="text" placeholder="プロジェクトを検索"
                                    class="flex w-80 h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
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


                    {{-- list --}}
                    @foreach ($projects as $project)
                        <div class="w-full bg-white border border-neutral-300 rounded-md p-4 mb-3">
                            <div class="flex items-center gap-2 mb-3">
                                @if ($project->status)
                                    {{-- 公開中 --}}
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
                                @else
                                    {{-- 非公開 --}}
                                    <span
                                        class="bg-gray-300 text-white relative flex items-center text-xs font-semibold pl-2 pr-2.5 py-1 rounded-full">
                                        <svg class="relative w-3.5 h-3.5 -translate-x-0.5 opacity-90"
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

                                <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">
                                    <a href="{{ route('project.show', $project->id) }}">{{ $project->project_name }}</a>
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
                            <div class="my-4 border"></div>
                            <div>
                                <p class="text-xs text-gray-500">
                                    {{ $project->description }}
                                </p>
                            </div>
                        </div>
                    @endforeach


                </div>
            </main>
        </div>
    </div>
</body>

</html>
