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
                                    <input type="text" class="form-control" id="nombreAdmin" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ap_paternoAdmin" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="ap_paternoAdmin" name="ap_paterno" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ap_maternoAdmin" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="ap_maternoAdmin" name="ap_materno" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefonoAdmin" class="form-label">Teléfono</label>
                                    <input type="tel" name="phone" class="form-control phone-input" value="+52" required>
                                </div>
                                <div class="mb-3">
                                    <label for="usernameAdmin" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="usernameAdmin" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emailAdmin" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailAdmin" name="email" required>
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
                                    <input type="text" class="form-control" id="nombreProfesor" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ap_paternoProfesor" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" id="ap_paternoProfesor" name="ap_paterno" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ap_maternoProfesor" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="ap_maternoProfesor" name="ap_materno" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefonoProfesor" class="form-label">Teléfono</label>
                                    <input type="tel" name="phone" class="form-control phone-input" value="+52" required>
                                </div>
                                <div class="mb-3">
                                    <label for="rfcProfesor" class="form-label">RFC</label>
                                    <input type="text" class="form-control" id="rfcProfesor" name="RFC" maxlength="13">
                                </div>
                                <div class="mb-3">
                                    <label for="curpProfesor" class="form-label">CURP</label>
                                    <input type="text" class="form-control" id="curpProfesor" name="CURP" maxlength="18">
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
                                    <input type="text" class="form-control" id="zipcodeProfesor" name="zipcode" maxlength="10">
                                </div>
                                <div class="mb-3">
                                    <label for="ciudadProfesor" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudadProfesor" name="ciudad" maxlength="100">
                                </div>
                                <div class="mb-3">
                                    <label for="coloniaProfesor" class="form-label">Colonia</label>
                                    <input type="text" class="form-control" id="coloniaProfesor" name="colonia" maxlength="100">
                                </div>
                                <div class="mb-3">
                                    <label for="calleProfesor" class="form-label">Calle</label>
                                    <input type="text" class="form-control" id="calleProfesor" name="calle" maxlength="100">
                                </div>
                                <div class="mb-3">
                                    <label for="n_extProfesor" class="form-label">Número Exterior</label>
                                    <input type="text" class="form-control" id="n_extProfesor" name="n_ext" maxlength="10">
                                </div>
                                <div class="mb-3">
                                    <label for="n_intProfesor" class="form-label">Número Interior</label>
                                    <input type="text" class="form-control" id="n_intProfesor" name="n_int" maxlength="10">
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
        @foreach($usuarios as $usuario)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <!-- Card Header with General and Role States Badges -->
                    <div class="card-header" style="display: flex; flex-wrap: wrap; gap: 0.25rem; justify-content: flex-end;">
                        <!-- General User State Badge -->
                        <span class="badge {{ $usuario->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                Usuario: {{ ucfirst($usuario->estado) }}
            </span>

                        <!-- Role-specific State Badges -->
                        @if($persona = $usuario->persona)
                            @if($persona->estilista)
                                <span class="badge {{ $persona->estilista->estado == 'activo' ? 'bg-success' : ($persona->estilista->estado == 'vacaciones' ? 'bg-warning' : 'bg-danger') }}">
                        Estilista: {{ ucfirst($persona->estilista->estado) }}
                    </span>
                            @endif
                            @if($persona->profesor)
                                <span class="badge {{ $persona->profesor->estado == 'activo' ? 'bg-success' : ($persona->profesor->estado == 'vacaciones' ? 'bg-warning' : 'bg-danger') }}">
                        Profesor: {{ ucfirst($persona->profesor->estado) }}
                    </span>
                            @endif
                            @if($persona->estudiante)
                                <span class="badge {{ $persona->estudiante->estado == 'activo' ? 'bg-success' : 'bg-danger' }}">
                        Estudiante: {{ ucfirst($persona->estudiante->estado) }}
                    </span>
                            @endif
                        @endif
                    </div>

                    <div class="card-body">
                        <!-- Profile Image -->
                        <div class="text-center mb-3">
                            <img src="{{ $usuario->profile_photo_url }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>

                        <h5 class="card-title">{{ $usuario->username }} <span class="badge bg-primary">{{ $usuario->email }}</span></h5>

                        @if($persona = $usuario->persona)
                            <p><strong>Nombre:</strong> {{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}</p>
                            <p><strong>Teléfono:</strong> {{ $persona->telefono }}</p>

                            <!-- Roles -->
                            <div class="mb-2">
                                @foreach(['administrador', 'estilista', 'profesor', 'estudiante', 'comprador'] as $role)
                                    @if($persona->$role)
                                        <span class="badge bg-secondary me-1">{{ ucfirst($role) }}</span>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Botón para ver más -->
                            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#modal{{ $usuario->id }}">Ver más</button>
                        @endif
                    </div>
                </div>
            </div>




            <!-- Modal para ver más de un usuario -->
            @if($persona)
                <div class="modal fade" id="modal{{ $usuario->id }}" tabindex="-1" aria-labelledby="modal{{ $usuario->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal{{ $usuario->id }}Label">{{ $usuario->username }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Información adicional de Persona -->
                                <p><strong>Nombre Completo:</strong> {{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}</p>
                                <p><strong>Teléfono:</strong> {{ $persona->telefono }}</p>

                                <!-- Información de Profesor -->
                                @if($profesor = $persona->profesor)
                                    <hr>
                                    <h6><strong>Información de Profesor</strong></h6>
                                    <p><strong>Especialidad:</strong> {{ $profesor->especialidad }}</p>
                                    <p><strong>Fecha Contratación:</strong> {{ $profesor->fecha_contratacion }}</p>
                                    <p><strong>Estado:</strong> {{ $profesor->estado }}</p>
                                    <p><strong>Dirección:</strong> {{ $profesor->calle }} {{ $profesor->n_ext }}@if($profesor->n_int), Int: {{ $profesor->n_int }}@endif, {{ $profesor->colonia }}, {{ $profesor->ciudad }}, {{ $profesor->zipcode }}</p>
                                @endif

                                <!-- Información de Estudiante -->
                                @if($estudiante = $persona->estudiante)
                                    <hr>
                                    <h6><strong>Información de Estudiante</strong></h6>
                                    <p><strong>Matrícula:</strong> {{ $estudiante->matricula }}</p>
                                    <p><strong>Grado de Estudio:</strong> {{ $estudiante->grado_estudio }}</p>
                                    <p><strong>Estado:</strong> {{ $estudiante->estado }}</p>
                                    <p><strong>Dirección:</strong> {{ $estudiante->calle }} {{ $estudiante->num_ext }}@if($estudiante->num_int), Int: {{ $estudiante->num_int }}@endif, {{ $estudiante->colonia }}, {{ $estudiante->ciudad }}, {{ $estudiante->zipcode }}</p>
                                @endif

                                <!-- Información de Comprador -->
                                @if($comprador = $persona->comprador)
                                    <hr>
                                    <h6><strong>Información de Comprador</strong></h6>
                                    <p><strong>Razón Social:</strong> {{ $comprador->razon_social }}</p>
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
</div>
