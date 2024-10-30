@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Mostrar la imagen principal del producto -->
            @if($producto->main_photo)
                <img src="{{ asset($producto->main_photo) }}" alt="{{ $producto->nombre }}" class="img-fluid rounded shadow mb-4">
            @else
                <div class="alert alert-warning">Imagen no disponible</div>
            @endif
        </div>

        <div class="col-md-6">
            <h2 class="mb-3">{{ $producto->nombre }}</h2>
            <p class="text-muted mb-4">{{ $producto->descripcion }}</p>
            <h4 class="mb-4">Precio: ${{ number_format($producto->precio_venta, 2) }}</h4>


                <button type="submit" class="btn btn-primary btn-lg">Agregar al carrito</button>
        </div>
    </div>

    <hr class="my-4">

    <h3 class="mb-4">Productos Relacionados</h3>
    <div class="row">
        @foreach($productosRelacionados as $productoRelacionado)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    @if($productoRelacionado->main_photo)
                        <img src="{{ asset($productoRelacionado->main_photo) }}" alt="{{ $productoRelacionado->nombre }}" class="card-img-top">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background-color: #f8f9fa;">
                            <p class="text-muted">Imagen no disponible</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ $productoRelacionado->nombre }}</h5>
                        <p class="card-text mb-4">Precio: ${{ number_format($productoRelacionado->precio_venta, 2) }}</p>
                        <a href="{{ route('producto.detalle', $productoRelacionado->id) }}" class="btn btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection