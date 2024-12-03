<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoAperturaRequest;
use App\Mail\EnvioCredenciales;
use App\Models\Estudiante;
use App\Models\EstudianteCurso;
use App\Models\ModuloCurso;
use App\Models\Modulos;
use App\Models\ModuloTemas;
use App\Models\Profesor;
use App\Models\Temas;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Models\Cursos;
use App\Models\Certificados;
use App\Models\Colegiaturas;
use App\Models\User;
use App\Models\CursoApertura;
use App\Models\Inscripcion ;
use App\Models\Persona;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;




class PlataformaController extends Controller
{
    public function iniciarCursosHoy()
    {
        $hoy = Carbon::today();

        // Buscar los cursos que deben iniciarse hoy
        $cursosIniciados = CursoApertura::where('fecha_inicio', $hoy)
            ->where('estado', 'programado')
            ->get();

        foreach ($cursosIniciados as $curso) {
            $curso->estado = 'en curso';
            $curso->save();
        }

        // Si no hay cursos que iniciar hoy
        if ($cursosIniciados->isEmpty()) {
            session()->flash('message', 'No hay cursos que necesiten iniciar hoy.');
            return redirect()->back();
        }

        // Si los cursos se han iniciado correctamente
        session()->flash('success', 'Cursos iniciados correctamente.');
        return redirect()->back();
    }



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

        // Pasar los módulos y los temas a la vista
        return view('plataforma.temas-modulos', compact('modulos', 'todosLosTemas','modulosSinTemas'));
    }


    public function eliminarTemaDeModulo(Request $request)
    {
        // Validar la entrada
        $validado = $request->validate([
            'modulo_id' => 'required|exists:modulos,id',
            'tema_id' => 'required|exists:temas,id',
        ]);

        // Eliminar la relación en la tabla pivot `modulo_temas`
        $eliminado = DB::table('modulo_temas')
            ->where('id_modulo', $validado['modulo_id'])
            ->where('id_tema', $validado['tema_id'])
            ->delete();

            if ($eliminado) {
                // Cargar la vista deseada con un mensaje de éxito
                return view('plataforma.temas-modulos', [
                    'success' => 'El tema se eliminó del módulo exitosamente.'
                ]);
            }

            // Cargar la vista deseada con un mensaje de error
            return view('plataforma.temas-modulos', [
                'error' => 'No se pudo eliminar el tema del módulo.',
            ]);
        }


public function actualizarTemas(Request $request, $moduloId)
{
    $temaIds = array_filter($request->input('tema_ids')); // Elimina valores nulos o vacíos
    $temaIds = array_unique($temaIds); // Evita duplicados

    // Validar que los temas existen en la base de datos
    $temasValidos = Temas::whereIn('id', $temaIds)->pluck('id')->toArray();

    if (count($temaIds) !== count($temasValidos)) {
        return redirect()->back()->with('error', 'Algunos temas seleccionados no son válidos.');
    }

    // Actualizar temas del módulo
    $modulo = Modulos::findOrFail($moduloId);
    $modulo->temas()->sync($temaIds); // Sincroniza los temas

    return redirect()->back()->with('success', 'Temas actualizados correctamente.');
}




    public function misCursos()
    {
        $cursos = Cursos::with('certificado')->paginate(5); // Paginación con 5 resultados por página
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
            'descripcion' => 'required|string|max:200', // Limita a 200 caracteres
            'duracion_semanas' => 'required|integer|min:1',
            'duracion_horas' => 'required|integer|min:1', // Validación para duracion_horas
            'id_certificacion' => 'nullable|exists:certificados,id',
        ]);

        // Crea un nuevo curso
        $curso = Cursos::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'duracion_semanas' => $request->duracion_semanas,
            'duracion_horas' => $request->duracion_horas, // Guarda la duración en horas
            'id_certificacion' => $request->id_certificacion, // Guarda el ID del certificado
        ]);

        return redirect()->route('plataforma.mis-cursos');
    }



    public function storeCertificado(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:200',
            'horas' => 'required|integer|min:1|max:120',
            'institucion' => 'required|string|in:SEP,Otra',
        ]);

        if ($request->horas > 120) {
            return response()->json(['error' => 'Horas excedidas: el máximo permitido es 120.'], 422);
        }

        Certificados::create($request->all());

        return redirect()->route('plataforma.mis-cursos');
    }


    public function cambiarEstado(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $curso = Cursos::find($request->curso_id);
        $curso->estado = $request->estado; // Asegúrate de tener una columna estado en la tabla cursos
        $curso->save();

        return redirect()->route('plataforma.mis-cursos')->with('success', 'Estado del curso actualizado con éxito.');
    }


    public function historialCursos(Request $request)
    {
        $user = auth()->user();
        $esAdmin = $user->hasRole('admin');
        $esProfesor = $user->hasRole('profesor');

        $estadoFiltro = $request->input('estado');
        $cursosApertura = collect(); // Valor por defecto

        // Cursos por rol
        if ($esAdmin) {
            $cursosApertura = CursoApertura::with(['moduloCursos.modulo.temas', 'curso']);
        } elseif ($esProfesor) {
            $profesor = Profesor::whereHas('persona', function ($query) use ($user) {
                $query->where('usuario', $user->id);
            })->first();

            if ($profesor) {
                $cursosApertura = CursoApertura::whereHas('moduloCursos', function ($query) use ($profesor) {
                    $query->where('id_profesor', $profesor->id);
                })->with(['moduloCursos.modulo.temas', 'curso']);
            }
        }

        // Aplicar filtro de estado si se proporciona
        if (!empty($estadoFiltro) && $cursosApertura instanceof \Illuminate\Database\Eloquent\Builder) {
            $cursosApertura->where('estado', $estadoFiltro);
        }

        // Paginación de cursos apertura con filtro
        $cursosAperturaPaginados = $cursosApertura instanceof \Illuminate\Database\Eloquent\Builder
            ? $cursosApertura->paginate(3)->appends(['estado' => $estadoFiltro])
            : collect();

        // Otros datos necesarios con paginación
        $todosCursos = Cursos::where('estado', 'activo')->get();
        $modulosConTemas = Modulos::with('temas:id,nombre')->has('temas')->get(['id', 'nombre']); // Sin paginar porque se usa para selects
        $profesores = Profesor::with('persona')->get();
        $estudiantes = Estudiante::with(['persona', 'cursosApertura'])->get();

        // Preparar el resultado agrupando los cursos por estudiante
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

            foreach ($estudiante->cursosApertura as $curso) {
                if (!empty($curso->hora_clase)) {
                    $horaClaseRaw = trim($curso->hora_clase);
                    try {
                        $horaClase = Carbon::createFromFormat('H:i:s', $horaClaseRaw);
                        $horaFin = $horaClase->copy()->addHours(2);

                        if ($horaClase->hour < 8 || $horaFin->hour >= 22 || ($horaClase->hour == 21 && $horaClase->minute > 0)) {
                            continue;
                        }

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
                    } catch (Exception $e) {
                        continue;
                    }
                }
            }
        }

        return view('plataforma.index', [
            'resultado' => array_values($resultado),
            'estudiantes' => $estudiantes, // Paginado
            'cursos' => $todosCursos, // Paginado
            'cursosApertura' => $cursosAperturaPaginados, // Paginado con filtro
            'modulosConTemas' => $modulosConTemas, // Sin paginar para selects
            'profesores' => $profesores, // Paginado
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
        // Recuperar el estudiante según la matrícula
        $estudiante = Estudiante::where('matricula', $request->matricula)->first();

        // Verificar si el estudiante existe
        if (!$estudiante) {
            return back()->with('error', 'Estudiante no encontrado.');
        }

        // Verificar si el estudiante está inscrito en el curso
        $estudianteCurso = EstudianteCurso::where('id_estudiante', $estudiante->matricula)
            ->where('id_curso_apertura', $request->apertura_id)
            ->first();

        // Si el estudiante está inscrito en el curso, se cambia su estado a "baja"
        if ($estudianteCurso) {
            $estudianteCurso->estado = 'baja';
            $estudianteCurso->save();

            return back()->with('success', 'El alumno con matrícula ' . $estudiante->matricula . ' ha sido dado de baja del curso.');
        }

        return back()->with('error', 'El estudiante no está inscrito en este curso.');
    }





    public function storeCursoApertura(CursoAperturaRequest $request)
    {
        // Los datos ya están validados
        $validatedData = $request->validated();



        // Obtener el curso seleccionado
        $curso = Cursos::findOrFail($validatedData['id_curso']);




        // Parsear la fecha de inicio
        $fecha_inicio = Carbon::createFromFormat('Y-m-d', $validatedData['fecha_inicio']); // Convertir a Carbon
        $mes_inicio = $fecha_inicio->translatedFormat('F'); // Mes en español
        $dia_semana = $fecha_inicio->translatedFormat('l'); // Día en español

        $fecha_inicio = $fecha_inicio->format('Y-m-d');
        $nombreRegistro = " {$curso->nombre}, {$validatedData['hora_clase']}";





        $hora_clase = $validatedData['hora_clase'];
        if (strlen($hora_clase) === 5) {
            $hora_clase .= ':00';
        }

        $hora_inicio = Carbon::createFromFormat('H:i:s', $hora_clase);

        $duracion_horas = $curso->duracion_horas ?? 0;

        $hora_final = $hora_inicio->copy()->addHours($duracion_horas);




        // Validar que la hora final no exceda las 10 PM
        $limite_hora = Carbon::createFromTime(22, 0); // 10:00 PM
        if ($hora_final->greaterThan($limite_hora)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Este curso tiene una duración de ' . $duracion_horas . ' horas y la hora de inicio es ' . $hora_clase . '. Esto excede las 10 PM. Por favor, seleccione otra hora.');
        }

        $cursoApertura = CursoApertura::create([
            'id_curso' => $validatedData['id_curso'],
            'nombre' => $nombreRegistro,
            'fecha_inicio' => $fecha_inicio,
            'monto_colegiatura' => $validatedData['monto_colegiatura'],
            'dia_clase' => $dia_semana,
            'hora_clase' => $hora_clase,
            'hora_clase_fin' => $hora_final->format('H:i:s'),
        ]);


        foreach ($validatedData['modulos'] as $semana => $moduloId) {
            $modulo = ModuloCurso::create([
                'id_modulo' => $moduloId,
                'id_curso_apertura' => $cursoApertura->id,
                'orden' => str_replace('semana_', '', $semana),
                'id_profesor' => $validatedData['id_profesor'],
            ]);

        }


        // Redirigir con un mensaje de éxito
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
            ->select('e.matricula', 'p.nombre', 'p.ap_paterno', 'p.ap_materno', 'ec.estado', 'ec.id as id_estudiante_curso', 'c.semana', 'c.asistio', 'c.colegiatura')
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


    public function listaModulos(Request $request)
    {
        // Obtén las páginas actuales para módulos y temas de los parámetros de la solicitud
        $modulosPage = $request->input('modulos_page', 1);
        $temasPage = $request->input('temas_page', 1);

        $categoria = $request->input('categoria', ''); // Filtrar por categoría si está presente

        $modulos = Modulos::when($categoria, function ($query, $categoria) {
            return $query->where('categoria', $categoria);
        })->paginate(2, ['*'], 'modulos_page')->withQueryString();

        $temas = Temas::paginate(2, ['*'], 'temas_page')->withQueryString();

        return view('plataforma.index', compact('modulos', 'temas'));
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



    public function estudiantes()
    {
        // Paginación de estudiantes
        $estudiantes = Estudiante::with(['persona.usuario', 'inscripcion'])->paginate(10);

        // Obtener usuarios sin el rol de "estudiante"
        $usuariosSinRolEstudiante = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'estudiante');
        })->get();

        $inscripciones = Inscripcion::all();

        return view('plataforma.index', compact('estudiantes', 'usuariosSinRolEstudiante', 'inscripciones'));
    }


    function generarContrasenaAleatoria($longitud = 8) {
        // Caracteres permitidos en cada categoría
        $minusculas = 'abcdefghijklmnopqrstuvwxyz';
        $mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numeros = '0123456789';
        $simbolos = '!@#$()_+-={}:?';

        // Aseguramos que cada tipo de carácter esté presente al menos una vez
        $contrasena = $minusculas[random_int(0, strlen($minusculas) - 1)] .
            $mayusculas[random_int(0, strlen($mayusculas) - 1)] .
            $numeros[random_int(0, strlen($numeros) - 1)] .
            $simbolos[random_int(0, strlen($simbolos) - 1)];

        // Llenamos el resto de la contraseña hasta la longitud deseada
        $todos = $minusculas . $mayusculas . $numeros . $simbolos;
        for ($i = strlen($contrasena); $i < $longitud; $i++) {
            $contrasena .= $todos[random_int(0, strlen($todos) - 1)];
        }

        // Mezclamos los caracteres para mayor aleatoriedad
        return str_shuffle($contrasena);
    }



    public function registrarEstudiante(Request $request)
    {
        // Validar datos
        $request->validate([
            'nombre' => 'required|string',
            'ap_paterno' => 'required|string',
            'ap_materno' => 'nullable|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
            'id_inscripcion' => 'required|exists:inscripciones,id',
            'fecha_inscripcion_estudiante' => 'required|date',
            'grado_estudio' => 'required|string',
            'zipcode' => 'required|string',
            'ciudad' => 'required|string',
            'colonia' => 'required|string',
            'calle' => 'required|string',
            'num_ext' => 'required|string',
            'num_int' => 'nullable|string',
        ]);

        $emailExiste = User::where('email', $request->email)->first();

        if ($emailExiste) {
            // Si el email ya existe, actualizamos los datos
            $user = $emailExiste;
            $user->assignRole('estudiante');

            // Actualizar datos de la persona
            $persona = $user->persona;
            $persona->nombre = $request->nombre;
            $persona->ap_paterno = $request->ap_paterno;
            $persona->ap_materno = $request->ap_materno;
            $persona->telefono = $request->telefono;
            $persona->save();

            // Crear el Estudiante relacionado con la persona y usuario
            $estudiante = Estudiante::create([
                'estado' => 'activo',
                'id_persona' => $persona->id,
                'id_inscripcion' => $request->id_inscripcion,
                'fecha_inscripcion' => $request->fecha_inscripcion_estudiante,
                'grado_estudio' => $request->grado_estudio,
                'zipcode' => $request->zipcode,
                'ciudad' => $request->ciudad,
                'colonia' => $request->colonia,
                'calle' => $request->calle,
                'num_ext' => $request->num_ext,
                'num_int' => $request->num_int,
            ]);

            $prefix = date('y') . date('m');
            $estudiante->matricula = $prefix . $user->id;
            $estudiante->save();

            // Asignar la matrícula al usuario
            $user->username = $estudiante->matricula;
            $user->save();

            $passowrdExiste = 'Ingresa con tu contraseña actual o en su caso con google';

            // Enviar correo con las credenciales
            Mail::to($request->email)->send(new EnvioCredenciales($user, $passowrdExiste));

            // Redirigir con mensaje de éxito
            return redirect()->route('plataforma.estudiantes')->with('success', 'Estudiante ya existente, datos actualizados y correo enviado.');
        }

        $password = $this->generarContrasenaAleatoria();
        // Crear Usuario con contraseña por defecto
        $usuario = User::create([
            'username' => random_int(1,10000).now(),
            'email' => $request->email,
            'password' => Hash::make($password),
            'provider' => 'default',
            'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
        ]);

        $usuario->assignRole('cliente');
        $usuario->assignRole('estudiante');


        // Crear Persona
        $persona = Persona::create([
            'nombre' => $request->nombre,
            'ap_paterno' => $request->ap_paterno,
            'ap_materno' => $request->ap_materno,
            'telefono' => $request->telefono,
            'usuario' => $usuario->id,
        ]);
        // Asignar rol de estudiante
        $usuario->assignRole('estudiante');



        // Crear Estudiante
        $estudiante = Estudiante::create([
            'estado' => 'activo',
            'id_persona' => $persona->id,
            'id_inscripcion' => $request->id_inscripcion,
            'fecha_inscripcion' => $request->fecha_inscripcion_estudiante,
            'grado_estudio' => $request->grado_estudio,
            'zipcode' => $request->zipcode,
            'ciudad' => $request->ciudad,
            'colonia' => $request->colonia,
            'calle' => $request->calle,
            'num_ext' => $request->num_ext,
            'num_int' => $request->num_int,
        ]);
        $prefix = date('y') . date('m');

        $estudiante->matricula = $prefix . $usuario->id;

        $estudiante->save();

        $usuario->username = $estudiante->matricula;
        $usuario->save();



        if ($estudiante)
        {

            Mail::to($request->email)->send(new EnvioCredenciales($usuario, $password));
        }




        return redirect()->route('plataforma.estudiantes')->with('success', 'Estudiante registrado y correo enviado.');
    }



    public function darDeBaja($matricula)
    {
        $estudiante = Estudiante::where('matricula', $matricula)->first();

        if (!$estudiante) {
            return redirect()->back()->with('error', 'Estudiante no encontrado.');
        }

        // Cambiar el estado a baja
        $estudiante->estado = 'baja';
        $estudiante->save();

        return redirect()->route('plataforma.estudiantes')->with('success', 'Estudiante dado de baja correctamente.');
    }


    public function darDeAlta($matricula)
    {
        $estudiante = Estudiante::where('matricula', $matricula)->first();

        if (!$estudiante) {
            return redirect()->back()->with('error', 'Estudiante no encontrado.');
        }

        // Cambiar el estado a baja
        $estudiante->estado = 'activo';
        $estudiante->save();

        return redirect()->route('plataforma.estudiantes')->with('success', 'Estudiante dado de baja correctamente.');
    }


    public function inscripciones() {
        $inscripciones = Inscripcion::all();
        return view('plataforma.index', compact('inscripciones'));

    }


    public function storeInscripcion(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string',
            'material_incluido' => 'required|boolean',
        ]);

        // Crear la nueva inscripción
        Inscripcion::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'material_incluido' => $request->material_incluido,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', 'Inscripción agregada correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string',
            'material_incluido' => 'required|boolean',
        ]);

        // Encontrar la inscripción por ID
        $inscripcion = Inscripcion::findOrFail($id);

        // Actualizar los campos con los nuevos valores
        $inscripcion->update([
            'nombre' => $validatedData['nombre'],
            'precio' => $validatedData['precio'],
            'descripcion' => $validatedData['descripcion'],
            'material_incluido' => $validatedData['material_incluido'],
        ]);

        // Redirigir a la lista de inscripciones o a otra vista con un mensaje de éxito
        return redirect()->route('plataforma.inscripciones')->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy($id)
{
    // Busca la inscripción por ID
    $inscripcion = Inscripcion::findOrFail($id);

    // Elimina la inscripción
    $inscripcion->delete();

    // Redirige con un mensaje de éxito
    return redirect()->route('inscripciones.index')->with('success', 'Inscripción eliminada correctamente.');
}


    public function profesores() {
        // Obtener los profesores con la relación 'persona' y 'usuario'
        $profesores = Profesor::with(['persona.usuario'])->get();

        // Retornar la vista pasando los datos de los profesores
        return view('plataforma.index', compact('profesores'));
    }




    public function bajaProfesor($id)
    {
        // Buscar al profesor por su ID
        $profesor = Profesor::find($id);

        // Verificar que el profesor exista
        if (!$profesor) {
            return redirect()->back()->with('error', 'Profesor no encontrado.');
        }

        // Cambiar su estado a 'inactivo'
        $profesor->estado = 'inactivo';
        $profesor->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('plataforma.profesores')->with('success', 'Profesor dado de baja correctamente.');
    }





    public function historialPagos()
    {

        return view('plataforma.index');
    }





    public function pagos() {
        return view('plataforma.index');

    }












    public function misCursosEspacio()
{
    // Obtener el usuario autenticado
    $username = auth()->user()->username;

    // Obtener la persona asociada al usuario
    $persona = DB::table('personas')
        ->join('users', 'personas.usuario', '=', 'users.id')
        ->where('users.username', $username)
        ->select('personas.id')
        ->first();

    if (!$persona || !isset($persona->id)) {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    // Obtener el estudiante basado en el id_persona de la tabla personas
    $estudiante = DB::table('estudiantes')
        ->where('id_persona', $persona->id)
        ->first();

    if (!$estudiante) {
        return redirect()->back()->with('error', 'Estudiante no encontrado.');
    }

    // Consultar los cursos del estudiante cuyo estado sea "en curso"
    $cursos = DB::table('estudiante_curso')
        ->join('curso_apertura', 'estudiante_curso.id_curso_apertura', '=', 'curso_apertura.id')
        ->join('cursos', 'curso_apertura.id_curso', '=', 'cursos.id')
        ->join('certificados', 'cursos.id_certificacion', '=', 'certificados.id')
        ->where('estudiante_curso.id_estudiante', $estudiante->matricula)
        ->where('curso_apertura.estado', '!=', 'finalizado') // Filtro por estado
        ->where('estudiante_curso.estado', '!=', 'baja')
        ->select(
            'cursos.id',
            'cursos.nombre as nombre_curso',
            'cursos.descripcion as descripcion_curso',
            'cursos.duracion_semanas',
            'certificados.nombre as nombre_certificado',
            'curso_apertura.id as id_curso_apertura', // Para relacionar con modulo_curso
            'curso_apertura.fecha_inicio',
            'curso_apertura.dia_clase',
            'curso_apertura.hora_clase'
        )
        ->get();

    // Agregar módulos, temas y profesor para cada curso
    foreach ($cursos as $curso) {
        // Obtener módulos relacionados con el curso
        $curso->modulos = DB::table('modulos')
            ->join('modulo_curso', 'modulos.id', '=', 'modulo_curso.id_modulo')
            ->leftJoin('profesores', 'modulo_curso.id_profesor', '=', 'profesores.id') // Relación con profesores
            ->leftJoin('personas', 'profesores.id_persona', '=', 'personas.id') // Relación con personas para obtener los datos del profesor
            ->where('modulo_curso.id_curso_apertura', $curso->id_curso_apertura)
            ->select(
                'modulos.id',
                'modulos.nombre as nombre_modulo',
                'modulo_curso.orden',
                'personas.nombre as nombre_profesor', // Nombre del profesor desde personas
                'personas.ap_paterno as ap_paterno_profesor', // Apellido paterno
                'personas.ap_materno as ap_materno_profesor' // Apellido materno
            )
            ->orderBy('modulo_curso.orden')
            ->get();

        // Obtener temas para cada módulo
        foreach ($curso->modulos as $modulo) {
            $modulo->temas = DB::table('temas')
                ->join('modulo_temas', 'temas.id', '=', 'modulo_temas.id_tema')
                ->where('modulo_temas.id_modulo', $modulo->id) // Relacionar con el módulo
                ->select('temas.id', 'temas.nombre as nombre_tema')
                ->get();
        }
    }

    // Pasar los cursos y el estudiante a la vista
    return view('plataforma.index', compact('cursos', 'estudiante'));
}






    public function misPagosEspacio()
    {
        // Obtener el usuario autenticado
        $username = auth()->user()->username;

        // Obtener la persona asociada al usuario
        $persona = DB::table('personas')
            ->join('users', 'personas.usuario', '=', 'users.id')
            ->where('users.username', $username)
            ->select('personas.id')
            ->first();

        if (!$persona) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        // Obtener el estudiante basado en el id_persona de la tabla personas
        $estudiante = DB::table('estudiantes')
            ->where('id_persona', $persona->id)
            ->first();

        if (!$estudiante) {
            return redirect()->back()->with('error', 'Estudiante no encontrado.');
        }

        // Subconsulta para obtener la última fecha de pago de cada curso del estudiante
        $subquery = DB::table('colegiaturas')
            ->select('id_estudiante_curso', DB::raw('MAX(fecha_pago) as max_fecha_pago'))
            ->groupBy('id_estudiante_curso');

        // Consulta principal para obtener los pagos de ese estudiante
        $colegiaturas = DB::table('colegiaturas')
            ->join('estudiante_curso', 'colegiaturas.id_estudiante_curso', '=', 'estudiante_curso.id')
            ->join('curso_apertura', 'estudiante_curso.id_curso_apertura', '=', 'curso_apertura.id')
            ->join('cursos', 'curso_apertura.id_curso', '=', 'cursos.id')
            ->joinSub($subquery, 'ultimo_pago', function ($join) {
                $join->on('colegiaturas.id_estudiante_curso', '=', 'ultimo_pago.id_estudiante_curso')
                    ->on('colegiaturas.fecha_pago', '=', 'ultimo_pago.max_fecha_pago');
            })
            ->where('estudiante_curso.id_estudiante', $estudiante->matricula)
            ->select(
                'colegiaturas.fecha_pago',
                'colegiaturas.Monto',
                'cursos.nombre as nombre_curso',
                'curso_apertura.fecha_inicio',
                'colegiaturas.semana'
            )
            ->get();

        // Pasar los pagos y el estudiante a la vista
        return view('plataforma.index', compact('colegiaturas', 'estudiante'));
    }


    public function perfilEspacio() {
        return view('plataforma.index');
    }
}
