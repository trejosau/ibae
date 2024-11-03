<?php

namespace App\Http\Controllers;

use App\Models\Modulos;
use Carbon\Carbon;
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

    public function cursoDestroy(Request $request)
    {
        $curso = Cursos::find($request->id);

        if ($curso->curso_aperturas()->exists()) {
            return redirect()->route('plataforma.mis-cursos')->with('error', 'No se puede eliminar el curso porque tiene aperturas asociadas.');
        }

        // Si no hay aperturas, eliminar el curso
        $curso->delete();

        return redirect()->route('plataforma.mis-cursos')->with('success', 'Curso eliminado con éxito.');
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
        // Obtener los cursos con su relación de aperturas
        $cursosApertura = CursoApertura::with('curso')->get();

        // Obtener todos los cursos
        $cursos = Cursos::all();

        // Pasar ambas variables a la vista
        return view('plataforma.index', compact('cursosApertura', 'cursos'));
    }


    public function storeCursoApertura(Request $request)
    {
        // Validar la solicitud entrante
        $request->validate([
            'id_curso' => 'required|exists:cursos,id',
            'fecha_inicio' => 'required|date',
            'hora_clase' => 'required|date_format:H:i',
            'monto_colegiatura' => 'required|integer|min:1',
        ]);

        // Obtener el curso seleccionado
        $curso = Cursos::find($request->id_curso);
        $duracion_semanas = $curso->duracion_semanas;

        // Parsear la fecha de inicio
        $fecha_inicio = Carbon::parse($request->fecha_inicio);
        $mes_inicio = $fecha_inicio->translatedFormat('F'); // Mes en español
        $dia_semana = $fecha_inicio->translatedFormat('l'); // Día en español

        // Crear el nombre del registro en el formato deseado
        $nombreRegistro = "{$dia_semana}, {$curso->nombre}, {$request->hora_clase}, {$mes_inicio}";

        // Crear el registro de apertura de curso
        CursoApertura::create([
            'id_curso' => $request->id_curso,
            'nombre' => $nombreRegistro, // Usar el nuevo formato para el nombre
            'fecha_inicio' => $fecha_inicio,
            'monto_colegiatura' => $request->monto_colegiatura,
            'dia_clase' => $dia_semana,
            'hora_clase' => $request->hora_clase, // Añadir la hora de clase
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('plataforma.historial-cursos')->with('success', 'Curso aperturado exitosamente.');
    }



    public function listaModulos()
    {
        $modulos = Modulos::all()->groupBy('categoria');
        return view('plataforma.index', compact('modulos'));
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
