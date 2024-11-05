<div class="container my-4"> 
    <h2 class="text-center mb-4">Gestión de Módulos y Temas</h2>

    <a href="{{ route('ligarTemasModulo') }}" class="btn btn-primary">Plan de estudios</a>

    <!-- Filtro por Categoría -->
    <div class="mb-4">
        <label for="categoryFilter" class="form-label">Filtrar por Categoría</label>
        <select class="form-select" id="categoryFilter">
            <option selected>Todas</option>
            <option value="barberia">Barbería</option>
            <option value="belleza">Belleza</option>
        </select>
    </div>

    <div class="row">
        <!-- Módulos -->
        <div class="col-md-6">
            <h3>Lista de Módulos</h3>
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
                    @foreach ($modulos as $modulo)
                    <tr>
                        <td>{{ $modulo->nombre }}</td>
                        <td>{{ $modulo->categoria }}</td>
                        <td>{{ $modulo->duracion }} Horas</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <form action="{{ route('plataforma.modificarModulo', $modulo->id) }}" method="GET">
                                    <button type="submit" class="btn btn-secondary btn-sm">Modificar</button>
                                </form>
                                <form action="{{ route('plataforma.eliminarModulo', $modulo->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este módulo?');">
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarModulo">
                Agregar Módulo
            </button>
        </div>

        <!-- Temas -->
        <div class="col-md-6">
            <h3>Lista de Temas</h3>
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
                                <form action="{{ route('plataforma.modificarTema', $tema->id) }}" method="GET">
                                    <button type="submit" class="btn btn-secondary btn-sm">Modificar</button>
                                </form>
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarTema">
                Agregar Tema
            </button>
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
                <form action="{{ route('plataforma.crearTema') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="themeName" class="form-label">Nombre del Tema</label>
                            <input type="text" name="nombre" class="form-control" id="themeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="themeDescription" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" id="themeDescription" required maxlength="100"></textarea>
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

    <!-- Modal para modificar Módulo -->
    <div class="modal fade" id="editModuleModal" tabindex="-1" aria-labelledby="editModuleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModuleModalLabel">Modificar Módulo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('plataforma.modificarModulo', 'ID_MODULO') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editModuleName" class="form-label">Nombre del Módulo</label>
                            <input type="text" name="nombre" class="form-control" id="editModuleName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editModuleCategory" class="form-label">Categoría</label>
                            <select name="categoria" class="form-select" id="editModuleCategory" required>
                                <option value="" selected disabled>Selecciona una categoría</option>
                                <option value="barberia">Barbería</option>
                                <option value="belleza">Belleza</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editModuleDuration" class="form-label">Duración (Horas)</label>
                            <input type="number" name="duracion" class="form-control" id="editModuleDuration" required>
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

    <!-- Modal para modificar Tema -->
    <div class="modal fade" id="editThemeModal" tabindex="-1" aria-labelledby="editThemeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editThemeModalLabel">Modificar Tema</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('plataforma.modificarTema', 'ID_TEMA') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editThemeName" class="form-label">Nombre del Tema</label>
                            <input type="text" name="nombre" class="form-control" id="editThemeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editThemeDescription" class="form-label">Descripción</label>
                            <textarea name="descripcion" class="form-control" id="editThemeDescription" required maxlength="100"></textarea>
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



<script>n = document.getElementById('themeDescription').value;
        const errorDescripcion = document.getElementById('errorDescripcion');
        const maxCaracteres = 100; // Cambia este valor al máximo que necesites

        // Comprobar si la descripción excede el máximo de caracteres
        if (descripcion.length > maxCaracteres) {
            errorDescripcion.style.display = 'block'; // Muestra el mensaje de error
            return false; // Evita el envío del formulario
        } else {
        
    function validarFormulario() {
        const descripcio    errorDescripcion.style.display = 'none'; // Oculta el mensaje de error
            return true; // Permite el envío del formulario
        }
    }
    function contarCaracteres() {
    const descripcion = document.getElementById('themeDescription').value;
    const caracteresRestantes = document.getElementById('caracteresRestantes');
    const maxCaracteres = 100; // Cambia este valor al máximo que necesites

    // Actualiza el texto de caracteres restantes
    caracteresRestantes.innerText = (maxCaracteres - descripcion.length) + " caracteres restantes";

    // Comprobar si la descripción excede el máximo de caracteres
    const errorDescripcion = document.getElementById('errorDescripcion');
    if (descripcion.length > maxCaracteres) {
        errorDescripcion.style.display = 'block'; // Muestra el mensaje de error
    } else {
        errorDescripcion.style.display = 'none'; // Oculta el mensaje de error
    }
}

function validarFormulario() {
    const descripcion = document.getElementById('themeDescription').value;
    const errorDescripcion = document.getElementById('errorDescripcion');
    const maxCaracteres = 100; // Cambia este valor al máximo que necesites

    // Comprobar si la descripción excede el máximo de caracteres
    if (descripcion.length > maxCaracteres) {
        errorDescripcion.style.display = 'block'; // Muestra el mensaje de error
        return false; // Evita el envío del formulario
    } else {
        errorDescripcion.style.display = 'none'; // Oculta el mensaje de error
        return true; // Permite el envío del formulario
    }
}
</script>