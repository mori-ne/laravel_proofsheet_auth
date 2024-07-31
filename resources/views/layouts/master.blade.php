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
    <div class="min-h-screen bg-gray-100">
        <div class="flex min-h-screen flex-row items-stretch">
            {{-- sidebar --}}
            @include('layouts.sidebar')
            {{-- content --}}
            @yield('content')
        </div>
    </div>
</body>

</html>
