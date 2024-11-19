<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Estudiante; // Modelo de Estudiante

class BuscarEstudiantes extends Component
{
    public $matricula = ''; // Campo para la búsqueda
    public $estudiantes = []; // Resultados
    public function render()
    {
        // Actualizar los resultados al renderizar
        $estudiantes = Estudiante::where('matricula', 'like', '%' . $this->matricula . '%')
            ->with('persona') // Asegúrate de que la relación "persona" está cargada
            ->take(10)
            ->get();

        return view('livewire.buscar-estudiantes', compact('estudiantes'));
    }
}
