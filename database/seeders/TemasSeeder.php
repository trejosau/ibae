<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Temas;

class TemasSeeder extends Seeder
{
    public function run()
    {
        $temas = [
            ['nombre' => 'Introducción al Maquillaje', 'descripcion' => 'Conceptos básicos de maquillaje y herramientas.'],
            ['nombre' => 'Técnicas de Coloración', 'descripcion' => 'Teoría de color y técnicas de aplicación.'],
            ['nombre' => 'Cuidado Capilar', 'descripcion' => 'Métodos de cuidado y tratamiento del cabello.'],
            ['nombre' => 'Uñas Acrílicas', 'descripcion' => 'Proceso de aplicación y decoración de uñas acrílicas.'],
            ['nombre' => 'Estilos de Peinados', 'descripcion' => 'Peinados clásicos y modernos para diferentes ocasiones.'],
        ];

        foreach ($temas as $tema) {
            Temas::create($tema);
        }
    }
}