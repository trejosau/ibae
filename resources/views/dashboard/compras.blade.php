<div class="compras-section">
    <h2 class="text-center mb-4">Sección de Compras</h2>

    <!-- Proveedores y Notificaciones -->



    <div class="row mb-4">
        <!-- Card Compras Recientes -->
        <div class="col-md-8">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h5 class="card-title text-center text-primary">
                        <i class="fas fa-shopping-cart fa-2x"></i> Compras Recientes
                    </h5>
                    <table class="table table-bordered text-center">
                        <thead class="table-primary">
                        <tr>
                            <th>Proveedor</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($compras as $compra)
                            <tr>
                                <td>{{ $compra->proveedor->nombre_empresa }}</td>
                                <td>{{ $compra->fecha_compra }}</td>
                                <td>${{ number_format($compra->total, 2) }}</td>
                                <td>
                                    @if($compra->estado == 'entregado')
                                        <span class="badge bg-success text-white">Entregado</span>
                                    @elseif($compra->estado == 'pendiente de entrega')
                                        <span class="badge bg-warning text-dark">Pendiente de Entrega</span>
                                        @elseif($compra->estado == 'pendiente de detalle')
                                            <span class="badge bg-warning text-dark">Pendiente de Detalle</span>
                                    @elseif($compra->estado == 'cancelado')
                                        <span class="badge bg-danger text-white">Cancelado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($compra->estado == 'pendiente de entrega')
                                        <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modal-detalle-productos-{{ $compra->id }}">Ver Detalle</button>
                                    @elseif($compra->estado == 'pendiente de detalle')
                                        <a class="btn btn-outline-primary btn-sm w-100" href="{{ route('detallar.producto', ['id' => $compra->id]) }}">Detallar</a>
                                    @elseif($compra->estado == 'cancelado')
                                        <button class="btn btn-outline-secondary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modal-motivo-cancelacion-{{ $compra->id }}">Ver Motivo</button>
                                    @elseif($compra->estado == 'entregado')
                                        <button class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modal-detalle-productos-{{ $compra->id }}">Ver Detalle</button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Paginación Compras -->
                    <div class="d-flex justify-content-between mt-3">
                        {{ $compras->appends(['proveedores_page' => $proveedores->currentPage(), 'productos_page' => $productos->currentPage()])->links('pagination::bootstrap-5') }}
                    </div>
                    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-agregar-compra">Agregar Compra</button>
                    <div class="modal fade" id="modal-agregar-compra" tabindex="-1" aria-labelledby="modal-agregar-compra-label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-agregar-compra-label">Agregar Compra</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para agregar compra -->
                                    <form action="{{ route('compra.agregar') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="proveedor" class="form-label">Seleccionar Proveedor</label>
                                            <select id="proveedor" name="proveedor_id" class="form-select" required>
                                                <option value="">Seleccione un proveedor</option>
                                                <!-- Aquí se llenarán los proveedores -->
                                                @foreach ($todosLosProveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_empresa }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="fecha" class="form-label">Fecha de Compra</label>
                                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Agregar Compra</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Tabla de Stock -->
        <div class="col-md-4">
            <div class="card border-secondary h-100" style="border-color: #d8bfd8;">
                <div class="card-body" style="background-color: #fdf7ff;">
                    <h5 class="card-title text-center" style="color: #8b5e83;">
                        <i class="fas fa-boxes fa-2x"></i> Tabla de Stock
                    </h5>
                    <table class="table table-bordered text-center">
                        <thead style="background-color: #f7d6e0;">
                        <tr>
                            <th>Producto</th>
                            <th>Stock Actual</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productos as $producto)
                            @php
                                $bgColor = '';
                                if ($producto->stock <= 5) {
                                    $bgColor = 'table-danger';
                                } elseif ($producto->stock <= 15) {
                                    $bgColor = 'table-warning';
                                } else {
                                    $bgColor = 'table-success';
                                }
                            @endphp
                            <tr class="{{ $bgColor }}">
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->stock }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Paginación Productos -->
                    <div class="d-flex justify-content-between mt-3">
                        {{ $productos->appends(['proveedores_page' => $proveedores->currentPage(), 'productos_page' => $productos->currentPage()])->links('pagination::bootstrap-5', ['onEachSide' => 2]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">

        <!-- Notificaciones -->
        <div class="col-md-4">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-bell fa-2x text-primary"></i> Notificaciones
                    </h5>

                    <!-- Filtros de notificaciones -->
                    <div class="d-flex justify-content-center mb-3">
                        <a href="{{ route('dashboard.compras', ['filtro' => 'todos']) }}" class="btn btn-sm btn-outline-primary mx-2">Todos</a>
                        <a href="{{ route('dashboard.compras', ['filtro' => 'leidas']) }}" class="btn btn-sm btn-outline-success mx-2">Leídas</a>
                        <a href="{{ route('dashboard.compras', ['filtro' => 'no-leidas']) }}" class="btn btn-sm btn-outline-danger mx-2">No leídas</a>
                    </div>

                    <ul class="list-group">
                        @foreach($notificaciones as $notificacion)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    <strong>{{ $notificacion->motivo }}</strong><br>
                                    <small>{{ $notificacion->mensaje }}</small>
                                </div>

                                <!-- Si la notificación no está leída -->
                                @if(is_null($notificacion->leida_at))
                                    <a href="{{ route('notificaciones.marcarLeida', $notificacion->id) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i> Marcar como leída
                                    </a>
                                @else
                                    <!-- Si la notificación ya está leída -->
                                    <button class="btn btn-sm btn-secondary" disabled>
                                        <i class="fas fa-check-double"></i> Leída
                                    </button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Proveedores -->
        <div class="col-md-8">
            <div class="card border-secondary h-100">
                <div class="card-body">
                    <h5 class="card-title text-start mb-3" style="font-size: 1.5rem; color: #6c757d;">Proveedores</h5>

                    <table class="table table-bordered table-striped table-hover text-center" id="tabla-proveedores">
                        <thead style="background-color: #e9ecef;">
                        <tr>
                            <th>Nombre Persona</th>
                            <th>Nombre Empresa</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($proveedores as $proveedor)
                            <tr style="cursor: pointer; background-color: #f9f9f9;">
                                <td>{{ $proveedor->nombre_persona }}</td>
                                <td>{{ $proveedor->nombre_empresa }}</td>
                                <td>
                                    <!-- Botón "Ver más" que abrirá el modal con la información del proveedor -->
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-ver-mas-{{ $proveedor->id }}">
                                        <i class="fas fa-info-circle"></i> Ver más
                                    </button>

                                    <!-- Botón "Eliminar" -->
                                    <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Seguro que quieres eliminar este proveedor?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal para ver y modificar información del proveedor -->
                            <div class="modal fade" id="modal-ver-mas-{{ $proveedor->id }}" tabindex="-1" aria-labelledby="modal-ver-mas-label-{{ $proveedor->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-ver-mas-label-{{ $proveedor->id }}">Información del Proveedor: {{ $proveedor->nombre_persona }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nombre_persona_{{ $proveedor->id }}" class="form-label">Nombre Persona</label>
                                                    <input type="text" class="form-control" id="nombre_persona_{{ $proveedor->id }}" name="nombre_persona" value="{{ $proveedor->nombre_persona }}" required readonly disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nombre_empresa_{{ $proveedor->id }}" class="form-label">Nombre Empresa</label>
                                                    <input type="text" class="form-control" id="nombre_empresa_{{ $proveedor->id }}" name="nombre_empresa" value="{{ $proveedor->nombre_empresa }}" required readonly disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contacto_telefono_{{ $proveedor->id }}" class="form-label">Teléfono</label>
                                                    <input type="text" class="form-control" id="contacto_telefono_{{ $proveedor->id }}" name="contacto_telefono" value="{{ $proveedor->contacto_telefono }}" required readonly disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contacto_correo_{{ $proveedor->id }}" class="form-label">Correo</label>
                                                    <input type="email" class="form-control" id="contacto_correo_{{ $proveedor->id }}" name="contacto_correo" value="{{ $proveedor->contacto_correo }}" required readonly disabled>
                                                </div>

                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-primary" id="btn-editar-{{ $proveedor->id }}" onclick="habilitarCampos({{ $proveedor->id }})">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </button>

                                                <!-- Hidden Update Button (initially hidden) -->
                                                <button type="submit" class="btn btn-success" id="btn-actualizar-{{ $proveedor->id }}" style="display: none;">
                                                    <i class="fas fa-save"></i> Actualizar
                                                </button>
                                            </form>
                                        </div>

                                        <script>
                                            function habilitarCampos(proveedorId) {
                                                // Get the fields by their IDs using the provider's ID to make them unique
                                                const nombrePersona = document.getElementById(`nombre_persona_${proveedorId}`);
                                                const nombreEmpresa = document.getElementById(`nombre_empresa_${proveedorId}`);
                                                const telefono = document.getElementById(`contacto_telefono_${proveedorId}`);
                                                const correo = document.getElementById(`contacto_correo_${proveedorId}`);

                                                // Remove the readonly and disabled attributes
                                                nombrePersona.removeAttribute('readonly');
                                                nombrePersona.removeAttribute('disabled');
                                                nombreEmpresa.removeAttribute('readonly');
                                                nombreEmpresa.removeAttribute('disabled');
                                                telefono.removeAttribute('readonly');
                                                telefono.removeAttribute('disabled');
                                                correo.removeAttribute('readonly');
                                                correo.removeAttribute('disabled');

                                                // Change the button to a "Guardar" button or similar if necessary
                                                const editarBtn = document.getElementById(`btn-editar-${proveedorId}`);
                                                editarBtn.style.display = 'none';  // Hide the Edit button

                                                const actualizarBtn = document.getElementById(`btn-actualizar-${proveedorId}`);
                                                actualizarBtn.style.display = 'inline-block';  // Show the Update button
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Paginación proveedores -->
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            {{ $proveedores->appends([
                                'compras_page' => $compras->currentPage(),
                                'productos_page' => $productos->currentPage()
                            ])->links('pagination::bootstrap-5') }}
                        </div>
                        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal-agregar-proveedor">
                            <i class="fas fa-plus-circle"></i> Agregar Proveedor
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Modal para ver Detalle Compra (Estado: Entregado o Pendiente) -->
        @foreach($compras as $compra)
            @if($compra->estado == 'pendiente de entrega' || $compra->estado == 'entregado')
                <!-- Modal principal de detalle de la compra -->
                <div class="modal fade" id="modal-detalle-productos-{{ $compra->id }}" tabindex="-1" aria-labelledby="modal-detalle-productos-{{ $compra->id }}-label" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 95%; max-height: 90%; margin: auto;">
                        <div class="modal-content" style="border-radius: 10px; background-color: #f9f9f9;">
                            <div class="modal-header" style="background-color: #f7c8d7; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <h5 class="modal-title" id="modal-detalle-productos-{{ $compra->id }}-label" style="color: #5a5a5a;">Detalle de Compra</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="padding: 20px; color: #333;">
                                <h6 style="color: #7d4e88; font-weight: bold;">Catálogo de Productos del Proveedor: {{ $compra->proveedor->nombre_empresa }}</h6>
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-6 row-cols-xl-8 g-3">
                                    @foreach($compra->productos as $producto)
                                        <div class="col">
                                            <div class="card" style="border: 1px solid #ddd; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); cursor: pointer; max-width: 100%; margin: 0 auto;" data-bs-toggle="collapse" data-bs-target="#producto-detalles-{{ $producto->id }}" aria-expanded="false" aria-controls="producto-detalles-{{ $producto->id }}">
                                                <img src="{{ $producto->main_photo }}" class="card-img-top" alt="{{ $producto->nombre }}" style="height: 150px; object-fit: contain; width: 100%; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                                <div class="card-body" style="padding: 15px; height: 120px;">
                                                    <h5 class="card-title" style="font-size: 16px; color: #5a5a5a; font-weight: bold;">{{ $producto->nombre }}</h5>
                                                    <p class="card-text" style="font-size: 14px; color: #8c8c8c;">
                                                        <strong>Cantidad:</strong> {{ $producto->pivot->cantidad }}
                                                    </p>
                                                    <p class="card-text" style="font-size: 14px; color: #8c8c8c;">
                                                        <strong>Precio Proveedor:</strong> ${{ number_format($producto->precio_proveedor, 2) }}
                                                    </p>
                                                    <div class="collapse" id="producto-detalles-{{ $producto->id }}">
                                                        <p class="card-text" style="font-size: 14px; color: #8c8c8c;">
                                                            <strong>Stock:</strong> {{ $producto->stock }}
                                                        </p>
                                                        <p class="card-text" style="font-size: 14px; color: #8c8c8c;">
                                                            <strong>Precio estudiantes:</strong> {{ $producto->precio_lista }}
                                                        </p>
                                                        <p class="card-text" style="font-size: 14px; color: #8c8c8c;">
                                                            <strong>Precio Publico:</strong> ${{ number_format($producto->precio_venta, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer" style="background-color: #f7c8d7; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                @if($compra->estado == 'pendiente de entrega')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-cancelar-compra-{{ $compra->id }}">Cancelar</button>
                                    <form method="POST" action="{{ route('compra.entregada', $compra->id) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Marcar como Recibido</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de Cancelación para solicitar motivo -->
                <div class="modal fade" id="modal-cancelar-compra-{{ $compra->id }}" tabindex="-1" aria-labelledby="modal-cancelar-compra-{{ $compra->id }}-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 10px; background-color: #f9f9f9;">
                            <div class="modal-header" style="background-color: #f7c8d7; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <h5 class="modal-title" id="modal-cancelar-compra-{{ $compra->id }}-label" style="color: #5a5a5a;">Cancelar Compra</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="padding: 20px;">
                                <p style="color: #333;">Por favor, indique el motivo de la cancelación:</p>
                                <form method="POST" action="{{ route('compra.cancelar', $compra->id) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="motivo" class="form-control" placeholder="Escriba el motivo de la cancelación" rows="3" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Confirmar Cancelación</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Modal para Ver Motivo de Cancelación (Estado: Cancelado) -->
        @foreach($compras as $compra)
            @if($compra->estado == 'cancelado')
                <div class="modal fade" id="modal-motivo-cancelacion-{{ $compra->id }}" tabindex="-1" aria-labelledby="modal-motivo-cancelacion-{{ $compra->id }}-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-motivo-cancelacion-{{ $compra->id }}-label">Motivo de Cancelación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <textarea class="form-control" rows="4" readonly>{{ $compra->motivo }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
</div>
<!-- Modal para agregar proveedor -->
<div class="modal fade" id="modal-agregar-proveedor" tabindex="-1" aria-labelledby="modal-agregar-proveedor-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-agregar-proveedor-label">Agregar Nuevo Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('proveedores.store') }}" method="POST">
                    @csrf
                    <!-- Campo Nombre Persona -->
                    <div class="mb-3">
                        <label for="nombre_persona" class="form-label">Nombre Persona</label>
                        <input type="text" class="form-control" id="nombre_persona" name="nombre_persona" required>
                    </div>

                    <!-- Campo Nombre Empresa -->
                    <div class="mb-3">
                        <label for="nombre_empresa" class="form-label">Nombre Empresa</label>
                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
                    </div>

                    <!-- Campo Teléfono con la librería intl-tel-input -->
                    <div class="mb-3">
                        <label for="contacto_telefono" class="form-label">Teléfono</label>
                        <input type="tel" id="contacto_telefono" name="contacto_telefono" class="form-control" value="+52" required>
                    </div>

                    <!-- Campo Correo -->
                    <div class="mb-3">
                        <label for="contacto_correo" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="contacto_correo" name="contacto_correo" required>
                    </div>

                    <!-- Botón Guardar -->
                    <button type="submit" class="btn btn-primary w-100">Guardar Proveedor</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.querySelector("#contacto_telefono");

        if (input) {
            const iti = window.intlTelInput(input, {
                nationalMode: false, // Desactiva el modo nacional
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                preferredCountries: [ "mx"],
            });
        }
    });
</script>



