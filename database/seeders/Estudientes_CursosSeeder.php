<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstudianteCursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estudiante_cursos')->insert([
            [
                'id' => 1,  // ID de la relación
                'id_estudiante' => 18,  // Relacionado con estudiante con id 18
                'estado' => 'cursando',
                'id_curso_apertura' => 1,  // Relacionado con curso de apertura con id 1
                'fecha_inscripcion' => Carbon::parse('2024-01-10'),
                'asistencia' => 5,  // Número de asistencias
            ],
            [
                'id' => 2,  // ID de la relación
                'id_estudiante' => 19,  // Relacionado con estudiante con id 19
                'estado' => 'graduado',
                'id_curso_apertura' => 2,  // Relacionado con curso de apertura con id 2
                'fecha_inscripcion' => Carbon::parse('2024-01-20'),
                'asistencia' => 10,  // Número de asistencias
            ],
            [
                'id' => 3,  // ID de la relación
                'id_estudiante' => 20,  // Relacionado con estudiante con id 20
                'estado' => 'baja',
                'id_curso_apertura' => 3,  // Relacionado con curso de apertura con id 3
                'fecha_inscripcion' => Carbon::parse('2024-02-05'),
                'asistencia' => 2,  // Número de asistencias
            ],
        ]);
    }
}
