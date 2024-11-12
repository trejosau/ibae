<div class="container-fluid my-5">
    <!-- Botones de agregar roles -->
    <div class="d-flex justify-content-around mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarAdmin">Agregar Administrador</button>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarProfesor">Agregar Profesor</button>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarEstilista">Agregar Estilista</button>
    </div>

    <!-- Modals para agregar roles -->
    @foreach(['Admin' => 'Administrador', 'Profesor' => 'Profesor', 'Estilista' => 'Estilista'] as $key => $role)
        <div class="modal fade" id="modalAgregar{{ $key }}" tabindex="-1" aria-labelledby="modalAgregar{{ $key }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAgregar{{ $key }}Label">Agregar {{ $role }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/{{ strtolower($role) }}/agregar" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username{{ $key }}" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username{{ $key }}" name="username" required>
                            </div>
                            @if($key == 'Admin' || $key == 'Estilista')
                                <div class="mb-3">
                                    <label for="email{{ $key }}" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email{{ $key }}" name="email" required>
                                </div>
                            @elseif($key == 'Profesor')
                                <div class="mb-3">
                                    <label for="especialidad{{ $key }}" class="form-label">Especialidad</label>
                                    <select class="form-control" id="especialidad{{ $key }}" name="especialidad" required>
                                        <option value="estilismo">Estilismo</option>
                                        <option value="barbería">Barbería</option>
                                        <option value="maquillaje">Maquillaje</option>
                                        <option value="uñas">Uñas</option>
                                    </select>
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Guardar {{ $role }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Listado de usuarios -->
    <div class="row">
        @foreach($usuarios as $usuario)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $usuario->username }}</h5>
                        <p class="card-text"><strong>Email:</strong> {{ $usuario->email }}</p>

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
                                    <p><strong>Preferencia:</strong> {{ $comprador->preferencia }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
