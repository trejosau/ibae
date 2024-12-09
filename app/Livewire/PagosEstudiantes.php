<?php

namespace App\Livewire;

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
        // Subconsulta para obtener el último pago por cada estudiante curso
        $subquery = DB::table('colegiaturas')
            ->select('id_estudiante_curso', DB::raw('MAX(fecha_pago) as max_fecha_pago'))
            ->where('semana', 1)
            ->groupBy('id_estudiante_curso');

        // Consulta principal para obtener las colegiaturas con los detalles del último pago
        $query = Colegiaturas::joinSub($subquery, 'ultimo_pago', function ($join) {
            $join->on('colegiaturas.id_estudiante_curso', '=', 'ultimo_pago.id_estudiante_curso')
                ->on('colegiaturas.fecha_pago', '=', 'ultimo_pago.max_fecha_pago');
        })
            ->with(['estudianteCurso.estudiante.persona', 'estudianteCurso.cursoApertura', 'estudianteCurso.colegiaturas'])
            ->distinct();  // Para evitar duplicados

        // Filtrar por matrícula si se ha proporcionado
        if (!empty($this->matricula)) {
            $query->whereHas('estudianteCurso.estudiante', function ($q) {
                $q->where('matricula', 'like', '%' . $this->matricula . '%');
            });
        }

        // Filtrar por nombre si se ha proporcionado
        if (!empty($this->nombre)) {
            $query->whereHas('estudianteCurso.estudiante.persona', function ($q) {
                $q->where('nombre', 'like', '%' . $this->nombre . '%');
            });
        }

        // Filtrar por fecha de pago exacta
        if (!empty($this->fecha_pago)) {
            $query->whereDate('colegiaturas.fecha_pago', $this->fecha_pago);
        }

        // Filtrar por fecha de inicio si se ha proporcionado
        if (!empty($this->fecha_inicio)) {
            $query->where('colegiaturas.fecha_pago', '>=', $this->fecha_inicio);
        }

        // Filtro por rango de fechas (fecha de inicio y fecha de fin)
        if (!empty($this->fecha_inicio) && !empty($this->fecha_fin)) {
            $query->whereBetween('colegiaturas.fecha_pago', [$this->fecha_inicio, $this->fecha_fin]);
        }

        // Ejecutar la consulta y obtener los resultados
        $colegiaturas = $query->paginate(9);  // Cambia el número según tus necesidades.

        // Calcular el adeudo de cada colegiatura
        foreach ($colegiaturas as $colegiatura) {
            $adeudo = $colegiatura->estudianteCurso->colegiaturas
                ->where('colegiatura', 0)  // Asumiendo que 0 significa no pagado
                ->sum('Monto');

            $colegiatura->adeudo = $adeudo;
        }

        return $colegiaturas;
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

