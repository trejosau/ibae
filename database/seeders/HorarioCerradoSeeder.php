<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioCerradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('horario_cerrado')->insert([
            [
                'fecha_hora_cierre_inicio' => '2024-10-25 10:00:00',
                'fecha_hora_cierre_fin' => '2024-10-25 12:00:00',
                'hora_fin' => '12:00:00',
                'motivo' => 'Mantenimiento programado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_hora_cierre_inicio' => '2024-11-01 14:00:00',
                'fecha_hora_cierre_fin' => '2024-11-01 16:00:00',
                'hora_fin' => '16:00:00',
                'motivo' => 'Evento especial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fecha_hora_cierre_inicio' => '2024-11-15 09:00:00',
                'fecha_hora_cierre_fin' => '2024-11-15 11:00:00',
                'hora_fin' => '11:00:00',
                'motivo' => 'Cierre anual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
