<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'postuser') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css">
    <link rel="stylesheet" href="{{ asset('css/documentstyle.css') }}">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div id="app">

        <div class="min-h-screen bg-gray-100">

            <div class="border-b border-gray-300 bg-white px-8 py-4">
                <div class="mx-auto max-w-6xl">
                    <h1 class="text-xl font-bold">{{ $project->project_name }}</h1>
                </div>
            </div>

            <div class="mx-auto flex max-w-6xl flex-col justify-center gap-4 py-8">
                <div class="w-full px-8">
                    <p>
                        {{ Auth::guard('postuser')->user()->name }} さん
                    </p>
                    <form action="{{ route('postuser.logout', ['uuid' => $project->uuid]) }}" method="POST">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </div>
            </div>
            <div class="mx-auto flex max-w-6xl flex-col justify-center gap-4 py-8">

                <div class="w-full px-8">
                    <div class="h-full rounded border border-gray-300 bg-white p-6">
                        @foreach ($project->forms as $form)
                            <div class="mb-4 flex flex-row gap-4 border-b border-gray-300 pb-2">
                                {{-- 1 --}}
                                <p class="text-md text-gray-400">{{ $form->id }}</p>
                                {{-- 2 --}}
                                <div class="flex flex-col">
                                    <p class="text-lg font-bold">{{ $form->form_name }}</p>
                                    <p class="text-sm">{{ $form->form_description }}</p>
                                </div>
                                {{-- 3 --}}
                                <div class="ml-auto flex flex-row gap-2">
                                    <button class="h-8 rounded-md border px-2 py-1" type="submit">投稿する</button>
                                    <button class="h-8 rounded-md border px-2 py-1" type="submit">編集する</button>
                                    <button class="h-8 rounded-md border px-2 py-1" type="submit">削除</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>



            </div>
        </div>
    </div>
</body>

</html>

{{ dd($project->forms) }}
