<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Estudiante;

class BuscadorEstudiantes extends Component
{
    public $query = '';
    public $resultados = [];

    // Método que se ejecuta cuando "query" se actualiza
    public function updatedQuery()
    {
        // Solo buscar por la matrícula (campo clave primaria)
        $this->resultados = Estudiante::where('matricula', 'like', '%' . $this->query . '%')
            ->take(10) // Limitar los resultados a 10
            ->get();
    }

    public function render()
    {
        return view('livewire.buscador-estudiantes');
    }
}
