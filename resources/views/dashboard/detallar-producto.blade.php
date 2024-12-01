<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de Productos de Belleza y Barbería</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Scrollbar personalizado para el sidebar */
        .custom-scroll::-webkit-scrollbar {
            width: 8px; /* Scrollbar width */
        }

        .custom-scroll::-webkit-scrollbar-track {
            background-color: #f3e5f5; /* Light purple background for scrollbar track */
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #d1c4e9; /* Pastel purple for scrollbar thumb */
            border-radius: 10px;
        }

        /* Para Firefox */
        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: #d1c4e9 #f3e5f5;
        }

        /* Alerts */
        .alert-custom {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1050;
            width: auto;

            padding: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

    </style>
</head>
<body style="background-color: #f4f7f6;">

@if(session('success'))
    <div class="alert alert-success alert-custom">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-custom">
        {{ session('error') }}
    </div>
@endif

<!-- Main Container -->
<div class="container-fluid">

    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4 col-lg-3" style="position: fixed; top: 0; left: 0; height: 100%; padding: 20px; z-index: 10;">
            <div style="position: sticky; top: 20px; background-color: #f8e8f8; padding: 15px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">



                <h4 class="text-center" style="color: #ba68c8;">Resumen de Compra</h4>

                <!-- Cart Items with Scroll -->
                <div id="cart-summary" class="mb-3 custom-scroll" style="max-height: 60vh; overflow-y: auto;">
                    @foreach($resumen as $detalle)
                        <div class="product-row mb-3 p-2" style="background-color: #fff0f5; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                            <div class="d-flex justify-content-between align-items-center" style="padding: 2px;">
                                <!-- Producto Nombre (con padding reducido) -->
                                <span class="product-name font-weight-bold" style="color: #8e44ad; font-size: 0.9em;">{{ $detalle->producto->nombre }}</span>
                                <!-- Botón para Eliminar -->
                                <form action="{{ route('compra.quitarProducto') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="compra_id" value="{{ $compra->id }}">
                                    <input type="hidden" name="producto_id" value="{{ $detalle->producto->id }}">
                                    <button type="submit" class="btn btn-link text-danger" style="font-size: 18px;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- Divider Line -->
                            <hr style="border-top: 1px solid #dcdcdc; margin: 5px 0;">
                            <!-- Precio Unitario y Cantidad Badge -->
                            <p class="mb-0" style="color: #616161; font-size: 0.9em;">
                                Precio unitario: ${{ number_format($detalle->producto->precio_proveedor, 2) }}
                                <span class="badge" style="background-color: #d1c4e9; color: #673ab7; margin-left: 10px;">x {{ $detalle->cantidad }}</span>
                            </p>
                            <!-- Total Badge -->
                            <p class="total-price" style="font-size: 18px; color: #43a047;">
                                <span class="badge badge-pill" style="background-color: #a5d6a7; color: #2e7d32;">Total: ${{ number_format($detalle->producto->precio_proveedor * $detalle->cantidad, 2) }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>

                <!-- Fixed Total Purchase Amount -->
                <hr style="border-top: 2px solid #ba68c8; margin-top: 20px;">
                <p class="total" style="font-size: 18px; font-weight: bold; color: #ba68c8; text-align: center;">
                    <span class="badge badge-pill" style="background-color: #e1bee7; color: #6a1b9a;">Total de la Compra: ${{ number_format($resumen->sum(fn($detalle) => $detalle->producto->precio_proveedor * $detalle->cantidad), 2) }}</span>
                </p>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mb-3 mt-2">
                    <a class="btn btn-outline-danger" href="{{ route('compra.limpiarCarrito', $compra->id) }}" style="width: 45%; background-color: #ffcccc; color: #d32f2f;">Limpiar Resumen</a>
                    <a class="btn btn-success" href="{{ route('compra.detallada', $compra->id) }}" style="width: 45%; background-color: #c5e1a5; color: #388e3c;">Confirmar Compra</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-8 col-lg-9" style="margin-left: 25%; padding: 20px;">
            <a href="/dashboard/compras" class="btn btn-primary">
                VOLVER AL MENU
            </a>

            <h1 class="text-center" style="color: #007bff; margin-bottom: 30px;">Compra al provedor: {{ $compra->proveedor->nombre_empresa }}({{ $compra->proveedor->nombre_persona }})</h1>

            <!-- Divider between Sidebar and Products -->
            <hr style="border-top: 1px solid #dcdcdc; margin-bottom: 30px;" />

            <!-- Products List -->
            <div class="row">
                @foreach($productos as $producto)
                    <div class="col-sm-12 col-md-6 col-lg-3 mb-4">
                        <div class="card shadow-sm" style="border-radius: 15px; background-color: #f8f9fa; min-height: 420px;">
                            <img src="{{ $producto->main_photo }}" class="card-img-top" alt="{{ $producto->nombre }}" style="border-radius: 15px 15px 0 0; height: 200px; object-fit: cover;">
                            <div class="card-body" style="padding: 1.5rem;">
                                <h5 class="card-title text-center" style="font-size: 18px; color: #6c757d;">{{ $producto->nombre }}</h5>
                                <p class="card-text" style="font-size: 14px; color: #6c757d; text-align: justify;">{{ Str::limit($producto->descripcion, 100) }}</p>

                                <hr style="border-top: 1px solid #dcdcdc;">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="text-success mb-0" style="font-size: 18px; font-weight: bold;">${{ number_format($producto->precio_proveedor, 2) }}</p>
                                    <div class="be-vietnam-pro-regular-italic"> Stock <span class="badge badge-secondary" style="background-color: #f7c1bb; font-size: 16px;">{{ $producto->stock }}</span></div>
                                </div>

                                <!-- Quantity Input and Add to Cart Button -->
                                <div class="d-flex justify-content-between align-items-center">

                                    <form action="{{ route('compra.agregarProducto') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <input type="number" name="cantidad" value="1" min="1">
                                        <input type="hidden" name="compra_id" value="{{ $compra->id }}">
                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                        <button type="submit" class="btn btn-sm btn-success" style=" padding: 8px 3px; font-size: 14px;">
                                            Agregar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

</body>
</html>
