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
                        <h4 class="font-bold text-lg mb-1">確認画面</h4>
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
                            <div class="border rounded p-3">{{ $project['project_name'] }}</div>
                        </div>

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-lg font-bold" for="#">プロジェクトの説明</label>
                            </div>
                            <div class="border rounded p-3 text-sm">
                                @if (!$project['description'])
                                    <span class="text-gray-400">なし</span>
                                @else
                                    {!! $project['description'] !!}
                                @endif
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-lg font-bold" for="#">公開期限</label>
                            </div>
                            <div class="border rounded p-3">
                                @if (!$project['is_deadline'])
                                    <span class="text-gray-400">指定しない</span>
                                @else
                                    {{ $project['is_deadline'] }}
                                @endif
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-lg font-bold" for="#">返信メールの件名</label>
                            </div>
                            <div class="border rounded p-3">
                                @if (!$project['mail_subject'])
                                    <span class="text-gray-400">なし</span>
                                @else
                                    {{ $project['mail_subject'] }}
                                @endif
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="mb-2">
                                <label class="text-lg font-bold" for="#">返信メールの本文</label>
                            </div>
                            <div class="border rounded p-3 text-sm">
                                @if (!$project['mail_content'])
                                    <span class="text-gray-400">なし</span>
                                @else
                                    {!! $project['mail_content'] !!}
                                @endif
                            </div>
                        </div>

                        <div class="mt-8">
                            <p class="text-sm text-center mb-4 text-gray-500">この内容で新規登録します。よろしいですか？</p>

                            <form action="{{ route('projects.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="project_name" value="{{ $project['project_name'] }}">
                                <input type="hidden" name="description" value="{{ $project['description'] }}">
                                <input type="hidden" name="is_deadline" value="{{ $project['is_deadline'] }}">
                                <input type="hidden" name="mail_subject" value="{{ $project['mail_subject'] }}">
                                <input type="hidden" name="mail_content" value="{{ $project['mail_content'] }}">
                                <button type="submit"
                                    class="flex items-center justify-center w-96 px-4 py-2 text-sm mx-auto font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                                    新規作成する
                                </button>
                        </div>
                        </form>
                    </div>

                </div>
            </main>
        </div>
    </div>


</body>

</html>
