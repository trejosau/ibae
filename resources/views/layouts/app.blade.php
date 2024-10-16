<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @stack('styles')
    </style>
</head>
<body>
@include('components.navbar')

<main>
    @yield('content')

</main>

@if(!request()->routeIs('dashboard'))
@include('components.footer')
    @endif
</body>
<script>
    @stack('scripts')
</script>
</html>
