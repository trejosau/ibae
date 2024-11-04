<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toma de Asistencia y Pagos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f2f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #444;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            max-width: 100%;
            margin: 30px auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #6d8a96;
        }
        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .search-input {
            width: 250px;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #c7d0d5;
        }
        .table-container {
            overflow-x: auto;
            max-width: 100%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px;
            white-space: nowrap;
        }
        .table th, .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #e3e7ea;
        }
        .table th {
            background-color: #d7e3ea;
            color: #4a5b68;
        }
        .nombre-completo {
            text-align: left;
            line-height: 1.5;
        }
        .nombre-completo span {
            display: block;
        }
        .nombre-completo .bold {
            font-weight: bold;
            color: #4f758b;
        }
        .form-check {
            margin: 5px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #7ea8be;
            color: #fff;
            border: none;
        }
        .btn-secondary {
            background-color: #9baab4;
            color: #fff;
            border: none;
            text-decoration: none;
        }
        .btn-danger {
            background-color: #e74c3c;
            color: #fff;
            border: none;
        }
        .btn-secondary:hover, .btn-primary:hover, .btn-danger:hover {
            opacity: 0.9;
        }
        .disabled-row {
            background-color: #f8b0b3; /* Fondo rojo pastel */
            color: #6c757d;
            border-left: 4px solid #8b0000; /* Borde rojo guinda */
        }
        .disabled-row .form-check-input {
            pointer-events: none;
            background-color: #f8b0b3; /* Fondo rojo pastel en checkbox */
            color: #6c757d;
            border-color: #8b0000; /* Borde rojo guinda en checkbox */
        }
        .form-check-input:disabled {
            background-color: #f8b0b3;
            border-color: #8b0000;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Toma de Asistencia y Pagos - {{ $apertura->curso->nombre }}</h1>

    <div class="search-container">
        <input type="text" id="searchInput" class="search-input" placeholder="Buscar por matrícula...">
    </div>

    <div class="table-container">
        <form action="{{ route('guardarAsistencia', $apertura->id) }}" method="POST">
            @csrf
            <table class="table" id="studentsTable">
                <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Nombre Completo</th>
                    @for ($semana = 1; $semana <= $apertura->curso->duracion_semanas; $semana++)
                        <th>Semana {{ $semana }}<br>
                            <small>Colegiatura / Asistencia</small>
                        </th>
                    @endfor
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($estudiantesInscritos as $estudiante)
                    <tr class="{{ $estudiante->estado === 'baja' ? 'disabled-row' : '' }}">
                        <td>{{ $estudiante->matricula }}</td>
                        <td class="nombre-completo">
                            <span class="bold">Nombres: {{ $estudiante->nombre }}</span>
                            <span class="bold">Paterno: {{ $estudiante->ap_paterno }}</span>
                            <span class="bold">Materno: {{ $estudiante->ap_materno }}</span>
                        </td>
                        @for ($semana = 1; $semana <= $apertura->curso->duracion_semanas; $semana++)
                            <td>
                                <div class="form-check">
                                    <label for="colegiatura-{{ $estudiante->matricula }}-semana{{ $semana }}">Colegiatura</label>
                                    <input class="form-check-input" type="checkbox" name="colegiatura[{{ $estudiante->matricula }}][semana{{ $semana }}]" id="colegiatura-{{ $estudiante->matricula }}-semana{{ $semana }}" {{ $estudiante->estado === 'baja' ? 'disabled' : '' }}>
                                </div>
                                <div class="form-check">
                                    <label for="asistencia-{{ $estudiante->matricula }}-semana{{ $semana }}">Asistencia</label>
                                    <input class="form-check-input" type="checkbox" name="asistencia[{{ $estudiante->matricula }}][semana{{ $semana }}]" id="asistencia-{{ $estudiante->matricula }}-semana{{ $semana }}" {{ $estudiante->estado === 'baja' ? 'disabled' : '' }}>
                                </div>
                            </td>
                        @endfor
                        <td>
                            @if ($estudiante->estado === 'baja')
                                <span class="badge bg-danger">Alumno baja</span>
                            @else
                                <form action="{{ route('darDeBaja') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="matricula" value="{{ $estudiante->matricula }}">
                                    <input type="hidden" name="curso_apertura_id" value="{{ $apertura->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Dar de baja <i class="fa fa-times"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Guardar Asistencias y Pagos</button>
        </form>
    </div>


    <a href="{{ route('plataforma.historial-cursos') }}" class="btn btn-secondary">Volver a Plataforma</a>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#studentsTable tbody tr');

        rows.forEach(row => {
            const matricula = row.cells[0].textContent.toLowerCase();
            if (matricula.indexOf(filter) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
