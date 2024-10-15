@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">{{ $lugar }}</h1> <!-- Título que mostrará el valor de $lugar -->

        @if ($roles->isNotEmpty())
            <h2>Roles de usuario:</h2>
            <ul>
                @foreach ($roles as $role)
                    <li>{{ $role }}</li>
                @endforeach
            </ul>
        @else
            <p>No tienes roles asignados.</p>
        @endif

        <p>Bienvenido, {{ $user->username }}!</p>
    </div>
@endsection
