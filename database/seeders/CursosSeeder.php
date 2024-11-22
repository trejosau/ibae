<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert([
            [
                'id' => 1,
                'nombre' => 'Curso de Corte de Cabello',
                'descripcion' => 'Curso que enseña técnicas de corte de cabello tanto para hombres como mujeres.',
                'duracion_semanas' => 6,
                'estado' => 'activo',
                'id_certificacion' => 1,  // Asumiendo que el certificado con id 1 existe en la tabla certificados
            ],
            [
                'id' => 2,
                'nombre' => 'Curso de Maquillaje para Eventos',
                'descripcion' => 'Curso especializado en maquillaje para eventos y ocasiones especiales.',
                'duracion_semanas' => 4,
                'estado' => 'activo',
                'id_certificacion' => 2,  // Asumiendo que el certificado con id 2 existe en la tabla certificados
            ],
            [
                'id' => 3,
                'nombre' => 'Curso de Diseño de Uñas',
                'descripcion' => 'Curso completo sobre el diseño y cuidado de uñas acrílicas y gel.',
                'duracion_semanas' => 8,
                'estado' => 'activo',
                'id_certificacion' => 3,  // Asumiendo que el certificado con id 3 existe en la tabla certificados
            ],
            [
                'id' => 4,
                'nombre' => 'Curso de Masajes Estéticos',
                'descripcion' => 'Curso de masajes faciales y corporales para fines estéticos.',
                'duracion_semanas' => 10,
                'estado' => 'inactivo',
                'id_certificacion' => 4,  // Asumiendo que el certificado con id 4 existe en la tabla certificados
            ],
        ]);
    }
}
