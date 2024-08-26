<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
        @yield('title') | Proofsheet with Laravel
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/@vectopus/atlas-icons/style.css" />
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('css/documentstyle.css') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- tinyMCE Laravel --}}
    <script src="https://cdn.tiny.cloud/1/9vs0qfvaptabc555wnnfa7azwz22jq0pykxs1j8x8t1pcb0i/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            language: 'ja',
            icons: 'thin',
            statusbar: false,
            menubar: false,
            selector: 'textarea#projectinstance', // このCSSセレクターをTinyMCEのプレースホルダー要素と一致するように置き換えます。
            plugins: 'code lists',
            toolbar: 'blocks bold italic underline strikethrough forecolor removeformat | emoticons link image table | numlist bullist | code',
        });
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-neutral-50">
        <div class="flex min-h-screen flex-row items-stretch">

            {{-- flash message --}}
            @if (session('status'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)">
                    <div class="fixed left-0 top-0 z-50 w-full border-b border-green-200 bg-green-100 p-4 text-green-600" x-show="show" x-transition:leave="transform ease-in duration-1000" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-10"
                        style="transition: all 1s ease;">
                        <div class="[&>svg]:text-foreground relative mx-auto max-w-6xl [&:has(svg)]:pl-4 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-0 [&>svg]:top-0">
                            <svg class="h-5 w-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h5 class="pl-2 leading-none tracking-tight">{{ session('status') }}</h5>
                        </div>
                    </div>
                </div>
            @endif

            {{-- content --}}
            @yield('content')

        </div>
    </div>
</body>

</html>
