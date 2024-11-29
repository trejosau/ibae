<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-KyPxAxDQ4H/C2rZT3vOa+Bcq8oSTFEs/1ty8fPKO4XRS13M/h3POmE4J0HLOtHBL+AH6FdYhBFgC+5l1z10Klg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f5f5f5; /* Color de fondo suave en gris claro */
            font-family: 'Arial', sans-serif; /* Fuente más moderna */
        }
        h1, h2 {
            color: #333; /* Color de texto más oscuro para contraste */
        }
        .card {
            background-color: #ffffff; /* Color blanco para tarjetas */
            border: 1px solid #ddd; /* Borde gris suave */
            margin-bottom: 20px;
            border-radius: 10px; /* Bordes redondeados */
        }
        .card-header {
            background-color: #ff6f61; /* Color suave para el encabezado */
            color: white; /* Texto en blanco para el encabezado */
            padding: 15px; /* Padding del encabezado */
            border-top-left-radius: 10px; /* Bordes redondeados en la parte superior */
            border-top-right-radius: 10px; /* Bordes redondeados en la parte superior */
        }
        .card-body {
            padding: 20px;
        }
        .tema {
            padding-left: 20px; /* Alinear los temas */
            display: flex; /* Flexbox para el botón de quitar */
            justify-content: space-between; /* Espacio entre texto y botón */
            align-items: center; /* Centrar verticalmente */
        }
        .btn-warning, .btn-success, .btn-danger, .btn-primary {
            transition: background-color 0.3s; /* Transición suave para los botones */
            width: 100%; /* Asegurar que todos los botones tengan el mismo tamaño */
        }
        .btn-warning:hover {
            background-color: #ffca28; /* Color de fondo al hacer hover */
        }
        .btn-success:hover {
            background-color: #66bb6a; /* Color de fondo al hacer hover */
        }
        .btn-danger:hover {
            background-color: #ef5350; /* Color de fondo al hacer hover */
        }
        .text-center {
            text-align: center; /* Centrar texto */
        }
        .btn-container {
            display: flex;
            justify-content: center; /* Centrar los botones */
            gap: 15px; /* Espacio entre botones */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Módulos</h1>
    
        @if(session('messages'))
            <div class="alert alert-info">
                <ul>
                    @foreach(session('messages') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <!-- Botón para regresar -->
        <a href="{{ route('plataforma.lista-modulos') }}" class="btn btn-primary btn-sm mb-3 btn-guardar">
            <i class="fa fa-arrow-left" style="margin-right: 10px"></i> Regresar 
        </a>
    
        <!-- Botón para asignar temas a módulos -->
        <button type="button" class="btn btn-primary btn-lg mb-4" data-bs-toggle="modal" data-bs-target="#asignarTemasModal">
            Asignar temas a módulos
        </button>
    
        <!-- Modal para asignar temas a módulos -->
        <div class="modal fade" id="asignarTemasModal" tabindex="-1" aria-labelledby="asignarTemasModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="asignarTemasModalLabel">Asignar temas a módulos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('asignar.temas') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="modulosSelect" class="form-label">Selecciona un módulo sin tema</label>
                                <select class="form-select" id="modulosSelect" name="modulo_id" required>
                                    <option selected disabled>Elige un módulo...</option>
                                    @foreach ($modulosSinTemas as $modulo)
                                        <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            @for ($i = 1; $i <= 3; $i++)
                                <div class="mb-3">
                                    <label for="tema{{ $i }}Select" class="form-label">Selecciona el tema {{ $i }}</label>
                                    <select class="form-select temaSelect" id="tema{{ $i }}Select" name="tema_ids[]">
                                        <option selected disabled>Elige un tema...</option>
                                        @foreach ($todosLosTemas as $tema)
                                            <option value="{{ $tema->id }}">{{ $tema->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endfor
    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Módulos por categoría -->
        <div class="row">
            <!-- Belleza -->
            <div class="col-md-6">
                <h2 class="text-center">Belleza</h2>
                <div class="accordion" id="accordionBelleza">
                    @if(isset($modulos['Belleza']) && $modulos['Belleza']->count() > 0)
                        @foreach ($modulos['Belleza'] as $modulo)
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#collapseModulo{{ $modulo->id }}" aria-expanded="false" aria-controls="collapseModulo{{ $modulo->id }}">
                                        {{ $modulo->nombre }} - Ver Más <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div id="collapseModulo{{ $modulo->id }}" class="collapse">
                                        <div class="card-body">
                                            <h6>Temas:</h6>
                                            <ul class="list-group">
                                                @if ($modulo->temas->isEmpty())
                                                    <li class="list-group-item">Este módulo no tiene temas.</li>
                                                @else
                                                    @foreach ($modulo->temas as $tema)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            {{ $tema->nombre }}
                                                            <!-- Botón para quitar tema -->
                                                            <form action="{{ route('plataforma.eliminarTema', [$modulo->id, $tema->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de quitar este tema?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">Quitar</button>
                                                            </form>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
    
                                            <!-- Botón para editar temas -->
                                            <button type="button" class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#editarTemasModal{{ $modulo->id }}">
                                                Editar Temas
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Modal para editar temas -->
                            <div class="modal fade" id="editarTemasModal{{ $modulo->id }}" tabindex="-1" aria-labelledby="editarTemasModalLabel{{ $modulo->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarTemasModalLabel{{ $modulo->id }}">Editar temas de "{{ $modulo->nombre }}"</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('modulos.actualizarTemas', $modulo->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
    
                                                @for ($i = 0; $i < 3; $i++)
                                                    <div class="mb-3">
                                                        <label for="temaSelect{{ $modulo->id }}_{{ $i }}" class="form-label">Tema {{ $i + 1 }}</label>
                                                        <select class="form-select" id="temaSelect{{ $modulo->id }}_{{ $i }}" name="tema_ids[]">
                                                            <option value="" {{ $i >= $modulo->temas->count() ? 'selected' : '' }}>Elige un tema...</option>
                                                            @foreach ($todosLosTemas as $tema)
                                                                <option value="{{ $tema->id }}" 
                                                                    {{ $modulo->temas[$i]->id ?? null == $tema->id ? 'selected' : '' }}>
                                                                    {{ $tema->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endfor
    
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No hay módulos disponibles para Belleza.</p>
                    @endif
                </div>
            </div>
    
      <!-- Barbería -->
<div class="col-md-6">
    <h2 class="text-center">Barbería</h2>
    <div class="accordion" id="accordionBarberia">
        @if(isset($modulos['Barberia']) && $modulos['Barberia']->count() > 0)
            @foreach ($modulos['Barberia'] as $modulo)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header" data-bs-toggle="collapse" data-bs-target="#collapseModuloBarberia{{ $modulo->id }}" aria-expanded="false" aria-controls="collapseModuloBarberia{{ $modulo->id }}">
                            {{ $modulo->nombre }} - Ver Más <i class="fas fa-chevron-down"></i>
                        </div>
                        <div id="collapseModuloBarberia{{ $modulo->id }}" class="collapse">
                            <div class="card-body">
                                <h6>Temas:</h6>
                                <ul class="list-group">
                                    @if ($modulo->temas->isEmpty())
                                        <li class="list-group-item">Este módulo no tiene temas.</li>
                                    @else
                                        @foreach ($modulo->temas as $tema)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $tema->nombre }}
                                                <!-- Botón para quitar tema -->
                                                <form action="{{ route('plataforma.eliminarTema', [$modulo->id, $tema->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de quitar este tema?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Quitar</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                <!-- Botón para editar temas -->
                                <button type="button" class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#editarTemasModalBarberia{{ $modulo->id }}">
                                    Editar Temas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para editar temas -->
                <div class="modal fade" id="editarTemasModalBarberia{{ $modulo->id }}" tabindex="-1" aria-labelledby="editarTemasModalLabelBarberia{{ $modulo->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarTemasModalLabelBarberia{{ $modulo->id }}">Editar temas de "{{ $modulo->nombre }}"</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('modulos.actualizarTemas', $modulo->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="mb-3">
                                            <label for="temaSelectBarberia{{ $modulo->id }}_{{ $i }}" class="form-label">Tema {{ $i + 1 }}</label>
                                            <select class="form-select" id="temaSelectBarberia{{ $modulo->id }}_{{ $i }}" name="tema_ids[]">
                                                <option value="" {{ $i >= $modulo->temas->count() ? 'selected' : '' }}>Elige un tema...</option>
                                                @foreach ($todosLosTemas as $tema)
                                                    <option value="{{ $tema->id }}" 
                                                        {{ $modulo->temas[$i]->id ?? null == $tema->id ? 'selected' : '' }}>
                                                        {{ $tema->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endfor

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No hay módulos disponibles para Barbería.</p>
        @endif
    </div>
</div>

    

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const temaSelects = document.querySelectorAll('.temaSelect');
    
            temaSelects.forEach(select => {
                select.addEventListener('change', function () {
                    const seleccionados = Array.from(temaSelects)
                        .map(s => s.value)
                        .filter(val => val); // Obtener solo los valores seleccionados
    
                    temaSelects.forEach(s => {
                        Array.from(s.options).forEach(option => {
                            if (seleccionados.includes(option.value) && option.value !== s.value) {
                                option.disabled = true;
                            } else {
                                option.disabled = false;
                            }
                        });
                    });
                });
            });
        });
    </script>

<script>
    function eliminarTema(moduloId, temaId) {
        if (confirm('¿Estás seguro de que deseas quitar este tema del módulo?')) {
            fetch('{{ route('eliminar.tema') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ modulo_id: moduloId, tema_id: temaId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exito) {
                    // Eliminar el tema de la lista
                    const temaElemento = document.getElementById(`tema-${temaId}`);
                    if (temaElemento) {
                        temaElemento.remove();
                    }
                    alert(data.mensaje);
                } else {
                    alert('Ocurrió un error al intentar quitar el tema.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al procesar la solicitud.');
            });
        }
    }
</script>

    
    
    </body>
    </html>