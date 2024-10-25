<?php

namespace Database\Seeders;

use App\Models\Certificados;
use App\Models\Cursos;
use Illuminate\Database\Seeder;
use App\Models\Curso; // Asumiendo que tu modelo se llama Curso
use App\Models\Certificado; // Para asociar con los certificados
use Faker\Factory as Faker;

class CursosSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $certificados = Certificados::all(); // Obtener todos los certificados creados

        for ($i = 1; $i <= 10; $i++) {
            Cursos::create([
                'nombre' => $faker->word . " Curso",
                'descripcion' => $faker->paragraph,
                'duracion_semanas' => $faker->numberBetween(4, 12), // Duración entre 4 y 12 semanas
                'id_certificacion' => $certificados->isNotEmpty() ? $certificados->random()->id : null, // Asignar un certificado aleatorio
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
