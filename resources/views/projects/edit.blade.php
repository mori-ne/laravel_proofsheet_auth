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

    {{-- tinyMCE --}}
    <x-head.tinymce-config />

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
                        <h4 class="font-bold text-lg mb-1">プロジェクトの編集</h4>
                        <p class="text-gray-500 text-sm"></p>
                    </div>

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
                                {{-- 公開設定 --}}
                                <div class="mr-4">
                                    <label class="text-lg font-bold" for="#">公開設定</label>
                                    <select class="ml-4 border-gray-300 rounded-md name="status" id="">
                                        @if ($project->status)
                                            <option value="1" selected>公開中</option>
                                            <option value="0">非公開</option>
                                        @else
                                            <option value="1">公開中</option>
                                            <option value="0" selected>非公開</option>
                                        @endif
                                    </select>
                                </div>

                                {{-- 公開期限 --}}
                                <div class="mr-4">
                                    <label class="text-lg font-bold" for="#">公開期限</label>
                                    <input name="is_deadline" class="ml-4 border-gray-300 rounded-md" type="date"
                                        value="{{ $project->is_deadline }}">
                                    <span class="text-xs text-gray-300 ml-2">後で直す</span>
                                </div>

                                {{-- 削除 --}}
                                <div class="ml-auto">
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
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-lg font-bold" for="#">
                                    プロジェクト名
                                </label>
                                <span
                                    class="bg-red-600 text-white relative text-xs font-semibold pl-2 pr-2.5 py-0.5 rounded-full">
                                    <span>必須</span>
                                </span>
                            </div>
                            <input name="project_name" type="text" placeholder="プロジェクト名を記入してください"
                                value="{{ $project->project_name }}"
                                class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            @error('project_name')
                                <div class="mt-2 text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- プロジェクトの説明 --}}
                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-lg font-bold" for="#">プロジェクトの説明</label>
                            </div>
                            <textarea id="projectinstance" name="description" type="text" placeholder="プロジェクトの説明を記入してください"
                                class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{{ $project->description }}</textarea>
                        </div>
                    </div>

                    <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                        <div>
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">返信メールの件名</label>
                                </div>
                                <input name="mail_subject" type="text" placeholder="メールの件名を記入してください"
                                    value="{{ $project->mail_subject }}"
                                    class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">返信メールの本文</label>
                                </div>
                                <textarea id="projectinstance" name="mail_content" type="text" placeholder="メールの返信内容を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{!! $project->mail_content !!}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                        <button type="submit"
                            class="flex items-center justify-center w-96 px-4 py-2 text-sm mx-auto font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">更新する</button>
                        <span class="text-xs text-gray-300 ml-2">まだ未実装</span>

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

    @livewireScripts
</body>

</html>
