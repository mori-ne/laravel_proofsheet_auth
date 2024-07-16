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

                    {{-- フラッシュメッセージ --}}
                    @if (session('status'))
                        <div
                            class="mb-4 relative w-full rounded-lg border border-transparent bg-green-50 p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-green-600">
                            <svg class="w-5 h-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h5 class="mb-1 font-medium leading-none tracking-tight">{{ session('status') }}</h5>
                        </div>
                    @endif

                    {{-- back --}}
                    <div class="mb-4 border-neutral-300 ">
                        <div class="flex gap-1 items-center">
                            <i class="at-arrow-left-circle"></i>
                            <a href="javascript:history.back()">戻る</a>
                        </div>
                    </div>

                    {{-- content --}}
                    <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                        <div>
                            <div class="flex flex-row items-center gap-2">
                                {{-- 公開／非公開 --}}
                                <div>
                                    @if ($project->status)
                                        {{-- 公開中 --}}
                                        <form name="toggleStatus"
                                            action="{{ route('projects.toggle', ['id' => $project->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-20 h-8 bg-green-600 text-white relative flex items-center justify-center text-sm font-semibold pl-2 pr-2.5 py-1 rounded-full">
                                                <svg class="relative w-4 h-4 -translate-x-0.5 opacity-90"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>公開中</span>
                                            </button>
                                        </form>
                                    @else
                                        {{-- 非公開 --}}
                                        <form name="toggleStatus"
                                            action="{{ route('projects.toggle', ['id' => $project->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="sumbit"
                                                class="w-20 h-8 bg-gray-300 text-white relative flex items-center justify-center text-sm font-semibold pl-2 pr-2.5 py-1 rounded-full">
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
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                {{-- 公開期限 --}}
                                <div>
                                    <p class="text-xs text-gray-400 m-0 leading-3">公開期限</p>
                                    <p class="text-lg font-bold">
                                        @if ($project->is_deadline)
                                            {{ $project->is_deadline }}
                                        @else
                                            設定なし
                                        @endif
                                    </p>
                                </div>
                                {{-- 編集 --}}
                                <div class="ml-auto">
                                    <form action="{{ route('projects.edit', $project->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border rounded-md text-neutral-500 hover:text-neutral-700 border-neutral-200/70 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
                                            編集する
                                        </button>
                                    </form>
                                </div>
                                {{-- 削除 --}}
                                <div>
                                    <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                        class="relative z-50 w-auto h-auto">
                                        <button @click="modalOpen=true"
                                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-red-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-red-100 bg-red-50 hover:text-red-600 hover:bg-red-100">削除</button>
                                        <template x-teleport="body">
                                            <div x-show="modalOpen"
                                                class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                                x-cloak>
                                                <div x-show="modalOpen" x-transition:enter="ease-out duration-300"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="ease-in duration-300"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0" @click="modalOpen=false"
                                                    class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>

                                                <div x-show="modalOpen" x-trap.inert.noscroll="modalOpen"
                                                    x-transition:enter="ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave="ease-in duration-200"
                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">

                                                    <div class="flex items-center justify-between pb-2">
                                                        <h3 class="text-lg font-semibold">プロジェクトを削除</h3>
                                                        <button @click="modalOpen=false"
                                                            class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>

                                                    <div class="relative w-auto mb-4">
                                                        <p>本当に削除してもよろしいですか？</p>
                                                        <p class="text-sm text-red-500">※この操作は取り消せません</p>
                                                    </div>

                                                    <div class="flex">

                                                        <form class="ml-auto"
                                                            action="{{ route('projects.destroy', $project->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class=" inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">
                                                                削除
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                        {{-- プロジェクト名 --}}
                        <div class="mb-8">
                            <p class="text-sm text-gray-400 mb-2">プロジェクト名</p>
                            <h5 class="text-2xl font-bold leading-none text-neutral-900">
                                {{ $project->project_name }}
                            </h5>
                        </div>
                        {{-- 公開URL --}}
                        <div class="mb-8">
                            <p class="text-sm text-gray-400 mb-2">公開URL<span class="text-xs">（公開URLは変更できません）</span>
                            </p>
                            <div class="text-sm bg-gray-100 p-4 rounded">
                                <a class="text-md  underline"
                                    href="{{ url('/') . '/forms' }}/{{ $project->uuid }}">{{ url('/') . '/forms' }}/{{ $project->uuid }}
                                </a>
                            </div>
                        </div>
                        {{-- プロジェクトの説明 --}}
                        <div>
                            <p class="text-sm text-gray-400 mb-2">プロジェクトの説明</p>
                            @if (!$project->description)
                                <span class="text-gray-400">なし</span>
                            @else
                                <div class="text-sm bg-gray-100 p-4 rounded">
                                    {!! $project->description !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                        <div>
                            <div class="mb-8">
                                <p class="text-sm text-gray-400 mb-2">メール件名</p>
                                @if (!$project->mail_subject)
                                    <span class="text-gray-400">なし</span>
                                @else
                                    <div class="text-sm bg-gray-100 p-4 rounded">
                                        {{ $project->mail_subject }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 mb-2">メール内容</p>
                                @if (!$project->mail_content)
                                    <span class="text-gray-400">なし</span>
                                @else
                                    <div class="text-sm bg-gray-100 p-4 rounded">
                                        {!! $project->mail_content !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <span class="text-xs text-gray-400 pr-4">
                            プロジェクト作成日：
                            @if (!$project->created_at)
                                <span class="text-gray-700">無し</span>
                            @else
                                <span class="text-gray-700">
                                    {{ $project->created_at }}
                                </span>
                            @endif
                        </span>
                        <span class="text-xs text-gray-400 pr-4">
                            プロジェクト更新日：
                            @if (!$project->updated_at)
                                <span class="text-gray-700">無し</span>
                            @else
                                <span class="text-gray-700">
                                    {{ $project->updated_at }}
                                </span>
                            @endif
                        </span>
                    </div>

                </div>
            </main>
        </div>
    </div>


</body>

</html>
