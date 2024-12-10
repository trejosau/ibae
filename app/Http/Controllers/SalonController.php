<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Citas;
use Carbon\Carbon;


class SalonController extends Controller
{
    public function index()
    {
        return view('salon.index');
    }
    public function agendar(){
        $servicios = Servicios::all();
        return view('salon.agendar' , compact('servicios'));
    }
    public function confirmar(){
        return view('salon.confirmarCita');
    }

    public function miagenda()
    {
        // Obtenemos al estilista autenticado
        $estilista = Auth::user()->persona?->estilista;
    
        if (!$estilista) {
            return redirect()->back()->with('error', 'No tienes citas asignadas.');
        }
    
        // Obtenemos las citas del estilista, incluyendo comprador, detalleCita y servicio
        $citas = Citas::where('id_estilista', $estilista->id)
            ->with(['comprador.persona', 'detalleCita.servicio'])
            ->orderBy('fecha_hora_inicio_cita', 'asc')
            ->paginate(10); // Número de registros por página
    
        // Retornamos la vista con las citas del estilista
        return view('salon.miagenda', compact('citas'));
    }
    

    public function miscitas()
    {
        $comprador = Auth::user()->persona?->comprador;
    
        if (!$comprador) {
            return redirect()->back()->with('error', 'No tienes citas registradas.');
        }
    
        $citas = Citas::where('id_comprador', $comprador->id)
            ->with(['estilista.persona', 'detalleCita.servicio'])
            ->paginate(10) // Paginación de 10 citas por página
            ->through(function ($cita) {
                // Calcula el total de los servicios por cita
                $cita->totalServicios = $cita->detalleCita->sum(function ($detalle) {
                    return $detalle->servicio->precio;
                });
                return $cita;
            });
    
        // Asegurarse de que cada cita tenga el campo estado_cita accesible
        $citas->each(function ($cita) {
            $cita->estado_cita = $cita->estado_cita;
        });
    
        return view('salon.miscitas', compact('citas'));
    }
    


    public function reprogramar(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        // Buscar la cita por ID
        $cita = Citas::findOrFail($id);

        // Actualizar la fecha y hora
        $nuevaFechaHora = $request->fecha . ' ' . $request->hora;
        $cita->update([
            'fecha_hora_inicio_cita' => $nuevaFechaHora,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->back()->with('success', 'La cita se ha reprogramado correctamente.');
    }



    public function concluirPago($id)
    {
        // Buscar la cita por ID
        $cita = Citas::findOrFail($id);

        // Verificar el estado del pago
        if ($cita->estado_pago !== 'anticipo') {
            return redirect()->back()->with('error', 'El pago no está en estado de anticipo, no se puede concluir.');
        }

        // Realizar la actualización
        $cita->update([
            'estado_pago' => 'concluido',
            'anticipo' => 0,
            'pago_restante' => 0,
            'estado_cita' => 'completada'
        ]);

        // Verificar la actualización
        if ($cita->estado_cita == 'completada') {
            return redirect()->back()->with('success', 'El pago se ha concluido correctamente y la cita está ahora completada.');
        } else {
            return redirect()->back()->with('error', 'Hubo un error al actualizar el estado de la cita.');
        }
    }


    public function completarCita($id)
{
    // Encuentra la cita
    $cita = Citas::findOrFail($id);

    // Verifica que la cita no esté ya completada
    if ($cita->estado_cita == 'completada') {
        return redirect()->back()->with('error', 'La cita ya está completada.');
    }

    // Actualiza los valores
    $cita->estado_cita = 'completada';

    // Guarda los cambios
    $cita->save();

    return redirect()->back()->with('success', 'Cita completada y pago actualizado.');
}

}
