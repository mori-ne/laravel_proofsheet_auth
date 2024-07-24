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

                <div class="p-6 max-w-4xl mx-auto">

                    <div class="mb-8">
                        <h4 class="font-bold text-md mb-1">プロジェクトの編集</h4>
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
                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- 公開設定・公開期限 --}}
                        <h4 class="text-md font-bold mb-2 text-gray-500">公開情報</h4>
                        <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                            <div class="flex flex-row items-center gap-2">
                                {{-- 公開設定 --}}
                                <div class="mr-4">
                                    <label class="text-md font-bold">公開設定</label>
                                    <select name="status" class="ml-4 border-gray-300 rounded-md">
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
                                    <label class="text-md font-bold">公開期限</label>
                                    <input name="is_deadline" class="ml-4 border-gray-300 rounded-md"
                                        type="datetime-local" value="{{ old('is_deadline', $project->is_deadline) }}">
                                </div>

                            </div>
                        </div>

                        {{-- プロジェクト名・プロジェクトの説明 --}}
                        <h4 class="text-md font-bold mb-2 text-gray-500">プロジェクト概要</h4>
                        <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                            {{-- プロジェクト名 --}}
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-md font-bold">
                                        プロジェクト名
                                    </label>
                                    <span
                                        class="bg-red-600 text-white relative text-xs font-semibold pl-2 pr-2.5 py-0.5 rounded-full">
                                        <span>必須</span>
                                    </span>
                                </div>
                                <input name="project_name" type="text" placeholder="プロジェクト名を記入してください"
                                    value="{{ old('project_name', $project->project_name) }}"
                                    class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                @error('project_name')
                                    <div class="mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- プロジェクトの説明 --}}
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-md font-bold">プロジェクトの説明</label>
                                </div>
                                <textarea id="projectinstance" name="project_description" type="text" placeholder="プロジェクトの説明を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{{ old('project_description', $project->project_description) }}</textarea>
                            </div>
                        </div>

                        {{-- プロジェクトの期間情報・プロジェクトの内容情報 --}}
                        <h4 class="text-md font-bold mb-2 text-gray-500">プロジェクト情報</h4>
                        <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                            {{-- 期間情報 --}}
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-md font-bold">
                                        期間情報
                                    </label>
                                </div>
                                <input name="project_date" type="text" placeholder="プロジェクト名を記入してください"
                                    value="{{ old('project_date', $project->project_date) }}"
                                    class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                @error('project_date')
                                    <div class="mt-2 text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- 内容情報 --}}
                            <div class="mb-6">
                                <div class="mb-2">
                                    <label class="text-md font-bold">内容情報</label>
                                </div>
                                <textarea id="projectinstance" name="project_message" type="text" placeholder="プロジェクトの説明を記入してください"
                                    class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{{ old('project_message', $project->project_message) }}</textarea>
                            </div>
                        </div>

                        {{-- 返信メールの件名・本文 --}}
                        <h4 class="text-md font-bold mb-2 text-gray-500">返信メール情報</h4>
                        <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                            <div>
                                <div class="mb-6">
                                    <div class="mb-2">
                                        <label class="text-md font-bold">返信メールの件名</label>
                                    </div>
                                    <input name="mail_subject" type="text" placeholder="メールの件名を記入してください"
                                        value="{{ old('mail_subject', $project->mail_subject) }}"
                                        class="flex w-full h-10 px-3 py-2 text-md bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" />
                                </div>
                                <div class="mb-6">
                                    <div class="mb-2">
                                        <label class="text-md font-bold">返信メールの本文</label>
                                    </div>
                                    <textarea id="projectinstance" name="mail_content" type="text" placeholder="メールの返信内容を記入してください"
                                        class="flex w-full h-48 min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">{!! old('mail_content', $project->mail_content) !!}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-neutral-300 rounded-md mb-3 p-8">
                            <button type="submit"
                                class="flex items-center justify-center w-96 px-4 py-2 text-sm mx-auto font-medium tracking-wide text-white transition-colors duration-200 rounded-md bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">更新する</button>
                        </div>
                    </form>

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
