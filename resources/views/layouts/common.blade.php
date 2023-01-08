<!DOCTYPE html>
<html lang="{{ str_replace('', '', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- CSFR TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- APP NAME --}}
    <title> {{ config('app.name', 'Laratto')}} </title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/release/v5.6.3/css/all.css">

    {{-- Styles --}}
    <link rel="stylesheet" href=" {{ asset('css/app.css') }} ">

    {{-- Scripts  --}}
    <script src=" {{ asset('js/app.js')}} " defer></script>
    {{-- Viteの場合は追記 ↓がないとcssが効かない --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <div>
        @yield('header')
    </div>
    <div class="flex">
        <div class="w-1/6">
            @yield('sidebar')
        </div>
        <main class="w-full">
            @yield('content')
        </main>
    </div>
    <div>
        @yield('footer')
    </div>
</body>
</html>
