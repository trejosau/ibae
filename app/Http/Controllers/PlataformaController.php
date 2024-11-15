<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoAperturaRequest;
use App\Mail\CredencialesEstudiantesMail;
use App\Mail\EnvioCredenciales;
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
use App\Models\Colegiaturas;
use App\Models\User;
use App\Models\CursoApertura;
use App\Models\Inscripcion ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;





class PlataformaController extends Controller
{
    public function iniciarCursosHoy()
    {
        $hoy = Carbon::today();

        $cursosIniciados = CursoApertura::where('fecha_inicio', $hoy)
            ->where('estado', 'programado')
            ->get();

        foreach ($cursosIniciados as $curso) {
            $curso->estado = 'en curso';
            $curso->save();
        }

        if ($cursosIniciados->isEmpty()) {
            return response()->json([
                'message' => 'No hay cursos que necesiten iniciar hoy.',
            ], 200);
        }

        return response()->json([
            'message' => 'Cursos iniciados con éxito.',
            'cursos' => $cursosIniciados,
        ], 200);
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
        // Los datos ya están validados, los puedes obtener directamente
        $validatedData = $request->validated();

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

    public function guardarAsistencia(Request $request)
    {
        $asistencia = $request->input('asistencia');
        $colegiatura = $request->input('colegiatura');

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
        // Recuperar la categoría seleccionada desde el request
        $categoria = $request->input('categoria', ''); // Si no hay categoría, se devuelve un valor vacío (lo que no aplicará filtro)

        // Filtrar los módulos según la categoría seleccionada
        $modulos = Modulos::when($categoria, function ($query, $categoria) {
            return $query->where('categoria', $categoria);
        })->get()->groupBy('categoria'); // Agrupar los módulos por categoría

        // Obtener todos los temas (sin filtro)
        $temas = Temas::all();

        // Retornar la vista con los módulos y temas filtrados o completos
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
        $estudiantes = Estudiante::with(['persona.usuario', 'inscripcion'])->get();
        $inscripciones = Inscripcion::all();

        // Obtener usuarios sin el rol de "estudiante"
        $usuariosSinRolEstudiante = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'estudiante');
        })->get();

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

    public function asignarRol(Request $request)
    {
        $usuario = User::find($request->usuario_id);
        $usuario->assignRole('estudiante');

        return redirect()->route('plataforma.estudiantes')->with('success', 'Rol asignado con éxito');
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
            'fecha_inscripcion' => 'required|date',
            'grado_estudio' => 'required|string',
            'zipcode' => 'required|string',
            'ciudad' => 'required|string',
            'colonia' => 'required|string',
            'calle' => 'required|string',
            'num_ext' => 'required|string',
            'num_int' => 'nullable|string',
        ]);


        $password = $this->generarContrasenaAleatoria();
        // Crear Usuario con contraseña por defecto
        $usuario = User::create([
            'username' => random_int(1,10000).now(),
            'email' => $request->email,
            'password' => Hash::make($password), // Contraseña por defecto
        ]);


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
            'fecha_inscripcion' => $request->fecha_inscripcion,
            'grado_estudio' => $request->grado_estudio,
            'zipcode' => $request->zipcode,
            'ciudad' => $request->ciudad,
            'colonia' => $request->colonia,
            'calle' => $request->calle,
            'num_ext' => $request->num_ext,
            'num_int' => $request->num_int,
        ]);

    $prefix = date('y') . date('m');
    $matricula_username = $prefix . $usuario->id;

            $usuario->username = $matricula_username;
            $estudiante->matricula = $matricula_username;
            $usuario->save();
            $estudiante->save;


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
        $estudiante->estado = 'baja';  // Asumiendo que el campo 'estado' es 'activo' o 'baja'
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





// En tu controlador, por ejemplo, EstudianteController.php
// App\Http\Controllers\EstudianteController.php
public function historialPagos()
{
    $subquery = DB::table('colegiaturas')
        ->select('id_estudiante_curso', DB::raw('MAX(fecha_pago) as max_fecha_pago'))
        ->groupBy('id_estudiante_curso');

    $colegiaturas = Colegiaturas::joinSub($subquery, 'ultimo_pago', function ($join) {
            $join->on('colegiaturas.id_estudiante_curso', '=', 'ultimo_pago.id_estudiante_curso')
                 ->on('colegiaturas.fecha_pago', '=', 'ultimo_pago.max_fecha_pago');
        })
        ->with(['estudianteCurso.estudiante.persona', 'estudianteCurso.cursoApertura', 'estudianteCurso.colegiaturas'])
        ->get();

    foreach ($colegiaturas as $colegiatura) {
        // Suma de las semanas no pagadas
        $adeudo = $colegiatura->estudianteCurso->colegiaturas
            ->where('colegiatura', 0) // 0 indica no pagado
            ->sum('Monto');
        
        $colegiatura->adeudo = $adeudo; // Añadimos el total adeudado a cada colegiatura
    }

    return view('plataforma.index', compact('colegiaturas'));
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
    
        return $cursos = DB::table('estudiante_curso')
        ->join('curso_apertura', 'estudiante_curso.id_curso_apertura', '=', 'curso_apertura.id')
        ->join('cursos', 'curso_apertura.id_curso', '=', 'cursos.id')
        ->join('certificados', 'cursos.id_certificacion', '=', 'certificados.id')
        ->where('estudiante_curso.id_estudiante', $estudiante->matricula)
        ->select(
            'cursos.nombre as nombre_curso',
            'cursos.descripcion as descripcion_curso',
            'cursos.duracion_semanas',
            'certificados.nombre as nombre_certificado',
            'curso_apertura.fecha_inicio'
        )
        ->get();
    

    
        // Pasar los cursos y el estudiante a la vista
        return view('plataforma.index', compact('cursos', 'estudiante'));
    }
    

    public function misPagosEspacio() {
        return view('plataforma.index');
    }

    public function perfilEspacio() {
        return view('plataforma.index');
    }
}
