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
                                <a class="block text-gray-500" href="{{ route('projects.index') }}">プロジェクト管理</a>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="flex items-center gap-3">
                                <i class="at-plus-clipboard-bold"></i>
                                <a class="block text-gray-500" href="{{ route('forms.index') }}">フォーム管理</a>
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


                <div class="p-6 max-w-4xl mx-auto">

                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">プロジェクトを新規作成</h4>
                        <p class="text-gray-500 text-sm"></p>
                    </div>

                    {{-- breadcrumb --}}
                    <div class="mb-2 border-neutral-300 ">
                        <a href="{{ url()->previous() }}">戻る</a>
                    </div>

                    {{-- content --}}
                    <div class="bg-white border border-neutral-300 rounded-md p-8 mb-3">

                        <form action="{{ route('projects.confirm') }}" method="POST">
                            @csrf

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
                                    class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">プロジェクトの説明</label>
                                </div>
                                <textarea name="description" type="text" placeholder="プロジェクトの説明を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                            </div>

                            <hr class="my-8">

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">公開期限</label>
                                    <input name="is_deadline" class="ml-4 border-gray-300 rounded-md" type="date"
                                        value="2024-01-01">
                                </div>

                            </div>

                            <hr class="my-8">

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">返信メールの件名</label>
                                </div>
                                <input name="mail_subject" type="text" placeholder="メールの件名を記入してください"
                                    class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">返信メールの本文</label>
                                </div>
                                <textarea name="mail_content" type="text" placeholder="メールの返信内容を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                            </div>

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

    @livewireScripts
</body>

</html>
