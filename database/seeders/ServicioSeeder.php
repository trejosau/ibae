<?php

namespace Database\Seeders;

use App\Models\Categorias_de_Servicios;
use App\Models\Servicios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        // Crear las categorías de servicios
        Categorias_de_Servicios::create([
            'nombre' => 'Color',
        ]);

        Categorias_de_Servicios::create([
            'nombre' => 'Manicura',
        ]);

        Categorias_de_Servicios::create([
            'nombre' => 'Pedicura',
        ]);

        Categorias_de_Servicios::create([
            'nombre' => 'Corte',
        ]);

        Categorias_de_Servicios::create([
            'nombre' => 'Maquillaje',
        ]);

        Categorias_de_Servicios::create([
            'nombre' => 'Peinado',
        ]);

        // Categoría 1: Color
        Servicios::create([
            'nombre' => 'Tinte Completo',
            'descripcion' => 'Aplicación de tinte en todo el cabello con cobertura completa.',
            'precio' => 800.00,
            'duracion_minima' => 60,
            'duracion_maxima' => 120,
            'categoria' => 1,
            'estado' => 'activo',
        ]);

        Servicios::create([
            'nombre' => 'Mechas Balayage',
            'descripcion' => 'Técnica de coloración para un efecto degradado natural.',
            'precio' => 1500.00,
            'duracion_minima' => 90,
            'duracion_maxima' => 180,
            'categoria' => 1,
            'estado' => 'activo',
        ]);

        Servicios::create([
            'nombre' => 'Reflejos',
            'descripcion' => 'Aplicación de reflejos parciales en mechones seleccionados.',
            'precio' => 1000.00,
            'duracion_minima' => 60,
            'duracion_maxima' => 120,
            'categoria' => 1,
            'estado' => 'activo',
        ]);

        // Categoría 2: Manicura
        Servicios::create([
            'nombre' => 'Manicura Clásica',
            'descripcion' => 'Corte, limado, hidratación y esmaltado simple.',
            'precio' => 300.00,
            'duracion_minima' => 30,
            'duracion_maxima' => 45,
            'categoria' => 2,
            'estado' => 'activo',
        ]);

        Servicios::create([
            'nombre' => 'Manicura de Gel',
            'descripcion' => 'Esmaltado con gel semipermanente para mayor duración.',
            'precio' => 500.00,
            'duracion_minima' => 45,
            'duracion_maxima' => 60,
            'categoria' => 2,
            'estado' => 'activo',
        ]);

        Servicios::create([
            'nombre' => 'Spa de Manos',
            'descripcion' => 'Tratamiento hidratante y exfoliante para manos.',
            'precio' => 600.00,
            'duracion_minima' => 40,
            'duracion_maxima' => 60,
            'categoria' => 2,
            'estado' => 'activo',
        ]);

        // Categoría 3: Pedicura
        Servicios::create([
            'nombre' => 'Pedicura Clásica',
            'descripcion' => 'Limpieza, corte, limado y esmaltado simple para pies.',
            'precio' => 400.00,
            'duracion_minima' => 45,
            'duracion_maxima' => 60,
            'categoria' => 3,
            'estado' => 'activo',
        ]);

        Servicios::create([
            'nombre' => 'Pedicura Spa',
            'descripcion' => 'Tratamiento relajante con exfoliación y masaje para pies.',
            'precio' => 700.00,
            'duracion_minima' => 60,
            'duracion_maxima' => 90,
            'categoria' => 3,
            'estado' => 'activo',
        ]);

        // Categoría 4: Corte
        Servicios::create([
            'nombre' => 'Corte de Cabello',
            'descripcion' => 'Corte personalizado según las preferencias del cliente.',
            'precio' => 300.00,
            'duracion_minima' => 30,
            'duracion_maxima' => 45,
            'categoria' => 4,
            'estado' => 'activo',
        ]);

        Servicios::create([
            'nombre' => 'Corte de Cabello y Barba',
            'descripcion' => 'Corte de cabello combinado con diseño de barba.',
            'precio' => 500.00,
            'duracion_minima' => 45,
            'duracion_maxima' => 60,
            'categoria' => 4,
            'estado' => 'activo',
        ]);

        // Categoría 5: Maquillaje
        Servicios::create([
            'nombre' => 'Maquillaje Social',
            'descripcion' => 'Maquillaje para eventos casuales o reuniones.',
            'precio' => 800.00,
            'duracion_minima' => 60,
            'duracion_maxima' => 90,
            'categoria' => 5,
            'estado' => 'activo',
        ]);

        Servicios::create([
            'nombre' => 'Maquillaje para Novias',
            'descripcion' => 'Maquillaje especializado para bodas con prueba previa.',
            'precio' => 2000.00,
            'duracion_minima' => 90,
            'duracion_maxima' => 120,
            'categoria' => 5,
            'estado' => 'activo',
        ]);

        // Categoría 6: Peinado
        Servicios::create([
            'nombre' => 'Peinado Casual',
            'descripcion' => 'Peinado sencillo para uso diario.',
            'precio' => 500.00,
            'duracion_minima' => 30,
            'duracion_maxima' => 60,
            'categoria' => 6,
            'estado' => 'activo',
        ]);

        Servicios::create([
            'nombre' => 'Peinado para Eventos',
            'descripcion' => 'Peinado elaborado para bodas, fiestas o eventos formales.',
            'precio' => 1000.00,
            'duracion_minima' => 60,
            'duracion_maxima' => 120,
            'categoria' => 6,
            'estado' => 'activo',
        ]);
    }
}
