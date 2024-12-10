<?php

namespace App\Livewire;

use App\Models\EstudianteCurso;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Colegiaturas;
use Livewire\WithPagination;

class PagosEstudiantes extends Component
{
    use WithPagination;

    public $matricula = '';
    public $nombre = '';
    public $fecha_pago = null;
    public $fecha_inicio = null;
    public $fecha_fin = null;

    public $modalOpen = false;
    public $selectedColegiatura = null;
    protected $paginationTheme = 'bootstrap'; // Opcional, define el tema para la paginación.

    public function historialPagos()
    {
        $query = EstudianteCurso::query();

        // Filtro por matrícula
        if (!empty($this->matricula)) {
            $query->whereHas('estudiante', function ($q) {
                $q->where('matricula', 'like', '%' . $this->matricula . '%');
            });
        }

        // Filtro por nombre del estudiante
        if (!empty($this->nombre)) {
            $query->whereHas('estudiante.persona', function ($q) {
                $q->where('nombre', 'like', '%' . $this->nombre . '%');
            });
        }

        // Filtro por rango de fechas de pago
        if (!empty($this->fecha_inicio) && !empty($this->fecha_fin)) {
            $query->whereHas('colegiaturas', function ($q) {
                $q->whereBetween('fecha_pago', [$this->fecha_inicio, $this->fecha_fin]);
            });
        }

        // Cargar datos agrupados por EstudianteCurso
        $estudianteCursos = $query->with([
            'cursoApertura.curso',    // Curso relacionado
            'estudiante.persona',    // Datos del estudiante
            'colegiaturas',          // Todas las colegiaturas asociadas
        ])->paginate(9);

        // Añadir información adicional (pagos completados y adeudos)
        foreach ($estudianteCursos as $estudianteCurso) {
            $pagosCompletados = $estudianteCurso->colegiaturas->where('colegiatura', 1)->count();
            $totalSemanas = $estudianteCurso->colegiaturas->count();
            $adeudo = $estudianteCurso->colegiaturas->where('colegiatura', 0)->sum('Monto');

            $estudianteCurso->pagos_completados = $pagosCompletados;
            $estudianteCurso->total_semanas = $totalSemanas;
            $estudianteCurso->adeudo = $adeudo;
        }

        return $estudianteCursos;
    }

    public function goToPage($page)
    {
        $this->setPage($page); // Método de Livewire para cambiar la página
    }
    public function render()
    {
        return view('livewire.pagos-estudiantes', [
            'colegiaturas' => $this->historialPagos(),
        ]);
    } public function openModal($id)
    {
        // Obtener los detalles de la colegiatura seleccionada
        $this->selectedColegiatura = Colegiaturas::find($id);
        $this->modalOpen = true; // Abrir el modal
    }

    public function closeModal()
    {
        $this->modalOpen = false; // Cerrar el modal
        $this->selectedColegiatura = null; // Limpiar la colegiatura seleccionada
    }

}

