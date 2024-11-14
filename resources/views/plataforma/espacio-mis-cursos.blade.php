<h2 class="text-center my-4" style="color: #007bff;">Cursos de {{ auth()->user()->username }}</h2>

<div class="container">
    <!-- Verificar si hay cursos -->
    @if($cursos->isEmpty())
        <p class="text-center" style="font-size: 1.2rem; color: #666;">No tienes cursos registrados.</p>
    @else
        <div class="row">
            <!-- Recorrer los cursos del estudiante -->
            @foreach($cursos as $curso)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm" style="border-radius: 10px; overflow: hidden; height: 100%;">
                        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Imagen de curso" style="object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold; color: #333;">{{ $curso->nombre_curso }}</h5>
                            <p class="card-text" style="font-size: 1rem; color: #555;">{{ $curso->descripcion_curso }}</p>
                            <p><strong>Duración:</strong> {{ $curso->duracion_semanas }} semanas</p>
                            <p><strong>Certificación:</strong> {{ $curso->nombre_certificado }}</p>
                            <p><strong>Fecha de Inicio:</strong> {{ $curso->fecha_inicio }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
