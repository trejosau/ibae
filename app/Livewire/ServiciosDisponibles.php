<?php

namespace App\Livewire;

use App\Models\Citas;
use App\Models\Estilista;
use App\Models\Comprador;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Livewire\Component;
use App\Models\Servicios;

class ServiciosDisponibles extends Component
{

    public $servicios;
    public $estilistaSeleccionada;
    public $fechaElegida;
    public $horaElegida;
    public $horariosLibres = [];
    public $estilistas;
    public $step = 1;
    public $selectedServices = [];
    public $duracionTotal = 0;
    public $fechaMinima;
    public $fechaMaxima;

    public $inputs = [
        ['id' => 'cantidad_piedras', 'label' => 'Piedras', 'value' => 0],
        ['id' => 'cantidad_cristales', 'label' => 'Cristales', 'value' => 0],
        ['id' => 'cantidad_stickers', 'label' => 'Stickers', 'value' => 0],
        ['id' => 'cantidad_efecto_foil', 'label' => 'Foil', 'value' => 0],
        ['id' => 'cantidad_efecto_espejo', 'label' => 'Espejo', 'value' => 0],
        ['id' => 'cantidad_efecto_azucar', 'label' => 'Azúcar', 'value' => 0],
        ['id' => 'cantidad_efecto_mano_alzada', 'label' => 'Mano Alzada', 'value' => 0],
        ['id' => 'cantidad_efecto_3d', 'label' => '3D', 'value' => 0],
    ];

    public $total = 0;
    public $max = 10;

    // Este método se ejecuta cada vez que un input se actualiza.
    public function updated($field)
    {
        // Sumamos todos los valores de los inputs
        $this->total = array_sum(array_column($this->inputs, 'value'));

        // Si el total excede el máximo, ajustamos los valores
        if ($this->total > $this->max) {
            $this->adjustValues();
        }
    }

    private function adjustValues()
    {
        // Restablecemos el total
        $this->total = 0;

        // Ajustamos los valores de los inputs
        foreach ($this->inputs as $key => $input) {
            // Si agregar este valor excede el máximo, ajustamos este campo
            if ($this->total + $input['value'] > $this->max) {
                // Ajustamos el valor del campo para que no se exceda
                $this->inputs[$key]['value'] = $this->max - $this->total;
            }
            // Sumamos el nuevo valor
            $this->total += $this->inputs[$key]['value'];
        }
    }
    public function obtenerHorariosLibres()
    {
        // Verificar que los parámetros necesarios estén definidos
        if (!$this->fechaElegida || !$this->estilistaSeleccionada || $this->duracionTotal <= 0) {
            $this->horariosLibres = [];  // Si falta información, no se muestran horarios
            return;
        }

        // Convertir duración total de minutos a horas (bloques de tiempo)
        $duracionEnHoras = $this->duracionTotal / 60;

        // Definir horarios laborales (ajustar según sea necesario)
        $inicioHorario = new DateTime($this->fechaElegida . ' 08:00:00'); // Hora de inicio de trabajo (9:00 AM)
        $finHorario = new DateTime($this->fechaElegida . ' 20:00:00');    // Hora de fin de trabajo (6:00 PM)
        $intervalo = new DateInterval('PT1H'); // Intervalo de tiempo de 1 hora

        // Generar todos los bloques horarios posibles
        $horarios = [];
        for ($hora = $inicioHorario; $hora < $finHorario; $hora->add($intervalo)) {
            $horarios[] = $hora->format('Y-m-d H:i:s');  // Formato de fecha y hora 'Y-m-d H:i:s'
        }

        // Obtener los horarios ocupados del estilista en la fecha seleccionada
        $horariosOcupados = \DB::table('citas')
            ->where('id_estilista', $this->estilistaSeleccionada)
            ->whereDate('fecha_hora_inicio_cita', $this->fechaElegida) // Filtrar por la fecha
            ->whereIn('estado_cita', ['programada', 'reprogramada', 'completada']) // Filtrar solo citas que están programadas, reprogramadas o completadas
            ->select('fecha_hora_inicio_cita', 'fecha_hora_fin_cita')
            ->get();

        // Array donde almacenaremos los horarios disponibles
        $horariosDisponibles = [];

        // Verificar los bloques de tiempo y comprobar si están ocupados
        foreach ($horarios as $inicioBloque) {
            $inicio = new DateTime($inicioBloque); // Convertir a objeto DateTime
            $fin = (clone $inicio)->modify("+{$this->duracionTotal} minutes"); // Calcular el fin del bloque según la duración total

            // Verificar que el bloque de tiempo no se pase del horario laboral
            if ($fin > $finHorario) {
                break;  // Si el fin del bloque es mayor que el fin del horario, salimos del bucle
            }

            // Comprobar si el bloque está ocupado (si hay un solapamiento con alguna cita)
            $estaOcupado = false;
            foreach ($horariosOcupados as $cita) {
                $inicioCita = new DateTime($cita->fecha_hora_inicio_cita);  // Convertir las fechas de la cita a objetos DateTime
                $finCita = new DateTime($cita->fecha_hora_fin_cita);

                // Si el bloque de tiempo se solapa con la cita, marcar como ocupado
                if ($inicio < $finCita && $fin > $inicioCita) {
                    $estaOcupado = true;
                    break;  // Si encontramos una cita ocupada, dejamos de comprobar
                }
            }

            // Si no está ocupado, agregarlo a los horarios disponibles
            if (!$estaOcupado) {
                $horariosDisponibles[] = $inicio->format('Y-m-d H:i:s'); // Agregar el horario disponible al array
            }
        }

        // Asignar los horarios disponibles a la propiedad del componente
        $this->horariosLibres = $horariosDisponibles;
    }




    public function selectService($serviceId)
    {
        $servicio = Servicios::find($serviceId);
    
        if (!$servicio) return;
    
        // Buscar si ya está seleccionado
        $index = array_search($serviceId, array_column($this->selectedServices, 'id'));
    
        if ($index === false) {
            // Si no está seleccionado, intentar agregar
            if ($this->duracionTotal + $servicio->duracion_maxima > 480) return;
    
            $this->selectedServices[] = $servicio;
            $this->duracionTotal += $servicio->duracion_maxima;
        } else {
            // Si ya está seleccionado, eliminarlo
            unset($this->selectedServices[$index]);
            $this->duracionTotal -= $servicio->duracion_maxima;
        }
    }
    
    public function nextStep()
    {
        // Verificar si el coste total es mayor a 0
        if ($this->calcularTotal($this->selectedServices) === 0) {
            session()->flash('error', 'Debes seleccionar al menos un servicio antes de continuar.');
            return;
        }
    
        $this->step++;
    }
    
    public function previousStep()
    {
        $this->step--;
    }



    public function mount()
    {
        $this->servicios = Servicios::all();
        $this->estilistas = Estilista::all();

            // Establecer fecha mínima (hoy) y máxima (hoy + 7 días)
    $this->fechaMinima = now()->format('Y-m-d');
    $this->fechaMaxima = now()->addDays(7)->format('Y-m-d');

    }

    public function calcularTotal($servicios)
    {
        $total = 0;
        foreach ($servicios as $servicio) {
            $total += $servicio->precio;
        }
        return $total;
    }


    public function confirmarCita()
    {
        // Verificar si los datos necesarios están disponibles
        if (!$this->fechaElegida || !$this->estilistaSeleccionada || !$this->selectedServices) {
            session()->flash('error', 'Faltan datos para confirmar la cita.');
            return;
        }
    
        // Calcular la duración total de la cita basada en los servicios seleccionados
        $duracionTotal = 0;
        foreach ($this->selectedServices as $servicio) {
            $duracionTotal += $servicio->duracion_maxima;
        }
    
        // Calcular los valores de la cita (esto podría basarse en los servicios seleccionados)
        $total = $this->calcularTotal($this->selectedServices);
        $anticipo = $total * 0.30;  // Ejemplo de anticipo del 30%
        $pagoRestante = $total - $anticipo;
        $fechaHoraCompleta = Carbon::parse($this->fechaElegida . ' ' . $this->horaElegida);
        $fechaHoraFin = $fechaHoraCompleta->copy()->addMinutes($duracionTotal);
    
        // Obtener el ID del comprador (usuario autenticado)
        $idComprador = auth()->id();
    
        // Verificar si el comprador existe en la tabla 'compradores' usando el ID del usuario
        $comprador = Comprador::where('id_usuario', $idComprador)->first();
    
        if (!$comprador) {
            session()->flash('error', 'El usuario autenticado no tiene un registro en compradores.');
            return;
        }
    
        // Crear una nueva cita
        try {
            $cita = Citas::create([
                'id_estilista' => $this->estilistaSeleccionada,
                'id_comprador' => $comprador->id,  // Usando el ID del comprador obtenido
                'fecha_hora_creacion' => now(),
                'fecha_hora_inicio_cita' => $fechaHoraCompleta->format('Y-m-d H:i:s'),
                'fecha_hora_fin_cita' => $fechaHoraFin->format('Y-m-d H:i:s'),
                'total' => $total,
                'anticipo' => $anticipo,
                'pago_restante' => $pagoRestante,
                'estado_pago' => 'anticipo',
                'estado_cita' => 'programada',
            ]);
    
            session()->flash('success', 'Cita confirmada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error al confirmar la cita: ' . $e->getMessage());
        }
    }
    
    
    
    public function render()
    {
        return view('livewire.servicios-disponibles', [
            'servicios' => $this->servicios,
            'selectedServices' => $this->selectedServices,
            'duracionTotal' => $this->duracionTotal,
            'estilistas' => $this->estilistas,
        ]);
    }
}
