<?php

namespace App\Livewire;

use Livewire\Component;

class ResumenVenta extends Component
{
    public $esEstudiante = false;
    public $matricula = '';

    public function render()
    {
        return view('livewire.resumen-venta');
    }
}
