@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenido, {{ $user->username }}!</h1>
            </div>
        </div>
@endsection
