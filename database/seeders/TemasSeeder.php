<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temas')->insert([
            [
                'id' => 1,
                'nombre' => 'Corte de Cabello Básico',
                'descripcion' => 'Introducción a las técnicas básicas de corte de cabello, incluyendo herramientas y métodos.',
            ],
            [
                'id' => 2,
                'nombre' => 'Maquillaje para Eventos Especiales',
                'descripcion' => 'Técnicas avanzadas de maquillaje para bodas, fiestas y otros eventos.',
            ],
            [
                'id' => 3,
                'nombre' => 'Diseño de Uñas Acrílicas',
                'descripcion' => 'Procedimiento y técnicas para la aplicación de uñas acrílicas, mantenimiento y diseños creativos.',
            ],
            [
                'id' => 4,
                'nombre' => 'Masajes Estéticos Faciales',
                'descripcion' => 'Técnicas de masajes faciales para rejuvenecimiento y relajación de los músculos faciales.',
            ],
            [
                'id' => 5,
                'nombre' => 'Corte de Cabello Avanzado',
                'descripcion' => 'Técnicas avanzadas de corte, incluyendo estilos modernos y personalizados.',
            ],
            [
                'id' => 6,
                'nombre' => 'Maquillaje para Fotografía',
                'descripcion' => 'Técnicas de maquillaje específicas para sesiones fotográficas, iluminación y efectos.',
            ],
        ]);
    }
}
