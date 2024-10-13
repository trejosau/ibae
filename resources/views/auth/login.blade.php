@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title text-center">Iniciar Sesión</h5>

                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Iniciar Sesión</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('register') }}">¿No tienes una cuenta? Regístrate aquí</a>
                </div>
            </div>
        </div>
    </div>
@endsection
