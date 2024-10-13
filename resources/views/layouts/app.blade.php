<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('components.navbar') <!-- Incluyendo el componente de la barra de navegación -->

<section class="section " style="margin-top: 97px;">
    <div class="container">
        @yield('content')
    </div>
</section>

@include('components.footer') <!-- Incluyendo el componente del pie de página -->

@livewireScripts
</body>
</html>
