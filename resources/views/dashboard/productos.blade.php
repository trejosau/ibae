<div class="container">
    <h1 class="mb-4">Gestión de Productos</h1>

    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#agregarProductoModal">
        Agregar Producto
    </button>

    <!-- Modal -->
    <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProductoModalLabel">Agregar/Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('productos.agregar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Nombre del producto -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <!-- Marca -->
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <select class="form-select" id="marca" name="marca">
                                <option value="">Selecciona una marca...</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nombre_empresa }}</option>
                                @endforeach
                            </select>

                        </div>
                        <!-- Precios -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="precio_proveedor" class="form-label">Precio Proveedor</label>
                                <input type="number" class="form-control" id="precio_proveedor" name="precio_proveedor" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_lista" class="form-label">Precio Lista</label>
                                <input type="number" class="form-control" id="precio_lista" name="precio_lista" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="precio_venta" class="form-label">Precio Venta</label>
                                <input type="number" class="form-control" id="precio_venta" name="precio_venta" required>
                            </div>
                        </div>
                        <!-- Cantidad y Medida -->
                        <div class="row">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="medida" class="form-label">Medida</label>
                                    <select class="form-select" id="medida" name="medida">
                                        <option disabled selected>Selecciona una medida...</option>
                                        @foreach($medidas as $valor => $texto)
                                            <option value="{{ $valor }}">{{ $texto }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Proveedor y Categoría -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_proveedor" class="form-label">Proveedor</label>
                                <select class="form-select" id="id_proveedor" name="id_proveedor">
                                    <option value="">Selecciona un proveedor...</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nombre_empresa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="id_categoria" class="form-label">Categoría</label>
                                <select class="form-select" id="id_categoria" name="id_categoria">
                                    <option value="">Selecciona una categoría...</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="main_photo" class="form-label">Foto Principal</label>
                            <div class="d-flex align-items-center">
                                <div class="photo-upload-btn position-relative">
                                    <input type="file" class="form-control position-absolute top-0 start-0 opacity-0" id="main_photo" name="main_photo" accept="image/*" style="width: 100%; height: 100%;" onchange="previewImage(event)">
                                    <div class="btn-circle">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </div>
                                <img id="photo_preview" src="#" alt="Image Preview" style="display: none; width: 100px; height: auto; margin-left: 20px;">
                            </div>
                        </div>

                        <style>

                            .btn-circle {
                                background-color: #007bff;
                            }

                            .btn-circle i {
                                font-size: 22px;
                                color: #9beade;
                            }
                        </style>

                        <script>
                            function previewImage(event) {
                                const reader = new FileReader();
                                const preview = document.getElementById('photo_preview');

                                reader.onload = function() {
                                    preview.src = reader.result;
                                    preview.style.display = 'block';
                                };

                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>
                        <!-- Stock y Estado -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de productos -->
    <div class="card">
        <div class="card-header">Lista de Productos</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Marca</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Fecha Agregado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>
                            <a href="{{ $producto->main_photo }}" data-lightbox="producto-{{ $producto->id }}" data-title="{{ $producto->nombre }}">
                              <img src="{{ $producto->main_photo }}" alt="{{ $producto->nombre }}" style="width: 128px; height: auto; object-fit: cover;">
                            </a>
                        </td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria->nombre }}</td>
                        <td>{{ $producto->Proveedor->nombre_empresa }}</td>
                        <td>${{ number_format($producto->precio_venta, 2) }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->estado == 'activo' ? 'Activo' : 'Inactivo' }}</td>
                        <td>{{ $producto->fecha_agregado }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-warning">Editar</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
