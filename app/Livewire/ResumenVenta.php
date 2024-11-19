<?php

namespace App\Livewire;

use Livewire\Component;

class ResumenVenta extends Component
{
    public $esEstudiante = false;
    public $matricula = ''; // Agregar la propiedad de matrícula

    public function updatedEsEstudiante($value)
    {
        // Esto te permitirá ver cuando el valor de $esEstudiante cambia.
        logger('El valor de esEstudiante es: ' . ($value ? 'true' : 'false'));
    }


    public function render()
    {
        return view('livewire.resumen-venta');
    }
}
