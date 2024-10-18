@php
    $usuarios = [
        (object)[ 'id' => 1, 'nombre_completo' => 'Juan Pérez', 'tipo_usuario' => 'comprador', 'estado' => 'activo' ],
        (object)[ 'id' => 2, 'nombre_completo' => 'María López', 'tipo_usuario' => 'estilista', 'estado' => 'activo' ],
        (object)[ 'id' => 3, 'nombre_completo' => 'Carlos García', 'tipo_usuario' => 'administrador', 'estado' => 'inactivo' ],
        (object)[ 'id' => 4, 'nombre_completo' => 'Laura Martínez', 'tipo_usuario' => 'alumno', 'estado' => 'activo' ],
        (object)[ 'id' => 5, 'nombre_completo' => 'Luis Torres', 'tipo_usuario' => 'profesor', 'estado' => 'activo' ],
    ];
@endphp

<div class="usuarios-section">
    <h2 class="text-center mb-4">Gestión de Usuarios</h2>

    <!-- Barra de Búsqueda -->
    <div class="mb-3">
        <input type="text" class="form-control" placeholder="Buscar usuarios..." id="searchInputUsuarios">
    </div>

    <!-- Tabla de Usuarios -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-primary h-100 mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <i class="fas fa-users fa-2x text-primary"></i> Lista de Usuarios
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <th>Nombre Completo</th>
                                <th>Tipo de Usuario</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->nombre_completo }}</td>
                                    <td>{{ ucfirst($usuario->tipo_usuario) }}</td>
                                    <td>{{ ucfirst($usuario->estado) }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal-editar-usuario-{{ $usuario->id }}">Modificar</button>
                                        <button class="btn btn-danger btn-sm" onclick="eliminarUsuario({{ $usuario->id }})">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar-usuario">Agregar Usuario</button>
                        <button class="btn btn-success" id="exportExcelBtn">
                            <i class="fas fa-file-excel"></i> Exportar a Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Usuario -->
    <div class="modal fade" id="modal-agregar-usuario" tabindex="-1" aria-labelledby="modal-agregar-usuario-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-agregar-usuario-label">Agregar Nuevo Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarUsuario">
                        <div class="mb-3">
                            <label for="nombre-completo" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre-completo" placeholder="Ingrese el nombre completo" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo-usuario" class="form-label">Tipo de Usuario</label>
                            <select class="form-select" id="tipo-usuario" required>
                                <option value="comprador">Comprador</option>
                                <option value="estilista">Estilista</option>
                                <option value="administrador">Administrador</option>
                                <option value="alumno">Alumno</option>
                                <option value="profesor">Profesor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregarUsuario()">Guardar Usuario</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Usuario -->
    @foreach($usuarios as $usuario)
        <div class="modal fade" id="modal-editar-usuario-{{ $usuario->id }}" tabindex="-1" aria-labelledby="modal-editar-usuario-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-editar-usuario-label">Modificar Usuario - {{ $usuario->nombre_completo }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarUsuario-{{ $usuario->id }}">
                            <div class="mb-3">
                                <label for="nombre-completo-{{ $usuario->id }}" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre-completo-{{ $usuario->id }}" value="{{ $usuario->nombre_completo }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo-usuario-{{ $usuario->id }}" class="form-label">Tipo de Usuario</label>
                                <select class="form-select" id="tipo-usuario-{{ $usuario->id }}" required>
                                    <option value="comprador" {{ $usuario->tipo_usuario === 'comprador' ? 'selected' : '' }}>Comprador</option>
                                    <option value="estilista" {{ $usuario->tipo_usuario === 'estilista' ? 'selected' : '' }}>Estilista</option>
                                    <option value="administrador" {{ $usuario->tipo_usuario === 'administrador' ? 'selected' : '' }}>Administrador</option>
                                    <option value="alumno" {{ $usuario->tipo_usuario === 'alumno' ? 'selected' : '' }}>Alumno</option>
                                    <option value="profesor" {{ $usuario->tipo_usuario === 'profesor' ? 'selected' : '' }}>Profesor</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="estado-{{ $usuario->id }}" class="form-label">Estado</label>
                                <select class="form-select" id="estado-{{ $usuario->id }}" required>
                                    <option value="activo" {{ $usuario->estado === 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ $usuario->estado === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" onclick="guardarCambiosUsuario({{ $usuario->id }})">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    // Funcionalidad de la barra de búsqueda para usuarios
    const searchInputUsuarios = document.getElementById('searchInputUsuarios');
    searchInputUsuarios.addEventListener('input', function () {
        const filter = searchInputUsuarios.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const nombre = row.cells[0].textContent.toLowerCase();
            if (nombre.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Simulación de controladores
    function agregarUsuario() {
        const nombreCompleto = document.getElementById('nombre-completo').value;
        const tipoUsuario = document.getElementById('tipo-usuario').value;
        const estado = document.getElementById('estado').value;
        console.log('Agregar usuario:', nombreCompleto, tipoUsuario, estado);
        // Aquí va la lógica para agregar un usuario
    }

    function eliminarUsuario(id) {
        console.log('Eliminar usuario con ID:', id);
        // Aquí va la lógica para eliminar un usuario
    }

    function guardarCambiosUsuario(id) {
        const nombreCompleto = document.getElementById(`nombre-completo-${id}`).value;
        const tipoUsuario = document.getElementById(`tipo-usuario-${id}`).value;
        const estado = document.getElementById(`estado-${id}`).value;
        console.log('Guardar cambios para usuario ID:', id, nombreCompleto, tipoUsuario, estado);
        // Aquí va la lógica para guardar cambios
    }
</script>
