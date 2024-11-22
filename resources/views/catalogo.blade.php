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
    <div>
        @livewire('catalogotienda')
    </div>
    @include('components.footer')
    @livewireScripts
</body>

</html>
