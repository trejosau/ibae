<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Colegiaturas;
use App\Models\Estudiante;
use App\Models\Pedidos;
use App\Models\Ventas;
use Illuminate\Http\Request;

class GraficasController extends Controller
{
    public function obtenerTotalPorMesAcademia(Request $request)
    {
        $colegiaturasPorMes = Colegiaturas::selectRaw('MONTH(fecha_pago) as Mes, SUM(Monto) as Monto_Total')
            ->where('colegiatura', 1)
            ->whereYear('fecha_pago', now()->year)
            ->groupBy('Mes')
            ->orderBy('Mes')
            ->get()
            ->keyBy('Mes');

        $inscripcionesPorMes = Estudiante::join('inscripciones', 'estudiantes.id_inscripcion', '=', 'inscripciones.id')
            ->selectRaw('MONTH(estudiantes.fecha_inscripcion) AS Mes, SUM(inscripciones.precio) AS Monto_Total')
            ->whereYear('estudiantes.fecha_inscripcion', now()->year)
            ->groupBy('Mes')
            ->orderBy('Mes')
            ->get()
            ->keyBy('Mes');

        return $this->formatearResultados($colegiaturasPorMes, $inscripcionesPorMes);
    }

    public function obtenerTotalSalon(Request $request)
    {
        $citasPorMes = Citas::selectRaw('MONTH(fecha_hora_creacion) AS Mes, SUM(total - pago_restante) AS Monto_Total')
            ->whereYear('fecha_hora_creacion', now()->year)
            ->groupBy('Mes')
            ->orderBy('Mes')
            ->get()
            ->keyBy('Mes');

        return $this->formatearResultados($citasPorMes);
    }

    public function obtenerTotalVentas(Request $request)
    {
        $ventasPorMes = Ventas::selectRaw('MONTH(fecha_compra) AS Mes, SUM(total) AS Total_Ventas')
            ->whereYear('fecha_compra', now()->year)
            ->groupBy('Mes')
            ->orderBy('Mes')
            ->get()->keyBy('Mes');

        $pedidosPorMes = Pedidos::selectRaw('MONTH(fecha_pedido) AS Mes, SUM(total) AS Total_Pedidos')
            ->whereYear('fecha_pedido', now()->year)
            ->groupBy('Mes')
            ->orderBy('Mes')
            ->get()->keyBy('Mes');

        return $this->formatearResultados($ventasPorMes, $pedidosPorMes);
    }

    public function obtenerData(Request $request)
    {
        $academiaData = $this->obtenerTotalPorMesAcademia($request)->getData(true);
        $citasData = $this->obtenerTotalSalon($request)->getData(true);
        $ventasData = $this->obtenerTotalVentas($request)->getData(true);

        $resultados = [
            'academia' => $academiaData,
            'salon' => $citasData,
            'ventas' => $ventasData
        ];

        return response()->json($resultados);
    }

    private function formatearResultados($data1, $data2 = null)
    {
        $resultados = [];
        for ($mes = 1; $mes <= 12; $mes++) {
            $montoData1 = $data1->get($mes)->Monto_Total ?? 0;

            // Verificamos si $data2 existe y no es null
            $montoData2 = $data2 ? ($data2->get($mes)->Total_Pedidos ?? 0) : 0;

            $resultados[] = [
                'Mes' => $mes,
                'Total' => $montoData1 + $montoData2
            ];
        }

        return response()->json($resultados);
    }
}
