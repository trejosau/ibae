<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ColegiaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colegiaturas')->insert([
            [
                'id' => 1,
                'id_estudiante_curso' => 1, // Relacionado con estudiante_curso id 1
                'semana' => 1,
                'asistio' => 1, // Sí asistió
                'colegiatura' => 1, // Pagada
                'Monto' => 1500.00, // Monto de la colegiatura
                'fecha_pago' => Carbon::parse('2024-01-15'),
            ],
            [
                'id' => 2,
                'id_estudiante_curso' => 2, // Relacionado con estudiante_curso id 2
                'semana' => 2,
                'asistio' => 0, // No asistió
                'colegiatura' => 0, // No pagada
                'Monto' => 0.00,
                'fecha_pago' => null, // No hubo pago
            ],
            [
                'id' => 3,
                'id_estudiante_curso' => 3, // Relacionado con estudiante_curso id 3
                'semana' => 3,
                'asistio' => 1, // Sí asistió
                'colegiatura' => 1, // Pagada
                'Monto' => 1800.00,
                'fecha_pago' => Carbon::parse('2024-02-10'),
            ],
        ]);
    }
}
