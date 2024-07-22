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

    {{-- {{ dd($projects) }} --}}
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

                    {{-- title --}}
                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">プロジェクト管理</h4>
                        <p class="text-gray-500 text-sm">プロジェクトの一覧がここに表示されます</p>
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

                    {{-- search and new project --}}
                    <div class="flex justify-between my-3">
                        <div>
                            {{-- 検索 --}}
                            <form action="{{ route('projects.index') }}" method="GET" class="flex gap-2">
                                <input name="search" type="text" placeholder="プロジェクトを検索"
                                    value="{{ request('search') }}"
                                    class="flex w-80 h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-gray-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />

                                <select name="sort"
                                    class="w-28 inline-flex items-center justify-center px-4 py-2 text-sm font-medium transition-colors duration-200 bg-white border rounded-md text-neutral-500 hover:text-neutral-700 border-neutral-300 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>新しい順
                                    </option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>古い順
                                    </option>
                                </select>

                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border rounded-md text-neutral-500 hover:text-neutral-700 border-neutral-300 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
                                    検索
                                </button>
                            </form>

                        </div>
                        <div>
                            <a href="{{ route('projects.create') }}" type="button"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                                プロジェクトを新規作成
                            </a>
                        </div>
                    </div>

                    @if ($projects->isEmpty())
                        <div
                            class="text-gray-600 text-sm w-full py-16 px-32 text-center border-dashed rounded-lg border-2 border-gray-300">
                            プロジェクトは見つかりませんでした...
                        </div>
                    @endif

                    {{-- list --}}
                    @foreach ($projects as $project)
                        <div class="mb-3 bg-white border border-gray-300 rounded-md">

                            <div class="p-4">
                                <div class="flex justify-start items-center gap-2 mb-2">

                                    @if ($project->status)
                                        {{-- 公開中 --}}
                                        <form name="toggleStatus"
                                            action="{{ route('projects.toggle', ['id' => $project->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-600 text-white relative flex items-center text-xs font-semibold pl-2 pr-2.5 py-1 rounded-full">
                                                <svg class="relative w-3.5 h-3.5 -translate-x-0.5 opacity-90"
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
                                            <button type="submit"
                                                class="bg-gray-300 text-white relative flex items-center text-xs font-semibold pl-2 pr-2.5 py-1 rounded-full">
                                                <svg class="relative w-3.5 h-3.5 -translate-x-0.5 opacity-90"
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

                                    {{-- プロジェクト名 --}}
                                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">
                                        <a
                                            href="{{ route('projects.show', $project->id) }}">{{ $project->project_name }}</a>
                                    </h5>

                                    {{-- ドロップダウンメニュー --}}
                                    <div x-data="{
                                        dropdownOpen: false
                                    }" class="ml-auto relative">

                                        <button @click="dropdownOpen=true"
                                            class="inline-flex items-center justify-center h-6 px-2 text-sm font-medium transition-colors bg-white rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"><i
                                                class="at-dots-vertical"></i></button>

                                        <div x-show="dropdownOpen" @click.away="dropdownOpen=false"
                                            x-transition:enter="ease-out duration-200"
                                            x-transition:enter-start="-translate-y-2"
                                            x-transition:enter-end="translate-y-0"
                                            class="absolute top-0 z-50 w-24 mt-10 -translate-x-1/2 left-1/2" x-cloak>
                                            <div
                                                class="p-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
                                                <a href="{{ route('projects.show', ['id' => $project->id]) }}"
                                                    @click="menuBarOpen=false"
                                                    class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                                    <span>詳細</span>
                                                </a>
                                                <form action="{{ route('projects.edit', $project->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" @click="menuBarOpen=false"
                                                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                                        <span>編集</span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('projects.duplicate', $project->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" @click="menuBarOpen=false"
                                                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                                        <span>コピー</span>
                                                    </button>
                                                </form>
                                                <div x-data="{ modalOpen: false }"
                                                    @keydown.escape.window="modalOpen = false"
                                                    class="relative z-50 w-auto h-auto">
                                                    <button @click="modalOpen=true"
                                                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none text-red-500">削除</button>
                                                    <template x-teleport="body">
                                                        <div x-show="modalOpen"
                                                            class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen"
                                                            x-cloak>
                                                            <div x-show="modalOpen"
                                                                x-transition:enter="ease-out duration-300"
                                                                x-transition:enter-start="opacity-0"
                                                                x-transition:enter-end="opacity-100"
                                                                x-transition:leave="ease-in duration-300"
                                                                x-transition:leave-start="opacity-100"
                                                                x-transition:leave-end="opacity-0"
                                                                @click="modalOpen=false"
                                                                class="absolute inset-0 w-full h-full bg-black bg-opacity-40">
                                                            </div>
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
                                                                        <svg class="w-5 h-5"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke-width="1.5" stroke="currentColor">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round"
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
                                                                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">
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
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center">
                                        <p class="text-sm text-gray-500">公開期限：</p>
                                        <p class="text-sm text-neutral-900">
                                            @if ($project->is_deadline)
                                                {{ $project->is_deadline }}
                                            @else
                                                設定なし
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="text-sm text-gray-500">フォーム数：</p>
                                        <p class="text-sm text-neutral-900">{{ $project->forms_count }}</p>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="text-sm text-gray-500">作成日：</p>
                                        <p class="text-sm text-neutral-900">{{ $project->created_at }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2 pl-4 pr-4 bg-gray-100 rounded-b-md">
                                <div class="flex items-center">
                                    <p class="text-sm text-gray-500">公開URL：</p>
                                    <a class="text-sm text-gray-700"
                                        href="{{ url('/') . '/forms' }}/{{ $project->uuid }}">{{ url('/') . '/forms' }}/{{ $project->uuid }}</a>
                                    <p class="text-gray-400 text-sm font-bold w-fit ml-auto">
                                        {{ $project->id }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </main>
        </div>
    </div>


</body>

</html>
