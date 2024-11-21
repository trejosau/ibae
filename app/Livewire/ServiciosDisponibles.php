<?php

namespace App\Livewire;

use App\Models\Estilista;
use Livewire\Component;
use App\Models\Servicios;

class ServiciosDisponibles extends Component
{
    public $horariosLibres = [];
    public $servicios;
    public $estilistaSeleccionada;
    public $fechaElegida;
    public $estilistas;
    public $step = 1;
    public $selectedServices = [];
    public $duracionTotal = 0; // Variable para almacenar la duración total

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
