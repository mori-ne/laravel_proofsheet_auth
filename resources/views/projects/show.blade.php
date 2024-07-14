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
    @livewireStyles
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

            @include('layouts.sidebar')

            <main class="w-full">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>

                <div class="p-6 max-w-4xl mx-auto">

                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">プロジェクトの詳細</h4>
                        <p class="text-gray-500 text-sm"></p>
                    </div>

                    {{-- breadcrumb --}}
                    <div class="mb-2 border-neutral-300 ">
                        <div class="flex gap-1 items-center">
                            <i class="at-arrow-left-circle"></i>
                            <a href="javascript:history.back()">戻る</a>
                        </div>
                    </div>

                    {{-- detail --}}
                    <div class="bg-white border border-neutral-300 rounded-md p-8 ">
                        <div>

                            <div class="flex flex-row items-center gap-2 mb-6">
                                {{-- 公開／非公開 --}}
                                <div>
                                    @if ($project->status)
                                        {{-- 公開中 --}}
                                        <span
                                            class="w-20 h-8 bg-green-600 text-white relative flex items-center justify-center text-sm font-semibold pl-2 pr-2.5 py-1 mb-2 rounded-full">
                                            <svg class="relative w-4 h-4 -translate-x-0.5 opacity-90"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">
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
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>
                                                非公開
                                            </span>
                                        </span>
                                    @endif
                                </div>
                                {{-- 投稿期限 --}}
                                <div>
                                    <p class="text-xs text-gray-400 m-0 leading-3">投稿期限</p>
                                    <p class="text-lg font-bold">
                                        {{ \Carbon\Carbon::parse($project->is_deadline)->format('Y/m/d') }}
                                    </p>
                                </div>
                                {{-- 編集 --}}
                                <div class="ml-auto">
                                    <button type="button"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border rounded-md text-neutral-500 hover:text-neutral-700 border-neutral-200/70 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
                                        編集する
                                    </button>
                                </div>
                                {{-- 削除 --}}
                                <div>
                                    <button type="button"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-red-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-red-100 bg-red-50 hover:text-red-600 hover:bg-red-100">
                                        削除
                                    </button>
                                </div>
                            </div>

                            {{-- プロジェクト名 --}}
                            <div class="mb-8">
                                <p class="text-sm text-gray-400 mb-2">プロジェクト名</p>
                                <h5 class="text-2xl font-bold leading-none text-neutral-900">
                                    {{ $project->project_name }}
                                </h5>
                            </div>


                            {{-- 公開URL --}}
                            <div class="mb-8">
                                <p class="text-sm text-gray-400">公開URL</p>
                                <p>
                                    <a class="text-md  underline"
                                        href="#">https://localhost/forms/{{ $project->uuid }}
                                    </a>
                                </p>
                            </div>


                            {{-- プロジェクトの説明 --}}
                            <div class="mb-8">
                                <p class="text-sm text-gray-400 mb-2">プロジェクトの説明</p>
                                @if (!$project->description)
                                    <span class="text-gray-400">なし</span>
                                @else
                                    <div class="text-sm bg-gray-100 p-4">
                                        {!! $project->description !!}
                                    </div>
                                @endif
                            </div>

                            <hr class="border-2 my-12">

                            <div>
                                <h5 class="text-2xl font-bold leading-none text-neutral-900 mb-4">
                                    返信メール
                                </h5>
                                <div class="mb-8">
                                    <p class="text-sm text-gray-400 mb-2">件名</p>
                                    @if (!$project->mail_subject)
                                        <span class="text-gray-400">なし</span>
                                    @else
                                        <div class="text-sm bg-gray-100 p-4">
                                            {{ $project->mail_subject }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm text-gray-400 mb-2">内容</p>
                                    @if (!$project->mail_content)
                                        <span class="text-gray-400">なし</span>
                                    @else
                                        <div class="text-sm bg-gray-100 p-4">
                                            {!! $project->mail_content !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
            </main>
        </div>
    </div>

    @livewireScripts
</body>

</html>
