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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div id="app">

        <div class="min-h-screen bg-gray-100">
            <div class="max-w-7xl mx-auto p-8">

                {{-- vue component --}}
                <input-component :form-attribute='@json($form)'
                    :input-attribute='@json($input)'></input-component>

            </div>
            <!-- ボトム -->
            <div class="fixed bottom-0 w-full border-t border-gray-300 bg-white">
                <div class="max-w-7xl mx-auto flex justify-end py-4 px-8">
                    <button type="button" class="rounded text-md text-white bg-gray-700 font-bold px-4 py-1">
                        更新する
                    </button>
                </div>
            </div>
        </div>

    </div>
</body>
