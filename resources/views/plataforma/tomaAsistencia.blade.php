<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $apertura->nombre }} - Asistencia y Colegiatura</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #fce4ec; /* Fondo rosa claro */
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 40px;
            overflow-x: auto; /* Scroll horizontal */
        }

        .header {
            background-color: #f48fb1; /* Rosa pastel suave */
            padding: 20px;
            border-radius: 12px 12px 0 0;
            color: white;
            text-align: left;
            margin-bottom: 20px;
        }

        .header i {
            font-size: 24px; /* Reduzco el tamaño de los iconos */
            margin-right: 10px;
        }

        .header h1 {
            font-size: 26px;
            margin-top: 10px;
            font-weight: 600;
        }

        .header p {
            font-size: 16px; /* Ajusto el tamaño de la fuente */
            margin: 5px 0; /* Ajusto el espaciado entre párrafos */
        }

        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap; /* Evitar salto de línea en celdas */
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table-bordered th, .table-bordered td {
            border-color: #f1f8fe;
        }

        .table th {
            background-color: #f8bbd0; /* Rosa claro para el encabezado */
            color: #333;
            font-weight: bold;
        }

        .table td {
            background-color: #fce4ec; /* Fondo rosa claro para las celdas */
        }

        .btn-baja {
            background-color: #f06292; /* Rosa más intenso */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-baja:hover {
            background-color: #ec407a; /* Rosa más oscuro */
        }

        .btn-guardar {
            background-color: #ab47bc; /* Rosa más oscuro */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
        }

        .btn-guardar:hover {
            background-color: #8e24aa; /* Rosa más oscuro */
        }

        .badge {
            font-size: 14px;
        }

        .bg-danger {
            background-color: #f8d7da !important;
            color: #721c24;
        }

        /* Estilos mejorados para los checkboxes */
        .checkbox-container {
            display: inline-flex;
            align-items: center;
            margin-bottom: 5px;
            justify-content: center;
        }

        .checkbox-container input[type="checkbox"] {
            width: 18px; /* Ajusta el tamaño del checkbox */
            height: 18px;
            margin-right: 6px; /* Espaciado entre el checkbox y la etiqueta */
            cursor: pointer;
            border-radius: 3px; /* Bordes redondeados para los checkboxes */
            border: 2px solid transparent; /* Asegura que los checkboxes tengan bordes */
            background-color: #e1f5fe; /* Azul pastel claro por defecto */
        }

        /* Color Azul para Asistió (sin marcar y marcado) */
        .checkbox-asistio input[type="checkbox"]:checked {
            background-color: #42a5f5; /* Azul más fuerte cuando está marcado */
            border-color: #42a5f5;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zY2hlbWUvZ3JhcGhpY3MiIHZpZXdCb3g9IjAgMCAxMCAxMCIgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiPjxwYXRoIGQ9Ik02IDcuMTE5TDIuNDI3IDMuNDI3TDEgMCAwLjQwNTQuMTkwMiA3LjEyNTEuODUzMC0zLjM3OTg2Ljk1NzEtLjk5OTg1LTEuNzI3MjAwNC0yLjk3MTEuM7J4ZmFjdC0w.'); /* Palomita de color negro */
        }
        .checkbox-asistio input[type="checkbox"]:checked ~ .checkbox-label {
            color: #42a5f5; /* Texto azul más oscuro para Asistió cuando está marcado */
        }

        /* Color Verde para Colegiatura */
        .checkbox-colegiatura input[type="checkbox"]:checked {
            background-color: #388e3c; /* Verde cuando marcado */
            border-color: #388e3c;
        }
        .checkbox-colegiatura input[type="checkbox"]:checked ~ .checkbox-label {
            color: #388e3c; /* Verde para el texto cuando marcado */
        }

        .checkbox-label {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            margin: 0;
        }

        .disabled-checkbox {
            background-color: #f1f1f1; /* Color gris cuando está deshabilitado */
            cursor: not-allowed;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Header de la página -->
    <div class="header">
        <div>
            <i class="fa fa-graduation-cap"></i>
            <h1>{{ $apertura->nombre }} - Asistencia y Colegiatura</h1>
            <p><i class="fa fa-calendar-day"></i> Fecha de inicio: <strong>{{ $apertura->fecha_inicio }}</strong></p>
            <p><i class="fa fa-dollar"></i> Monto de colegiatura: <strong>${{ $apertura->monto_colegiatura }}</strong></p>
            <p><i class="fa fa-calendar"></i> Día de clase: <strong>{{ $apertura->dia_clase }}</strong></p>
            <p><i class="fa fa-clock"></i> Hora de clase: <strong>{{ $apertura->hora_clase }}</strong></p>
        </div>
    </div>
    <!-- Tabla de asistencia -->
    <h3 class="my-4">Lista de Estudiantes Inscritos</h3>
    <form id="formAsistencia" action="{{ route('guardarAsistencia', ['curso_apertura_id' => $idApertura]) }}" method="POST">
        @csrf
        <!-- Tabla de Asistencia -->
        <table class="table">
            <thead>
            <tr>
                <th>Matricula</th>
                <th>Nombre</th>
                @for ($i = 1; $i <= $cantidad_semanas; $i++)
                    <th>Semana {{ $i }}</th>
                @endfor
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($estudiantesInscritos as $matricula => $estudiante)
                <tr>
                    <td>{{ $matricula }}</td>
                    <td>{{ $estudiante['nombre'] }}</td>

                    @for ($i = 1; $i <= $cantidad_semanas; $i++)
                        <td>
                            <!-- Hidden input to ensure the "off" state is sent for asistencia -->
                            <input type="hidden" name="asistencia[{{ $matricula }}][{{ $i }}]" value="off">

                            <div class="checkbox-container checkbox-asistio">
                                <input type="checkbox" name="asistencia[{{ $matricula }}][{{ $i }}]"
                                    {{ isset($estudiante['semanas'][$i]['asistio']) && $estudiante['semanas'][$i]['asistio'] ? 'checked' : '' }}
                                    {{ $estudiante['estado'] == 'baja' ? 'disabled' : '' }}>
                                <label>Asistió</label>
                            </div>

                            <!-- Hidden input to ensure the "off" state is sent for colegiatura -->
                            <input type="hidden" name="colegiatura[{{ $matricula }}][{{ $i }}]" value="off">

                            <div class="checkbox-container checkbox-colegiatura">
                                <input type="checkbox" name="colegiatura[{{ $matricula }}][{{ $i }}]"
                                    {{ isset($estudiante['semanas'][$i]['colegiatura']) && $estudiante['semanas'][$i]['colegiatura'] ? 'checked' : '' }}
                                    {{ $estudiante['estado'] == 'baja' ? 'disabled' : '' }}>
                                <label>Colegiatura</label>
                            </div>

                            <!-- Hidden input for collegiatura ID -->
                            @if (isset($estudiante['semanas'][$i]['id_colegiatura']))
                                <input type="hidden" name="colegiatura_id[{{ $matricula }}][{{ $i }}]" value="{{ $estudiante['semanas'][$i]['id_colegiatura'] }}">
                            @endif
                        </td>
                    @endfor

                    <td>
                        @if ($estudiante['estado'] != 'baja')
                            <!-- Botón de dar de baja que abre el modal -->
                            <button type="button" class="btn-baja" data-toggle="modal" data-target="#bajaModal{{ $matricula }}">
                                Dar de baja
                            </button>
                        @else
                            <span class="badge badge-danger">Baja</span>
                        @endif
                    </td>
                </tr>

                <!-- Modal para confirmación de baja -->
                <div class="modal fade" id="bajaModal{{ $matricula }}" tabindex="-1" role="dialog" aria-labelledby="bajaModalLabel{{ $matricula }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bajaModalLabel{{ $matricula }}">Confirmar Baja de {{ $estudiante['nombre'] }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro que desea dar de baja a este estudiante? Esta acción no se puede deshacer.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                <!-- Formulario para enviar la solicitud de baja -->
                                <form action="{{ route('darDeBaja') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="matricula" value="{{ $matricula }}">
                                    <input type="hidden" name="apertura_id" value="{{ $idApertura }}">
                                    <button type="submit" class="btn btn-danger">Confirmar Baja</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn-guardar">Guardar Cambios</button>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
