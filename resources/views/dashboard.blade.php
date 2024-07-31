<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css" />
    <link rel="stylesheet" href="{{ asset('css/documentstyle.css') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    {{-- alpine.jsとvueが競合する --}}
    {{-- <div id="app"> --}}

    <div class="min-h-screen bg-gray-100">
        {{-- @include('layouts.navigation') --}}


        <!-- Page Content -->
        <div class="flex min-h-screen flex-row items-stretch">
            @include('layouts.sidebar')

            <main class="h-svh flex-1 overflow-y-scroll">
                <x-slot name="header">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        {{ __('Dashboard') }}
                    </h2>
                </x-slot>

                <div class="mx-auto max-w-5xl p-6">

                    <div class="mb-8">
                        <h4 class="text-lg font-bold">ダッシュボード</h4>
                        <p class="text-sm text-gray-500"></p>
                    </div>

                    <div class="flex flex-row flex-wrap gap-4">

                        @if (!$projects)
                            <div class="w-full rounded-lg border-2 border-dashed border-gray-300 px-32 py-16 text-center text-sm text-gray-600">
                                まだ何もないです...
                            </div>
                        @endif

                        <div class="w-1/4 rounded-md border bg-white p-8">
                            <p class="mb-2 text-sm text-gray-400">総プロジェクト数</p>
                            <p class="text-4xl">
                                {{ $projects->count() }}
                            </p>
                        </div>

                        <div class="w-1/4 rounded-md border bg-white p-8">
                            <p class="mb-2 text-sm text-gray-400">総フォーム数</p>
                            <p class="text-4xl">
                                {{--  --}}
                            </p>
                        </div>

                        <div class="w-full rounded-md border bg-white p-8">
                            <p class="mb-2 text-sm text-gray-400">最近更新されたプロジェクト</p>
                            @foreach ($recentProjects as $recentProject)
                                <div class="mb-2 flex flex-row items-center gap-4 border-b pb-2 last:mb-0 last:border-b-0 last:pb-0">
                                    <p class="text-sm text-gray-400">
                                        {{ $recentProject->updated_at }}
                                    </p>
                                    <a href="{{ route('projects.show', $recentProject->id) }}" class="text-lg font-bold">
                                        {{ $recentProject->project_name }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- </div> --}}
</body>

</html>
