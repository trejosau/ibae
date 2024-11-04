<?php

namespace Database\Seeders;

use App\Models\Colegiaturas;
use Illuminate\Database\Seeder;
use App\Models\EstudianteCurso;
use App\Models\CursoApertura;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ColegiaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Obtener IDs de estudiante_curso con sus respectivos montos de colegiatura
        $estudiantesCursos = EstudianteCurso::with('cursoApertura')->get();

        foreach ($estudiantesCursos as $estudianteCurso) {
            $montoColegiatura = $estudianteCurso->cursoApertura->monto_colegiatura; // Obtener el monto de colegiatura del curso_apertura

            // Crear registros de colegiatura para 12 semanas
            for ($semana = 1; $semana <= 12; $semana++) {
                Colegiaturas::create([
                    'id_estudiante_curso' => $estudianteCurso->id,
                    'semana' => $semana,
                    'asistio' => rand(0, 1),
                    'colegiatura' => rand(0, 1),
                    'fecha_pago' => rand(0, 1) ? Carbon::now()->subWeeks($semana) : null,
                    'monto' => $montoColegiatura, // Usar el monto de curso_apertura
                ]);
            }
        }
    }
}
