<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert([
            [
                'id' => 1,
                'nombre' => 'Corte de Cabello Básico',
                'categoria' => 'Barbería',
                'duracion' => 2,  // Duración en semanas
            ],
            [
                'id' => 2,
                'nombre' => 'Maquillaje para Eventos Especiales',
                'categoria' => 'Belleza',
                'duracion' => 4,  // Duración en semanas
            ],
            [
                'id' => 3,
                'nombre' => 'Técnicas de Uñas Acrílicas',
                'categoria' => 'Belleza',
                'duracion' => 3,  // Duración en semanas
            ],
            [
                'id' => 4,
                'nombre' => 'Masajes Estéticos Avanzados',
                'categoria' => 'Belleza',
                'duracion' => 6,  // Duración en semanas
            ],
        ]);
    }
}
