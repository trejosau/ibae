<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulos;

class ModulosSeeder extends Seeder
{
    public function run()
    {
        $modulos = [
            ['nombre' => 'Técnicas de Maquillaje Básico', 'duracion' => 8],
            ['nombre' => 'Cuidado de la Piel y Facial', 'duracion' => 6],
            ['nombre' => 'Extensiones de Pestañas', 'duracion' => 4],
            ['nombre' => 'Técnicas de Uñas Acrílicas', 'duracion' => 10],
            ['nombre' => 'Balayage y Técnicas de Coloración', 'duracion' => 12],
            ['nombre' => 'Peinados para Eventos', 'duracion' => 5],
            ['nombre' => 'Tratamientos Capilares', 'duracion' => 7],
            ['nombre' => 'Estilismo Profesional', 'duracion' => 15],
            ['nombre' => 'Maquillaje Avanzado', 'duracion' => 10],
            ['nombre' => 'Uñas en Gel y Decoración', 'duracion' => 6],
            ['nombre' => 'Aplicación de Keratina', 'duracion' => 3],
            ['nombre' => 'Corte de Cabello Básico', 'duracion' => 8],
            ['nombre' => 'Corte de Cabello Avanzado', 'duracion' => 12],
            ['nombre' => 'Coloración de Fantasía', 'duracion' => 9],
            ['nombre' => 'Marketing para Estilistas', 'duracion' => 4],
        ];

        foreach ($modulos as $modulo) {
            Modulos::create($modulo);
        }
    }
}