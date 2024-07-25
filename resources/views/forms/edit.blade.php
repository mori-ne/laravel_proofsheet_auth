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

    {{-- tinyMCE --}}
    <x-head.tinymce-config />

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

            <main class="w-full">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>

                <div class="p-6 max-w-4xl mx-auto">

                    {{-- title --}}
                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">フォームの編集</h4>
                        <p class="text-gray-500 text-sm"></p>
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

                    {{-- content --}}
                    <form action="{{ route('forms.update', $form->id) }}" method="POST">
                        @method('PUT')
                        @csrf

                        <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">


                            {{-- select project --}}
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">プロジェクトを選択</label>
                                    <span
                                        class="bg-red-600 text-white relative text-xs font-semibold pl-2 pr-2.5 py-0.5 rounded-full">
                                        <span>必須</span>
                                    </span>
                                </div>
                                <select name="project_id" id="project_id" class="border rounded border-gray-300">
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            @if ($form->project_id === $project->id) selected @endif>
                                            {{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- form name --}}
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="form_name">フォーム名</label>
                                    <span
                                        class="bg-red-600 text-white relative text-xs font-semibold pl-2 pr-2.5 py-0.5 rounded-full">
                                        <span>必須</span>
                                    </span>
                                </div>
                                <input name="form_name" type="text" placeholder="フォーム名を記入してください"
                                    value="{{ old('form_name', $form->form_name) }}"
                                    class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                @error('form_name')
                                    <div class="mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- フォームの説明 --}}
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="form_description">フォームの説明</label>
                                </div>
                                <textarea id="projectinstance" name="form_description" type="text" placeholder="フォームの説明を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{{ old('form_description', $form->form_description) }}</textarea>
                            </div>
                        </div>


                        {{-- submit --}}
                        <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                            <button type="submit"
                                class="flex items-center justify-center w-96 px-4 py-2 text-sm mx-auto font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">フォームを更新する</button>
                        </div>
                    </form>

                    {{-- created_at / updated_at --}}
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
