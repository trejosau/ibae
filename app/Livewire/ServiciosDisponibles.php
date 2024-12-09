<?php

namespace App\Livewire;

use App\Models\Citas;
use App\Models\Estilista;
use App\Models\DetalleCita;
use App\Models\Comprador;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Livewire\Component;
use App\Models\Servicios;
use Illuminate\Support\Facades\DB;


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
    public $anticipo = 0;

    public $tipopago = 'anticipo';
    public $total = 0;
    public $max = 10;
    public function updatedTipopago($value)
    {
        // Lógica para manejar el valor seleccionado
        if ($value == 'anticipo') {
            // Realizar lógica para pago anticipo
        } elseif ($value == 'concluido') {
            // Realizar lógica para pago completo
        }
    }
    // Este método se ejecuta cada vez que un input se actualiza.





    public function obtenerHorariosLibres()
    {
        // Verificar que los parámetros necesarios estén definidos
        if (!$this->fechaElegida || !$this->estilistaSeleccionada || $this->duracionTotal <= 0) {
            $this->horariosLibres = [];
            return;
        }

        // Convertir duración total de minutos a formato horas
        $duracionEnMinutos = $this->duracionTotal;

        // Definir horarios laborales (ajustar según sea necesario)
        $inicioHorario = new DateTime($this->fechaElegida . ' 08:00:00');
        $finHorario = new DateTime($this->fechaElegida . ' 20:00:00');
        $intervalo = new DateInterval('PT30M'); // Intervalo de tiempo de 30 minutos

        // Generar todos los bloques horarios posibles
        $horarios = [];
        for ($hora = $inicioHorario; $hora < $finHorario; $hora->add($intervalo)) {
            $horarios[] = $hora->format('Y-m-d H:i:s');
        }

        // Obtener los horarios ocupados del estilista en la fecha seleccionada
        $horariosOcupados = DB::table('citas')
            ->where('id_estilista', $this->estilistaSeleccionada)
            ->whereDate('fecha_hora_inicio_cita', $this->fechaElegida)
            ->whereIn('estado_cita', ['programada', 'reprogramada', 'completada'])
            ->select('fecha_hora_inicio_cita', 'fecha_hora_fin_cita')
            ->get();

        // Convertir horarios ocupados a un formato manipulable
        $horariosOcupados = $horariosOcupados->map(function ($cita) {
            return [
                'inicio' => new DateTime($cita->fecha_hora_inicio_cita),
                'fin' => new DateTime($cita->fecha_hora_fin_cita),
            ];
        });

        // Array para almacenar los horarios disponibles
        $horariosDisponibles = [];

        // Evaluar los bloques horarios contra los horarios ocupados
        foreach ($horarios as $inicioBloque) {
            $inicio = new DateTime($inicioBloque);
            $fin = (clone $inicio)->modify("+{$duracionEnMinutos} minutes");

            // Verificar que el bloque no se salga del horario laboral
            if ($fin > $finHorario) {
                break;
            }

            // Verificar si el bloque está ocupado
            $estaOcupado = false;
            foreach ($horariosOcupados as $cita) {
                if ($inicio < $cita['fin'] && $fin > $cita['inicio']) {
                    $estaOcupado = true;
                    break;
                }
            }

            // Si no está ocupado, agregar a los horarios disponibles
            if (!$estaOcupado) {
                $horariosDisponibles[] = $inicio->format('H:i');
            }
        }

        // Actualizar la propiedad de horarios libres
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
        $this->anticipo = $total * 0.30; // Actualizar anticipo basado en el 30% del total
        return $total;
    }


    public function resetDatosCita()
{
    $this->fechaElegida = null;   // Restablecer la fecha elegida
    $this->horaElegida = null;    // Restablecer la hora elegida
    $this->estilistaSeleccionada = null; // Restablecer el estilista seleccionado
    $this->selectedServices = []; // Limpiar los servicios seleccionados
    $this->duracionTotal = 0;     // Restablecer la duración total
    $this->horariosLibres = [];   // Limpiar los horarios libres
}


    public function confirmarCita()
    {
        // Verificar si los datos necesarios están disponibles
        if (!$this->fechaElegida || !$this->estilistaSeleccionada || !$this->selectedServices) {
            session()->flash('error', 'Faltan datos para confirmar la cita.');
            return;
        }

        // Obtener el comprador asociado al usuario autenticado
        $comprador = auth()->user()->persona?->comprador;

        // Verificar si el comprador existe
        if (!$comprador) {
            session()->flash('error', 'No se encontró un comprador asociado a su cuenta.');
            return;
        }

        // Calcular la duración total de la cita basada en los servicios seleccionados
        $duracionTotal = 0;
        foreach ($this->selectedServices as $servicio) {
            $duracionTotal += $servicio->duracion_maxima;
        }

        // Calcular los valores de la cita
        $total = $this->calcularTotal($this->selectedServices);
        $anticipo = $total * 0.30; // Ejemplo de anticipo del 30%
        $pagoRestante = 0;
        $fechaHoraCompleta = Carbon::parse($this->fechaElegida . ' ' . $this->horaElegida);
        $fechaHoraFin = $fechaHoraCompleta->copy()->addMinutes($duracionTotal);

        if ($this->tipopago == 'anticipo') {
            $pagoRestante = $total - $anticipo;
            $total = $anticipo;
        }

        $nombreEstilista = Estilista::find($this->estilistaSeleccionada)->persona->nombre;

        $cita = Citas::create([
            'id_estilista' => $this->estilistaSeleccionada,
            'id_comprador' => $comprador->id,
            'fecha_hora_inicio_cita' => $fechaHoraCompleta,
            'fecha_hora_fin_cita' => $fechaHoraFin,
            'total' => $total,
            'anticipo' => $anticipo,
            'pago_restante' => $pagoRestante,
            'estado_pago' => $this->tipopago,
            'estado_cita' => 'programada',
        ]);


        foreach ($this->selectedServices as $servicio) {
            DetalleCita::create([
                'id_cita' => $cita->id,
                'id_servicio' => $servicio->id,
            ]);
        }

        // Resetear los datos de la cita
        $this->resetDatosCita();


        try {
            // Crear la sesión de pago de Stripe
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'mxn',
                            'product_data' => [
                                'name' => 'Cita Estilista - ' . $nombreEstilista,
                            ],
                            'unit_amount' => $total * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('cita.success'),
                'cancel_url' => route('cita.cancel', ['id_cita' => $cita->id]),
            ]);

            // Redirigir al usuario a la página de pago de Stripe
            return redirect($session->url);

        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error al generar la sesión de pago: ' . $e->getMessage());
            return;
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
