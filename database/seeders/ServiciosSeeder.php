<?php

namespace Database\Seeders;

use App\Models\Servicios; // Asegúrate de que este modelo esté creado
use Illuminate\Database\Seeder;

class ServiciosSeeder extends Seeder
{
    public function run()
    {
        // Define una lista de servicios
        $servicios = [
            [
                'nombre' => 'Manicura Básica',
                'descripcion' => 'Servicio de manicura básica que incluye corte, limado y pulido de uñas.',
                'precio' => 200.00,
                'categoria' => 'manicura',
            ],
            [
                'nombre' => 'Manicura Gel',
                'descripcion' => 'Manicura con esmalte en gel que dura más tiempo.',
                'precio' => 350.00,
                'categoria' => 'manicura',
            ],
            [
                'nombre' => 'Color Completo',
                'descripcion' => 'Aplicación de color completo en el cabello.',
                'precio' => 500.00,
                'categoria' => 'color',
            ],
            [
                'nombre' => 'Corte y Estilizado',
                'descripcion' => 'Corte de cabello y estilizado con productos de alta calidad.',
                'precio' => 400.00,
                'categoria' => 'corte y estilizado',
            ],
            [
                'nombre' => 'Alisado de Cabello',
                'descripcion' => 'Servicio de alisado de cabello con productos especializados.',
                'precio' => 800.00,
                'categoria' => 'alisado y tratamiento',
            ],
            [
                'nombre' => 'Diseño de Cejas',
                'descripcion' => 'Diseño y depilación de cejas para un acabado perfecto.',
                'precio' => 150.00,
                'categoria' => 'cejas y pestañas',
            ],
            [
                'nombre' => 'Maquillaje Social',
                'descripcion' => 'Maquillaje para eventos sociales y ocasiones especiales.',
                'precio' => 600.00,
                'categoria' => 'maquillaje y peinado',
            ],
            [
                'nombre' => 'Pedicura Completa',
                'descripcion' => 'Servicio completo de pedicura que incluye exfoliación y masaje.',
                'precio' => 250.00,
                'categoria' => 'pedicura',
            ],
        ];

        // Insertar los servicios en la base de datos
        foreach ($servicios as $servicio) {
            Servicios::create($servicio);
        }
    }
}
