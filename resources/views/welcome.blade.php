<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Proofsheet with Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/documentstyle.css') }}" />
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-100">
        <div class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <main class="mt-6">

                    <div class="mb-12">
                        <a href="{{ route('welcome') }}">
                            <h1 class="text-center text-3xl font-bold text-gray-600">Proofsheet</h1>
                        </a>
                    </div>

                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-center gap-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="min-w-60 rounded-md bg-white px-3 py-2 text-center text-gray-700 ring-1 ring-transparent transition hover:text-gray-700/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                    管理画面へ
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="min-w-60 rounded-md bg-white px-3 py-2 text-center text-gray-700 ring-1 ring-transparent transition hover:text-gray-700/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                    ログイン
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="min-w-60 rounded-md bg-white px-3 py-2 text-center text-gray-700 ring-1 ring-transparent transition hover:text-gray-700/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                        新規登録
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </main>

                <footer class="py-16 text-center text-sm text-gray-700">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
