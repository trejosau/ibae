<div class="container mt-4">
    <h2 class="text-center">Gestión de Usuarios</h2>

    <!-- Botón para abrir el modal de agregar usuario -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fas fa-user-plus"></i> Agregar Usuario
    </button>

    <!-- Tabla de usuarios -->
    <table class="table table-dark table-bordered table-hover">
        <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->persona->nombre ?? '' }} {{ $usuario->persona->ap_paterno ?? '' }} {{ $usuario->persona->ap_materno ?? '' }}</td>
                <td>{{ $usuario->username }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    @foreach($usuario->roles as $role)
                        <span class="badge bg-info text-dark">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar Roles</a>
                    <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Modal para agregar usuario -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="inputFirstName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="inputFirstName" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputLastNameP" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="inputLastNameP" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputLastNameM" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="inputLastNameM">
                        </div>
                        <div class="mb-3">
                            <label for="inputPhone" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="inputPhone">
                        </div>
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="inputUsername" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="inputEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="inputPassword" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ver detalles del usuario (contenido de ejemplo) -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="viewUserModalLabel">Detalles del Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Aquí puedes mostrar más detalles del usuario seleccionado.</p>
                    <!-- Ejemplo de campos -->
                    <p><strong>Nombre Completo:</strong> Juan Pérez</p>
                    <p><strong>Email:</strong> juan.perez@example.com</p>
                    <p><strong>Roles:</strong> Admin, Editor</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
