<?php

namespace Database\Seeders;

use App\Models\Cursos;
use Illuminate\Database\Seeder;
use App\Models\CursoApertura;
use Faker\Factory as Faker;

class CursoAperturaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $cursos = Cursos::all(); // Obtener todos los cursos

        for ($i = 1; $i <= 10; $i++) {
            CursoApertura::create([
                'id_curso' => $cursos->random()->id, // Asignar curso aleatorio
                'nombre' => $faker->word . " Apertura",
                'fecha_inicio' => $faker->date,
                'periodo' => $faker->randomElement(['Primavera', 'Verano', 'Otoño', 'Invierno']),
                'año' => $faker->year,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
