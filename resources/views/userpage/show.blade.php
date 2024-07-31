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

            <div class="border-b border-gray-300 bg-white px-8 py-4">
                <div class="mx-auto max-w-6xl">
                    <h1 class="text-2xl font-bold">#</h1>
                </div>
            </div>

            <div class="mx-auto flex max-w-6xl flex-row justify-center gap-4 py-8">
                <div class="w-full">
                    <div class="documentstyle h-full rounded border border-gray-300 bg-white p-6">
                        #
                    </div>
                </div>
                <div class="w-96 shrink-0">

                    {{-- registerd user --}}
                    <div class="mb-4 rounded border border-gray-300 bg-white p-6">
                        <h3 class="mb-6 border-l-4 border-orange-500 bg-gray-100 px-2 py-1 text-lg font-bold">
                            登録済の方はこちらから
                        </h3>
                        <form action="#">
                            <div class="mb-8">
                                <div class="mb-4">
                                    <label class="mb-1 block text-sm" for="email">メールアドレス</label>
                                    <input class="w-full rounded border border-gray-300" type="text" value="" placeholder="メールアドレス">
                                </div>
                                <div class="mb-4">
                                    <label class="mb-1 block text-sm" for="password">パスワード</label>
                                    <input class="w-full rounded border border-gray-300" type="password" value="" placeholder="パスワード">
                                </div>
                            </div>
                            <div class="mb-4">
                                <button class="w-full rounded bg-orange-500 py-2 font-bold text-white" type="submit">ログイン</button>
                            </div>
                            <p class="text-center text-sm text-orange-700">
                                <a class="underline" href="#">※パスワードをお忘れの方</a>
                            </p>
                        </form>
                    </div>

                    {{-- new user --}}
                    <div class="rounded border border-gray-300 bg-white p-6">
                        <h3 class="mb-6 border-l-4 border-orange-500 bg-gray-100 px-2 py-1 text-lg font-bold">
                            初めてのかたはこちらから
                        </h3>
                        <div class="mb-4">
                            <button class="w-full rounded bg-orange-500 py-2 font-bold text-white" type="submit">新規登録</button>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p class="py-2 text-center text-sm text-gray-400">
                    Powered by Proofsheet
                </p>
            </div>
        </div>

    </div>
</body>


</html>
