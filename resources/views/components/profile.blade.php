@extends('layouts.app')


        @section('content')
            @php
                // Simulación de datos del usuario
                $usuario = [
                    'nombre_completo' => 'Juan Pérez',
                    'email' => 'juan.perez@example.com',
                    'telefono' => '123-456-7890',
                    'direccion' => 'Calle Falsa 123',
                    'foto' => 'https://th.bing.com/th/id/OIP.ptWtXRl15WkFas1-030N0gHaEJ?rs=1&pid=ImgDetMain',
                    'dos_factor' => false,
                    'roles' => ['Usuario', 'Administrador'],
                ];
            @endphp

<div class="container-fluid mt-5">
        <div class="row">
            <!-- Aside de Navegación -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark text-light sidebar">
                <div class="position-sticky">
                    <h4 class="text-center mt-3">Mi Perfil</h4>
                    <div class="text-center mb-3">
                        <h5 class="text-light">{{ $usuario['nombre_completo'] }}</h5>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#" onclick="cargarContenido('informacion')">Información</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#" onclick="cargarContenido('configuracion')">Configuración</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#" onclick="cargarContenido('roles')">Mis Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#" onclick="cargarContenido('2fa')">{{ $usuario['dos_factor'] ? 'Deshabilitar 2FA' : 'Habilitar 2FA' }}</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido Principal -->
            <main class="col-md-9  col-lg-10 px-4 bg-dark text-light" id="contenido-principal" style="min-height: 80vh; border: 2px solid #ff69b4;">
                <h2 class="mt-4">Selecciona una sección</h2>
                <p>Aquí verás la información correspondiente a la sección seleccionada.</p>
            </main>
        </div>
    </div>

    <!-- Modal Subir Foto -->
    <div class="modal fade" id="modal-subir-foto" tabindex="-1" aria-labelledby="modal-subir-foto-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-subir-foto-label">Subir Foto de Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formSubirFoto">
                        <div class="mb-3">
                            <label for="foto-perfil" class="form-label">Selecciona una nueva foto:</label>
                            <input type="file" class="form-control" id="foto-perfil" accept="image/*" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="subirFoto()">Subir Foto</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Efecto hover para mostrar la opción de subir foto
        const fotoPerfil = document.querySelector('.rounded-circle');
        const overlay = document.querySelector('.overlay');

        fotoPerfil.addEventListener('mouseenter', () => {
            overlay.style.opacity = '1';
        });

        fotoPerfil.addEventListener('mouseleave', () => {
            overlay.style.opacity = '0';
        });

        // Función para cargar contenido en el área principal
        function cargarContenido(seccion) {
            const contenidoPrincipal = document.getElementById('contenido-principal');
            let contenidoHtml = '';

            switch(seccion) {
                case 'informacion':
                    contenidoHtml = `
                    <h2 class="mt-4">Información Personal</h2>
                    <div class="text-center mb-3">
                        <img src="{{ $usuario['foto'] }}" alt="Foto de perfil" class="img-fluid rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="mt-2">
                            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-subir-foto">Cambiar Foto</button>
                        </div>
                    </div>
                    <form id="formCambiarInformacion">
                        <div class="mb-3">
                            <label for="nombre-completo" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre-completo" value="{{ $usuario['nombre_completo'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $usuario['email'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" value="{{ $usuario['telefono'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" value="{{ $usuario['direccion'] }}" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="guardarInformacion()">Guardar Cambios</button>
                    </form>
                    `;
                    break;
                case 'configuracion':
                    contenidoHtml = `
                    <div class="card mb-4" style="border-radius: 10px; margin-top: 2rem;  ">
                        <div class="card-header text-light">
                            <i class="fas fa-cog"></i> Configuración
                        </div>
                        <div class="card-body text-light">
                            <p>Personaliza tu experiencia y configura tu cuenta.</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-cambiar-contrasena">Cambiar Contraseña</button>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-verificar-correo" style="background-color: #ff69b4;">Verificar Correo</button>
                        </div>
                    </div>
                    `;
                    break;
                case 'roles':
                    contenidoHtml = `
                    <div class="card mb-4" style="border-radius: 10px; background: #2c2c2c;">
                        <div class="card-header text-light">
                            <i class="fas fa-user-shield"></i> Mis Roles
                        </div>
                        <div class="card-body text-light">
                            <p>Los roles que tienes asignados te permiten acceder a diversas funcionalidades dentro de la plataforma.</p>
                            <ul>
                                @foreach($usuario['roles'] as $rol)
                    <li>{{ $rol }}</li>
                                @endforeach
                    </ul>

                </div>
            </div>
`;
                    break;
                case '2fa':
                    contenidoHtml = `
                    <div class="card mb-4" style="border-radius: 10px; background: #2c2c2c;">
                        <div class="card-header text-light">
                            <i class="fas fa-lock"></i> Autenticación de Dos Factores
                        </div>
                        <div class="card-body text-light">
                            <p>{{ $usuario['dos_factor'] ? 'Actualmente tienes habilitada la autenticación de dos factores.' : 'Habilita la autenticación de dos factores para mayor seguridad.' }}</p>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-2fa">${{ $usuario['dos_factor'] ? 'Deshabilitar 2FA' : 'Habilitar 2FA' }}</button>
                        </div>
                    </div>
                    `;
                    break;
            }

            contenidoPrincipal.innerHTML = contenidoHtml;
        }

        // Implementar las funciones de guardar información, cambiar contraseña, etc. posteriormente.
    </script>

    <!-- Modal Cambiar Contraseña -->
    <div class="modal fade" id="modal-cambiar-contrasena" tabindex="-1" aria-labelledby="modal-cambiar-contrasena-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-cambiar-contrasena-label">Cambiar Contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCambiarContrasena">
                        <div class="mb-3">
                            <label for="contrasena-actual" class="form-label">Contraseña Actual</label>
                            <input type="password" class="form-control" id="contrasena-actual" required>
                        </div>
                        <div class="mb-3">
                            <label for="nueva-contrasena" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="nueva-contrasena" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmar-contrasena" class="form-label">Confirmar Nueva Contraseña</label>
                            <input type="password" class="form-control" id="confirmar-contrasena" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="cambiarContrasena()">Cambiar Contraseña</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Verificar Correo -->
    <div class="modal fade" id="modal-verificar-correo" tabindex="-1" aria-labelledby="modal-verificar-correo-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-verificar-correo-label">Verificar Correo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Se enviará un correo de verificación a <strong>{{ $usuario['email'] }}</strong>.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="verificarCorreo()">Enviar Verificación</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 2FA -->
    <div class="modal fade" id="modal-2fa" tabindex="-1" aria-labelledby="modal-2fa-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-2fa-label">Autenticación de Dos Factores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas habilitar la autenticación de dos factores?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger">Activar 2FA</button>
                </div>
            </div>
        </div>
    </div>
@endsection
