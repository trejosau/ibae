<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;  // Asegúrate de tener el modelo Profesor

class ProfesorController extends Controller
{
    // Método para dar de baja al profesor
    public function darBaja($id)
    {
        $profesor = Profesor::find($id);

        if ($profesor) {
            $profesor->estado = 'inactivo';  // Cambiar el estado a inactivo
            $profesor->save();

            return redirect()->back()->with('success', 'Profesor dado de baja exitosamente.');
        }

        return redirect()->back()->with('error', 'Profesor no encontrado.');
    }

    // Método para dar vacaciones al profesor
    public function darVacaciones($id)
    {
        $profesor = Profesor::find($id);

        if ($profesor) {
            $profesor->estado = 'vacaciones';  // Cambiar el estado a vacaciones
            $profesor->save();

            return redirect()->back()->with('success', 'Profesor enviado a vacaciones.');
        }

        return redirect()->back()->with('error', 'Profesor no encontrado.');
    }

    // Método para reactivar al profesor
    public function reactivar($id)
    {
        $profesor = Profesor::find($id);

        if ($profesor) {
            $profesor->estado = 'activo';  // Cambiar el estado a activo
            $profesor->save();

            return redirect()->back()->with('success', 'Profesor reactivado exitosamente.');
        }

        return redirect()->back()->with('error', 'Profesor no encontrado.');
    }

    // Método para terminar las vacaciones del profesor
    public function terminarVacaciones($id)
    {
        $profesor = Profesor::find($id);

        if ($profesor) {
            $profesor->estado = 'activo';  // Cambiar el estado a activo
            $profesor->save();

            return redirect()->back()->with('success', 'Vacaciones del profesor terminadas.');
        }

        return redirect()->back()->with('error', 'Profesor no encontrado.');
    }
}
