@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title text-center">Registro</h5>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Registrar</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia sesión aquí</a>
                </div>
            </div>
        </div>
    </div>
@endsection
