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
    <div class="min-h-screen bg-gray-100">
        {{-- @include('layouts.navigation') --}}

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
                        <h4 class="font-bold text-lg mb-1">フォームの詳細</h4>
                        <p class="text-gray-500 text-sm">フォームの詳細画面です。確認、編集、削除ができます</p>
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

                    {{-- form name / form_description / controll --}}
                    <div class="flex mb-8">

                        {{-- form name / form_description --}}
                        <div class="">
                            {{-- form name --}}
                            <div>
                                <p class="text-sm text-gray-400 mb-2">フォーム名</p>
                                <h5 class="text-2xl font-bold leading-none text-neutral-900 mb-2">
                                    {{ $form->form_name }}
                                </h5>
                            </div>

                            {{-- description --}}
                            <div>
                                @if (!$form->form_description)
                                    <span class="text-md text-gray-400">なし</span>
                                @else
                                    <div class="text-md text-gray-600">{!! $form->form_description !!}</div>
                                @endif
                            </div>
                        </div>

                        {{-- controll form --}}
                        <div class="ml-auto">
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
                                        <a a href="{{ route('forms.edit', $form->id) }}" @click="menuBarOpen=false"
                                            class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                                            <span>フォームを編集</span>
                                        </a>

                                        {{-- delete --}}
                                        <div x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
                                            class="relative z-50 w-auto h-auto">
                                            <button @click="modalOpen=true"
                                                class="relative flex justify-between w-full cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 hover:text-neutral-900 outline-none data-[disabled]:opacity-50 data-[disabled]:pointer-events-none text-red-500">フォームを削除</button>
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
                                                            <h3 class="text-lg font-semibold">フォームを削除</h3>
                                                            <button @click="modalOpen=false"
                                                                class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke="currentColor">
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
                                                            <form class="ml-auto" action="#" method="POST">
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

                    </div>

                    {{-- controller buttons --}}
                    <div class="mb-8">

                    </div>

                    {{-- input details --}}
                    <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                        入力項目が入る予定
                    </div>

                    {{-- created / modified --}}
                    <div>
                        <span class="text-xs text-gray-400 pr-4">
                            フォーム作成日：
                            @if (!$form->created_at)
                                <span class="text-gray-700">無し</span>
                            @else
                                <span class="text-gray-700">
                                    {{ $form->created_at }}
                                </span>
                            @endif
                        </span>
                        <span class="text-xs text-gray-400 pr-4">
                            フォーム更新日：
                            @if (!$form->updated_at)
                                <span class="text-gray-700">無し</span>
                            @else
                                <span class="text-gray-700">
                                    {{ $form->updated_at }}
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
