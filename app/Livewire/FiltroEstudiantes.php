<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Estudiante;
use Livewire\WithPagination;

class FiltroEstudiantes extends Component
{
    use WithPagination;

    public $query;

    protected $updatesQueryString = ['query'];
    public function updatedQuery()
{
    $this->resetPage(); // Regresa siempre a la página 1 cuando cambie el filtro
}


    public function render()
    {
        $estudiantes = Estudiante::with('persona')
        ->when($this->query, function ($query) {
            $query->where('matricula', 'like', '%' . $this->query . '%')
                  ->orWhereHas('persona', function ($q) {
                      $q->where('nombre', 'like', '%' . $this->query . '%');
                  });
        })
        ->paginate(6);

        return view('livewire.filtro-estudiantes', compact('estudiantes'));
    }
}