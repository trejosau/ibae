<?php

namespace Database\Seeders;

use App\Models\Colegiaturas;
use Illuminate\Database\Seeder;
use App\Models\EstudianteCurso; use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ColegiaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Suponiendo que existen estudiantes_cursos con IDs válidos en tu base de datos
        $estudiantesCursosIds = DB::table('estudiante_curso')->pluck('id')->toArray();

        // Creamos datos de muestra para varias semanas
        foreach ($estudiantesCursosIds as $idEstudianteCurso) {
            for ($semana = 1; $semana <= 12; $semana++) {
                Colegiaturas::create([
                    'id_estudiante_curso' => $idEstudianteCurso,
                    'semana' => $semana,
                    'asistio' => rand(0, 1), // Random para simular asistencia
                    'colegiatura' => rand(0, 1), // Random para simular si fue pagada o no
                    'fecha_pago' => rand(0, 1) ? Carbon::now()->subWeeks($semana) : null, // Fecha de pago si está pagada
                ]);
            }
        }
    }
}
