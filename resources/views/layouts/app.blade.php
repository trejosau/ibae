<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IBA&E')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
