<div class="container my-4">
    <h2 class="text-center mb-4">Gestión de Módulos y Temas</h2>

    <a href="{{ route('ligarTemasModulo') }}" class="btn btn-primary mb-4">Plan de estudios</a>

 <!-- Filtro por Categoría -->
 <form action="{{ route('plataforma.lista-modulos') }}" method="GET">
    <div class="mb-4">
        <label for="categoryFilter" class="form-label">Filtrar por Categoría</label>
        <select class="form-select" name="categoria" id="categoryFilter" onchange="this.form.submit()">
            <option value="">Todas</option>
            <option value="barberia" {{ request('categoria') == 'barberia' ? 'selected' : '' }}>Barbería</option>
            <option value="belleza" {{ request('categoria') == 'belleza' ? 'selected' : '' }}>Belleza</option>
        </select>
    </div>
</form>

    <div class="row">
      
        <div class="col-md-6">
            <h3>Lista de Módulos</h3>
            <button type="button" class="btn btn-primary botoncin-ca" data-bs-toggle="modal" data-bs-target="#modalAgregarModulo">
                Agregar Módulo
            </button>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col">Nombre del Módulo</th>
                    <th scope="col" class="text-center">Categorías</th>
                    <th scope="col" class="text-center">Duración</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($modulos as $categoria => $moduloCollection)
                    @foreach ($moduloCollection as $modulo)
                        <tr>
                            <td>{{ $modulo->nombre }}</td>
                            <td>{{ $modulo->categoria }}</td>
                            <td>{{ $modulo->duracion }} Horas</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarModulo-{{ $modulo->id }}">Modificar</button>
                                    <form action="{{ route('plataforma.eliminarModulo', $modulo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este módulo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Temas -->
        <div class="col-md-6">
            <h3>Lista de Temas</h3>
            <button type="button" class="btn btn-primary botoncin-ca" data-bs-toggle="modal" data-bs-target="#modalAgregarTema">
                Agregar Tema
            </button>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nombre del Tema</th>
                        <th scope="col" class="text-center">Descripción</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($temas as $tema)
                    <tr>
                        <td>{{ $tema->nombre }}</td>
                        <td style="width: 300px;">{{ $tema->descripcion }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarTema{{ $tema->id }}">Modificar</button>
                                <form action="{{ route('plataforma.eliminarTema', $tema->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este tema?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
</div>

<!-- Modal para Editar Módulo -->
@foreach ($modulos as $categoria => $moduloCollection)
    @foreach ($moduloCollection as $modulo)
    <div class="modal fade" id="modalEditarModulo-{{ $modulo->id }}" tabindex="-1" aria-labelledby="modalEditarModuloLabel-{{ $modulo->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarModuloLabel-{{ $modulo->id }}">Editar Módulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('plataforma.actualizarModulo', $modulo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="moduleName-{{ $modulo->id }}" class="form-label">Nombre del Módulo</label>
                            <input type="text" name="nombre" class="form-control" id="moduleName-{{ $modulo->id }}" value="{{ $modulo->nombre }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="moduleCategory-{{ $modulo->id }}" class="form-label">Categoría</label>
                            <select name="categoria" class="form-select" id="moduleCategory-{{ $modulo->id }}" required>
                                <option value="barberia" {{ $modulo->categoria == 'barberia' ? 'selected' : '' }}>Barbería</option>
                                <option value="belleza" {{ $modulo->categoria == 'belleza' ? 'selected' : '' }}>Belleza</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="moduleDuration-{{ $modulo->id }}" class="form-label">Duración (Horas)</label>
                            <input type="number" name="duracion" class="form-control" id="moduleDuration-{{ $modulo->id }}" value="{{ $modulo->duracion }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endforeach

<!-- Modal para Editar Tema -->
@foreach ($temas as $tema)
<div class="modal fade" id="modalEditarTema{{ $tema->id }}" tabindex="-1" aria-labelledby="modalEditarTemaLabel{{ $tema->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarTemaLabel{{ $tema->id }}">Editar Tema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('plataforma.actualizarTema', $tema->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editThemeName{{ $tema->id }}" class="form-label">Nombre del Tema</label>
                        <input type="text" name="nombre" class="form-control" id="editThemeName{{ $tema->id }}" value="{{ $tema->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editThemeDescription{{ $tema->id }}" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="editThemeDescription{{ $tema->id }}" required>{{ $tema->descripcion }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
