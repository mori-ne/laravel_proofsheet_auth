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

            <main class="flex-1 h-svh overflow-y-scroll">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>


                <div class="p-6 max-w-5xl mx-auto">

                    <div class="mb-8">
                        <h4 class="font-bold text-lg mb-1">プロジェクトを新規作成</h4>
                        <p class="text-gray-500 text-sm"></p>
                    </div>

                    {{-- breadcrumb --}}
                    <div class="mb-4 border-neutral-300 ">
                        <div class="flex gap-1 items-center">
                            <i class="at-arrow-left-circle"></i>
                            <a href="javascript:history.back()">戻る</a>
                        </div>
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
                                    value="{{ old('project_name') }}"
                                    class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                @error('project_name')
                                    <div class="mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">プロジェクトの概要</label>
                                </div>
                                <textarea id="projectinstance" name="project_description" type="text" placeholder="プロジェクトの概要を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{{ old('project_description') }}</textarea>
                                @error('project_description')
                                    <div class="mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-8">

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">公開期限</label>
                                    <input name="is_deadline" class="ml-4 border-gray-300 rounded-md"
                                        type="datetime-local" value="{{ old('is_deadline') }}">
                                </div>
                            </div>

                            <hr class="my-8">

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">プロジェクトの説明</label>
                                </div>
                                <textarea name="project_message" id="projectinstance" type="text" placeholder="プロジェクトの説明を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{{ old('project_message') }}</textarea>
                                @error('project_message')
                                    <div class="mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-8">

                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">返信メールの件名</label>
                                </div>
                                <input name="mail_subject" type="text" placeholder="メールの件名を記入してください"
                                    value="{{ old('mail_subject', '「●●●●●●●●●●●●●●●●●●●●」演題登録 投稿受付通知') }}"
                                    class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                            </div>


                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-lg font-bold" for="#">返信メールの本文</label>
                                </div>
                                <textarea id="projectinstance" name="mail_content" type="text" placeholder="メールの返信内容を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{!! old(
                                        'mail_content',
                                        '<p>■演題登録期間<br>～●●●●年●●月●●日（●●）<br><br>※締め切り直前はホームページへのアクセスが集中しますので、 演題登録に時間がかかることが予想されます。時間に余裕をもってご登録をお願いします。<br>※登録された演題のご修正につきましても上記期間内に行うようお願い致します。<br>（演題募集締切後の、演題の登録・確認・修正・削除の操作は一切できません。）予めご了承ください。<br><br>■字数制限<br>文字数︓●●●●文字</p>',
                                    ) !!}</textarea>
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


</body>

</html>
