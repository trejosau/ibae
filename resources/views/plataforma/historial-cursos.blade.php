<div class="container my-5">
    <h1 class="text-center mb-4">Historial de Cursos Apertura</h1>
    
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h3>Cursos Disponibles</h3>
            <!-- Botón para abrir el modal -->
           <!-- Para Bootstrap 5 -->
<button type="button" class="btn btn-light  botoncin-ca" data-bs-toggle="modal" data-bs-target="#agregarCursoModal">
    Agregar Curso Apertura
</button>

        </div>
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre del Curso</th>
                        <th>Fecha de Inicio</th>
                        <th>Periodo</th>
                        <th>Año</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cursosApertura as $cursoApertura)
                        <tr>
                            <td>{{ $cursoApertura->curso->nombre }}</td>
                            <td>{{ \Carbon\Carbon::parse($cursoApertura->fecha_inicio)->format('d/m/Y') }}</td>
                            <td>{{ $cursoApertura->periodo }}</td>
                            <td>{{ $cursoApertura->año }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay cursos de apertura disponibles</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal para agregar curso apertura -->
<div class="modal fade" id="agregarCursoModal" tabindex="-1" aria-labelledby="agregarCursoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCursoModalLabel">Agregar Curso Apertura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('plataforma.storeCursoApertura') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_curso" class="form-label">Curso</label>
                        <select name="id_curso" id="id_curso" class="form-select" required>
                            <option value="">Seleccione un curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="periodo" class="form-label">Periodo</label>
                        <input type="text" class="form-control" name="periodo" id="periodo" required>
                    </div>
                    <div class="mb-3">
                        <label for="año" class="form-label">Año</label>
                        <input type="number" class="form-control" name="año" id="año" required>
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

</div>
