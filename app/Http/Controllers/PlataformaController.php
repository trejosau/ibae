<?php

namespace App\Http\Controllers;

use App\Models\Colegiaturas;
use App\Models\Estudiante;
use App\Models\EstudianteCurso;
use App\Models\Modulos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\Certificados;
use App\Models\CursoApertura;
use Illuminate\Support\Facades\DB;


class PlataformaController extends Controller
{
    public function guardarAsistencia(Request $request)
    {
    }


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
        // Obtener la lista de estudiantes y sus cursos con estado
        $estudiantes = Estudiante::with(['persona', 'cursosApertura'])->get();

        // Agrupar cursos por estudiante
        $resultado = [];
        foreach ($estudiantes as $estudiante) {
            $matricula = $estudiante->matricula;
            if (!isset($resultado[$matricula])) {
                $resultado[$matricula] = [
                    'matricula' => $matricula,
                    'nombre' => $estudiante->persona->nombre,
                    'ap_paterno' => $estudiante->persona->ap_paterno,
                    'ap_materno' => $estudiante->persona->ap_materno,
                    'cursos' => []
                ];
            }

            // Agregar cursos al estudiante
            foreach ($estudiante->cursosApertura as $curso) {
                // Obtenemos el estado desde la relación pivot
                $estado = $curso->pivot->estado; // Accediendo al estado desde el pivot

                $resultado[$matricula]['cursos'][] = [
                    'id_curso_apertura' => $curso->id,
                    'nombre_curso' => $curso->nombre,
                    'fecha_inicio' => $curso->fecha_inicio,
                    'monto_colegiatura' => $curso->monto_colegiatura,
                    'dia_clase' => $curso->dia_clase,
                    'hora_clase' => $curso->hora_clase,
                    'estado' => $estado // Agregamos el estado aquí
                ];
            }
        }

        // Obtener todos los estudiantes y cursos
        $todosEstudiantes = Estudiante::all();
        $todosCursos = Cursos::all();
        $todosCursosApertura = CursoApertura::all();

        // Pasar los datos a la vista
        return view('plataforma.index', [
            'resultado' => array_values($resultado),
            'estudiantes' => $todosEstudiantes,
            'cursos' => $todosCursos,
            'cursosApertura' => $todosCursosApertura
        ]);
    }



    public function storeAlumnoCurso(Request $request)
    {
        $request->validate([
            'matricula' => 'required|exists:estudiantes,matricula',
            'curso_apertura_id' => 'required|exists:curso_apertura,id',
        ]);

        $estudiante = Estudiante::where('matricula', $request->matricula)->first();
        $cursoApertura = CursoApertura::find($request->curso_apertura_id);

        if ($estudiante && $cursoApertura) {
            $estudiante->cursosApertura()->attach($cursoApertura->id, [
                'fecha_inscripcion' => now(),
                'asistencia' => 0
            ]);

            return redirect()->route('plataforma.historial-cursos')->with('success', 'Alumno con matricula ' . $estudiante->matricula . ' ha sido inscrito en el curso ' . $cursoApertura->curso->nombre);
        }

        return redirect()->route('plataforma.historial-cursos')->with('error', 'Error al inscribir al alumno.');
    }

    public function quitarAlumnoCurso(Request $request)
    {
        $request->validate([
            'matricula' => 'required|exists:estudiantes,matricula',
            'curso_apertura_id' => 'required|exists:curso_apertura,id',
        ]);

        $estudiante = Estudiante::where('matricula', $request->matricula)->first();
        $cursoApertura = CursoApertura::find($request->curso_apertura_id);

        if ($estudiante && $cursoApertura) {
            // Actualizar el estado a 'baja' en la relación
            $estudiante->cursosApertura()->updateExistingPivot($cursoApertura->id, ['estado' => 'baja']);

            return back()->with('success', 'El alumno con matrícula ' . $estudiante->matricula . ' ha sido dado de baja del curso ' . $cursoApertura->curso->nombre);
        }

        return back()->with('error', 'Error al dar de baja al alumno.');
    }




    public function storeCursoApertura(Request $request)
    {
        // Validar la solicitud entrante
        $request->validate([
            'id_curso' => 'required|exists:cursos,id',
            'fecha_inicio' => 'required|date',
            'hora_clase' => 'required|date_format:H:i', // Asegúrate de que el nombre sea correcto
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
            'nombre' => $nombreRegistro,
            'fecha_inicio' => $fecha_inicio,
            'monto_colegiatura' => $request->monto_colegiatura,
            'dia_clase' => $dia_semana,
            'hora_clase' => $request->hora_clase,
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('plataforma.historial-cursos')->with('success', 'Curso aperturado exitosamente.');
    }

    public function registrarAsistencia($idApertura)
    {
        // Obtener la información del curso apertura
        $apertura = CursoApertura::findOrFail($idApertura);

        // Obtener los estudiantes inscritos en el curso apertura, incluyendo el estado
        $estudiantesInscritos = DB::table('estudiante_curso as ec')
            ->join('estudiantes as e', 'ec.id_estudiante', '=', 'e.matricula')
            ->join('personas as p', 'e.id_persona', '=', 'p.id')
            ->where('ec.id_curso_apertura', $idApertura)
            ->select('e.matricula', 'p.nombre', 'p.ap_paterno', 'p.ap_materno', 'ec.estado') // Asegúrate de incluir 'ec.estado'
            ->get();


        // Pasar los datos a la vista
        return view('plataforma.tomaAsistencia', [
            'apertura' => $apertura,
            'estudiantesInscritos' => $estudiantesInscritos,
        ]);
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
