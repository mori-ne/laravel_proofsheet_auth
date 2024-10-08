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

        <div class="w-96 overflow-hidden rounded-md border-0 bg-white p-10 shadow-lg shadow-neutral-200">
            <h2 class="mb-6 text-center text-lg font-bold leading-snug text-neutral-700">メール認証</h2>

            <div class="mb-4 text-sm text-neutral-600">
                メールアドレス確認のリンクを送付しました。<br>
                記載されたURLをクリックして認証してください。
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type='submit'
                        class='mt-4 flex w-full items-center justify-center rounded border border-transparent bg-neutral-800 px-4 py-2 text-sm font-semibold uppercase text-white transition duration-150 ease-in-out hover:bg-neutral-600 focus:bg-neutral-600 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 active:bg-neutral-900'>
                        確認メールを再送信する
                    </button>
                </form>

            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="mt-6 rounded-md text-sm text-neutral-600 underline hover:text-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</body>

</html>
