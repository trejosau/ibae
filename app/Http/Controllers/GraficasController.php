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

        return $this->formatearResultadosAcademia($colegiaturasPorMes, $inscripcionesPorMes);
    }

    public function obtenerTotalSalon(Request $request)
    {
        $citasPorMes = Citas::selectRaw('MONTH(fecha_hora_creacion) AS Mes, SUM(total - pago_restante) AS Monto_Total')
            ->whereYear('fecha_hora_creacion', now()->year)
            ->groupBy('Mes')
            ->orderBy('Mes')
            ->get()
            ->keyBy('Mes');

        return $this->formatearResultadosSalon($citasPorMes);
    }

    public function obtenerTotalVentas(Request $request)
    {
        $ventasPorMes = Ventas::selectRaw('MONTH(fecha_compra) AS Mes, SUM(total) AS Total_Ventas')
            ->whereYear('fecha_compra', now()->year)
            ->groupBy('Mes')
            ->orderBy('Mes')
            ->get()->keyBy('Mes');

        $pedidosPorMes = Pedidos::selectRaw('MONTH(`fecha_hora_pedido`) AS Mes, SUM(total) AS Total_Pedidos')
            ->whereYear('fecha_hora_pedido', 2024)
            ->groupBy('Mes')
            ->orderBy('Mes', 'asc')
            ->get();


        return $this->formatearResultadosVentas($ventasPorMes, $pedidosPorMes);
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

    // Formato para los resultados de Academia
    private function formatearResultadosAcademia($colegiaturasPorMes, $inscripcionesPorMes)
    {
        $resultados = [];

        // Iteramos por los meses del 1 al 12
        for ($mes = 1; $mes <= 12; $mes++) {
            $montoColegiaturas = isset($colegiaturasPorMes[$mes]) ? $colegiaturasPorMes[$mes]->Monto_Total : 0;
            $montoInscripciones = isset($inscripcionesPorMes[$mes]) ? $inscripcionesPorMes[$mes]->Monto_Total : 0;

            $resultados[] = [
                'Mes' => $mes,
                'Total' => $montoColegiaturas + $montoInscripciones
            ];
        }

        return response()->json($resultados);
    }

    // Formato para los resultados de Salon (Citas)
    private function formatearResultadosSalon($citasPorMes)
    {
        $resultados = [];

        // Iteramos por los meses del 1 al 12
        for ($mes = 1; $mes <= 12; $mes++) {
            $montoCitas = isset($citasPorMes[$mes]) ? $citasPorMes[$mes]->Monto_Total : 0;

            $resultados[] = [
                'Mes' => $mes,
                'Total' => $montoCitas
            ];
        }

        return response()->json($resultados);
    }

    // Formato para los resultados de Tienda (Ventas y Pedidos)
    private function formatearResultadosVentas($ventasPorMes, $pedidosPorMes)
    {
        $resultados = [];

        // Iteramos por los meses del 1 al 12
        for ($mes = 1; $mes <= 12; $mes++) {
            $montoVentas = isset($ventasPorMes[$mes]) ? $ventasPorMes[$mes]->Total_Ventas : 0;
            $montoPedidos = isset($pedidosPorMes[$mes]) ? $pedidosPorMes[$mes]->Total_Pedidos : 0;

            $resultados[] = [
                'Mes' => $mes,
                'Total' => $montoVentas + $montoPedidos
            ];
        }

        return response()->json($resultados);
    }
}
