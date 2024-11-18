<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Inscripciones extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entries = [
            [
                'nombre' => 'Inscripción Básica Primavera-2022 (400)',
                'precio' => 400.00,
                'descripcion' => 'Inscripción básica para el periodo de Primavera del año 2022.',
                'material_incluido' => 0,
            ],
            [
                'nombre' => 'Inscripción Básica Verano-2022 (500)',
                'precio' => 500.00,
                'descripcion' => 'Inscripción básica para el periodo de Verano del año 2022.',
                'material_incluido' => 0,
            ],
            [
                'nombre' => 'Inscripción Básica Otoño-2022 (600)',
                'precio' => 600.00,
                'descripcion' => 'Inscripción básica para el periodo de Otoño del año 2022.',
                'material_incluido' => 0,
            ],
            [
                'nombre' => 'Inscripción Básica Invierno-2022 (400)',
                'precio' => 400.00,
                'descripcion' => 'Inscripción básica para el periodo de Invierno del año 2022.',
                'material_incluido' => 0,
            ],
            [
                'nombre' => 'Inscripción con Material Incluido Primavera-2022 (400)',
                'precio' => 400.00,
                'descripcion' => 'Inscripción con material incluido para el periodo de Primavera del año 2022.',
                'material_incluido' => 1,
            ],
            [
                'nombre' => 'Inscripción con Material Incluido Verano-2022 (500)',
                'precio' => 500.00,
                'descripcion' => 'Inscripción con material incluido para el periodo de Verano del año 2022.',
                'material_incluido' => 1,
            ],
        ];

        DB::table('inscripciones')->insert($entries);
    }
}
