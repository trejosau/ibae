<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcademiaSeeder extends Seeder
{
    public function run()
    {
        $estudiantesMatriculas = DB::table('estudiantes')->pluck('matricula')->toArray();

         // Certificados
         $certificados = [];
         for ($i = 1; $i <= 5; $i++) {
             $certificados[] = [
                 'nombre' => 'Certificado ' . $i,
                 'descripcion' => 'Este es el certificado ' . $i,
                 'horas' => rand(20, 100),
                 'institucion' => rand(0, 1) ? 'SEP' : 'Otra',
                 'created_at' => now(),
                 'updated_at' => now(),
             ];
         }
         DB::table('certificados')->insert($certificados);
        // Cursos
        $cursos = [];
        for ($i = 1; $i <= 10; $i++) {
            $cursos[] = [
                'nombre' => 'Curso ' . Str::random(5),
                'descripcion' => 'Descripción del curso ' . $i,
                'duracion_semanas' => rand(4, 20),
                'estado' => rand(0, 1) ? 'activo' : 'inactivo',
                'id_certificacion' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('cursos')->insert($cursos);

        // Cursos Apertura
        $cursoAperturas = [];
        for ($i = 1; $i <= 10; $i++) {
            $cursoAperturas[] = [
                'id_curso' => rand(1, 10),
                'nombre' => 'Apertura de Curso ' . $i,
                'fecha_inicio' => now()->addDays(rand(1, 30)),
                'monto_colegiatura' => rand(1000, 5000),
                'dia_clase' => ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'][rand(0, 6)],
                'hora_clase' => now()->setTime(rand(8, 18), 0),
                'estado' => ['programado', 'finalizado', 'en curso'][rand(0, 2)],
            ];
        }
        DB::table('curso_apertura')->insert($cursoAperturas);

        // Módulos
        $modulos = [];
        for ($i = 1; $i <= 10; $i++) {
            $modulos[] = [
                'nombre' => 'Módulo ' . $i,
                'categoria' => rand(0, 1) ? 'Barberia' : 'Belleza',
                'duracion' => rand(1, 12),
            ];
        }
        DB::table('modulos')->insert($modulos);

        // Temas
        $temas = [];
        for ($i = 1; $i <= 20; $i++) {
            $temas[] = [
                'nombre' => 'Tema ' . $i,
                'descripcion' => 'Descripción del tema ' . $i,
            ];
        }
        DB::table('temas')->insert($temas);

        // Modulo Curso
        $moduloCurso = [];
        for ($i = 1; $i <= 20; $i++) {
            $moduloCurso[] = [
                'id_modulo' => rand(1, 10),
                'id_curso_apertura' => rand(1, 10),
                'orden' => rand(1, 5),
                'id_profesor' => rand(1, 5),
            ];
        }
        DB::table('modulo_curso')->insert($moduloCurso);

        // Modulo Temas
        $moduloTemas = [];
        for ($i = 1; $i <= 20; $i++) {
            $moduloTemas[] = [
                'id_modulo' => rand(1, 10),
                'id_tema' => rand(1, 20),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('modulo_temas')->insert($moduloTemas);

        $estudianteCurso = [];

        // Utilizar el array de matrículas generadas previamente
        foreach ($estudiantesMatriculas as $matricula) {
            $estudianteCurso[] = [
                'id_estudiante' => $matricula, // Usar la matrícula válida
                'estado' => ['cursando', 'graduado', 'baja'][rand(0, 2)],
                'id_curso_apertura' => rand(1, 10), // ID válido de curso apertura
                'fecha_inscripcion' => now()->subDays(rand(1, 60)),
                'asistencia' => rand(50, 100), // Porcentaje de asistencia
            ];
        }
        
        // Insertar los datos en la tabla
        DB::table('estudiante_curso')->insert($estudianteCurso);

        // Colegiaturas
        $colegiaturas = [];
        for ($i = 1; $i <= 50; $i++) {
            $colegiaturas[] = [
                'id_estudiante_curso' => rand(1, 15),
                'semana' => rand(1, 20),
                'asistio' => rand(0, 1),
                'colegiatura' => rand(0, 1),
                'monto' => rand(100, 500),
                'fecha_pago' => now()->subDays(rand(1, 60)),
            ];
        }
        DB::table('colegiaturas')->insert($colegiaturas);
    }
}
