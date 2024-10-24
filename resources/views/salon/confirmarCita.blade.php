<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendador de Citas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Pickadate CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/themes/default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/themes/default.date.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/themes/default.time.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 90%;
            max-width: 1200px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .calendar-container {
            padding: 20px;
            flex: 2;
        }

        .resumen-citas {
            background-color: #f9f9f9;
            padding: 20px;
            flex: 1;
            border-left: 1px solid #e0e0e0;
        }

        h2, h3 {
            margin-bottom: 15px;
            font-size: 1.6em;
            color: #333;
        }

        input[type="text"].datepicker, input[type="text"].timepicker {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: border-color 0.2s ease-in-out;
        }

        input[type="text"].datepicker:focus, input[type="text"].timepicker:focus {
            border-color: #6c757d;
            outline: none;
        }

        .horarios-ocupados {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f1f3f5;
            font-size: 1em;
            color: #333;
        }

        .horarios-ocupados h4 {
            margin-bottom: 10px;
        }

        .horarios-ocupados ul {
            list-style-type: none;
            padding: 0;
        }

        .horarios-ocupados ul li {
            margin-bottom: 5px;
        }

        .horarios-ocupados .empty {
            color: #868e96;
        }

        .resumen-citas ul {
            list-style-type: none;
            padding: 0;
        }

        .resumen-citas li {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .resumen-citas li:last-child {
            border-bottom: none;
        }

        .btn-confirmar {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: #fff;
            font-size: 1.1em;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-confirmar:hover {
            background-color: #218838;
        }

        /* Estilos para el logo y los botones con diseño más limpio */
        .contenedor-logo {
            background-color: #ccf3dc; /* Azul claro elegante */
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .logo {
            width: 120px;
            height: auto;
        }

        .contenedor-logo a {
            padding: 10px 20px;
            font-size: 1em;
            font-weight: 500;
            color: #ffffff;
            background-color: #ccf3dc; /* Verde claro */
            border-radius: 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.2s ease;
        }

        .contenedor-logo a:hover {
            background-color: #4bdacc;
        }

        i {
            margin-right: 10px;
        }

        /* Responsiveness */
        @media (min-width: 768px) {
            .container {
                flex-direction: row;
                gap: 20px;
            }
        }

        @media (max-width: 767px) {
            .resumen-citas {
                border-left: none;
            }
        }

        @media (max-width: 576px) {
            h2, h3 {
                font-size: 1.4em;
            }

            .btn-confirmar {
                font-size: 1em;
            }

            .container {
                width: 100%;
                padding: 10px;
            }

            .contenedor-logo {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .logo {
                width: 100px;
            }

            .calendar-container, .resumen-citas {
                padding: 15px;
            }
        }


    </style>
</head>
<body>
<div class="container d-flex justify-content-between align-items-center py-2 contenedor-logo">
    <div class="logo">
        <img src="{{asset('images/logo-salon.jpg')}}" alt="Rosy Saucedo Salon" class="img-fluid w-100 h-100 object-fit-cover">
    </div>
    <a href="{{ route('salon.index') }}" class="btn d-flex align-items-center">
        <i class="fa fa-chevron-circle-left"></i>
        Volver a inicio
    </a>
    <a href="{{ route('salon.agendar') }}" class="btn d-flex align-items-center">
        <i class="fa fa-pencil-alt"></i>
        Modificar servicios
    </a>
</div>

<div class="container">
    <div class="calendar-container">
        <h2>Selecciona una Fecha</h2>
        <input type="text" class="datepicker">
        <h2>Selecciona una Hora</h2>
        <input type="text" class="timepicker">

        <div class="horarios-ocupados" id="horarios-ocupados">
        </div>
    </div>

    <div class="resumen-citas">
        <h3>Resumen de Citas</h3>
        <p>3 servicios - $455.00 - 3 hr 45 min</p>
        <ul>
            <li>
                <span>Secado</span>
                <span>$75.00</span>
            </li>
            <li>
                <span>Doble Proceso</span>
                <span>$250.00</span>
            </li>
            <li>
                <span>Corte</span>
                <span>$130.00</span>
            </li>
        </ul>
        <button class="btn-confirmar">Confirmar</button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.date.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.time.js"></script>

<script>
    $(document).ready(function() {
        var horariosOcupados = {
            '2024-10-25': [
                { inicio: '13:00', fin: '18:00' }
            ],
            '2024-10-26': [
                { inicio: '09:00', fin: '11:00' },
                { inicio: '14:00', fin: '16:00' }
            ]
        };

        var $datePicker = $('.datepicker').pickadate({
            format: 'yyyy-mm-dd',
            onSet: function(context) {
                var fechaSeleccionada = $datePicker.pickadate('picker').get('select', 'yyyy-mm-dd');
                if (horariosOcupados[fechaSeleccionada]) {
                    actualizarUIHorariosOcupados(horariosOcupados[fechaSeleccionada]);
                    var horariosADeshabilitar = horariosOcupados[fechaSeleccionada].map(function(horario) {
                        return [horario.inicio, horario.fin];
                    });
                    actualizarHorariosOcupados(horariosADeshabilitar);
                } else {
                    actualizarUIHorariosOcupados([]);
                    actualizarHorariosOcupados([]);
                }
            }
        });

        var $timePicker = $('.timepicker').pickatime({
            format: 'HH:i',
            interval: 60
        });

        function actualizarHorariosOcupados(horariosADeshabilitar) {
            var $timePickerInstance = $timePicker.pickatime('picker');
            $timePickerInstance.clear();
            if (horariosADeshabilitar.length > 0) {
                $timePickerInstance.set('disable', horariosADeshabilitar.map(function(rangoHorario) {
                    var inicio = rangoHorario[0].split(':').map(Number);
                    var fin = rangoHorario[1].split(':').map(Number);
                    return {
                        from: inicio[0] * 60 + inicio[1],
                        to: fin[0] * 60 + fin[1]
                    };
                }));
            } else {
                $timePickerInstance.set('enable', true);
            }
        }

        function actualizarUIHorariosOcupados(horarios) {
            var $horariosOcupadosContainer = $('#horarios-ocupados');
            if (horarios.length > 0) {
                var html = '<h4>Horarios Ocupados:</h4><ul>';
                horarios.forEach(function(horario) {
                    html += '<li>' + horario.inicio + ' - ' + horario.fin + '</li>';
                });
                html += '</ul>';
                $horariosOcupadosContainer.html(html);
            } else {
                $horariosOcupadosContainer.html('<h4>Horarios Ocupados:</h4><p class="empty">No hay horarios ocupados para esta fecha.</p>');
            }
        }
    });
</script>
</body>
</html>
