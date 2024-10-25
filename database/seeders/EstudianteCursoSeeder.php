<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstudianteCurso; // Modelo de la tabla estudiante_curso
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
                'id_estudiante' => $estudiante->matricula, // Asegúrate de usar la propiedad correcta
                'id_curso_apertura' => $curso_aperturas->random()->id,
                'fecha_inscripcion' => $faker->date,
                'asistencia' => 0,
            ]);
        }

    }
}
