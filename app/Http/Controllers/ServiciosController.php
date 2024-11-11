<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    public function agregarServicio(Request $request)
    {
        // Validación de los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'categoria' => 'required|exists:categorias_servicios,id', // Asegúrate de que la categoría exista
            'descripcion' => 'required|string|max:99',
            'duracion_minima' => 'required|integer|min:1',
            'duracion_maxima' => 'required|integer|min:1',
        ]);

        // Crear el nuevo servicio usando los datos enviados
        Servicios::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'categoria' => $request->categoria,
            'descripcion' => $request->descripcion,
            'duracion_minima' => $request->duracion_minima,
            'duracion_maxima' => $request->duracion_maxima,
        ]);

        return redirect()->back()->with('success', 'Servicio agregado correctamente.');

    }


}
