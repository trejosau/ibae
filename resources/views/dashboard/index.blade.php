<!-- resources/views/dashboard/index.blade.php -->

@extends('layouts.app')

@section('content')

    @switch(Route::currentRouteName())
        @case('dashboard.inicio')
            @include('dashboard.inicio')  <!-- Archivo: resources/views/dashboard/inicio.blade.php -->
            @break

        @case('dashboard.ventas')
            @include('dashboard.ventas')  <!-- Archivo: resources/views/dashboard/ventas.blade.php -->
            @break

        @case('dashboard.academia')
            @include('dashboard.academia')  <!-- Archivo: resources/views/dashboard/academia.blade.php -->
            @break

        @case('dashboard.salon')
            @include('dashboard.salon')  <!-- Archivo: resources/views/dashboard/salon.blade.php -->
            @break

        @case('dashboard.tienda')
            @include('dashboard.tienda')  <!-- Archivo: resources/views/dashboard/tienda.blade.php -->
            @break

        @case('dashboard.productos')
            @include('dashboard.productos')  <!-- Archivo: resources/views/dashboard/productos.blade.php -->
            @break

        @case('dashboard.reportes')
            @include('dashboard.reportes')  <!-- Archivo: resources/views/dashboard/reportes.blade.php -->
            @break

        @default
            <p>No se encontró el contenido para esta ruta.</p>
    @endswitch

@endsection
