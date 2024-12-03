<div class="container my-4">
    <h2 class="text-center mb-4">Gestión de Inscripciones</h2>

  

    <!-- Botón para agregar Inscripción -->
    <div class="d-flex justify-content-center mb-4">
        <button 
            type="button" 
            class="btn" 
            data-bs-toggle="modal" 
            data-bs-target="#modalAgregarInscripcion"
            style="background-color: #C39BD3; color: white; border: none;">
            Agregar Inscripción
        </button>
    </div>
    <div class="row">
        @foreach ($inscripciones as $inscripcion)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm" style="border: none; background-color: #F9F7FB; border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #6A4E77;">{{ $inscripcion->nombre }}</h5>
                    <p class="card-text" style="color: #8C7A71;"><strong>Precio:</strong> ${{ number_format($inscripcion->precio, 2) }}</p>
                    <p class="card-text" style="color: #8C7A71;"><strong>Descripción:</strong> {{ $inscripcion->descripcion }}</p>
                    <div class="d-flex justify-content-end gap-2">
                        <!-- Modificar / Eliminar botones -->
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarInscripcion-{{ $inscripcion->id }}" style="background-color: #C9A3BE; color: white; border: none;">Modificar</button>
                        <form method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta inscripción?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="background-color: #D2968E; border: none;">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

<div class="modal fade" id="modalAgregarInscripcion" tabindex="-1" aria-labelledby="modalAgregarInscripcionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarInscripcionLabel">Agregar Inscripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('plataforma.storeInscripcion') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inscripcionNombre" class="form-label">Nombre de la Inscripción</label>
                        <input type="text" name="nombre" class="form-control" id="inscripcionNombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="inscripcionPrecio" class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" id="inscripcionPrecio" required>
                    </div>
                    <div class="mb-3">
                        <label for="inscripcionDescripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="inscripcionDescripcion" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="materialIncluido" class="form-label">Material Incluido</label>
                        <select name="material_incluido" class="form-select" id="materialIncluido" required>
                            <option value="" selected disabled>Selecciona una Opción</option>
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
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

<!-- Modal para Editar Inscripción -->
@foreach ($inscripciones as $inscripcion)
<div class="modal fade" id="modalEditarInscripcion-{{ $inscripcion->id }}" tabindex="-1" aria-labelledby="modalEditarInscripcionLabel-{{ $inscripcion->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarInscripcionLabel-{{ $inscripcion->id }}">Editar Inscripción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('plataforma.updateInscripcion', $inscripcion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editInscripcionNombre-{{ $inscripcion->id }}" class="form-label">Nombre de la Inscripción</label>
                        <input type="text" name="nombre" class="form-control" id="editInscripcionNombre-{{ $inscripcion->id }}" value="{{ $inscripcion->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editInscripcionPrecio-{{ $inscripcion->id }}" class="form-label">Precio</label>
                        <input type="number" name="precio" class="form-control" id="editInscripcionPrecio-{{ $inscripcion->id }}" value="{{ $inscripcion->precio }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editInscripcionDescripcion-{{ $inscripcion->id }}" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="editInscripcionDescripcion-{{ $inscripcion->id }}" required>{{ $inscripcion->descripcion }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editMaterialIncluido-{{ $inscripcion->id }}" class="form-label">Material Incluido</label>
                        <select name="material_incluido" class="form-select" id="editMaterialIncluido-{{ $inscripcion->id }}" required>
                            <option value="1" {{ $inscripcion->material_incluido == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ $inscripcion->material_incluido == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

