<h2 class="text-center my-4" style="color: #007bff;">Cursos de {{ auth()->user()->username }}</h2>

<div class="container">
    @if($cursos->isEmpty())
        <p class="text-center" style="font-size: 1.2rem; color: #666;">No tienes cursos registrados.</p>
    @else
        <div class="row">
            @foreach($cursos as $curso)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm" style="border-radius: 10px; background-color: #333; color: #0a0a0a;">
                        <div class="d-flex align-items-center justify-content-center" style="height: 100px; background-color: #007bff; color: white;">
                            <span style="font-size: 2rem; font-weight: bold;">{{ substr($curso->nombre_curso, 0, 2) }}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold;">{{ $curso->nombre_curso }}</h5>
                            <p class="card-text" style="font-size: 0.9rem;">{{ $curso->descripcion_curso }}</p>
                            <div class="d-flex justify-content-around mt-3">
                                <i class="fas fa-calendar-alt" style="font-size: 1.2rem;"></i>
                                <i class="fas fa-book" style="font-size: 1.2rem;"></i>
                                <i class="fas fa-pencil-alt" style="font-size: 1.2rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
