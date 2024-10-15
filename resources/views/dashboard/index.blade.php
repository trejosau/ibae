@extends('layouts.app')



@section('content')
    <div class="d-flex">


        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-3 ps-5">

            @if (auth()->user()->roles->isNotEmpty())
                <ul>
                    @foreach (auth()->user()->roles as $role)
                        Hola, {{ auth()->user()->username }}
                        <li>{{ $role->name }}</li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
@endsection
