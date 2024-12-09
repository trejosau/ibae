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
    public function paymentSuccess()
    {
        return redirect()->route('miscitas')->with('success', 'Pago exitoso y cita confirmada');
    }

    /**
     * Manejar la cancelación de un pago de Stripe.
     */
    public function paymentCancel(Request $request)
    {
        $cita = Citas::find($request->id_cita);

        Citas::destroy($cita->id);



        return redirect()->route('salon.agendar')->with('error', 'El pago no fue exitoso.');
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
