<?php

namespace Database\Seeders;

use App\Models\Categorias_de_Servicios;
use App\Models\Servicios;
use Illuminate\Database\Seeder;

class ServiciosSeeder extends Seeder
{
    public function run(): void
    {

        Categorias_de_Servicios::insert([
            ['nombre' => 'Manicura'],
            ['nombre' => 'Color'],
            ['nombre' => 'Corte y estilizado'],
            ['nombre' => 'Alisado y tratamiento'],
            ['nombre' => 'Cejas y pestañas'],
            ['nombre' => 'Maquillaje y peinado'],
            ['nombre' => 'Pedicura'],
        ]);

        $manicura = Categorias_de_Servicios::where('nombre', 'Manicura')->first();
        $color = Categorias_de_Servicios::where('nombre', 'Color')->first();
        $corte_y_estilizado = Categorias_de_Servicios::where('nombre', 'Corte y estilizado')->first();
        $alisado_y_tratamiento = Categorias_de_Servicios::where('nombre', 'Alisado y tratamiento')->first();
        $cejas_y_pestanas = Categorias_de_Servicios::where('nombre', 'Cejas y pestañas')->first();
        $maquillaje_y_peinado = Categorias_de_Servicios::where('nombre', 'Maquillaje y peinado')->first();
        $pedicura = Categorias_de_Servicios::where('nombre', 'Pedicura')->first();

        // Servicios para Manicura
        Servicios::create([
            'nombre' => 'Manicure Básico',
            'descripcion' => 'Manicure básico con esmalte de colores.',
            'precio' => 250.00,
            'duracion_maxima' => 60,
            'duracion_minima' => 45,
            'categoria' => $manicura->id,
            'estado' => 'activo'
        ]);

        Servicios::create([
            'nombre' => 'Manicure Completo',
            'descripcion' => 'Manicure con esmaltado y tratamiento.',
            'precio' => 350.00,
            'duracion_maxima' => 90,
            'duracion_minima' => 75,
            'categoria' => $manicura->id,
            'estado' => 'activo'
        ]);

        // Servicios para Color
        Servicios::create([
            'nombre' => 'Coloración de Cabello',
            'descripcion' => 'Cambio de color de cabello, incluye un solo tono.',
            'precio' => 700.00,
            'duracion_maxima' => 120,
            'duracion_minima' => 90,
            'categoria' => $color->id,
            'estado' => 'activo'
        ]);

        Servicios::create([
            'nombre' => 'Mechas',
            'descripcion' => 'Aplicación de mechas en todo el cabello.',
            'precio' => 1500.00,
            'duracion_maxima' => 180,
            'duracion_minima' => 150,
            'categoria' => $color->id,
            'estado' => 'activo'
        ]);

        // Servicios para Corte y estilizado
        Servicios::create([
            'nombre' => 'Corte de Cabello',
            'descripcion' => 'Corte básico de cabello.',
            'precio' => 250.00,
            'duracion_maxima' => 60,
            'duracion_minima' => 45,
            'categoria' => $corte_y_estilizado->id,
            'estado' => 'activo'
        ]);

        Servicios::create([
            'nombre' => 'Estilizado y Peinado',
            'descripcion' => 'Peinado con técnica profesional.',
            'precio' => 300.00,
            'duracion_maxima' => 90,
            'duracion_minima' => 60,
            'categoria' => $corte_y_estilizado->id,
            'estado' => 'activo'
        ]);

        // Servicios para Alisado y tratamiento
        Servicios::create([
            'nombre' => 'Alisado de Cabello',
            'descripcion' => 'Alisado de cabello con productos profesionales.',
            'precio' => 1200.00,
            'duracion_maxima' => 180,
            'duracion_minima' => 150,
            'categoria' => $alisado_y_tratamiento->id,
            'estado' => 'activo'
        ]);

        Servicios::create([
            'nombre' => 'Tratamiento Capilar',
            'descripcion' => 'Tratamiento para revitalizar y restaurar el cabello.',
            'precio' => 700.00,
            'duracion_maxima' => 120,
            'duracion_minima' => 90,
            'categoria' => $alisado_y_tratamiento->id,
            'estado' => 'activo'
        ]);

        // Servicios para Cejas y pestañas
        Servicios::create([
            'nombre' => 'Laminado de Cejas',
            'descripcion' => 'Tratamiento para moldear las cejas.',
            'precio' => 250.00,
            'duracion_maxima' => 60,
            'duracion_minima' => 45,
            'categoria' => $cejas_y_pestanas->id,
            'estado' => 'activo'
        ]);

        Servicios::create([
            'nombre' => 'Lash Lifting',
            'descripcion' => 'Rizado permanente de pestañas.',
            'precio' => 250.00,
            'duracion_maxima' => 60,
            'duracion_minima' => 45,
            'categoria' => $cejas_y_pestanas->id,
            'estado' => 'activo'
        ]);

        // Servicios para Maquillaje y Peinado
        Servicios::create([
            'nombre' => 'Maquillaje Social',
            'descripcion' => 'Maquillaje para eventos sociales.',
            'precio' => 650.00,
            'duracion_maxima' => 90,
            'duracion_minima' => 60,
            'categoria' => $maquillaje_y_peinado->id,
            'estado' => 'activo'
        ]);

        Servicios::create([
            'nombre' => 'Maquillaje de Novia',
            'descripcion' => 'Maquillaje completo para novias.',
            'precio' => 1400.00,
            'duracion_maxima' => 120,
            'duracion_minima' => 90,
            'categoria' => $maquillaje_y_peinado->id,
            'estado' => 'activo'
        ]);

        // Servicios para Pedicura
        Servicios::create([
            'nombre' => 'Pedicura Básica',
            'descripcion' => 'Pedicura básica con esmalte de colores.',
            'precio' => 300.00,
            'duracion_maxima' => 60,
            'duracion_minima' => 45,
            'categoria' => $pedicura->id,
            'estado' => 'activo'
        ]);

        Servicios::create([
            'nombre' => 'Pedicura con Acrígel',
            'descripcion' => 'Pedicura con tratamiento acrígel.',
            'precio' => 400.00,
            'duracion_maxima' => 90,
            'duracion_minima' => 75,
            'categoria' => $pedicura->id,
            'estado' => 'activo'
        ]);
    }
}
