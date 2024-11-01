@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="ventas-section">

    <h2 class="text-center mb-4">Sección de Ventas</h2>

    <!-- Gráfica de Ventas -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-info h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-chart-line fa-2x text-info"></i> Gráfica de Ventas
                    </h5>
                    <div id="grafica-ventas" class="text-center">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Filtros y Búsqueda -->
    <form id="filtro-compras-form" method="GET" action="{{ route('dashboard.filtrar') }}">
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <input type="text" id="buscadorCompradores" class="form-control" placeholder="Buscar por cliente">
            </div>
            <div class="col-md-4 mb-3">
                <input type="date" class="form-control" name="fecha_compra" placeholder="Fecha de Compra">
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-select" name="estado" >
                    <option value="">Estado de la Compra</option>
                    <option value="completada">Completada</option>
                    <option value="pendiente">Pendiente</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-select" name="es_estudiante" >
                    <option value="">Todos</option>
                    <option value="1">Por Estudiantes</option>
                    <option value="0">Por Público General</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-select" name="tipo_venta">
                    <option value="">Tipo de Venta</option>
                    <option value="online">ONLINE</option>
                    <option value="fisica">FÍSICA</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-select" name="id_admin">
                    <option value="">Todos</option>
                    @foreach($administradores as $admin)
                        @if($admin->persona)
                            <option value="{{ $admin->id }}">
                                {{ $admin->persona->nombre }} {{ $admin->persona->apellido_pa }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </form>



    <!-- Tabla de Ventas Recientes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-success h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i> Ventas Recientes
                    </h5>

                    <table class="table table-bordered table-sm text-center">
                        <thead>
                        <tr>
                            <th>Comprador</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>Estudiante?</th>
                            <th>Vendedor</th>
                            <th>Acc.</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ventas as $venta)
                            <tr>
                                <td>{{ $venta->nombre_comprador }}</td>
                                <td>{{ $venta->fecha_compra }}</td>
                                <td>${{ $venta->total }}</td>
                                <td>{{ $venta->estado ?? 'N/A' }}</td>
                                <td>{{ $venta->tipo ?? 'N/A' }}</td>
                                <td>{{ $venta->es_estudiante === 'si' ? 'Sí' : 'No' }}</td>
                                <td>
                                    @if($venta->administrador && $venta->administrador->persona)
                                        {{ $venta->administrador->persona->nombre }} {{ $venta->administrador->persona->apellido_pa }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <!-- Botón para abrir modal de detalles de la venta específica -->
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detalle-venta-{{ $venta->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Botón para eliminar venta específica -->
                                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center">
                        {{ $ventas->links() }}
                    </div>

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-agregar-venta">Agregar Venta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ver Venta -->
    @foreach($ventas as $venta)
        <div class="modal fade" id="modal-detalle-venta-{{ $venta->id }}" tabindex="-1" aria-labelledby="modal-detalle-venta-label-{{ $venta->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content h-100">
                    <div class="modal-header d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column text-end">
                            <div class="d-flex flex-wrap mb-0">
                                <p class="mb-1 me-2"><strong>Cliente:</strong> {{ $venta->nombre_comprador }}</p>
                                <p class="mb-1 me-2"><strong>Fecha:</strong> {{ $venta->fecha_compra }}</p>
                                <p class="mb-1 me-2"><strong>Estudiante?:</strong> {{ $venta->es_estudiante === 'si' ? 'Sí' : 'No' }}</p>
                                <p class="mb-1"><strong>Vendedor:</strong>
                                    @if($venta->administrador && $venta->administrador->persona)
                                        {{ $venta->administrador->persona->nombre }} {{ $venta->administrador->persona->apellido_pa }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">
                        <div class="row row-cols-5 g-3 overflow-auto" style="max-height: 60vh;">
                            @foreach($venta->detalles as $detalle)
                                @php
                                    $total = $detalle->precio_aplicado * $detalle->cantidad; // Calcular el total por detalle
                                @endphp
                                <div class="col">
                                    <div class="card text-center border-0 shadow-sm">
                                        <img src="{{ $detalle->producto->main_photo ?? 'https://picsum.photos/100' }}" class="card-img-top rounded" alt="{{ $detalle->producto->nombre ?? 'Producto no disponible' }}">
                                        <div class="card-body p-1">
                                            <h6 class="card-title fw-semibold" style="font-size: 1rem;">
                                                {{ $detalle->producto->nombre ?? 'Producto no disponible' }}
                                            </h6>
                                            <p class="card-text mb-1" style="font-size: 0.75rem;">
                                                Cantidad: {{ $detalle->cantidad }}
                                            </p>
                                            <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">
                                                Total: ${{ number_format($total, 2) }} <!-- Total calculado -->
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="modal-footer justify-content-center">
                        <span class="fw-bold" style="font-size: 1.2rem;">Total: ${{ number_format($venta->total, 2) }}</span>
                        <div class="modal-body">
                            <div class="row row-cols-5 g-3 overflow-auto" style="max-height: 60vh;">
                                @foreach($venta->detalles as $detalle)
                                    @php
                                        $total = $detalle->precio_aplicado * $detalle->cantidad; // Calcular el total por detalle
                                    @endphp
                                    <div class="col">
                                        <div class="card text-center border-0 shadow-sm">
                                            <img src="{{ $detalle->producto->main_photo ?? 'https://picsum.photos/100' }}" class="card-img-top rounded" alt="{{ $detalle->producto->nombre ?? 'Producto no disponible' }}">
                                            <div class="card-body p-1">
                                                <h6 class="card-title fw-semibold" style="font-size: 1rem;">
                                                    {{ $detalle->producto->nombre ?? 'Producto no disponible' }}
                                                </h6>
                                                <p class="card-text mb-1" style="font-size: 0.75rem;">
                                                    Cantidad: {{ $detalle->cantidad }}
                                                </p>
                                                <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">
                                                    Total: ${{ number_format($total, 2) }} <!-- Total calculado -->
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    <!-- Modal Agregar Venta -->
    <div class="modal fade" id="modal-agregar-venta" tabindex="-1" aria-labelledby="modal-agregar-venta-label" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content h-100">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title mb-0 me-3" id="modal-agregar-venta-label">Agregar Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex p-0">
                    <!-- Sidebar con Información del Comprador y Resumen de la Venta -->
                    <div class="col-3 border-end p-4 d-flex flex-column bg-light">
                        <h5 class="mb-4">Información del Comprador</h5>
                        <form id="form-venta" action="{{ route('ventas.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="es_estudiante" value="false"> <!-- Campo oculto -->
                            <div class="mb-3">
                                <label for="nombre-comprador-nueva" class="form-label">Nombre del Comprador</label>
                                <input type="text" class="form-control" name="nombre_comprador" id="nombre-comprador-nueva" placeholder="Ingrese el nombre del comprador" required autocomplete="off">
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="es-estudiante" name="es_estudiante" value="true" onchange="toggleMatricula()">
                                <label class="form-check-label" for="es-estudiante">¿Es Estudiante?</label>
                            </div>

                            <div class="mb-3 d-none" id="div-matricula">
                                <label for="matricula" class="form-label">Matrícula del Estudiante</label>
                                <input type="text" class="form-control" name="matricula" id="matricula" placeholder="Ingrese la matrícula" autocomplete="off">
                                <div class="dropdown" id="dropdown-matriculas">
                                    <div class="dropdown-menu">
                                        <!-- Aquí se llenarán los elementos del dropdown -->
                                    </div>
                                </div>
                            </div>




                            <!-- Resumen de la Venta -->
                            <h6 class="text-center mb-3">Resumen de la Venta</h6>
                            <div id="resumen-venta" class="border rounded p-3 bg-white flex-grow-1 overflow-auto" style="max-height: 300px;">
                                <ul class="list-group list-group-flush" id="lista-productos">
                                    @if (session()->has('carrito') && count(session('carrito')) > 0)
                                        @foreach (session('carrito') as $productoId => $producto)
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-1" id="producto-{{ $productoId }}">
                                                <span>{{ $producto['nombre'] }}: {{ $producto['cantidad'] }}</span>
                                                <span class="badge bg-primary rounded-pill">${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</span>
                                                <button type="button" class="btn btn-outline-danger btn-sm ms-2 btn-quitar-producto" data-producto-id="{{ $productoId }}">Eliminar</button>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="list-group-item text-center">No hay productos en el carrito</li>
                                    @endif
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h6 class="mb-0">Total:</h6>
                                <span class="fw-bold">
            ${{ number_format(array_sum(array_map(fn($p) => $p['precio'] * $p['cantidad'], session('carrito', []))), 2) }}
        </span>
                            </div>

                            <!-- Botón para Enviar al Controlador -->
                            <!-- Botones para realizar la venta y limpiar el carrito -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <button type="submit" class="btn btn-primary mt-3">Realizar Venta</button>
                                <button type="button" class="btn btn-outline-danger mt-3" id="btn-limpiar-carrito">Limpiar Carrito</button>
                            </div>

                        </form>
                    </div>

                    <!-- Catálogo de productos -->
                    <div class="col-9 row row-cols-1 row-cols-md-4 g-3 p-3" style="height: 100%; overflow-y: auto;">
                        @foreach ($productos as $producto)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="{{ $producto->main_photo }}" class="card-img-top rounded-top" style="height: 150px; object-fit: cover;" alt="{{ $producto->nombre }}">
                                    <div class="card-body text-center p-2">
                                        <h6 class="card-title fw-semibold mb-2" style="font-size: 1rem;">{{ $producto->nombre }}</h6>
                                        <p class="card-text text-muted mb-1" style="font-size: 0.85rem;">{{ Str::limit($producto->descripcion, 50) }}</p>
                                        <p class="card-text text-primary fw-bold mb-2" style="font-size: 0.9rem;">${{ number_format($producto->precio_venta, 2) }}</p>
                                        <form action="{{ route('ventas.agregarProducto') }}" method="POST" class="form-agregar-producto">
                                            @csrf
                                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                            <label for="cantidad-{{ $producto->id }}" class="form-label">Cantidad:</label>
                                            <input type="number" name="cantidad" id="cantidad-{{ $producto->id }}" class="form-control form-control-sm mb-2" min="1" value="1">
                                            <button type="button" class="btn btn-outline-primary btn-sm btn-agregar-producto" data-producto-id="{{ $producto->id }}">Agregar al Carrito</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function toggleMatricula() {
            const checkbox = document.getElementById('es-estudiante');
            const divMatricula = document.getElementById('div-matricula');
            const matriculaInput = document.getElementById('matricula');

            divMatricula.classList.toggle('d-none', !checkbox.checked);

            // Establece el atributo required según el estado del checkbox
            matriculaInput.required = checkbox.checked;
        }
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Dropdown de búsqueda de matrículas
    $(document).ready(function() {
        $('#matricula').on('input', function() {
            let query = $(this).val();

            // Solo realizar la búsqueda si hay al menos 1 carácter
            if (query.length > 0) {
                $.ajax({
                    url: '{{ route('buscar.matriculas') }}', // Ruta de la API
                    type: 'GET',
                    data: { query: query },
                    success: function(data) {
                        var dropdown = $('#dropdown-matriculas .dropdown-menu');
                        dropdown.empty();

                        if (data.length > 0) {
                            data.forEach(function(item) {
                                dropdown.append(`
                                    <div class="dropdown-item" data-matricula="${item.matricula}" data-nombre="${item.nombre}" data-ap-paterno="${item.ap_paterno}">
                                        ${item.matricula} | ${item.nombre} ${item.ap_paterno}
                                    </div>
                                `);
                            });
                            dropdown.parent().removeClass('d-none');
                            dropdown.addClass('show');
                        } else {
                            dropdown.parent().addClass('d-none');
                            dropdown.removeClass('show');
                        }
                    },
                    error: function() {
                        console.error("Error al buscar las matrículas.");
                    }
                });
            } else {
                $('#dropdown-matriculas .dropdown-menu').empty().parent().addClass('d-none'); // Limpiar y ocultar el dropdown si no hay query
            }
        });

        // Manejar la selección de una matrícula del dropdown
        $('#dropdown-matriculas').on('click', '.dropdown-item', function() {
            let matricula = $(this).data('matricula');
            let nombre = $(this).data('nombre');
            let apPaterno = $(this).data('ap-paterno');



            // Establecer la matrícula en el input
            $('#matricula').val(matricula);

            // Establecer el nombre y apellido en otros campos, si los tienes
            $('#nombre').val(nombre);
            $('#ap_paterno').val(apPaterno);

            // Limpiar el dropdown y ocultarlo
            $('#dropdown-matriculas .dropdown-menu').empty().parent().addClass('d-none');
            dropdown.removeClass('show'); // Asegúrate de quitar la clase 'show' al cerrar
        });
    });
</script>



    <script>
        // Manejar el evento para limpiar el carrito
        document.getElementById('btn-limpiar-carrito').addEventListener('click', function () {
            fetch('{{ route('limpiarCarrito') }}', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualiza la lista de productos en el carrito
                        document.getElementById('lista-productos').innerHTML = `<li class="list-group-item text-center">No hay productos en el carrito</li>`;
                        document.querySelector('.fw-bold').innerText = '$0.00'; // Resetea el total a 0
                    }
                });
        });

    // Agregar producto al carrito
    document.querySelectorAll('.btn-agregar-producto').forEach(button => {
        button.addEventListener('click', function () {
            const form = button.closest('form');
            const productoId = button.getAttribute('data-producto-id');

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    producto_id: productoId,
                    cantidad: form.querySelector(`input[name="cantidad"]`).value
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualiza la lista de productos en el carrito
                        document.getElementById('lista-productos').innerHTML = data.carritoHtml;
                    }
                });
        });
    });

    // Delegación de eventos para eliminar producto
    document.getElementById('lista-productos').addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-quitar-producto')) {
            const productoId = event.target.getAttribute('data-producto-id');

            fetch('{{ route('ventas.quitarProducto') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    producto_id: productoId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualiza la lista de productos en el carrito
                        document.getElementById('lista-productos').innerHTML = data.carritoHtml;
                    }
                });
        }
    });
</script>


