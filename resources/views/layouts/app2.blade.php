<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('fonts/nunito.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        * {
            font-family: 'Nunito Sans', sans-serif;
        }

        :root {
            --shadowDark: #D9DDE6;
            --background: #E4E9F2;
            --shadowLight: #EFF5FE;
        }

        body {
            background: var(--background);
        }

        .hero-body,.hero-head {
            justify-content: center;
            /* background-color: #FFFFFF; */
        }

        .login {
            border-radius: 25px;
            padding: 1.5rem;
            box-shadow: 8px 8px 15px var(--shadowDark), -8px -8px 15px var(--shadowLight);
        }

        input {
            background: var(--shadowDark) !important;
        }

        a {
            font-weight: 600;
        }
        body {
            background-image: url("{{url('/images/wallpaperv2.png')}}");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
@yield('content')
</body>
@yield('javascript')
</html>
