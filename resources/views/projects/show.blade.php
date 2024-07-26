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
    <link rel="stylesheet" href="{{ asset('css/documentstyle.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    {{-- alpine.jsとvueが競合する --}}
    {{-- <div id="app"> --}}

    <div class="min-h-screen bg-gray-100">

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

            <main class="flex-1 h-svh overflow-y-scroll">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>

                <div class="p-6 max-w-5xl mx-auto">

                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">プロジェクトの詳細</h4>
                        <p class="text-gray-500 text-sm">プロジェクトの詳細画面です。確認、編集、削除ができます</p>
                    </div>

                    {{-- back --}}
                    <div class="mb-4 border-neutral-300 ">
                        <div class="flex gap-1 items-center">
                            <i class="at-arrow-left-circle"></i>
                            <a href="javascript:history.back()">戻る</a>
                        </div>
                    </div>

                    {{-- flash message --}}
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

                    {{-- controll --}}
                    <div class="flex items-center gap-4 mb-4">
                        {{-- 公開／非公開 --}}
                        <div>
                            @if ($project->status)
                                {{-- 公開中 --}}
                                <form name="toggleStatus"
                                    action="{{ route('projects.toggle', ['id' => $project->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-20 h-8 bg-green-600 text-white relative flex items-center justify-center text-sm font-semibold pl-2 pr-2.5 py-1 rounded-full">
                                        <svg class="relative w-4 h-4 -translate-x-0.5 opacity-90"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
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
                                    action="{{ route('projects.toggle', ['id' => $project->id]) }}" method="POST">
                                    @csrf
                                    <button type="sumbit"
                                        class="w-20 h-8 bg-gray-300 text-white relative flex items-center justify-center text-sm font-semibold pl-2 pr-2.5 py-1 rounded-full">
                                        <svg class="relative w-4 h-4 -translate-x-0.5 opacity-90"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>非公開</span>
                                    </button>
                                </form>
                            @endif
                        </div>

                        {{-- 公開期限 --}}
                        <div class="flex gap-2 items-center">
                            <p class="text-gray-400">公開期限</p>
                            <p class="text-lg font-bold">
                                @if ($project->is_deadline)
                                    {{ $project->is_deadline }}
                                @else
                                    設定なし
                                @endif
                            </p>
                        </div>
                        {{-- dropdown menu project --}}
                        <div x-data="{
                            dropdownOpen: false
                        }" class="ml-auto relative">

                            <button @click="dropdownOpen=true"
                                class="text-lg inline-flex items-center justify-center py-2 px-4 font-medium transition-colorsrounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:rounded focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"><i
                                    class="at-dots-vertical"></i></button>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen=false"
                                x-transition:enter="ease-out duration-200" x-transition:enter-start="-translate-y-2"
                                x-transition:enter-end="translate-y-0"
                                class="absolute top-0 z-50 w-44 mt-10 -translate-x-1/2 left-1/2" x-cloak>
                                <div
                                    class="p-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">

                                    {{-- edit --}}
                                    <a href="{{ route('projects.edit', $project->id) }}" @click="menuBarOpen=false"
                                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                        <span>プロジェクトを編集</span>
                                    </a>

                                    {{-- delete --}}
                                    <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                        class="relative z-50 w-auto h-auto">
                                        <button @click="modalOpen=true"
                                            class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none text-red-500">プロジェクトを削除</button>
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

                    {{-- project --}}
                    <div class="mb-8 border-t border-b border-gray-300 py-6">
                        {{-- <h4 class="text-md font-bold mb-2 text-gray-500">プロジェクト情報</h4> --}}
                        {{-- project name / project description --}}
                        <div class="mb-6">
                            <h5 class="text-2xl font-bold leading-none text-neutral-900 mb-3">
                                {{ $project->project_name }}
                            </h5>
                            <h5 class="text-lg leading-none mb-2">
                                <div class="text-md">{!! $project->project_description !!}</div>
                            </h5>
                        </div>
                        {{-- public url --}}
                        <div class="">
                            <p class="text-sm text-gray-400">公開URL（URLは変更できません）</p>
                            <a class="text-md underline text-blue-700"
                                href="{{ url('/') . '/userpage' }}/{{ $project->uuid }}" target="_blank">
                                {{ url('/') . '/userpage' }}/{{ $project->uuid }}
                            </a>
                        </div>
                    </div>



                    <div x-data="{
                        tabSelected: 1,
                        tabId: $id('tabs'),
                        tabButtonClicked(tabButton) {
                            this.tabSelected = tabButton.id.replace(this.tabId + '-', '');
                            this.tabRepositionMarker(tabButton);
                        },
                        tabRepositionMarker(tabButton) {
                            this.$refs.tabMarker.style.width = tabButton.offsetWidth + 'px';
                            this.$refs.tabMarker.style.height = tabButton.offsetHeight + 'px';
                            this.$refs.tabMarker.style.left = tabButton.offsetLeft + 'px';
                        },
                        tabContentActive(tabContent) { return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', ''); },
                        tabButtonActive(tabContent) { const tabId = tabContent.id.split('-').slice(-1); return this.tabSelected == tabId; }
                    }" x-init="tabRepositionMarker($refs.tabButtons.firstElementChild);" class="relative w-full">

                        <div x-ref="tabButtons"
                            class="relative inline-grid items-center justify-center w-full h-12 grid-cols-4 p-1 text-gray-500 bg-white border border-gray-300 rounded-lg select-none mb-8 ">
                            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                                :class="{ 'bg-gray-100 text-gray-700': tabButtonActive($el) }"
                                class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">フォーム情報</button>
                            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                                :class="{ 'bg-gray-100 text-gray-700': tabButtonActive($el) }"
                                class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">返信メール情報</button>
                            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                                :class="{ 'bg-gray-100 text-gray-700': tabButtonActive($el) }"
                                class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">ユーザー情報</button>
                            <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button"
                                :class="{ 'bg-gray-100 text-gray-700': tabButtonActive($el) }"
                                class="relative z-20 inline-flex items-center justify-center w-full h-10 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">ページ情報</button>
                            <div x-ref="tabMarker" class="absolute left-0 z-10 w-1/2 h-full duration-300 ease-out"
                                x-cloak>
                                <div class="w-full h-full bg-gray-100 rounded-md shadow-sm"></div>
                            </div>
                        </div>
                        <div class="">

                            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="">
                                {{-- forms --}}
                                <div class="mb-8">
                                    <h4 class="text-md font-bold mb-2 text-gray-500">フォーム情報</h4>

                                    {{-- if --}}
                                    @if ($project->forms->isEmpty())
                                        <div
                                            class="text-gray-600 text-sm w-full py-16 px-32 text-center border-dashed rounded-lg border-2 border-gray-300">
                                            フォームは見つかりませんでした...
                                        </div>
                                    @endif

                                    {{-- detail --}}
                                    <div>
                                        @foreach ($project->forms as $form)
                                            <div
                                                class="flex flex-col mb-3 bg-white border border-gray-300 rounded-md px-8 py-4">

                                                {{-- col --}}
                                                <div
                                                    class="flex justify-start items-center gap-2 border-b border-gray-300 mb-2 pb-2">

                                                    {{-- form_name --}}
                                                    <h5
                                                        class="text-xl font-bold leading-none tracking-tight text-neutral-900">
                                                        <a
                                                            href="{{ route('forms.show', $form->id) }}">{{ $form->form_name }}</a>
                                                    </h5>

                                                    {{-- input method --}}
                                                    <div class="ml-auto">
                                                        <a href="{{ route('forms.inputEdit', $form->id) }}"
                                                            target="_blank"
                                                            class="text-xs rounded border border-gray-300 py-1 px-3"
                                                            target="_blank">入力項目エディターを開く</a>
                                                        <button
                                                            class="text-xs rounded border border-gray-300 py-1 px-3">投稿一覧</button>
                                                        <button
                                                            class="text-xs rounded border bg-red-500 text-white py-1 px-3">PDF一括DL</button>
                                                    </div>

                                                    {{-- dropdown menu --}}
                                                    <div x-data="{
                                                        dropdownOpen: false
                                                    }" class="relative">
                                                        <button @click="dropdownOpen=true"
                                                            class="inline-flex items-center justify-center h-6 px-2 text-sm font-medium transition-colors bg-white rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"><i
                                                                class="at-dots-vertical"></i></button>
                                                        <div x-show="dropdownOpen" @click.away="dropdownOpen=false"
                                                            x-transition:enter="ease-out duration-200"
                                                            x-transition:enter-start="-translate-y-2"
                                                            x-transition:enter-end="translate-y-0"
                                                            class="absolute top-0 z-50 w-48 mt-10 -translate-x-1/2 left-1/2"
                                                            x-cloak>
                                                            <div
                                                                class="p-1 text-sm bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
                                                                <a href="{{ route('forms.show', $form->id) }}"
                                                                    @click="menuBarOpen=false"
                                                                    class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                                                    <span>フォームの詳細</span>
                                                                </a>
                                                                <a href="{{ route('forms.edit', $form->id) }}"
                                                                    @click="menuBarOpen=false"
                                                                    class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                                                    <span>フォームを編集</span>
                                                                </a>
                                                                <form
                                                                    action="{{ route('forms.duplicate', $form->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit" @click="menuBarOpen=false"
                                                                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                                                        <span>フォームを複製</span>
                                                                    </button>
                                                                </form>
                                                                <div x-data="{ modalOpen: false }"
                                                                    @keydown.escape.window="modalOpen = false"
                                                                    class="relative z-50 w-auto h-auto">
                                                                    <button @click="modalOpen=true"
                                                                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none text-red-500">フォームを削除</button>
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
                                                                            <div x-show="modalOpen"
                                                                                x-trap.inert.noscroll="modalOpen"
                                                                                x-transition:enter="ease-out duration-300"
                                                                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                                                x-transition:leave="ease-in duration-200"
                                                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                                class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">

                                                                                <div
                                                                                    class="flex items-center justify-between pb-2">
                                                                                    <h3 class="text-lg font-semibold">
                                                                                        フォームを削除
                                                                                    </h3>
                                                                                    <button @click="modalOpen=false"
                                                                                        class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                                        <svg class="w-5 h-5"
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke-width="1.5"
                                                                                            stroke="currentColor">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="M6 18L18 6M6 6l12 12" />
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="relative w-auto mb-4">
                                                                                    <p>本当に削除してもよろしいですか？</p>
                                                                                    <p class="text-sm text-red-500">
                                                                                        ※この操作は取り消せません
                                                                                    </p>
                                                                                </div>
                                                                                <div class="flex">
                                                                                    <form class="ml-auto"
                                                                                        action="{{ route('forms.destroy', $form->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">
                                                                                            フォームを削除
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </template>
                                                                </div>
                                                                <div x-data="{ modalOpen: false }"
                                                                    @keydown.escape.window="modalOpen = false"
                                                                    class="relative z-50 w-auto h-auto">
                                                                    <button @click="modalOpen=true"
                                                                        class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none text-red-500">すべてのフォームを削除</button>
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
                                                                            <div x-show="modalOpen"
                                                                                x-trap.inert.noscroll="modalOpen"
                                                                                x-transition:enter="ease-out duration-300"
                                                                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                                                x-transition:leave="ease-in duration-200"
                                                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                                                class="relative w-full py-6 bg-white px-7 sm:max-w-lg sm:rounded-lg">

                                                                                <div
                                                                                    class="flex items-center justify-between pb-2">
                                                                                    <h3 class="text-lg font-semibold">
                                                                                        すべてのフォームを削除
                                                                                    </h3>
                                                                                    <button @click="modalOpen=false"
                                                                                        class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                                        <svg class="w-5 h-5"
                                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke-width="1.5"
                                                                                            stroke="currentColor">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="M6 18L18 6M6 6l12 12" />
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="relative w-auto mb-4">
                                                                                    <p>本当に削除してもよろしいですか？</p>
                                                                                    <p class="text-sm text-red-500">
                                                                                        ※この操作は取り消せません
                                                                                    </p>
                                                                                </div>
                                                                                <div class="flex">
                                                                                    <form class="ml-auto"
                                                                                        action="{{ route('forms.destroyAll', $form->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <button type="submit"
                                                                                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-700 focus:shadow-outline focus:outline-none">
                                                                                            すべてのフォームを削除
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

                                                {{-- col --}}
                                                <div class="flex items-center justify-start">

                                                    {{-- project_name --}}
                                                    <div class="flex gap-4">
                                                        <p class="text-xs text-gray-400">
                                                            {{ $project->project_name }}
                                                        </p>

                                                        <p class="text-xs text-gray-400">
                                                            入力項目：
                                                            <span class="text-gray-600">
                                                                @if ($form->input)
                                                                    入力済
                                                                @else
                                                                    無し
                                                                @endif
                                                            </span>
                                                        </p>
                                                    </div>

                                                    {{-- created --}}
                                                    <div class="flex gap-4 ml-auto">
                                                        <p class="text-xs text-gray-400">
                                                            作成日：{{ $form->created_at }}
                                                        </p>
                                                        <p class="text-xs text-gray-400">
                                                            更新日：{{ $form->updated_at }}
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative"
                                x-cloak>
                                {{-- mail --}}
                                <div class="mb-8">
                                    <h4 class="text-md font-bold mb-2 text-gray-500">返信メール情報</h4>
                                    <div class="bg-white border border-neutral-300 rounded-md p-8">
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
                                </div>
                            </div>

                            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative"
                                x-cloak>
                                {{-- users --}}
                                <div class="mb-2">
                                    <h4 class="text-md font-bold mb-2 text-gray-500">ユーザー情報</h4>
                                    <div class="bg-white border border-neutral-300 rounded-md p-8">
                                        <p>アカウント登録した人の情報をテーブルで表示する</p>
                                    </div>
                                </div>
                            </div>

                            <div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" class="relative"
                                x-cloak>
                                {{-- description --}}
                                <div class="mb-8">
                                    <h4 class="text-md font-bold mb-2 text-gray-500">プロジェクトの説明（ユーザーページに表示されます）</h4>
                                    <div class="bg-white border border-neutral-300 rounded-md mb-8 p-8">

                                        {{-- project message --}}
                                        <div class="mb-8">
                                            <p class="text-sm text-gray-400 mb-2">内容情報</p>
                                            <div class="documentstyle">{!! $project->project_message !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- created / modified --}}
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

    {{-- </div> --}}
</body>

</html>
