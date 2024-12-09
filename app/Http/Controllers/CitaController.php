<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\DetalleCita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;

class CitaController extends Controller
{


    /**
     * Manejar la redirección después de un pago exitoso.
     */
    public function paymentSuccess(Request $request)
    {
        $citaId = $request->get('cita_id');

        // Verificar si la cita existe
        $cita = Citas::find($citaId);
        if (!$cita) {
            session()->flash('error', 'No se encontró la cita para confirmar el pago.');
            return redirect()->route('cita.index');
        }

        // Aquí deberías verificar el pago en Stripe y asegurarte de que se haya completado correctamente
        $paymentIntent = PaymentIntent::retrieve($request->get('payment_intent'));

        // Solo proceder si el pago fue exitoso
        if ($paymentIntent->status === 'succeeded') {
            // Actualizar la cita para confirmar el pago
            $cita->update([
                'estado_pago' => 'pagado',
                'estado_cita' => 'confirmada',
            ]);

            // Registrar los detalles de la cita
            foreach ($request->selectedServices as $servicio) {
                DetalleCita::create([
                    'id_cita' => $cita->id,
                    'id_servicio' => $servicio['id'],
                ]);
            }

            session()->flash('success', 'Pago confirmado y cita agendada exitosamente.');
            return redirect()->route('miscitas');
        } else {
            session()->flash('error', 'El pago no se completó correctamente.');
            return redirect()->route('cita.index');
        }
    }

    /**
     * Manejar la cancelación de un pago de Stripe.
     */
    public function paymentCancel()
    {
        session()->flash('error', 'El pago fue cancelado.');
        return redirect()->route('salon.agendar');
    }

    /**
     * Calcular el total de los servicios seleccionados.
     */
    private function calcularTotal($selectedServices)
    {
        $total = 0;
        foreach ($selectedServices as $servicio) {
            $total += $servicio['precio']; // Aquí asumes que cada servicio tiene un campo 'precio'
        }
        return $total;
    }
}
