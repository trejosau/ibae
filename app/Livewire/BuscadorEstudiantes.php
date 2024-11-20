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
        $this->resultados = Estudiante::with('persona.usuario')
        ->where('matricula', 'like', '%' . $this->query . '%')
        ->orWhereHas('persona', function ($query) {
            $query->where('nombre', 'like', '%' . $this->query . '%')
                ->orWhere('ap_paterno', 'like', '%' . $this->query . '%')
                ->orWhere('ap_materno', 'like', '%' . $this->query . '%');
        })
        ->get();
    }

    public function render()
    {
        return view('livewire.buscador-estudiantes');
    }
}
