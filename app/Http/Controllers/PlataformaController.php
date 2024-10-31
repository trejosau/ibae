<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\Certificados;




class PlataformaController extends Controller
{
  
    

 // En PlataformaController.php
 public function misCursos()
 {
     $cursos = Cursos::with('certificado')->get(); // Obtiene cursos con sus certificados
     $certificados = Certificados::all(); // Obtiene todos los certificados
     return view('plataforma.index', compact('cursos', 'certificados'));
 }
 

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'duracion_semanas' => 'required|integer|min:1',
        'id_certificacion' => 'nullable|exists:certificados,id', // Asegúrate de que el ID del certificado exista
    ]);

    // Crea un nuevo curso
    $curso = Cursos::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'duracion_semanas' => $request->duracion_semanas,
        'id_certificacion' => $request->id_certificacion, // Guarda el ID del certificado
    ]);

    return redirect()->route('plataforma.mis-cursos')->with('success', 'Curso creado con éxito.');
}
public function storeCertificado(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'horas' => 'required|integer|min:1',
        'institucion' => 'required|string|max:255',
    ]);

    // Crea un nuevo certificado
    Certificados::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'horas' => $request->horas,
        'institucion' => $request->institucion,
    ]);

    return redirect()->route('plataforma.mis-cursos')->with('success', 'Certificado creado con éxito.');
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
