<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Citas;
use App\Models\Colegiaturas;
use App\Models\Comprador;
use App\Models\Estilista;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Pedidos;
use App\Models\Productos;
use App\Models\Profesor;
use App\Models\Ventas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardInicioController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard.inicio');
    }
    public function inicio(Request $request)
    {

        $totalVentasPedidos = Ventas::sum('total') + Pedidos::sum('total');

        $totalCitasConcluido = Citas::where('estado_pago', 'concluido')->sum('total');
        $totalCitasAnticipo = Citas::where('estado_pago', 'anticipo')->sum('anticipo');
        $totalCitas = $totalCitasConcluido + $totalCitasAnticipo;

        $totalInscripciones = Inscripcion::join('estudiantes', 'inscripciones.id', '=', 'estudiantes.id_inscripcion')
            ->sum('inscripciones.precio');

        $totalColegiaturas = Colegiaturas::where('estado', 'pagado')->sum('Monto');

        $totalAcademia = $totalInscripciones + $totalColegiaturas;

        $totalGeneral = $totalVentasPedidos + $totalCitas + $totalAcademia;


        $compradoresCount = Comprador::count();
        $estilistasCount = Estilista::count();
        $administradoresCount = Administrador::count();
        $profesoresCount = Profesor::count();
        $estudiantesCount = Estudiante::count();


        $totalUsuarios = $compradoresCount + $estilistasCount + $administradoresCount + $profesoresCount + $estudiantesCount;

        $productos = Productos::all();

        $valorStock = $productos->sum(function ($producto) {
            return $producto->precio_proveedor * $producto->stock;
        });

        // Calcular el valor de stock venta
        $valorStockVenta = $productos->sum(function ($producto) {
            return $producto->precio_venta * $producto->stock;
        });


        // Retornar vista con los datos necesarios
        return view('dashboard.index', compact(
            'totalVentasPedidos',
            'totalCitas',
            'totalAcademia',
            'totalGeneral',
            'compradoresCount',
            'estilistasCount',
            'administradoresCount',
            'profesoresCount',
            'estudiantesCount',
            'totalUsuarios',
            'valorStock',
            'valorStockVenta',
        ));
    }


    public function ventas(Request $request)
    {
        return view('dashboard.index');
    }

    public function compras(Request $request)
    {
        return view('dashboard.index');
    }

    public function citas(Request $request)
    {
        return view('dashboard.index');
    }

    public function servicios(Request $request)
    {
        return view('dashboard.index');
    }

    public function productos(Request $request)
    {
        return view('dashboard.index');
    }

    public function usuarios(Request $request)
    {
        return view('dashboard.index');
    }

    public function auditoria(Request $request)
    {
        return view('dashboard.index');
    }

    public function profile(Request $request)
    {
        return view('dashboard.index');
    }

}
