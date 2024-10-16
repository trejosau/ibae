<!-- resources/views/dashboard/index.blade.php -->

@extends('layouts.app')


@section('content')

    @switch(Route::currentRouteName())
        @case('dashboard.inicio')
            @include('dashboard.inicio')
            @break

        @case('dashboard.ventas')
            @include('dashboard.ventas')
            @break

        @case('dashboard.academia')
            @include('dashboard.academia')
            @break

        @case('dashboard.salon')
            @include('dashboard.salon')
            @break

        @case('dashboard.tienda')
            @include('dashboard.tienda')
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

@endsection
