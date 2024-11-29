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
                        <span style="font-size: 2rem; font-weight: bold; color: #ffffff;">
                            <i class='fas fa-graduation-cap'></i>
                        </span>
                    </div>

                    <!-- Contenido del curso -->
                    <div class="flex-grow-1 d-flex flex-column justify-content-center">
                        <h5 class="m-0" style="font-size: 1rem; font-weight: bold;">{{ $curso->nombre_curso }}</h5>
                        <div class="d-flex mt-2 justify-content-around">
                            <!-- Íconos con redirección -->
                            <a href="#" class="text-decoration-none" title="Calendario" 
                               data-bs-toggle="modal" data-bs-target="#modalCalendario{{ $curso->id }}">
                                <i class="fas fa-calendar-alt" style="font-size: 1.5rem; color: #83A6CE; margin-top: 10px;"></i>
                            </a>
                            <!-- Este ícono abrirá el modal de Módulos -->
                            <a href="#" class="text-decoration-none" title="Módulos y Temas"
                               data-bs-toggle="modal" data-bs-target="#modalModulos{{ $curso->id }}">
                                <i class="fas fa-book" style="font-size: 1.5rem; color: #83A6CE; margin-top: 10px;"></i>
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
                <h5 class="modal-title" id="modalCalendarioLabel{{ $curso->id }}" style="color: rgb(56, 33, 6);">Horario del Curso</h5>
            </div>
            <div class="modal-body" style="background-color: white; color: #333;">
                <p><strong>Día de Clase:</strong> {{ $curso->dia_clase }}</p>
                <p><strong>Hora de Clase:</strong> {{ $curso->hora_clase }}</p>
                
                <!-- Nueva sección: Profesor -->
                <p><strong>Profesor:</strong> 
                    @if($curso->modulos->isNotEmpty())
                        @php
                            // Obtener el primer módulo con profesor asignado
                            $profesor = $curso->modulos->firstWhere('nombre_profesor');
                        @endphp
                        @if($profesor)
                            {{ $profesor->nombre_profesor }} {{ $profesor->ap_paterno_profesor }} {{ $profesor->ap_materno_profesor }}
                        @else
                            No asignado
                        @endif
                    @else
                        No asignado
                    @endif
                </p>
                <!-- Fin de la sección -->
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
                                <h5 class="modal-title" id="modalModulosLabel{{ $curso->id }}" style="color: rgb(56, 33, 6); ">Módulos y Temas</h5>
                            </div>
                            <div class="modal-body" style="background-color: white; color: #333;">
                                @foreach($curso->modulos as $modulo)
                                    <div style="margin-top: 20px;">
                                        <h6 style="font-size: 1.2rem; color: #83395a; font-weight: bold;">Módulo: {{ $modulo->nombre_modulo }}</h6>
                                        <div style="height: 2px; background-color: #f4c3d6; width: 100%; margin-bottom: 10px;"></div>
                                        <ul style="list-style: none; padding: 0;">
                                            @foreach($modulo->temas as $tema)
                                                <li style="display: flex; align-items: center; margin-bottom: 8px;">
                                                    <span style="color: #83395a; font-size: 0.9rem; font-weight: bold; margin-right: 5px;">Tema: {{ $tema->nombre_tema }}</span>
                                                    <span style="color: #83395a; font-size: 1.2rem;"></span>
                                                </li>
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
