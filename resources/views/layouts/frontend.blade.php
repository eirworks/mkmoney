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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand site-title" href="{{ route('home') }}">{{ config('app.name') }}</a>
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('auth::login') }}" class="nav-link fw-bold text-white">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('auth::register') }}" class="nav-link text-white">Daftar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    @include('shared.errors')
    <main>
        @yield('content')
    </main>
    <footer class="text-center my-5">
        &copy; {{ config('app.name') }}
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('bottom')
</body>
</html>
