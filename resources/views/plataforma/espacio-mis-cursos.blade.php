<h2 class="text-center mb-4">Mis Cursos</h2>

<div class="container">
    @if($cursos->isEmpty())
        <p class="text-center" style="font-size: 1.2rem; color: #666;">No tienes cursos registrados.</p>
    @else
        <div class="d-flex flex-row flex-wrap justify-content-start">
            @foreach($cursos as $curso)
                <div class="card shadow-sm d-flex flex-row align-items-center m-2 justify-content-center" 
                     style="width: 320px; height: 100px; border-radius: 10px; background-color: #ffffff; color: #000000;">
                    <!-- Letra inicial -->
                    <div class="d-flex justify-content-center align-items-center" 
                         style="width: 80px; height: 80px; margin: 10px; background-color: #83a6ce; border-radius: 5px;">
                        <span style="font-size: 2rem; font-weight: bold; color: #ca6aa0;">
                            <i class='fas fa-graduation-cap' ></i>
                        </span>
                    </div>

                    <!-- Contenido del curso -->
                    <div class="flex-grow-1 d-flex flex-column justify-content-center">
                        <h5 class="m-0" style="font-size: 1rem; font-weight: bold;">{{ $curso->nombre_curso }}</h5>
                        <div class="d-flex mt-2 justify-content-between" style="gap: 15px;">
                            <!-- Íconos con redirección -->
                            <a href="#" class="text-decoration-none" title="Calendario" 
                               data-bs-toggle="modal" data-bs-target="#modalCalendario{{ $curso->id }}">
                                <i class="fas fa-calendar-alt" style="font-size: 1.5rem; color: #83A6CE; margin-top: 10px;"></i>
                            </a>
                            <!-- Este ícono abrirá el modal de Módulos -->
                            <a href="#" class="text-decoration-none" title="Materiales"
                               data-bs-toggle="modal" data-bs-target="#modalModulos{{ $curso->id }}">
                                <i class="fas fa-book" style="font-size: 1.5rem; color: #83A6CE; margin-top: 10px;"></i>
                            </a>
                            <a href="" class="text-decoration-none" title="Exámenes">
                                <i class="fas fa-pencil-alt" style="font-size: 1.5rem; color: #83A6CE; margin-top: 10px;"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Opciones (tres puntos) -->
                    <div class="d-flex align-items-center justify-content-center" style="width: 30px; margin-right: 10px;">
                        <i class="fas fa-ellipsis-v" style="color: #fff; cursor: pointer;"></i>
                    </div>
                </div>

                <!-- Modal de Calendario -->
                <div class="modal fade" id="modalCalendario{{ $curso->id }}" tabindex="-1" aria-labelledby="modalCalendarioLabel{{ $curso->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 30px; overflow: hidden;">
                            <div class="modal-header" style="background-color: #E5C9D7; color: white; border-top-left-radius: 30px; border-top-right-radius: 30px; justify-content: center;">
                                <h5 class="modal-title" id="modalCalendarioLabel{{ $curso->id }}" style="color: rgb(56, 33, 6); ">Horario del Curso</h5>
                            </div>
                            <div class="modal-body" style="background-color: white; color: #333;">
                                <p><strong>Día de Clase:</strong> {{ $curso->dia_clase }}</p>
                                <p><strong>Hora de Clase:</strong> {{ $curso->hora_clase }}</p>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #26415E;">Cerrar</button>
                        </div>
                    </div>
                </div>

                <!-- Modal de Módulos -->
                <div class="modal fade" id="modalModulos{{ $curso->id }}" tabindex="-1" aria-labelledby="modalModulosLabel{{ $curso->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 30px; overflow: hidden;">
                            <div class="modal-header" style="background-color: #E5C9D7; color: white; border-top-left-radius: 30px; border-top-right-radius: 30px; justify-content: center;">
                                <h5 class="modal-title" id="modalModulosLabel{{ $curso->id }}" style="color: rgb(56, 33, 6); ">Módulos del Curso</h5>
                            </div>
                            <div class="modal-body" style="background-color: white; color: #333;">
                                @foreach($curso->modulos as $modulo)
                                    <div>
                                        <h6><strong>{{ $modulo->nombre_modulo }}</strong></h6>
                                        <ul>
                                            @foreach($modulo->temas as $tema)
                                                <li>{{ $tema->nombre_tema }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: #26415E;">Cerrar</button>
                        </div>
                    </div>
                </div>
                <!-- Fin del Modal de Módulos -->
            @endforeach
        </div>
    @endif
</div>
