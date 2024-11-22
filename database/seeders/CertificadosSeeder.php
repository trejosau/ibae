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
                'nombre' => 'Certificado en Estilismo de Cabello',
                'descripcion' => 'Certificación otorgada por la SEP para estilistas de cabello.',
                'horas' => 120,
                'institucion' => 'SEP',
            ],
            [
                'id' => 2,
                'nombre' => 'Certificado en Maquillaje Profesional',
                'descripcion' => 'Certificación en técnicas avanzadas de maquillaje profesional.',
                'horas' => 80,
                'institucion' => 'Otra',
            ],
            [
                'id' => 3,
                'nombre' => 'Certificado en Uñas Acrílicas',
                'descripcion' => 'Certificación en la técnica de aplicación de uñas acrílicas.',
                'horas' => 100,
                'institucion' => 'SEP',
            ],
            [
                'id' => 4,
                'nombre' => 'Certificado en Masajes Estéticos',
                'descripcion' => 'Certificación para realizar masajes estéticos y terapéuticos.',
                'horas' => 150,
                'institucion' => 'Otra',
            ],
        ]);
    }
}
