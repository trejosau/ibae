<div>
    <div class="container py-5">
        <!-- Enlace Volver a la tienda -->
        <div class="mb-3">
            <a href="/tienda" class="back-link">← Volver a la tienda</a>
        </div>

        <div class="row justify-content-center mb-4">
            <!-- Barra de búsqueda centrada -->
            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    <div class="search-bar-container rounded-pill">
                        <input id="busqueda" 
                               wire:model.live="busqueda" 
                               type="text" 
                               class="form-control search-bar"
                               placeholder="Buscar productos...">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Filtros -->
            <div class="col-md-3">
                <div class="mb-4">
                    <label for="categoriaFiltro" class="form-label">Categorías</label>
                    <select id="categoriaFiltro" wire:model.live="categoriaSeleccionada" class="form-select shadow">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
        
                <!-- Filtro de subcategorías -->
                <div class="mb-4" x-data>
                    <label for="subcategoriaFiltro" class="form-label">Subcategorías</label>
                    <select id="subcategoriaFiltro" wire:model.live="subcategoriaSeleccionada" class="form-select shadow">
                        <option value="">Todas las subcategorías</option>
                        @foreach($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="precioMin" class="form-label">Precio mínimo</label>
                    <input id="precioMin" wire:model.live.debounce="precioMin" type="number" class="form-control mb-2" placeholder="Mínimo" min="0">
                    
                    <label for="precioMax" class="form-label">Precio máximo</label>
                    <input id="precioMax" wire:model.live.debounce="precioMax" type="number" class="form-control" placeholder="Máximo" min="0">
                </div>

                <div class="mb-4">
                    <label for="disponibilidad" class="form-label">Disponibilidad</label>
                    <select id="disponibilidad" wire:model.live="disponibilidad" class="form-select">
                        <option value="">Todas</option>
                        <option value="1">En stock</option>
                        <option value="0">Agotado</option>
                    </select>
                </div>

                <div>
                    <label for="ordenarPor" class="form-label">Ordenar por</label>
                    <select id="ordenarPor" wire:model.live="ordenarPor" class="form-select">
                        <option value="">Selecciona</option>
                        <option value="mas_nuevo">Más nuevo</option>
                        <option value="mas_vendido">Más vendido</option>
                        <option value="precio_mas_alto">Precio más alto</option>
                        <option value="precio_mas_bajo">Precio más bajo</option>
                    </select>
                </div>
            </div>

            <!-- Productos -->
            <div class="col-md-9">
                <div class="row g-4">
                    @forelse($productos as $producto)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow border-0" style="background-color: #f9f9f9; border-radius: 10px;">
                                <div class="ratio ratio-1x1" style="overflow: hidden; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                    <a href="{{ route('producto.detalle', $producto->id) }}" class="shadow-sm border-0">
                                        <img src="{{ $producto->main_photo }}" alt="{{ $producto->nombre }}" class="card-img-top" style="object-fit: cover;">
                                    </a>
                                </div>
                                <div class="card-body d-flex flex-column p-3">
                                    <h5 class="card-title text-truncate text-dark">{{ $producto->nombre }}</h5>
                                    <p class="card-text text-muted text-truncate">{{ Str::limit($producto->descripcion, 80) }}</p>
                                    @if (auth()->check() && auth()->user()->Persona?->Estudiante)
                                    <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_lista, 2) }}</p>
                                    <small class="text-muted">Descuento: -${{ $producto->precio_venta - $producto->precio_lista }}</small>
                                    @else
                                    <p class="card-text text-danger fw-bold mb-4 precio">Precio: ${{ number_format($producto->precio_venta, 2) }}</p>
                                    @endif
                                    </a>
                                    <p>En stock:
                                        <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $producto->stock }}
                                        </span>
                                    </p>
                                    <div class="mt-auto">
                                        <form id="agregar-carrito-form">
                                            @csrf
                                            <input type="hidden" name="cantidad" id="cantidad-input" value="1" />
                                            <button type="button" class="btn btn-agg btn-lg fw-bold mt-3"
                                                    aria-label="Agregar {{ $producto->nombre }} al carrito"
                                                    onclick="agregarAlCarrito({{ $producto->id }})">
                                                <i class="fas fa-shopping-cart"></i> Agregar al carrito
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Mensaje mejorado para filtros vacíos -->
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                No se encontraron productos para los filtros seleccionados. <br>
                                Intenta con diferentes opciones.
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-5">
                    {{ $productos->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>





<script>

function agregarAlCarrito(productoId) {
            const cantidad = document.getElementById('cantidad-input').value;
            const token = document.querySelector('input[name="_token"]').value;

            fetch(`/producto/${productoId}/agregar-al-carrito`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ cantidad: cantidad })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    actualizarTotalCarrito();
                    cargarContenidoCarrito();
                    mostrarMensaje('Producto agregado al carrito', 'exito');
                } else {
                    mostrarMensaje('Hubo un problema al agregar el producto al carrito', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                mostrarMensaje('Error al procesar la solicitud', 'error');
            });
        }

        function mostrarMensaje(mensaje, tipo) {
            const mensajeDiv = document.createElement('div');
            mensajeDiv.className = `mensaje-ajax ${tipo}`;
            mensajeDiv.textContent = mensaje;

            document.body.appendChild(mensajeDiv);

            // Activa la animación después de un breve retraso
            setTimeout(() => {
                mensajeDiv.classList.add('show');
            }, 10);

            // Elimina el mensaje después de 3 segundos
            setTimeout(() => {
                mensajeDiv.remove();
            }, 3000);
        }
</script>