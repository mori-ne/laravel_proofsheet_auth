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

        <div class="w-96 overflow-hidden rounded-md border border-neutral-300 bg-white p-10">
            <div class="mb-4 text-sm text-neutral-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mb-6 mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button type='submit'
                    class='mt-4 flex w-full items-center justify-center rounded border border-transparent bg-neutral-800 px-4 py-2 text-sm font-semibold uppercase text-white transition duration-150 ease-in-out hover:bg-neutral-600 focus:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-neutral-900'>
                    パスワードリセットメールを送信
                </button>
            </form>
        </div>
        <p class="mt-6 flex justify-center text-xs text-neutral-600">
            <a class="underline" href="javascript:history.back()">
                前のページへ戻る
            </a>
        </p>
    </div>
</body>

</html>
