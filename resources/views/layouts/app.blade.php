<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('head')
    @livewireStyles
</head>
<body>
    @include('shared.app_navbar')
    @include('shared.errors')
    <main class="app-main">
        @yield('content')
    </main>
    <footer class="text-center my-5 d-print-none">
        {{ config('app.name') }}
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
    @stack('bottom')
</body>
</html>
