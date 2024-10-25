<?php

namespace Database\Seeders;

use App\Models\Certificados;
use Illuminate\Database\Seeder;
use App\Models\Certificado; // Asumiendo que tu modelo se llama Certificado
use Faker\Factory as Faker;

class CertificadosSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $instituciones = ['SEP', 'Otra']; // Opciones del enum

        for ($i = 1; $i <= 5; $i++) {
            Certificados::create([
                'nombre' => $faker->word . " Certificado",
                'descripcion' => $faker->paragraph,
                'horas' => $faker->numberBetween(20, 100), // Horas entre 20 y 100
                'institucion' => $instituciones[array_rand($instituciones)], // Selección aleatoria
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
