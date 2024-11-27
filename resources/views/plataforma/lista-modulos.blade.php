<div class="container my-4">
    <h2 class="text-center mb-4">Gestión de Módulos y Temas</h2>
    
    <div class="row">
        <!-- Módulos -->
        <div class="col-md-6">
            <h3 class="titulito mb-4 text-center">Lista de Módulos</h3>
            <div class="text-center mb-3">
                <form action="{{ route('plataforma.lista-modulos') }}" method="GET" class="mb-4">
                    <label for="categoryFilter" class="form-label">Filtrar por Categoría</label>
                    <select class="form-select" name="categoria" id="categoryFilter" onchange="this.form.submit()">
                        <option value="">Todas</option>
                        <option value="barberia" {{ request('categoria') == 'barberia' ? 'selected' : '' }}>Barbería</option>
                        <option value="belleza" {{ request('categoria') == 'belleza' ? 'selected' : '' }}>Belleza</option>
                    </select>
                </form>
                <button type="button" class="btn botoncin-ca" data-bs-toggle="modal" data-bs-target="#modalAgregarModulo" 
                        style="padding: 10px 20px; background-color: #6A4E77; color: white; border: none; border-radius: 8px;">
                    Agregar Módulo
                </button>
            </div>
            
            <div class="module-list">
                @forelse ($modulos as $modulo)
                    <div class="card shadow-sm mb-3" style="border: none; background-color: #F9F7FB; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #6A4E77;">{{ $modulo->nombre }}</h5>
                            <p class="card-text" style="color: #8C7A71;"><strong>Categoría:</strong> {{ $modulo->categoria }}</p>
                            <p class="card-text" style="color: #8C7A71;"><strong>Duración:</strong> {{ $modulo->duracion }} Horas</p>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarModulo-{{ $modulo->id }}" style="background-color: #C9A3BE; color: white; border: none;">Modificar</button>
                                <form action="{{ route('plataforma.eliminarModulo', $modulo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este módulo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="background-color: #D2968E; border: none;">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center" style="color: #8C7A71;">No hay módulos disponibles.</p>
                @endforelse
        
                @if ($modulos->hasPages())
                <nav aria-label="Page navigation" style="margin-top: 20px;">
                    <ul style="display: flex; justify-content: center; list-style: none; padding: 0;">
                        {{-- Botón de página anterior --}}
                        @if ($modulos->onFirstPage())
                            <li style="margin: 0 5px;">
                                <span style="display: inline-block; padding: 10px 15px; color: #ccc; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">&laquo;</span>
                            </li>
                        @else
                            <li style="margin: 0 5px;">
                                <a href="{{ $modulos->appends(['temas_page' => $temas->currentPage()])->previousPageUrl() }}" rel="prev" 
                                   style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                    &laquo;
                                </a>
                            </li>
                        @endif
            
                        {{-- Números de página (máximo 3 botones) --}}
                        @foreach (range(max(1, $modulos->currentPage() - 1), min($modulos->lastPage(), $modulos->currentPage() + 1)) as $page)
                            @if ($page == $modulos->currentPage())
                                <li style="margin: 0 5px;">
                                    <span style="display: inline-block; padding: 10px 15px; color: #fff; background-color: #007bff; border: 1px solid #007bff; border-radius: 5px;">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li style="margin: 0 5px;">
                                    <a href="{{ $modulos->appends(['temas_page' => $temas->currentPage()])->url($page) }}" 
                                       style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
            
                        {{-- Botón de página siguiente --}}
                        @if ($modulos->hasMorePages())
                            <li style="margin: 0 5px;">
                                <a href="{{ $modulos->appends(['temas_page' => $temas->currentPage()])->nextPageUrl() }}" rel="next" 
                                   style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                    &raquo;
                                </a>
                            </li>
                        @else
                            <li style="margin: 0 5px;">
                                <span style="display: inline-block; padding: 10px 15px; color: #ccc; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif            
            </div>
        </div>

        <!-- Temas -->
        <div class="col-md-6">
            <h3 class="titulito mb-4 text-center" style="padding-bottom: 90px">Lista de Temas</h3>
            <div class="text-center mb-3" style="padding-bottom: 5px">
                <button type="button" class="btn botoncin-ca " data-bs-toggle="modal" data-bs-target="#modalAgregarTema" style="padding: 10px 20px;  background-color: #6A4E77; color: white; border: none; border-radius: 8px;">
                    Agregar Tema
                </button>
            </div>
            <div class="topic-list">
                @foreach($temas as $tema)
                    <div class="card shadow-sm mb-3" style="border: none; background-color: #F9F7FB; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #6A4E77;">{{ $tema->nombre }}</h5>
                            <p class="card-text" style="color: #8C7A71;"><strong>Descripción:</strong> {{ $tema->descripcion }}</p>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarTema{{ $tema->id }}" style="background-color: #C9A3BE; color: white; border: none;">Modificar</button>
                                <form action="{{ route('plataforma.eliminarTema', $tema->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este tema?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="background-color: #D2968E; border: none;">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach


                @if ($temas->hasPages())
                <nav aria-label="Page navigation" style="margin-top: 20px;">
                    <ul style="display: flex; justify-content: center; list-style: none; padding: 0;">
                        {{-- Botón de página anterior --}}
                        @if ($temas->onFirstPage())
                            <li style="margin: 0 5px;">
                                <span style="display: inline-block; padding: 10px 15px; color: #ccc; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">&laquo;</span>
                            </li>
                        @else
                            <li style="margin: 0 5px;">
                                <a href="{{ $temas->previousPageUrl() }}" rel="prev" 
                                   style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                    &laquo;
                                </a>
                            </li>
                        @endif
            
                        {{-- Números de página (solo 3 botones) --}}
                        @php
                            $currentPage = $temas->currentPage();
                            $lastPage = $temas->lastPage();
                            $start = max(1, $currentPage - 1); // Página inicial
                            $end = min($lastPage, $currentPage + 1); // Página final
                        @endphp
            
                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page == $currentPage)
                                <li style="margin: 0 5px;">
                                    <span style="display: inline-block; padding: 10px 15px; color: #fff; background-color: #007bff; border: 1px solid #007bff; border-radius: 5px;">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li style="margin: 0 5px;">
                                    <a href="{{ $temas->url($page) }}" 
                                       style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endfor
            
                        {{-- Botón de página siguiente --}}
                        @if ($temas->hasMorePages())
                            <li style="margin: 0 5px;">
                                <a href="{{ $temas->nextPageUrl() }}" rel="next" 
                                   style="display: inline-block; padding: 10px 15px; color: #007bff; background-color: #fff; border: 1px solid #ddd; border-radius: 5px; text-decoration: none;">
                                    &raquo;
                                </a>
                            </li>
                        @else
                            <li style="margin: 0 5px;">
                                <span style="display: inline-block; padding: 10px 15px; color: #ccc; background-color: #f5f5f5; border: 1px solid #ddd; border-radius: 5px;">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif              
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar Módulo -->
<div class="modal fade" id="modalAgregarModulo" tabindex="-1" aria-labelledby="modalAgregarModuloLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarModuloLabel">Agregar Módulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('plataforma.crearModulo') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="moduleName" class="form-label">Nombre del Módulo</label>
                        <input type="text" name="nombre" class="form-control" id="moduleName" required>
                    </div>
                    <div class="mb-3">
                        <label for="moduleCategory" class="form-label">Categoría</label>
                        <select name="categoria" class="form-select" id="moduleCategory" required>
                            <option value="" selected disabled>Selecciona una categoría</option>
                            <option value="barberia">Barbería</option>
                            <option value="belleza">Belleza</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="moduleDuration" class="form-label">Duración (Horas)</label>
                        <input type="number" name="duracion" class="form-control" id="moduleDuration" required>
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

<!-- Modal para agregar Tema -->
<div class="modal fade" id="modalAgregarTema" tabindex="-1" aria-labelledby="modalAgregarTemaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarTemaLabel">Agregar Tema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('plataforma.crearTema') }}" method="POST" onsubmit="return validarFormulario();">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="themeName" class="form-label">Nombre del Tema</label>
                        <input type="text" name="nombre" class="form-control" id="themeName" required>
                    </div>
                    <div class="mb-3">
                        <label for="themeDescription" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="themeDescription" required maxlength="100" oninput="contarCaracteres();"></textarea>
                        <div id="caracteresRestantes" class="form-text">100 caracteres restantes</div>
                        <div id="errorDescripcion" class="text-danger" style="display: none;">Excede el máximo de caracteres permitidos.</div>
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

<!-- Modal para Editar Módulo -->
@foreach($modulos as $modulo)
<div class="modal fade" id="modalEditarModulo-{{ $modulo->id }}" tabindex="-1" aria-labelledby="modalEditarModuloLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarModuloLabel">Editar Módulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('plataforma.modificarModulo', $modulo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="moduleName" class="form-label">Nombre del Módulo</label>
                        <input type="text" name="nombre" class="form-control" id="moduleName" value="{{ $modulo->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="moduleCategory" class="form-label">Categoría</label>
                        <select name="categoria" class="form-select" id="moduleCategory" required>
                            <option value="barberia" {{ $modulo->categoria == 'barberia' ? 'selected' : '' }}>Barbería</option>
                            <option value="belleza" {{ $modulo->categoria == 'belleza' ? 'selected' : '' }}>Belleza</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="moduleDuration" class="form-label">Duración (Horas)</label>
                        <input type="number" name="duracion" class="form-control" id="moduleDuration" value="{{ $modulo->duracion }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach






<script>
    function ajustarAlturaCategorias() {
        const categoryCards = document.querySelectorAll('.card-body');

        if (categoryCards.length === 0) return;

        let maxAltura = 0;

        categoryCards.forEach(card => {
            const alturaActual = card.offsetHeight;
            if (alturaActual > maxAltura) {
                maxAltura = alturaActual;
            }
        });

        categoryCards.forEach(card => {
            card.style.height = maxAltura + 'px';
        });
    }

    // Reajusta cuando la página esté cargada
    document.addEventListener('DOMContentLoaded', ajustarAlturaCategorias);

    // Reajusta al redimensionar la ventana
    window.addEventListener('resize', ajustarAlturaCategorias);
</script>