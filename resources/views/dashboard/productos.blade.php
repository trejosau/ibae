<!-- Cropper.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

<!-- Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <h1 class="mb-4">Gestión de Productos</h1>

        <div class="d-flex mb-3">
            <!-- Botón de Agregar Producto -->
            <div class="input-group me-3">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#agregarProductoModal"
                        style="background-color: #4CAF50; border-color: #4CAF50; color: white; border-radius: 8px;">
                    <i class="bi bi-box" style="font-size: 1.5rem;"></i> <!-- Icono Agregar Producto -->
                    <span class="d-none d-sm-inline">Agregar Producto</span> <!-- Texto solo en pantallas grandes -->
                </button>
            </div>

            <!-- Botón de Agregar Categoría -->
            <div class="input-group me-3">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria"
                        style="background-color: #2196F3; border-color: #2196F3; color: white; border-radius: 8px 0 0 8px; border-right: 0;">
                    <i class="bi bi-folder-plus" style="font-size: 1.5rem;"></i> <!-- Icono Agregar Categoría -->
                    <span class="d-none d-sm-inline">Agregar Categoría</span> <!-- Texto solo en pantallas grandes -->
                </button>
                <!-- Botón de Ojo para Ver Categoría -->
                <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalVerCategoria"
                        style="border-radius: 0 8px 8px 0; background-color: #1976D2; border-left: 0;">
                    <i class="bi bi-eye" style="font-size: 1.5rem; color: white;"></i> <!-- Icono Ojo -->
                    <span class="d-none d-sm-inline">Ver Categoría</span> <!-- Texto solo en pantallas grandes -->
                </button>
            </div>

            <!-- Botón de Agregar Subcategoría -->
            <div class="input-group me-3">
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalAgregarSubcategoria"
                        style="background-color: #FF9800; border-color: #FF9800; color: white; border-radius: 8px;">
                    <i class="bi bi-tags" style="font-size: 1.5rem;"></i> <!-- Icono Agregar Subcategoría -->
                    <span class="d-none d-sm-inline">Agregar Subcategoría</span> <!-- Texto solo en pantallas grandes -->
                </button>
            </div>
        </div>



        <!-- Modal para Ver Categorías -->
        <div class="modal fade" id="modalVerCategoria" tabindex="-1" aria-labelledby="modalVerCategoriaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalVerCategoriaLabel">Ver Categorías y Subcategorías</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 60vh; overflow-y: auto;"> <!-- Agregado estilo para altura y scroll -->
                        @foreach ($categorias as $categoria)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $categoria->nombre }}</h5>
                                    <p class="card-text">{{ $categoria->descripcion }}</p>
                                    <p class="card-text">
                                        <strong>Subcategorías:</strong>
                                    @foreach ($categoria->subcategorias as $subcategoria)
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="badge bg-secondary" style="font-size: 1rem;">{{ $subcategoria->nombre }}</span>
                                            <!-- Botón de eliminar subcategoría -->
                                            <form action="{{ route('subcategorias.destroy', $subcategoria->id) }}" method="POST" class="ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                    <span class="d-none d-sm-inline">Eliminar</span> <!-- El texto solo se muestra en pantallas grandes -->
                                                </button>

                                            </form>
                                        </div>
                                        @endforeach
                                        </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>





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
                            <div class="col-12 col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
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
                            <div class="col-12 col-md-4 mb-3">
                                <label for="precio_proveedor" class="form-label">Precio Proveedor</label>
                                <input type="number" class="form-control" id="precio_proveedor" name="precio_proveedor" required>
                            </div>
                            <div class="col-12 col-md-4 mb-3">
                                <label for="precio_lista" class="form-label">Precio Lista</label>
                                <input type="number" class="form-control" id="precio_lista" name="precio_lista" required>
                            </div>
                            <div class="col-12 col-md-4 mb-3">
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
                            <div class="row">
                                <!-- Categoría -->
                                <div class="col-md-12 mb-3">
                                    <label for="id_categoria" class="form-label">Categoría</label>
                                    <select class="form-select" id="id_categoria" name="id_categoria">
                                        <option value="">Selecciona una categoría...</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Subcategoría 1 -->
                                <div class="col-md-4 mb-3">
                                    <label for="id_subcategoria_1" class="form-label">Subcategoría 1</label>
                                    <select class="form-select" id="select_subcategoria_1" name="select_subcategoria_1">
                                        <option value="">Selecciona una subcategoría...</option>
                                    </select>
                                    <input type="hidden" name="id_subcategoria_1" id="id_subcategoria_1">
                                </div>

                                <!-- Subcategoría 2 -->
                                <div class="col-md-4 mb-3">
                                    <label for="id_subcategoria_2" class="form-label">Subcategoría 2</label>
                                    <select class="form-select" id="select_subcategoria_2" name="select_subcategoria_2">
                                        <option value="">Selecciona una subcategoría...</option>
                                    </select>
                                    <input type="hidden" name="id_subcategoria_2" id="id_subcategoria_2">
                                </div>

                                <!-- Subcategoría 3 -->
                                <div class="col-md-4 mb-3">
                                    <label for="id_subcategoria_3" class="form-label">Subcategoría 3</label>
                                    <select class="form-select" id="select_subcategoria_3" name="select_subcategoria_3">
                                        <option value="">Selecciona una subcategoría...</option>
                                    </select>
                                    <input type="hidden" name="id_subcategoria_3" id="id_subcategoria_3">
                                </div>
                            </div>

                            <!-- Añadir jQuery -->
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                            <script>
                                $(document).ready(function() {
                                    var selectedSubcategorias = {
                                        '1': null,
                                        '2': null,
                                        '3': null
                                    };

                                    // Cargar subcategorías al cambiar la categoría
                                    $('#id_categoria').on('change', function() {
                                        var categoria_id = $(this).val();

                                        if (categoria_id) {
                                            $.ajax({
                                                url: '/dashboard/subcategorias/' + categoria_id, // Asegúrate de que esta URL sea correcta
                                                type: 'GET',
                                                dataType: 'json',
                                                success: function(subcategorias) {
                                                    // Limpiar selects de subcategorías
                                                    $('#select_subcategoria_1, #select_subcategoria_2, #select_subcategoria_3').empty();

                                                    // Agregar opción por defecto
                                                    $('#select_subcategoria_1, #select_subcategoria_2, #select_subcategoria_3').append(
                                                        $('<option>', { value: '', text: 'Selecciona una subcategoría...' })
                                                    );

                                                    // Llenar los selects con las subcategorías recibidas
                                                    $.each(subcategorias, function(index, subcategoria) {
                                                        $('#select_subcategoria_1, #select_subcategoria_2, #select_subcategoria_3').append(
                                                            $('<option>', {
                                                                value: subcategoria.id,
                                                                text: subcategoria.nombre
                                                            })
                                                        );
                                                    });

                                                    // Actualizar el estado de las opciones deshabilitadas
                                                    updateDisabledOptions();
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Error al cargar las subcategorías: ', error);
                                                }
                                            });
                                        } else {
                                            $('#select_subcategoria_1, #select_subcategoria_2, #select_subcategoria_3').empty();
                                        }
                                    });

                                    // Sincronizar selects de subcategorías con campos ocultos y deshabilitar globalmente opciones seleccionadas
                                    $('#select_subcategoria_1, #select_subcategoria_2, #select_subcategoria_3').on('change', function() {
                                        var selectId = $(this).attr('id');
                                        var selectNumber = selectId.split('_')[2];
                                        var selectedValue = $(this).val();

                                        // Actualizar valores en el objeto y campos ocultos
                                        selectedSubcategorias[selectNumber] = selectedValue || null;
                                        $('#id_subcategoria_' + selectNumber).val(selectedValue);

                                        // Actualizar el estado de las opciones deshabilitadas
                                        updateDisabledOptions();
                                    });

                                    // Deshabilitar opciones seleccionadas globalmente
                                    function updateDisabledOptions() {
                                        $('#select_subcategoria_1 option, #select_subcategoria_2 option, #select_subcategoria_3 option').each(function() {
                                            var optionValue = $(this).val();
                                            var isDisabled = Object.values(selectedSubcategorias).includes(optionValue) && optionValue !== '';
                                            $(this).prop('disabled', isDisabled);
                                        });
                                    }

                                    // Antes de enviar el formulario, sincronizar selects con los campos ocultos
                                    $('#form-producto').submit(function() {
                                        $('#select_subcategoria_1, #select_subcategoria_2, #select_subcategoria_3').each(function() {
                                            var selectId = $(this).attr('id');
                                            var selectNumber = selectId.split('_')[2];
                                            var selectedValue = $(this).val();
                                            $('#id_subcategoria_' + selectNumber).val(selectedValue);
                                        });
                                    });
                                });
                            </script>

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

    <!-- Modal para agregar Categoría -->
    <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarCategoriaLabel">Agregar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('categorias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Nombre de la Categoría -->
                        <div class="mb-3">
                            <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let cropperCategoria;

        function previewImageCategoria(event) {
            if (event.target.files.length === 0) {
                return;
            }

            var image = document.getElementById('image_to_crop_categoria');
            var reader = new FileReader();

            reader.onload = function () {
                image.src = reader.result;
                image.style.display = 'block';

                if (cropperCategoria) {
                    cropperCategoria.destroy();
                }

                cropperCategoria = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    minContainerWidth: 300,
                    minContainerHeight: 300,
                    responsive: true,
                    crop(event) {
                        document.getElementById('crop_x_categoria').value = event.detail.x;
                        document.getElementById('crop_y_categoria').value = event.detail.y;
                        document.getElementById('crop_width_categoria').value = event.detail.width;
                        document.getElementById('crop_height_categoria').value = event.detail.height;
                    }
                });
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


    <!-- Modal para agregar Subcategoría -->
    <div class="modal fade" id="modalAgregarSubcategoria" tabindex="-1" aria-labelledby="modalAgregarSubcategoriaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarSubcategoriaLabel">Agregar Subcategoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('subcategorias.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre_subcategoria" class="form-label">Nombre de la Subcategoría</label>
                            <input type="text" class="form-control" id="nombre_subcategoria" name="nombre_subcategoria" required>
                            <small class="form-text text-muted">Solo puedes tener un maximo de 3 subcategorías por categoría.</small>
                        </div>
                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoría</label>
                            <select class="form-select" id="categoria_id" name="categoria_id" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Tabla de productos -->
    <div class="card">
        <div class="card-header">Lista de Productos</div>
        <div class="card-body">
            <div class="table-responsive">
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
                                <img src="{{ $producto->main_photo }}" alt="{{ $producto->nombre }}" class="img-fluid" style="max-width: 50px; height: auto; object-fit: cover;">

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

                            @if($producto->estado == 'activo')
                                <!-- Botón Eliminar que abre el modal de confirmación -->
                                <button type="button" class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#confirmarRetiroModal{{ $producto->id }}">
                                    Retirar
                                </button>
                            @endif
                        </td>

                        <!-- Modal de confirmación de retiro -->
                        <div class="modal fade" id="confirmarRetiroModal{{ $producto->id }}" tabindex="-1" aria-labelledby="confirmarRetiroModalLabel{{ $producto->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmarRetiroModalLabel{{ $producto->id }}">Confirmar retiro del producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body text-center">
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
                    </tr>




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

                                <!-- Subcategorías -->
                                <div class="mb-4">
                                    <label for="subcategorias{{ $producto->id }}" class="form-label fs-5">Subcategorías</label>
                                    <div class="mb-3">
                                        <!-- Subcategorías asignadas -->
                                        <div class="d-flex flex-wrap gap-3">
                                            @foreach($producto->subcategoria as $subcategoria)
                                                <span class="badge bg-primary d-flex align-items-center gap-2 mb-2">
                    {{ $subcategoria->nombre }}
                    <form action="{{ route('productos.subcategoria.destroy', ['producto' => $producto->id, 'subcategoria' => $subcategoria->id]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" style="border: none; padding: 0.2rem 0.4rem;" title="Eliminar subcategoría">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Agregar subcategorías (ocultar si ya hay 3 subcategorías) -->
                                    <div class="mb-3">
                                        <label for="subcategorias{{ $producto->id }}" class="form-label fs-5">Agregar subcategorías</label>
                                        @if($producto->subcategoria->count() < 3) <!-- Mostrar solo si hay menos de 3 subcategorías -->
                                        <form action="{{ route('productos.subcategoria.agregar', ['producto' => $producto->id]) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <select class="form-select" id="subcategorias{{ $producto->id }}" name="subcategorias" required>
                                                    <option value="">Selecciona una subcategoría...</option>
                                                    @foreach($subcategorias as $subcategoria)
                                                        @if(!$producto->subcategoria->contains('id', $subcategoria->id)) <!-- Excluir subcategorías ya asignadas -->
                                                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-success" style="border-radius: 0 0.25rem 0.25rem 0;">
                                                    <i class="fa fa-plus"></i> Agregar
                                                </button>
                                            </div>
                                        </form>
                                        @else
                                            <p class="text-muted">Ya tienes 3 subcategorías asignadas.</p>
                                        @endif
                                    </div>
                                </div>
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
