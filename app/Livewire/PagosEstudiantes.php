<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Colegiaturas;

class PagosEstudiantes extends Component
{
    public $matricula = '';
    public $nombre = '';
    public $fecha_pago = null;
    public $fecha_inicio = null;
    public $fecha_fin = null;
    public $colegiaturas;

    public function historialPagos()
    {
        $subquery = DB::table('colegiaturas')
            ->select('id_estudiante_curso', DB::raw('MAX(fecha_pago) as max_fecha_pago'))
            ->groupBy('id_estudiante_curso');

        $query = Colegiaturas::joinSub($subquery, 'ultimo_pago', function ($join) {
                $join->on('colegiaturas.id_estudiante_curso', '=', 'ultimo_pago.id_estudiante_curso')
                    ->on('colegiaturas.fecha_pago', '=', 'ultimo_pago.max_fecha_pago');
            })
            ->with(['estudianteCurso.estudiante.persona', 'estudianteCurso.cursoApertura', 'estudianteCurso.colegiaturas']);

        // Filtros dinámicos
        if (!empty($this->matricula)) {
            $query->whereHas('estudianteCurso.estudiante', function ($q) {
                $q->where('matricula', 'like', '%' . $this->matricula . '%');
            });
        }

        if (!empty($this->nombre)) {
            $query->whereHas('estudianteCurso.estudiante.persona', function ($q) {
                $q->where('nombre', 'like', '%' . $this->nombre . '%');
            });
        }

        if (!empty($this->fecha_pago)) {
            $query->whereDate('colegiaturas.fecha_pago', $this->fecha_pago);
        }

        if (!empty($this->fecha_inicio) && !empty($this->fecha_fin)) {
            $query->whereBetween('colegiaturas.fecha_pago', [$this->fecha_inicio, $this->fecha_fin]);
        }

        $colegiaturas = $query->get();

        foreach ($colegiaturas as $colegiatura) {
            $adeudo = $colegiatura->estudianteCurso->colegiaturas
                ->where('colegiatura', 0) // 0 indica no pagado
                ->sum('Monto');

            $colegiatura->adeudo = $adeudo;
        }

        return $colegiaturas;
    }

    public function render()
    {
        $this->colegiaturas = $this->historialPagos();
        return view('livewire.pagos-estudiantes', ['colegiaturas' => $this->colegiaturas]);
    }
}
