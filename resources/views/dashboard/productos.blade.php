<!-- Cropper.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

<!-- Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

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
                        <!-- Nombre y Marca -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <select class="form-select" id="marca" name="marca">
                                    <option value="">Selecciona una marca...</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nombre_empresa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
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
                        <!-- Cantidad/Medida/Categoría -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="medida" class="form-label">Medida</label>
                                <select class="form-select" id="medida" name="medida">
                                    <option disabled selected>Selecciona una medida...</option>
                                    @foreach($medidas as $valor => $texto)
                                        <option value="{{ $valor }}">{{ $texto }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="id_categoria" class="form-label">Categoría</label>
                                <select class="form-select" id="id_categoria" name="id_categoria">
                                    <option value="">Selecciona una categoría...</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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


                        <!-- Foto -->
                        <div class="mb-3">
                            <label for="main_photo" class="form-label">Foto Principal</label>
                            <div class="d-flex align-items-center">
                                <div class="photo-upload-btn position-relative">
                                    <input type="file" class="form-control position-absolute top-0 start-0 opacity-0" id="main_photo" name="main_photo" accept="image/*" style="width: 100%; height: 100%;" onchange="previewImage(event)">
                                    <input type="hidden" id="crop_x" name="crop_x">
                                    <input type="hidden" id="crop_y" name="crop_y">
                                    <input type="hidden" id="crop_width" name="crop_width">
                                    <input type="hidden" id="crop_height" name="crop_height">
                                    <div class="btn-circle">
                                        <i class="fa fa-camera"></i>
                                    </div>
                                </div>
                                   </div>

                            <!-- Contenedor para la imagen y el área de recorte -->
                            <div class="mt-3">
                                <img id="image_to_crop" src="#" alt="Image to crop" style="max-width: 100%; display: none;">
                            </div>
                        </div>

                        <script>
                            let cropper;

                            function previewImage(event) {
                                if (event.target.files.length === 0) {
                                    return;
                                }

                                var image = document.getElementById('image_to_crop');
                                var reader = new FileReader();

                                reader.onload = function () {
                                    image.src = reader.result;
                                    image.style.display = 'block';

                                    if (cropper) {
                                        cropper.destroy();
                                    }

                                    cropper = new Cropper(image, {
                                        aspectRatio: 1,
                                        viewMode: 1,
                                        autoCropArea: 0.8,
                                        minContainerWidth: 300,
                                        minContainerHeight: 300,
                                        responsive: true,
                                        crop(event) {

                                            document.getElementById('crop_x').value = event.detail.x;
                                            document.getElementById('crop_y').value = event.detail.y;
                                            document.getElementById('crop_width').value = event.detail.width;
                                            document.getElementById('crop_height').value = event.detail.height;
                                        }
                                    });
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }

                        </script>
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
                        <td class="text-center">
                            <!-- Botón Editar -->
                            <button type="button" class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editarProductoModal{{ $producto->id }}">
                                Editar
                            </button>

                            <!-- Botón Eliminar que abre el modal de confirmación -->
                            <button type="button" class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#confirmarRetiroModal{{ $producto->id }}">
                                Retirar
                            </button>
                        </td>

                        <!-- Modal de confirmación de retiro -->
                        <div class="modal fade" id="confirmarRetiroModal{{ $producto->id }}" tabindex="-1" aria-labelledby="confirmarRetiroModalLabel{{ $producto->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmarRetiroModalLabel{{ $producto->id }}">Confirmar retiro del producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Para confirmar el retiro del producto del catálogo, escribe: <strong>retirar {{ $producto->nombre }}</strong></p>
                                        <input type="text" class="form-control" id="confirmarRetiroInput{{ $producto->id }}" autocomplete="off" placeholder="Escribe aquí...">
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('productos.retirar', ['id' => $producto->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary" id="confirmarRetiroBtn{{ $producto->id }}" disabled>
                                                Retirar producto del catálogo
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const productoId = "{{ $producto->id }}";
                                const nombreProducto = "{{ $producto->nombre }}";
                                const inputRetiro = document.getElementById(`confirmarRetiroInput${productoId}`);
                                const botonRetiro = document.getElementById(`confirmarRetiroBtn${productoId}`);

                                inputRetiro.addEventListener("input", function () {
                                    if (inputRetiro.value.toLowerCase() === `retirar ${nombreProducto.toLowerCase()}`) {
                                        botonRetiro.disabled = false;
                                        botonRetiro.classList.remove("btn-secondary");
                                        botonRetiro.classList.add("btn-danger");
                                    } else {
                                        botonRetiro.disabled = true;
                                    }
                                });
                            });
                        </script>

                    </tr>

                    <div class="modal fade" id="editarProductoModal{{ $producto->id }}" tabindex="-1" aria-labelledby="editarProductoModalLabel{{ $producto->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editarProductoModalLabel{{ $producto->id }}">Editar Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('productos.update', ['id' => $producto->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">

                                        <!-- Nombre y Marca -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nombre_update" class="form-label">Nombre del Producto</label>
                                                <input type="text" class="form-control" id="nombre_update" name="nombre" value="{{ $producto->nombre }}" required>
                                            </div>
                                        </div>

                                        <!-- Descripción -->
                                        <div class="mb-3">
                                            <label for="descripcion_update" class="form-label">Descripción</label>
                                            <textarea class="form-control" id="descripcion_update" name="descripcion" rows="3" required>{{ $producto->descripcion }}</textarea>
                                        </div>

                                        <!-- Precios -->
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="precio_proveedor_update" class="form-label">Precio Proveedor</label>
                                                <input type="number" class="form-control" id="precio_proveedor_update" name="precio_proveedor" value="{{ $producto->precio_proveedor }}" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="precio_lista_update" class="form-label">Precio Lista</label>
                                                <input type="number" class="form-control" id="precio_lista_update" name="precio_lista" value="{{ $producto->precio_lista }}" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="precio_venta_update" class="form-label">Precio Venta</label>
                                                <input type="number" class="form-control" id="precio_venta_update" name="precio_venta" value="{{ $producto->precio_venta }}" required>
                                            </div>
                                        </div>

                                        <!-- Cantidad/Medida/Categoría -->
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="cantidad_update" class="form-label">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad_update" name="cantidad" value="{{ $producto->cantidad }}" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="medida_update" class="form-label">Medida</label>
                                                <select class="form-select" id="medida_update" name="medida">
                                                    <option disabled selected>Selecciona una medida...</option>
                                                    @foreach($medidas as $valor => $texto)
                                                        <option value="{{ $valor }}" {{ $producto->medida == $valor ? 'selected' : '' }}>{{ $texto }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="id_categoria_update" class="form-label">Categoría</label>
                                                <select class="form-select" id="id_categoria_update" name="id_categoria">
                                                    <option value="">Selecciona una categoría...</option>
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}" {{ $producto->id_categoria == $categoria->id ? 'selected' : '' }}>
                                                            {{ $categoria->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Stock y Estado -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="stock_update" class="form-label">Stock</label>
                                                <input type="number" class="form-control" id="stock_update" name="stock" value="{{ $producto->stock }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="estado_update" class="form-label">Estado</label>
                                                <select class="form-select" id="estado_update" name="estado" required>
                                                    <option value="activo" {{ $producto->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                                                    <option value="inactivo" {{ $producto->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Foto -->
                                        <div class="mb-3">
                                            <label for="main_photo_update{{ $producto->id }}" class="form-label">Foto Principal</label>
                                            <div class="d-flex align-items-center">
                                                <div class="photo-upload-btn position-relative">
                                                    <input type="file" class="form-control position-absolute top-0 start-0 opacity-0" id="main_photo_update{{ $producto->id }}" name="main_photo" accept="image/*" style="width: 100%; height: 100%;" onchange="previewImageUpdate(event, {{ $producto->id }})">
                                                    <input type="hidden" id="crop_x_update{{ $producto->id }}" name="crop_x">
                                                    <input type="hidden" id="crop_y_update{{ $producto->id }}" name="crop_y">
                                                    <input type="hidden" id="crop_width_update{{ $producto->id }}" name="crop_width">
                                                    <input type="hidden" id="crop_height_update{{ $producto->id }}" name="crop_height">
                                                    <div class="btn-circle">
                                                        <i class="fa fa-camera"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Contenedor para la imagen y el área de recorte -->
                                            <div class="mt-3">
                                                <img id="image_to_crop_update{{ $producto->id }}" src="#" alt="Image to crop" style="max-width: 100%; display: none;">
                                            </div>
                                        </div>

                                        <script>
                                            let cropperUpdate;

                                            function previewImageUpdate(event, productId) {
                                                if (event.target.files.length === 0) {
                                                    return;
                                                }

                                                var imageUpdate = document.getElementById('image_to_crop_update' + productId);
                                                var readerUpdate = new FileReader();

                                                readerUpdate.onload = function () {
                                                    imageUpdate.src = readerUpdate.result;
                                                    imageUpdate.style.display = 'block';

                                                    if (cropperUpdate) {
                                                        cropperUpdate.destroy();
                                                    }

                                                    cropperUpdate = new Cropper(imageUpdate, {
                                                        aspectRatio: 1,
                                                        crop(event) {
                                                            document.getElementById('crop_x_update' + productId).value = event.detail.x;
                                                            document.getElementById('crop_y_update' + productId).value = event.detail.y;
                                                            document.getElementById('crop_width_update' + productId).value = event.detail.width;
                                                            document.getElementById('crop_height_update' + productId).value = event.detail.height;
                                                        }
                                                    });
                                                };
                                                readerUpdate.readAsDataURL(event.target.files[0]);
                                            }
                                        </script>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach


                </tbody>
            </table>

            <!-- Paginación -->
            <div class="d-flex justify-content-between mt-3">
                {{ $productos->links('pagination::bootstrap-5') }}
            </div>


        </div>
    </div>
</div>
