<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    @include('components.navbarTienda')
    <main class="main" style="margin-top: 92px;">
        @livewire('catalogo-tienda')
    </main>
    @include('components.footer')
    @livewireScripts
</body>

</html>
