<?php

namespace App\Http\Controllers;

use App\Models\Colegiaturas;
use App\Models\Estudiante;
use App\Models\EstudianteCurso;
use App\Models\ModuloCurso;
use App\Models\Modulos;
use App\Models\ModuloTemas;
use App\Models\Profesor;
use App\Models\Temas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\Certificados;
use App\Models\CursoApertura;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class PlataformaController extends Controller
{
    public function asignarTemas(Request $request)
    {
        // Validación de los datos de entrada
        $validated = $request->validate([
            'modulo_id' => 'required|exists:modulos,id',
            'tema_ids' => 'required|array',
            'tema_ids.*' => 'exists:temas,id',
        ]);

        // Recoge el ID del módulo y los IDs de los temas
        $moduloId = $validated['modulo_id'];
        $temaIds = $validated['tema_ids'];

        // Obtener el nombre del módulo
        $moduloNombre = Modulos::find($moduloId)->nombre; // Asegúrate de que el campo 'nombre' exista en la tabla 'modulos'

        $successMessages = [];
        $errorMessages = [];

        foreach ($temaIds as $temaId) {
            // Inserta el tema en la tabla modulo_temas
            $created = ModuloTemas::create([
                'id_modulo' => $moduloId,
                'id_tema' => $temaId,
            ]);

            // Obtener el nombre del tema
            $temaNombre = Temas::find($temaId)->nombre; // Asegúrate de que el campo 'nombre' exista en la tabla 'temas'

            // Verifica si se creó correctamente
            if ($created) {
                $successMessages[] = "Tema '$temaNombre' asignado correctamente al módulo '$moduloNombre'.";
            } else {
                $errorMessages[] = "Error al asignar el tema '$temaNombre' al módulo '$moduloNombre'.";
            }
        }

        // Mensajes de éxito o error
        $messages = array_merge($successMessages, $errorMessages);

        // Redirecciona con mensajes
        return redirect()->back()->with('messages', $messages);
    }

    public function ligarModulosATemas()
    {
        // Obtener todos los módulos con sus temas y agruparlos por categoría
        $modulos = Modulos::with('temas')->get()->groupBy('categoria');

        // Obtener todos los módulos que no tienen temas asociados
        $modulosSinTemas = DB::table('modulos AS m')
            ->leftJoin('modulo_temas AS mt', 'm.id', '=', 'mt.id_modulo')
            ->select('m.*')
            ->whereNull('mt.id_modulo')
            ->get();


        // Obtener todos los temas disponibles
        $todosLosTemas = Temas::all();

        // Agrupar los temas por categoría
        $temasPorCategoria = [];
        foreach ($todosLosTemas as $tema) {
            $temasPorCategoria[$tema->categoria][] = $tema;
        }

        // Pasar los módulos y los temas a la vista
        return view('plataforma.temas-modulos', compact('modulos', 'todosLosTemas', 'temasPorCategoria', 'modulosSinTemas'));
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
                $estado = $curso->pivot->estado;

                $resultado[$matricula]['cursos'][] = [
                    'id_curso_apertura' => $curso->id,
                    'nombre_curso' => $curso->nombre,
                    'fecha_inicio' => $curso->fecha_inicio,
                    'monto_colegiatura' => $curso->monto_colegiatura,
                    'dia_clase' => $curso->dia_clase,
                    'hora_clase' => $curso->hora_clase,
                    'estado' => $estado
                ];
            }
        }

        // Obtener todos los estudiantes y cursos
        $todosEstudiantes = Estudiante::all();
        $todosCursos = Cursos::where('estado', 'activo')->get();
        $todosCursosApertura = CursoApertura::with(['moduloCursos.modulo.temas']) // Carga los módulos y sus temas
        ->get();
        $modulosConTemas = Modulos::with('temas:id,nombre')->has('temas')->get(['id', 'nombre']);

        $profesores = Profesor::with('persona')->get();

        // Pasar los datos a la vista
        return view('plataforma.index', [
            'resultado' => array_values($resultado),
            'estudiantes' => $todosEstudiantes,
            'cursos' => $todosCursos,
            'cursosApertura' => $todosCursosApertura,
            'modulosConTemas' => $modulosConTemas,
            'profesores' => $profesores,
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
        $estudiante = Estudiante::where('matricula', $request->matricula)->first();

        if (!$estudiante) {
            return back()->with('error', 'Estudiante no encontrado.');
        }

        $estudianteCurso = EstudianteCurso::where('id_estudiante', $estudiante->matricula)
            ->where('id_curso_apertura', $request->apertura_id)
            ->first();


        if ($estudianteCurso) {
            $estudianteCurso->estado = 'baja';
            $estudianteCurso->save();

            return back()->with('success', 'El alumno con matrícula ' . $estudiante->matricula . ' ha sido dado de baja del curso.');
        }

        return back()->with('error', 'El estudiante no está inscrito en este curso.');
    }





    public function storeCursoApertura(Request $request)
    {
        // Validar la solicitud entrante
        $validatedData = $request->validate([
            'id_curso' => 'required|exists:cursos,id',
            'fecha_inicio' => 'required|date',
            'hora_clase' => 'required|date_format:H:i', // Asegúrate de que el formato sea correcto
            'monto_colegiatura' => 'required|integer|min:1',
            'modulos' => 'required|array',
            'id_profesor' => 'required|exists:profesores,id', // Validación para el id_profesor
        ], [
            'id_curso.required' => 'El curso es obligatorio.',
            'id_curso.exists' => 'El curso seleccionado no es válido.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'hora_clase.required' => 'La hora de clase es obligatoria.',
            'hora_clase.date_format' => 'La hora de clase debe estar en el formato HH:mm.',
            'monto_colegiatura.required' => 'El monto de la colegiatura es obligatorio.',
            'monto_colegiatura.integer' => 'El monto de la colegiatura debe ser un número entero.',
            'monto_colegiatura.min' => 'El monto de la colegiatura debe ser al menos 1.',
            'modulos.required' => 'Debe seleccionar al menos un módulo para cada semana.',
            'modulos.array' => 'Los módulos deben estar en un formato de arreglo.',
            'id_profesor.required' => 'Debe seleccionar un profesor.',
            'id_profesor.exists' => 'El profesor seleccionado no es válido.',
        ]);

        // Obtener el curso seleccionado
        $curso = Cursos::find($validatedData['id_curso']);

        // Parsear la fecha de inicio
        $fecha_inicio = Carbon::parse($validatedData['fecha_inicio']);
        $mes_inicio = $fecha_inicio->translatedFormat('F'); // Mes en español
        $dia_semana = $fecha_inicio->translatedFormat('l'); // Día en español

        // Crear el nombre del registro en el formato deseado
        $nombreRegistro = "{$dia_semana}, {$curso->nombre}, {$validatedData['hora_clase']}, {$mes_inicio}";

        // Usar el id_profesor del select
        $id_profesor = $validatedData['id_profesor'];

        // Crear el registro de apertura de curso
        $cursoApertura = CursoApertura::create([
            'id_curso' => $validatedData['id_curso'],
            'nombre' => $nombreRegistro,
            'fecha_inicio' => $fecha_inicio,
            'monto_colegiatura' => $validatedData['monto_colegiatura'],
            'dia_clase' => $dia_semana,
            'hora_clase' => $validatedData['hora_clase'],
        ]);

        // Crear los registros de módulos asociados al curso
        foreach ($validatedData['modulos'] as $semana => $moduloId) {
            ModuloCurso::create([
                'id_modulo' => $moduloId,
                'id_curso_apertura' => $cursoApertura->id,
                'orden' => str_replace('semana_', '', $semana),
                'id_profesor' => $id_profesor,
            ]);
        }

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('plataforma.historial-cursos')->with('success', 'Curso aperturado exitosamente.');
    }


    public function guardarAsistencia($curso_apertura_id, Request $request)
    {
        $asistencia = $request->input('asistencia');
        $colegiatura = $request->input('colegiatura');

        foreach ($asistencia as $matricula => $semanasAsistencia) {
            $estudianteCurso = EstudianteCurso::whereHas('estudiante', function($query) use ($matricula) {
                $query->where('matricula', $matricula);
            })
                ->where('id_curso_apertura', $curso_apertura_id)
                ->first();


            foreach ($semanasAsistencia as $semana => $estadoAsistencia) {
                $estadoColegiatura = isset($colegiatura[$matricula][$semana]) ? $colegiatura[$matricula][$semana] : 'off';

                Colegiaturas::updateOrCreate(
                    [
                        'id_estudiante_curso' => $estudianteCurso->id,
                        'semana' => $semana,
                    ],
                    [
                        'asistio' => $estadoAsistencia == 'on' ? 1 : 0,

                        'colegiatura' => $estadoColegiatura == 'on' ? 1 : 0,

                         'fecha_pago' => Carbon::now(),
                    ]
                );
            }
        }

        // Retornar una respuesta de éxito con los datos recibidos
        return redirect()->back()->with('success', 'Datos de asistencia guardados correctamente.');
    }






    public function registrarAsistencia($idApertura)
    {
        // Obtener la información del curso apertura
        $apertura = CursoApertura::findOrFail($idApertura);

        // Obtener los estudiantes inscritos en el curso apertura, incluyendo el estado
        $estudiantesInscritos = DB::table('estudiante_curso as ec')
            ->join('estudiantes as e', 'ec.id_estudiante', '=', 'e.matricula')
            ->join('personas as p', 'e.id_persona', '=', 'p.id')
            ->join('colegiaturas as c', 'ec.id', '=', 'c.id_estudiante_curso')
            ->where('ec.id_curso_apertura', $idApertura)
            ->select('e.matricula', 'p.nombre', 'p.ap_paterno', 'p.ap_materno', 'ec.estado', 'ec.id as id_estudiante_curso', 'c.id', 'c.semana', 'c.asistio', 'c.colegiatura')
            ->get();


        // Agrupar los datos por estudiante
        $estudiantesAgrupados = [];
        foreach ($estudiantesInscritos as $estudiante) {
            $matricula = $estudiante->matricula;
            if (!isset($estudiantesAgrupados[$matricula])) {
                $estudiantesAgrupados[$matricula] = [
                    'nombre' => $estudiante->nombre . ' ' . $estudiante->ap_paterno . ' ' . $estudiante->ap_materno,
                    'estado' => $estudiante->estado,
                    'semanas' => []
                ];
            }
            // Agrupar por semana
            $estudiantesAgrupados[$matricula]['semanas'][$estudiante->semana] = [
                'asistio' => (bool) $estudiante->asistio,
                'colegiatura' => (bool) $estudiante->colegiatura,
            ];
        }

        // Calcular la cantidad de semanas (basado en los datos de las semanas disponibles)
        $cantidad_semanas = 0;
        foreach ($estudiantesAgrupados as $estudiante) {
            if (!empty($estudiante['semanas'])) {
                $cantidad_semanas = max($cantidad_semanas, max(array_keys($estudiante['semanas'])));
            }
        }

        // Retornar la respuesta a la vista
        return view('plataforma.tomaAsistencia', [
            'apertura' => $apertura,
            'estudiantesInscritos' => $estudiantesAgrupados,
            'cantidad_semanas' => $cantidad_semanas,
            'idApertura' => $idApertura
        ]);
    }







    public function listaModulos()
    {
        $temas = Temas::all();
        $modulos = Modulos::all()->groupBy('categoria');


        return view('plataforma.index', compact('modulos', 'temas' ));
    }



    public function crearModulo(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'duracion' => 'required|integer|min:1',
        ]);

        $modulo = new Modulos();
        $modulo->nombre = $validatedData['nombre'];
        $modulo->categoria = $validatedData['categoria'];
        $modulo->duracion = $validatedData['duracion'];
        $modulo->save();

        return redirect()->back()->with('success', 'Módulo agregado correctamente.');
    }



    public function crearTema(Request $request)
    {
        $messages = [
            'descripcion.max' => 'Has alcanzado el máximo de caracteres permitidos en la descripción.',
        ];

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:100',
        ], $messages);

        $tema = new Temas();
        $tema->nombre = $validatedData['nombre'];
        $tema->descripcion = $validatedData['descripcion'];
        $tema->save();

        return redirect()->back()->with('success', 'Tema agregado correctamente.');
    }

     // Método para eliminar un módulo
     public function eliminarModulo($id)
     {
         // Buscar el módulo por ID y eliminarlo
         $modulo = Modulos::findOrFail($id);
         $modulo->delete();

         return redirect()->route('plataforma.lista-modulos')->with('success', 'Módulo eliminado correctamente.');
     }



     // Método para eliminar un tema
     public function eliminarTema($id)
     {
         // Buscar el tema por ID y eliminarlo
         $tema = Temas::findOrFail($id);
         $tema->delete();

         return redirect()->route('plataforma.lista-modulos')->with('success', 'Tema eliminado correctamente.');
     }


     public function actualizarModulo(Request $request, $id)
{
    $modulo = Modulos::findOrFail($id);
    $modulo->update($request->only(['nombre', 'categoria', 'duracion']));
    return redirect()->back()->with('success', 'Módulo actualizado con éxito.');
}

public function actualizarTema(Request $request, $id)
{
    $tema = Temas::findOrFail($id);
    $tema->update($request->only(['nombre', 'descripcion']));
    return redirect()->back()->with('success', 'Tema actualizado con éxito.');
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
