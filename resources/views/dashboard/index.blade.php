@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bienvenido, {{ $user->username }}!</h1>

        <h2>Roles</h2>
        <ul>
            @foreach($roles as $role)
                <li>{{ $role }}</li>
            @endforeach
        </ul>

    </div>
@endsection
