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
                        <h4 class="font-bold text-lg mb-1">フォームを作成</h4>
                        <p class="text-gray-500 text-sm"></p>
                    </div>

                    {{-- breadcrumb --}}
                    <div class="mx-auto mb-4 border-neutral-300 ">
                        <div class="flex gap-1 items-center">
                            <i class="at-arrow-left-circle"></i>
                            <a href="javascript:history.back()">戻る</a>
                        </div>
                    </div>

                    {{-- content --}}
                    <div class="mx-auto bg-white border border-neutral-300 rounded-md p-8 mb-3">

                        <form action="#" method="POST">
                            @csrf

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">
                                        プロジェクトを選択
                                    </label>
                                    <span
                                        class="bg-red-600 text-white relative text-xs font-semibold pl-2 pr-2.5 py-0.5 rounded-full">
                                        <span>必須</span>
                                    </span>
                                    <p class="text-xs text-gray-500">作成するプロジェクトを選択してください</p>
                                </div>

                                <select name="selectProject" id="selectProject"
                                    class="py-3 px-4 pe-9 block w-full border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                                    <option value="null">設定しない</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->project_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">
                                        フォーム名
                                    </label>
                                    <span
                                        class="bg-red-600 text-white relative text-xs font-semibold pl-2 pr-2.5 py-0.5 rounded-full">
                                        <span>必須</span>
                                    </span>
                                </div>
                                <input type="text" placeholder="フォーム名を記入してください"
                                    class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">フォームの説明</label>
                                    <p class="text-gray-500 text-xs mb-2">記事投稿画面にも表示されます</p>
                                </div>
                                <textarea type="text" placeholder="フォームの説明を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                            </div>

                            <hr class="my-8">

                            <div class="mt-8">
                                <button type="submit"
                                    class="flex items-center justify-center w-96 px-4 py-2 text-sm mx-auto font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">新規作成する</button>
                            </div>
                        </form>
                    </div>

                </div>
            </main>
        </div>
    </div>


</body>

</html>
