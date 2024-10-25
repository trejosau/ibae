<?php

namespace Database\Seeders;

use App\Models\Citas; // Asegúrate de que este modelo esté creado
use App\Models\Estilista;
use App\Models\Comprador;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CitasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $estilistas = Estilista::all();
        $compradores = Comprador::all();

        // Generar citas aleatorias
        for ($i = 0; $i < 10; $i++) { // Cambia el número de citas a generar si es necesario
            Citas::create([
                'id_estilista' => $estilistas->random()->id,
                'id_comprador' => $compradores->random()->id,
                'fecha_hora_creacion' => now(), // Fecha y hora de creación
                'fecha_hora_inicio_cita' => $faker->dateTimeBetween('now', '+1 week'), // Fecha y hora de inicio en el futuro
                'fecha_hora_fin_cita' => $faker->dateTimeBetween('+1 week', '+2 weeks'), // Fecha y hora de fin en un rango futuro
            ]);
        }
    }
}
