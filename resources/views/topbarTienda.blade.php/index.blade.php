<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOPBAR </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>

</style>

<body>
@include('components.sidebar')
<div class="main p-3">
    @switch(Route::currentRouteName())
        @case('topbar.inicio')
            @include('topbar.tintes')
            @break

        @case('dashboard.ventas')
            @include('dashboard.ventas')
            @break

        @case('dashboard.compras')
            @include('dashboard.compras')
            @break

        @case('dashboard.citas')
            @include('dashboard.citas')
            @break

        @case('dashboard.servicios')
            @include('dashboard.servicios')
            @break

        @case('dashboard.productos')
            @include('dashboard.productos')
            @break

        @case('dashboard.reportes')
            @include('dashboard.reportes')
            @break

        @default
            <p>No se encontró el contenido para esta ruta.</p>
    @endswitch
</div>
</div>

</body>

</html>
