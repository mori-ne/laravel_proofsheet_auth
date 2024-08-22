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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-neutral-900 antialiased">
    <div class="flex min-h-screen flex-col items-center bg-neutral-50 pt-6 sm:justify-center sm:pt-0">

        {{-- title --}}
        <div class="mb-12">
            <a href="{{ route('welcome') }}">
                <h1 class="text-center text-3xl font-bold text-neutral-600">Proofsheet</h1>
            </a>
        </div>

        <div class="w-96 overflow-hidden rounded-sm border-0 bg-white p-10 shadow-md shadow-neutral-200">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h2 class="mb-6 text-center text-lg font-bold leading-snug text-neutral-700">管理者ログイン</h2>
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" value="メールアドレス" />
                    <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" value="パスワード" />

                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="mt-4 block">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-neutral-300 text-neutral-600 shadow-sm focus:ring-neutral-500" name="remember">
                        <span class="ms-2 text-sm text-neutral-600">ログイン情報を記憶する</span>
                    </label>
                </div>

                {{-- login btn --}}
                <div class="mt-16">
                    <button type='submit'
                        class='mt-4 flex w-full items-center justify-center rounded border border-transparent bg-neutral-800 px-4 py-2 text-sm font-semibold uppercase text-white transition duration-150 ease-in-out hover:bg-neutral-600 focus:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 active:bg-neutral-900'>
                        ログインする
                    </button>
                </div>

                {{-- forget password --}}
                <div class="mt-4 flex items-center justify-center">
                    @if (Route::has('password.request'))
                        <p class="rounded-sm text-xs text-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2">
                            <a class="underline" href="{{ route('password.request') }}">
                                パスワードを忘れてしまった方
                            </a>
                        </p>
                    @endif
                </div>
            </form>
        </div>

        <div class="mt-6">
            <a class="text-xs text-neutral-600 underline" href="{{ route('register') }}">
                はじめての方はこちら
            </a>
        </div>

    </div>
</body>

</html>
