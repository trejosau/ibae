<?php

namespace App\Livewire;

use App\Models\Citas;
use App\Models\Estilista;
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
        // Obtener el servicio seleccionado
        $servicio = Servicios::find($serviceId);

        if (!$servicio) {
            return;
        }

        // Verificar si el servicio ya está en la lista de seleccionados
        $existeServicio = collect($this->selectedServices)->contains(fn($s) => $s->id === $serviceId);

        // Si no está, verificar el límite y agregarlo
        if (!$existeServicio) {
            $nuevaDuracionTotal = $this->duracionTotal + $servicio->duracion_maxima;

            if ($nuevaDuracionTotal > 480) {
                // Si la duración total excede 480 minutos, no agregar el servicio
                return;
            }

            $this->selectedServices[] = $servicio; // Agregar el objeto completo
            $this->duracionTotal = $nuevaDuracionTotal;
        } else {
            // Si el servicio ya está seleccionado, quitarlo y actualizar la duración total
            $this->selectedServices = array_filter(
                $this->selectedServices,
                fn($s) => $s->id !== $serviceId
            );
            $this->duracionTotal -= $servicio->duracion_maxima;
        }
    }

    public function nextStep()
    {
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
        // Crear una nueva cita
        try {
            $cita = Citas::create([
                'id_estilista' => $this->estilistaSeleccionada,
                'id_comprador' => auth()->id(),  // Usando el ID del usuario autenticado
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
