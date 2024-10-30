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
    <form id="filtro-compras-form" method="GET" action="{{ route('dashboard.compras') }}">
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
                    <option value="1">Luis</option>
                    <option value="2">Alberto</option>
                    <option value="3">Juan</option>
                </select>
            </div>
        </div>
    </form>



    <!-- Ventas Recientes -->
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
                            <th>Estudiante?</th> <!-- Abreviatura para "Es Estudiante" -->
                            <th>Vendedor</th>
                            <th>Acc.</th> <!-- Abreviatura para "Acciones" -->
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Juan Pérez</td>
                            <td>2024-10-05</td>
                            <td>$250</td>
                            <td>Completada</td>
                            <td>ONLINE</td>
                            <td>Sí</td>
                            <td>Admin</td>
                            <td>
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal-detalle-venta">
                                    <i class="fas fa-eye"></i> <!-- Icono de ver -->
                                </button>
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> <!-- Icono de eliminar -->
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-agregar-venta">Agregar Venta</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal ver Venta -->
    <div class="modal fade" id="modal-detalle-venta" tabindex="-1" aria-labelledby="modal-detalle-venta-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content h-100">
                <div class="modal-header d-flex justify-content-between align-items-start"> <!-- Cambiar align-items-center a align-items-start -->
                    <div class="d-flex flex-column text-end">
                        <div class="d-flex flex-wrap mb-0"> <!-- Usar flex-wrap para permitir que los textos largos se ajusten -->
                            <p class="mb-1 me-2"><strong>Comprador:</strong> Abraham senior</p>
                            <p class="mb-1 me-2"><strong>Fecha:</strong> 2024-10-30</p>
                            <p class="mb-1 me-2"><strong>Estudiante?:</strong> No</p>
                            <p class="mb-1"><strong>Vendedor:</strong> Chuy 0 commits</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">
                    <div class="row row-cols-5 g-3 overflow-auto" style="max-height: 60vh;"> <!-- Limitar la altura del contenido del modal -->
                        <!-- Tarjeta 1 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1015/100/100" class="card-img-top rounded" alt="Producto A">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto A</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 1</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $500.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 2 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1016/100/100" class="card-img-top rounded" alt="Producto B">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto B</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 2</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $600.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 3 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1016/100/100" class="card-img-top rounded" alt="Producto C">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto C</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 3</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $700.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 4 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1018/100/100" class="card-img-top rounded" alt="Producto D">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto D</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 4</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $800.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 5 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1019/100/100" class="card-img-top rounded" alt="Producto E">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto E</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 5</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $900.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 6 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1020/100/100" class="card-img-top rounded" alt="Producto F">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto F</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 6</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $1000.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 7 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1021/100/100" class="card-img-top rounded" alt="Producto G">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto G</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 7</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $1100.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 8 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1022/100/100" class="card-img-top rounded" alt="Producto H">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto H</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 8</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $1200.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 9 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1023/100/100" class="card-img-top rounded" alt="Producto I">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto I</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 9</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $1300.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 10 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1024/100/100" class="card-img-top rounded" alt="Producto J">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto J</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 10</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $1400.00</p>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta 11 -->
                        <div class="col">
                            <div class="card text-center border-0 shadow-sm">
                                <img src="https://picsum.photos/id/1025/100/100" class="card-img-top rounded" alt="Producto K">
                                <div class="card-body p-1">
                                    <h6 class="card-title fw-semibold" style="font-size: 1rem;">Producto K</h6>
                                    <p class="card-text mb-1" style="font-size: 0.75rem;">Cantidad: 11</p>
                                    <p class="card-text text-primary fw-bold" style="font-size: 0.85rem;">Total: $1500.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <span class="fw-bold" style="font-size: 1.2rem;">Total: $99,999.00</span>
                </div>
            </div>
        </div>
    </div>


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
                        <form id="form-venta">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre-comprador-nueva" class="form-label">Nombre del Comprador</label>
                                <input type="text" class="form-control" name="nombre_comprador" id="nombre-comprador-nueva" placeholder="Ingrese el nombre del comprador">
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="es-estudiante" onchange="toggleMatricula()">
                                <label class="form-check-label" for="es-estudiante">¿Es Estudiante?</label>
                            </div>
                            <div class="mb-3 d-none" id="div-matricula">
                                <label for="matricula" class="form-label">Matrícula del Estudiante</label>
                                <input type="text" class="form-control" id="matricula" placeholder="Ingrese la matrícula">
                            </div>

                            <!-- Resumen de la Venta -->
                            <h6 class="text-center mb-3">Resumen de la Venta</h6>
                            <div id="resumen-venta" class="border rounded p-3 bg-white flex-grow-1 overflow-auto" style="max-height: 300px;">
                                <ul id="lista-resumen" class="list-group list-group-flush">
                                    <!-- Aquí se agregarán los productos seleccionados con JavaScript -->
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h6 class="mb-0">Total:</h6>
                                <span id="total-venta" class="fw-bold">$0.00</span>
                            </div>

                            <!-- Botón para Enviar al Controlador -->
                            <button type="button" class="btn btn-primary mt-3" onclick="enviarVenta()">Realizar Venta</button>
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
                                        <div class="d-flex justify-content-center align-items-center mb-2">
                                            <button class="btn btn-outline-secondary btn-sm" onclick="cambiarCantidad('{{ $producto->id }}', -1)" title="Quitar">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" id="input-cantidad-{{ $producto->id }}" class="form-control form-control-sm mx-1" min="0" value="0" oninput="validarCantidad(this)" style="width: 60px; height: 36px; text-align: center;">
                                            <button class="btn btn-outline-secondary btn-sm" onclick="cambiarCantidad('{{ $producto->id }}', 1)" title="Agregar">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm ms-2" onclick="agregarProducto('{{ $producto->id }}', '{{ $producto->nombre }}', {{ $producto->precio_venta }})" title="Agregar al Carrito">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm ms-2" onclick="quitarProducto('{{ $producto->id }}')" title="Eliminar del Resumen">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMatricula() {
            const checkBox = document.getElementById('es-estudiante');
            const divMatricula = document.getElementById('div-matricula');
            if (checkBox.checked) {
                divMatricula.classList.remove('d-none'); // Muestra el campo de matrícula
            } else {
                divMatricula.classList.add('d-none'); // Oculta el campo de matrícula
                document.getElementById('matricula').value = ''; // Limpia el valor del campo
            }
        }
    </script>

    <script>
        let carrito = {};

        function validarCantidad(input) {
            if (input.value < 0) {
                input.value = 0;
            }
        }

        function cambiarCantidad(id, cambio) {
            const cantidadInput = document.getElementById(`input-cantidad-${id}`);
            let cantidad = parseInt(cantidadInput.value) || 0;
            cantidad += cambio;
            if (cantidad < 0) {
                cantidad = 0;
            }

            cantidadInput.value = cantidad;
        }

        function agregarProducto(id, nombre, precio) {
            const cantidadInput = document.getElementById(`input-cantidad-${id}`);
            const cantidad = parseInt(cantidadInput.value) || 0;

            if (cantidad > 0) {
                if (carrito[id]) {
                    carrito[id].cantidad += cantidad; // Incrementar la cantidad en el carrito
                } else {
                    carrito[id] = { nombre: nombre, cantidad: cantidad, precio: precio }; // Agregar nuevo producto al carrito
                }

                actualizarResumen();
                cantidadInput.value = 0; // Reiniciar el campo de cantidad después de agregar
            }
        }

        function quitarProducto(id) {
            delete carrito[id]; // Eliminar producto del carrito
            actualizarResumen();
        }

        function actualizarResumen() {
            const listaResumen = document.getElementById("lista-resumen");
            listaResumen.innerHTML = "";
            let total = 0;

            for (const [id, producto] of Object.entries(carrito)) {
                const item = document.createElement("li");
                item.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center", "p-1");
                item.innerHTML = `<span>${producto.nombre}</span><span>${producto.cantidad}</span>`;
                const subtotal = producto.cantidad * producto.precio;
                total += subtotal;
                const totalBadge = document.createElement("span");
                totalBadge.classList.add("badge", "bg-primary", "rounded-pill");
                totalBadge.textContent = `$${subtotal.toFixed(2)}`;
                item.appendChild(totalBadge);
                listaResumen.appendChild(item);
            }

            document.getElementById("total-venta").textContent = `$${total.toFixed(2)}`;
        }
    </script>




</div>
