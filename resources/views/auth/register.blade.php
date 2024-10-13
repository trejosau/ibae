<!-- resources/views/auth/register.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="title">Registro</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" value="prueba_1" required>
                </div>

                <div>
                    <label for="correo">Email</label>
                    <input type="email" name="email" value="prueba_1@prueba.com" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" value="prueba_1" required>
                </div>
                <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" value="prueba_1" required>
                </div>
                <button type="submit">Register</button>
            </form>
    </div>
@endsection
