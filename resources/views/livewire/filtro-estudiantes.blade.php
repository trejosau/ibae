<div>
    <!-- Campo de búsqueda -->
    <div class="form-group">
        <input
            type="text"
            class="form-control"
            placeholder="Buscar estudiante (por nombre o matrícula)..."
            wire:model.live="query"
            style="border-radius: 0.375rem; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);"
        />
    </div>


    <!-- Lista de estudiantes filtrados -->
    <div class="row">
        @forelse($estudiantes as $estudiante)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm position-relative" style="background-color: #f9f4f2; border: none; border-radius: 100px; rounded: 10px;">
                    <!-- Badge de estado activo/dado de baja -->
                    @if($estudiante->estado == 'activo')
                        <span class="badge badge-success position-absolute" style="top: 10px; right: 10px; font-size: 14px; padding: 8px 12px;">Activo</span>
                    @else
                        <span class="badge badge-danger position-absolute" style="top: 10px; right: 10px; font-size: 14px; padding: 8px 12px;">Baja</span>
                    @endif

                    <div class="card-body text-center" >
                        <!-- Foto de perfil -->
                        <div class="mb-3" style="width: 120px; height: 120px; margin: 0 auto; overflow: hidden; border-radius: 50%; background-color: #ddd;">
                            <img src="https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Información del estudiante -->
                        <h5>{{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }}</h5>
                        <p>Matrícula: {{ $estudiante->matricula }}</p>

                        <!-- Botón para abrir modal -->
                        <button 
                            class="btn btn-info" 
                            style="background-color: #OD1E4C; border: none;" 
                            data-toggle="modal" 
                            data-target="#modalEstudiante{{ $estudiante->matricula }}"
                        >
                            Ver más
                        </button>

                        <!-- Botón de acción para cambiar estado -->
                        @if($estudiante->estado == 'activo')
                            <!-- Formulario para dar de baja -->
                            <form action="{{ route('plataforma.baja', ['matricula' => $estudiante->matricula]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger" style="background-color: #e6b0aa; border: none;" onclick="return confirm('¿Estás seguro de que deseas dar de baja a este estudiante?');">
                                    Dar de baja
                                </button>
                            </form>
                        @else
                            <!-- Formulario para dar de alta -->
                            <form action="{{ route('plataforma.alta', ['matricula' => $estudiante->matricula]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success" style="background-color: #82d091; border: none;" onclick="return confirm('¿Estás seguro de que deseas dar de alta a este estudiante?');">
                                    Dar de alta
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal de información del estudiante -->
            <div class="modal fade" id="modalEstudiante{{ $estudiante->matricula }}" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                        <div class="modal-header" style="background-color: #F2C6D1; color: #4B4A5A; border-top-left-radius: 12px; border-top-right-radius: 12px;">
                            <h5>Información del Estudiante</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" style="background-color: #FFF1F3; color: #4B4A5A; padding: 1rem;">
                            <p><strong>Nombre Completo:</strong> {{ $estudiante->persona->nombre }} {{ $estudiante->persona->ap_paterno }} {{ $estudiante->persona->ap_materno }}</p>
                            <p><strong>Matrícula:</strong> {{ $estudiante->matricula }}</p>
                            <p><strong>Correo:</strong> {{ $estudiante->persona->Usuario->email }}</p>
                            <p><strong>Grado de Estudios:</strong> {{ $estudiante->grado_estudio }}</p>
                            <p><strong>Inscripción:</strong> {{ $estudiante->inscripcion->nombre }}</p>
                            <p><strong>Estado:</strong> {{ ucfirst($estudiante->estado) }}</p>
                        </div>
                        <div class="modal-footer" style="border-top: 1px solid #F2C6D1;">
                            <button type="button" class="btn" style="background-color: #F2C6D1; color: #4B4A5A; font-weight: bold;" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No se encontraron estudiantes.</p>
        @endforelse
    </div>

  <!-- Paginación con diseño personalizado -->
  <div class="d-flex justify-content-center mt-4">
    <ul class="pagination" style="background-color: #f5f5f5; border-radius: 10px; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);">
        @if ($estudiantes->onFirstPage())
            <li class="page-item disabled" style="margin: 0 5px;">
                <span class="page-link" style="background-color: #C48CB3; color: #FFFFFF; border: none; border-radius: 5px;">&laquo;</span>
            </li>
        @else
            <li class="page-item" style="margin: 0 5px;">
                <button wire:click="previousPage" class="page-link"
                    style="background-color: #83A6CE; color: #FFFFFF; border: none; border-radius: 5px; transition: all 0.3s;"
                    onmouseover="this.style.backgroundColor='#26415E';"
                    onmouseout="this.style.backgroundColor='#83A6CE';">&laquo;</button>
            </li>
        @endif

        @foreach ($estudiantes->getUrlRange(1, $estudiantes->lastPage()) as $page => $url)
            @if ($page == $estudiantes->currentPage())
                <li class="page-item active" style="margin: 0 5px;">
                    <span class="page-link" style="background-color: #0D1E4C; color: #FFFFFF; border: none; border-radius: 5px;">{{ $page }}</span>
                </li>
            @else
                <li class="page-item" style="margin: 0 5px;">
                    <button wire:click="gotoPage({{ $page }})" class="page-link"
                        style="background-color: #83A6CE; color: #FFFFFF; border: none; border-radius: 5px; transition: all 0.3s;"
                        onmouseover="this.style.backgroundColor='#26415E';"
                        onmouseout="this.style.backgroundColor='#83A6CE';">{{ $page }}</button>
                </li>
            @endif
        @endforeach

        @if ($estudiantes->hasMorePages())
            <li class="page-item" style="margin: 0 5px;">
                <button wire:click="nextPage" class="page-link"
                    style="background-color: #83A6CE; color: #FFFFFF; border: none; border-radius: 5px; transition: all 0.3s;"
                    onmouseover="this.style.backgroundColor='#26415E';"
                    onmouseout="this.style.backgroundColor='#83A6CE';">&raquo;</button>
            </li>
        @else
            <li class="page-item disabled" style="margin: 0 5px;">
                <span class="page-link" style="background-color: #C48CB3; color: #FFFFFF; border: none; border-radius: 5px;">&raquo;</span>
            </li>
        @endif
    </ul>
</div>
    
</div>

<script>
    function ajustarAlturaCategorias() {
        const categoryCards = document.querySelectorAll('.card-body');

        if (categoryCards.length === 0) return;

        let maxAltura = 0;

        categoryCards.forEach(card => {
            const alturaActual = card.offsetHeight;
            if (alturaActual > maxAltura) {
                maxAltura = alturaActual;
            }
        });

        categoryCards.forEach(card => {
            card.style.height = maxAltura + 'px';
        });
    }

    // Reajusta cuando la página esté cargada
    document.addEventListener('DOMContentLoaded', ajustarAlturaCategorias);

    // Reajusta al redimensionar la ventana
    window.addEventListener('resize', ajustarAlturaCategorias);
</script>