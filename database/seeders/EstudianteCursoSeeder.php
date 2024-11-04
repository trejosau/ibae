<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstudianteCurso;
use App\Models\CursoApertura;
use App\Models\Estudiante;
use Faker\Factory as Faker;

class EstudianteCursoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $estudiantes = Estudiante::all();
        $curso_aperturas = CursoApertura::all();

        foreach ($estudiantes as $estudiante) {

            EstudianteCurso::create([
                'id_estudiante' => $estudiante->matricula,
                'id_curso_apertura' => $curso_aperturas->random()->id,
                'fecha_inscripcion' => $faker->date,
                'asistencia' => 0,
            ]);
        }

    }
}
