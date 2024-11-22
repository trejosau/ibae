<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certificados')->insert([
            [
                'id' => 1,
                'nombre' => 'Certificado de Inglés Avanzado',
                'descripcion' => 'Certificado otorgado por la SEP que acredita habilidades avanzadas en el idioma inglés.',
                'horas' => 120,
                'institucion' => 'SEP',
            ],
            [
                'id' => 2,
                'nombre' => 'Certificado de Programación Web',
                'descripcion' => 'Certificado emitido por una institución privada que acredita conocimientos en desarrollo web.',
                'horas' => 200,
                'institucion' => 'Otra',
            ],
            [
                'id' => 3,
                'nombre' => 'Certificado de Diseño Gráfico',
                'descripcion' => 'Certificado proporcionado por la SEP para la certificación en diseño gráfico digital.',
                'horas' => 150,
                'institucion' => 'SEP',
            ],
            [
                'id' => 4,
                'nombre' => 'Certificado en Administración de Proyectos',
                'descripcion' => 'Certificado otorgado por una institución reconocida internacionalmente.',
                'horas' => 180,
                'institucion' => 'Otra',
            ],
        ]);
    }
}
