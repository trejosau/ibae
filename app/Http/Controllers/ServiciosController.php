<?php

namespace App\Http\Controllers;

use App\Models\Categorias_de_Servicios;
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

    public function agregarCategoria(Request $request)
        {

            $request->validate([
                'nombre' => 'required|string|max:255',
            ]);

            Categorias_de_Servicios::create([
                'nombre' => $request->nombre,
            ]);
            return redirect()->back()->with('success', 'Categoria agregada correctamente.');
        }

        public function updateEstado($id)
{
    $servicio = Servicios::findOrFail($id);
    $servicio->estado = 'inactivo';
    $servicio->save();

    return redirect()->back()->with('success', 'Servicio inactivado correctamente.');
}

        
        public function update(Request $request, $id)
        {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'categoria' => 'required|exists:categorias,id', // Asegúrate de que el ID de la categoría sea válido
                'descripcion' => 'required|string',
                'duracion_minima' => 'required|integer|min:1',
                'duracion_maxima' => 'required|integer|min:1',
                'precio' => 'required|numeric|min:0',
                'estado' => 'required|in:activo,inactivo',
            ]);
        
            $servicio = Servicios::findOrFail($id);
            
            // Actualizamos el servicio con los nuevos datos
            $servicio->update([
                'nombre' => $request->nombre,
                'categoria' => $request->categoria, // Usamos el ID de la categoría seleccionada
                'descripcion' => $request->descripcion,
                'duracion_minima' => $request->duracion_minima,
                'duracion_maxima' => $request->duracion_maxima,
                'precio' => $request->precio,
                'estado' => $request->estado,
            ]);
        
            return redirect()->back()->with('success', 'Servicio actualizado correctamente.');
        }
        

}
