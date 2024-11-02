<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\Certificados;
use App\Models\CursoApertura;





class PlataformaController extends Controller
{
  
    

    public function misCursos()
    {
        $cursos = Cursos::with('certificado')->get(); 
        $certificados = Certificados::all(); 
        $instituciones = ['SEP', 'Otra']; // Enum de instituciones
    
        return view('plataforma.index', compact('cursos', 'certificados', 'instituciones'));
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
            'institucion' => 'required|string|in:SEP,Otra', // Validación enum
        ]);

        Certificados::create($request->all());

        return redirect()->route('plataforma.mis-cursos')->with('success', 'Certificado creado con éxito.');
    }
    public function cambiarEstado(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $curso = Cursos::find($request->curso_id);
        $curso->estado = $request->estado; // Asegúrate de tener una columna `estado` en la tabla `cursos`
        $curso->save();

        return redirect()->route('plataforma.mis-cursos')->with('success', 'Estado del curso actualizado con éxito.');
    }

    public function historialCursos()
    {
        $cursosApertura = CursoApertura::with('curso')->get(); // Obtiene los cursos de apertura con el curso relacionado
        $cursos = Cursos::all(); // Obtiene todos los cursos para llenar el select en el modal
        return view('plataforma.index', compact('cursosApertura', 'cursos')); // Asegúrate de pasar 'cursos' aquí
    }

    public function storeCursoApertura(Request $request)
    {
        $request->validate([
            'id_curso' => 'required|exists:cursos,id', // Verifica que el curso exista
            'fecha_inicio' => 'required|date',
            'periodo' => 'required|string|max:255',
            'año' => 'required|integer|min:2000|max:' . date('Y'), // Limita el año a un rango razonable
        ]);

        // Obtén el curso para obtener su nombre
        $curso = Cursos::find($request->id_curso);

        // Construye el nombre del curso de apertura
        $nombreCursoApertura = "{$curso->nombre} - {$request->periodo} {$request->año}";

        // Crea un nuevo curso de apertura
        CursoApertura::create([
            'id_curso' => $request->id_curso,
            'nombre' => $nombreCursoApertura, // Usa el nombre construido
            'fecha_inicio' => $request->fecha_inicio,
            'periodo' => $request->periodo,
            'año' => $request->año,
        ]);

        return redirect()->route('plataforma.historial-cursos')->with('success', 'Curso de apertura creado con éxito.');
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
