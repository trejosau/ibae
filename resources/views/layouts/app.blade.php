<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IBA&E')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* --- NAVBAR STYLES --- */
        .navbar {
            background-color: #081444;
            transition: background-color 0.3s, box-shadow 0.3s;
            padding: 10px 0;
            box-shadow: none;
        }

        @media (min-width: 768px) {
            .navbar {
                min-height: 99px;
                max-height: 99px;
            }
        }

        .fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: #081444;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .nav-item a {
            padding: 5px 1rem;
            margin: 0 -.25rem;
            font-size: 27px;
            border: none;
            text-decoration: none;
            border-bottom: 2px solid transparent;
            background-image: linear-gradient(
                to right,
                #e089b2,
                #e089b2 50%,
                #ffffff 50%
            );
            background-size: 200% 100%;
            background-position: -100%;
            display: inline-block;
            position: relative;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.2s ease-in-out;
        }

        .nav-item a:hover {
            background-position: 0;
            border-bottom: 3px solid #e089b2;
        }


        .nav-item .icono {
            color: #ffffff;
            margin-right: 20px;
        }

        .login-button {
            background-color: #ff69b4;
            transition: background-color 0.3s;
            color: white;
            border: none;

        }
    </style>
</head>
<body>
@stack('styles')
@include('components.navbar')

<main class="container">
    @yield('content')

</main>

@if(!request()->routeIs('dashboard'))
@include('components.footer')
    @endif
</body>

@stack('scripts')
</html>
