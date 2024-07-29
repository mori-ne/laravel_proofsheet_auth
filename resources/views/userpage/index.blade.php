<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'UserPage') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css">
    <link rel="stylesheet" href="{{ asset('css/documentstyle.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div id="app">

        <div class="min-h-screen bg-gray-100">

            <div class="bg-white border-b border-gray-300 py-4 px-8">
                <div class="max-w-6xl mx-auto">
                    <h1 class="text-2xl font-bold">{{ $project->project_name }}</h1>
                </div>
            </div>

            <div class="max-w-6xl mx-auto py-8 flex flex-row gap-4 justify-center">
                <div class="w-full">
                    <div class="documentstyle h-full border border-gray-300 rounded p-6 bg-white">
                        {!! $project->project_message !!}
                    </div>
                </div>
                <div class="w-96 shrink-0">

                    {{-- registerd user --}}
                    <div class="border border-gray-300 rounded p-6 bg-white mb-4">
                        <h3 class="bg-gray-100 py-1 px-2 border-l-4 border-orange-500 text-lg font-bold mb-6">
                            登録済の方はこちらから
                        </h3>
                        <form action="#">
                            <div class="mb-8">
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm" for="email">メールアドレス</label>
                                    <input class="border border-gray-300 rounded w-full" type="text" value=""
                                        placeholder="メールアドレス">
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm" for="password">パスワード</label>
                                    <input class="border border-gray-300 rounded w-full" type="password" value=""
                                        placeholder="パスワード">
                                </div>
                            </div>
                            <div class="mb-4">
                                <button class="rounded bg-orange-500 text-white w-full py-2 font-bold"
                                    type="submit">ログイン</button>
                            </div>
                            <p class="text-center text-sm text-orange-700">
                                <a class="underline" href="#">※パスワードをお忘れの方</a>
                            </p>
                        </form>
                    </div>

                    {{-- new user --}}
                    <div class="border border-gray-300 rounded p-6 bg-white">
                        <h3 class="bg-gray-100 py-1 px-2 border-l-4 border-orange-500 text-lg font-bold mb-6">
                            初めてのかたはこちらから
                        </h3>
                        <div class="mb-4">
                            <button class="rounded bg-orange-500 text-white w-full py-2 font-bold"
                                type="submit">新規登録</button>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p class="text-center text-gray-400 text-sm py-2">
                    Powered by Proofsheet
                </p>
            </div>
        </div>

    </div>
</body>


</html>
