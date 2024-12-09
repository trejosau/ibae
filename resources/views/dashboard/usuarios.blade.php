<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

<div class="container-fluid my-3">
            <!-- Botones de agregar roles -->
            <div class="d-flex justify-content-around mb-1">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarAdmin">Agregar Administrador</button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarProfesor">Agregar Profesor</button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarEstilista">Agregar Estilista</button>
            </div>

            <!-- Modal para agregar Administrador -->
            <div class="modal fade" id="modalAgregarAdmin" tabindex="-1" aria-labelledby="modalAgregarAdminLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarAdminLabel">Agregar Administrador</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('usuarios.agregarAdmin') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="nombreAdmin" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombreAdmin" name="nombre" required value="{{ old('nombre') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="ap_paternoAdmin" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="ap_paternoAdmin" name="ap_paterno" required value="{{ old('ap_paterno') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="ap_maternoAdmin" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="ap_maternoAdmin" name="ap_materno" required value="{{ old('ap_materno') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="telefonoAdmin" class="form-label">Teléfono</label>
                                    <input type="tel" name="phone" class="form-control phone-input" required value="{{ old('phone', '+52') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="usernameAdmin" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="usernameAdmin" name="username" required value="{{ old('username') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="emailAdmin" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailAdmin" name="email" required value="{{ old('email') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Administrador</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Modal para agregar Profesor -->
    <div class="modal fade" id="modalAgregarProfesor" tabindex="-1" aria-labelledby="modalAgregarProfesorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarProfesorLabel">Agregar Profesor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuarios.agregarProfesor') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombreProfesor" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombreProfesor" name="nombre" required value="{{ old('nombre') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="ap_paternoProfesor" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="ap_paternoProfesor" name="ap_paterno" required value="{{ old('ap_paterno') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="ap_maternoProfesor" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="ap_maternoProfesor" name="ap_materno" required value="{{ old('ap_materno') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="telefonoProfesor" class="form-label">Teléfono</label>
                                    <input type="tel" name="phone" class="form-control phone-input"  required  value="{{ old('phone', '+52') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="rfcProfesor" class="form-label">RFC</label>
                                    <input type="text" class="form-control" id="rfcProfesor" required name="RFC" minlength="12" maxlength="13" value="{{ old('RFC') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="curpProfesor" class="form-label">CURP</label>
                                    <input type="text" class="form-control" id="curpProfesor" name="CURP" minlength="18" maxlength="18" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="usernameProfesor" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="usernameProfesor" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emailProfesor" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailProfesor" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="especialidadProfesor" class="form-label">Especialidad</label>
                                    <select class="form-control" id="especialidadProfesor" name="especialidad" required>
                                        <option value="estilismo">Estilismo</option>
                                        <option value="barbería">Barbería</option>
                                        <option value="maquillaje">Maquillaje</option>
                                        <option value="uñas">Uñas</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="zipcodeProfesor" class="form-label">Código Postal</label>
                                    <input type="text" class="form-control" id="zipcodeProfesor" name="zipcode" maxlength="10" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ciudadProfesor" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudadProfesor" name="ciudad" maxlength="100" required>
                                </div>
                                <div class="mb-3">
                                    <label for="coloniaProfesor" class="form-label">Colonia</label>
                                    <input type="text" class="form-control" id="coloniaProfesor" name="colonia" maxlength="100" required>
                                </div>
                                <div class="mb-3">
                                    <label for="calleProfesor" class="form-label">Calle</label>
                                    <input type="text" class="form-control" id="calleProfesor" name="calle" maxlength="100" required>
                                </div>
                                <div class="mb-3">
                                    <label for="n_extProfesor" class="form-label">Número Exterior</label>
                                    <input type="text" class="form-control" id="n_extProfesor" name="n_ext" maxlength="10" required>
                                </div>
                                <div class="mb-3">
                                    <label for="n_intProfesor" class="form-label">Número Interior</label>
                                    <input type="text" class="form-control" id="n_intProfesor" name="n_int" maxlength="10" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Profesor</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

            <!-- Modal para agregar Estilista -->
            <div class="modal fade" id="modalAgregarEstilista" tabindex="-1" aria-labelledby="modalAgregarEstilistaLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAgregarEstilistaLabel">Agregar Estilista</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('usuarios.agregarEstilista') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="nombreEstilista" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombreEstilista" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ap_paternoEstilista" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="ap_paternoEstilista" name="ap_paterno" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ap_maternoEstilista" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="ap_maternoEstilista" name="ap_materno" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefonoEstilista" class="form-label">Teléfono</label>
                                    <input type="tel" name="phone" class="form-control phone-input" value="+52" required>
                                </div>
                                <div class="mb-3">
                                    <label for="usernameEstilista" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="usernameEstilista" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emailEstilista" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailEstilista" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Estilista</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    $(document).ready(function() {
        $('.phone-input').each(function() {
            window.intlTelInput(this, {
                initialCountry: "mx",
                nationalMode: false,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                preferredCountries: ["mx"]
            });
        });
    });
</script>

    <!-- Listado de usuarios -->
    <div class="row">
        <form method="GET" action="{{ route('dashboard.usuarios') }}" class="mb-3">
            <div class="row">

                <!-- Filtros agrupados en una sola fila -->
                <div class="col-md-2">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ request('nombre') }}" placeholder="Buscar por nombre">
                </div>

                <div class="col-md-2">
                    <label for="ap_paterno" class="form-label">Apellido Paterno</label>
                    <input type="text" name="ap_paterno" id="ap_paterno" class="form-control" value="{{ request('ap_paterno') }}" placeholder="Buscar por apellido paterno">
                </div>

                <div class="col-md-2">
                    <label for="ap_materno" class="form-label">Apellido Materno</label>
                    <input type="text" name="ap_materno" id="ap_materno" class="form-control" value="{{ request('ap_materno') }}" placeholder="Buscar por apellido materno">
                </div>

                <!-- Filtro por Rol -->
                <div class="col-md-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select name="rol" id="rol" class="form-control">
                        <option value="">Todos</option>
                        <option value="estilista" {{ request('rol') == 'estilista' ? 'selected' : '' }}>Estilista</option>
                        <option value="profesor" {{ request('rol') == 'profesor' ? 'selected' : '' }}>Profesor</option>
                        <option value="estudiante" {{ request('rol') == 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                        <option value="administrador" {{ request('rol') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <!-- Botón de Filtrar -->
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </div>
        </form>

    @foreach($usuarios as $usuario)


        <div class="col-md-3 mb-4">
                <div class="card" style="border: 1px solid #ddd; border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; height: auto;">
                    <!-- Card Body -->
                    <div style="padding: 1rem; text-align: center;">
                        <!-- Profile Image -->
                        <div style="margin-bottom: 1rem;">
                            <img src="{{ $usuario->profile_photo_url }}" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 2px solid #ddd;">
                        </div>

                        <!-- User Info -->
                        <h5 style="margin: 0; font-size: 1.25rem; color: #333;">{{ $usuario->username }}</h5>
                        <span style="font-size: 0.9rem; color: #007bff;">{{ $usuario->email }}</span>
                        <hr style="border: 0; height: 1px; background-color: #e9ecef; margin: 1rem 0;">

                        @if($persona = $usuario->persona)
                            <p style="margin: 0.5rem 0; font-size: 0.95rem;"><strong>Nombre:</strong> {{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}</p>
                            <p style="margin: 0.5rem 0; font-size: 0.95rem;"><strong>Teléfono:</strong> {{ $persona->telefono }}</p>
                        @endif
                    </div>

                    <!-- Botones de bloqueo centrados -->
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        @if($usuario->estado == 'activo')
                            <!-- Badge de estado activo -->
                            <span class="badge" style="font-size: 0.75rem; padding: 5px 12px; font-weight: 600; background-color: #28a745; color: white; border-radius: 10px;">
                               Estado: Activo
                            </span>
                            <!-- Botón de bloquear -->
                            <a href="{{ route('usuarios.bloquear', $usuario->id) }}" class="btn btn-sm" style="background-color: #dc3545; color: white; padding: 4px 10px; border-radius: 3px; font-weight: 600; margin-left: 8px; transition: background-color 0.3s ease;">
                                Bloquear
                            </a>

                        @else
                            <!-- Badge de estado inactivo -->
                            <span class="badge" style="font-size: 0.75rem; padding: 5px 12px; font-weight: 600; background-color: #6c757d; color: white; border-radius: 10px;">
                               Estado: Inactivo
                            </span>
                            <!-- Botón de desbloquear -->
                            <a href="{{ route('usuarios.desbloquear', $usuario->id) }}" class="btn btn-sm" style="background-color: #28a745; color: white; padding: 4px 10px; border-radius: 3px; font-weight: 600; margin-left: 8px; transition: background-color 0.3s ease;">
                                Desbloquear
                            </a>
                        @endif
                    </div>


                    <!-- Card Footer -->
                    <div style="padding: 0.75rem; background-color: #f8f9fa; display: flex; flex-wrap: wrap; gap: 0.5rem; min-height: 50px;">
                        @if($persona)
                            @foreach([ 'estilista', 'profesor', 'estudiante', 'administrador'] as $role)
                                @if($persona->$role)
                                    @php
                                        $estado = $persona->$role->estado ?? 'inactivo';
                                        $color = match($estado) {
                                            'activo' => '#28a745',
                                            'vacaciones' => '#ffc107',
                                            default => '#dc3545'
                                        };
                                    @endphp
                                    <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; padding: 0.25rem 0.5rem; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; width: fit-content;">
                                        <span style="width: 12px; height: 12px; background-color: {{ $color }}; border-radius: 50%; display: inline-block;"></span>
                                        {{ ucfirst($role) }}
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $usuario->id }}">
                            Ver más
                        </button>
                    </div>
                </div>
            </div>





            <!-- Modal para ver más de un usuario -->
            @if($persona)
                <div class="modal fade" id="modal{{ $usuario->id }}" tabindex="-1" aria-labelledby="modal{{ $usuario->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" style="background-color: #FFFFFF; color: #26415E; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                            <div class="modal-header" style="border-bottom: 2px solid #83A6CE;">
                                <h5 class="modal-title" id="modal{{ $usuario->id }}Label" style="color: #0D1E4C; font-weight: 600;">{{ $usuario->username }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="background-color: #eee5f4; padding: 25px; border-radius: 8px;">
                                <!-- Información adicional de Persona -->
                                <div class="mb-4">
                                    <p style="font-size: 16px; line-height: 1.6;"><strong>Nombre Completo:</strong> {{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}</p>
                                    <p style="font-size: 16px; line-height: 1.6;"><strong>Teléfono:</strong> {{ $persona->telefono }}</p>
                                </div>

                                <!-- Información de Profesor -->
                                @if($profesor = $persona->profesor)
                                    <hr style="border-top: 1px solid #83A6CE; margin: 20px 0;">
                                    <h6 style="color: #0D1E4C; font-weight: 600;"><strong>Información de Profesor</strong></h6>
                                    <div class="mb-3">
                                        <p style="font-size: 16px; line-height: 1.6;"><strong>Especialidad:</strong> {{ $profesor->especialidad }}</p>
                                        <p style="font-size: 16px; line-height: 1.6;"><strong>Fecha Contratación:</strong> {{ $profesor->fecha_contratacion }}</p>
                                        <p style="font-size: 16px; line-height: 1.6;"><strong>Estado:</strong>
                                            <span class="badge" style="background-color: {{ $profesor->estado == 'activo' ? '#28a745' : ($profesor->estado == 'vacaciones' ? '#ffc107' : '#6c757d') }}; font-size: 14px; padding: 6px 12px; border-radius: 20px;">
                                {{ ucfirst($profesor->estado) }}
                            </span>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        @if($profesor->estado == 'activo')
                                            <a href="{{ route('profesor.darBaja', $profesor->id) }}" class="btn" style="background-color: #FFB200; color: white; margin-right: 10px;">Dar baja</a>
                                            <a href="{{ route('profesor.darVacaciones', $profesor->id) }}" class="btn" style="background-color: #C48CB3; color: white;">Dar vacaciones</a>
                                        @elseif($profesor->estado == 'inactivo')
                                            <a href="{{ route('profesor.reactivar', $profesor->id) }}" class="btn" style="background-color: #28a745; color: white;">Reactivar</a>
                                        @elseif($profesor->estado == 'vacaciones')
                                            <a href="{{ route('profesor.terminarVacaciones', $profesor->id) }}" class="btn" style="background-color: #dc3545; color: white;">Terminar vacaciones</a>
                                        @endif
                                    </div>
                                    <p style="font-size: 16px; line-height: 1.6;"><strong>Dirección:</strong> {{ $profesor->calle }} {{ $profesor->n_ext }}@if($profesor->n_int), Int: {{ $profesor->n_int }}@endif, {{ $profesor->colonia }}, {{ $profesor->ciudad }}, {{ $profesor->zipcode }}</p>
                                @endif

                                <!-- Información de Estudiante -->
                                @if($estudiante = $persona->estudiante)
                                    <hr style="border-top: 1px solid #83A6CE; margin: 20px 0;">
                                    <h6 style="color: #0D1E4C; font-weight: 600;"><strong>Información de Estudiante</strong></h6>
                                    <div class="mb-3">
                                        <p style="font-size: 16px; line-height: 1.6;"><strong>Matrícula:</strong> {{ $estudiante->matricula }}</p>
                                        <p style="font-size: 16px; line-height: 1.6;"><strong>Grado de Estudio:</strong> {{ $estudiante->grado_estudio }}</p>
                                        <p style="font-size: 16px; line-height: 1.6;"><strong>Estado:</strong>
                                            <span class="badge" style="background-color: {{ $estudiante->estado == 'activo' ? '#28a745' : '#6c757d' }}; font-size: 14px; padding: 6px 12px; border-radius: 20px;">
                                {{ ucfirst($estudiante->estado) }}
                            </span>
                                        </p>
                                    </div>
                                    <p style="font-size: 16px; line-height: 1.6;"><strong>Dirección:</strong> {{ $estudiante->calle }} {{ $estudiante->num_ext }}@if($estudiante->num_int), Int: {{ $estudiante->num_int }}@endif, {{ $estudiante->colonia }}, {{ $estudiante->ciudad }}, {{ $estudiante->zipcode }}</p>
                                @endif

                                <!-- Información de Comprador -->
                                @if($comprador = $persona->comprador)
                                    <hr style="border-top: 1px solid #83A6CE; margin: 20px 0;">
                                    <h6 style="color: #0D1E4C; font-weight: 600;"><strong>Información de Comprador</strong></h6>
                                    <div class="mb-3">
                                        <p style="font-size: 16px; line-height: 1.6;"><strong>Razón Social:</strong> {{ $comprador->razon_social }}</p>
                                    </div>
                                @endif



                            </div>
                        </div>
                    </div>
                </div>

            @endif
        @endforeach
            <!-- Paginación -->
            <div class="d-flex justify-content-center">
                {{ $usuarios->links('pagination::bootstrap-5')}}
            </div>
    </div>
