<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;


class PlataformaController extends Controller
{
    public function index() {
        return view('plataforma.index');
    }

    public function misCursos() {
        // Supongamos que tienes un modelo Curso
        $cursos = Cursos::all();
    
        // Pasamos los cursos a la vista
        return view('plataforma.index', compact('cursos'));
    }


    public function destroy($id) {
        // Encuentra el curso por su ID
        $curso = Cursos::findOrFail($id);
        
        // Elimina el curso
        $curso->delete();
    
        // Redirige a la lista de cursos con un mensaje de éxito
        return redirect()->route('plataforma.mis-cursos')->with('success', 'Curso eliminado con éxito.');
    }
    public function update(Request $request, $id) {
        // Valida los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'duracion_semanas' => 'required|integer',
        ]);
    
        // Encuentra el curso por su ID
        $curso = Cursos::findOrFail($id);
        
        // Actualiza los campos del curso
        $curso->nombre = $request->nombre;
        $curso->descripcion = $request->descripcion;
        $curso->duracion_semanas = $request->duracion_semanas;
        $curso->save();
    
        // Redirige a la lista de cursos con un mensaje de éxito
        return redirect()->route('plataforma.mis-cursos')->with('success', 'Curso actualizado con éxito.');
    }

    public function store(Request $request)
{
    // Validar los datos
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'duracion_semanas' => 'required|integer|min:1',
    ]);

    // Crear un nuevo curso
    Cursos::create($validated);

    // Redirigir con un mensaje de éxito
    return redirect()->route('plataforma.mis-cursos')->with('success', 'Curso agregado exitosamente.');
}

    

    public function historialCursos() {
        return view('plataforma.index');
    }

    public function listaModulos() {
        return view('plataforma.index');
    }

    public function temasModulos() {
        return view('plataforma.index');
    }

    public function estudiantes() {
        return view('plataforma.index');
    }

    public function inscripciones() {
        return view('plataforma.index');
    }

    public function profesores() {
        return view('plataforma.index');
    }

    public function pagos() {
        return view('plataforma.index');
    }

    public function historialPagos() {
        return view('plataforma.index');
    }

    public function misCursosEspacio() {
        return view('plataforma.index');
    }

    public function misPagosEspacio() {
        return view('plataforma.index');
    }

    public function perfilEspacio() {
        return view('plataforma.index');
    }
}
