<?php

namespace Database\Seeders;

use App\Models\HorarioSalonCerrado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class HorarioSalonCerradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir algunas fechas de cierre
        $cierres = [
            [
                'fecha_hora_cierre_inicio' => Carbon::create(2024, 11, 1, 10, 0, 0), // 1 de noviembre 2024, 10 AM
                'fecha_hora_cierre_fin' => Carbon::create(2024, 11, 1, 18, 0, 0), // 1 de noviembre 2024, 6 PM
                'hora_fin' => '18:00:00',
                'motivo' => 'Mantenimiento',
            ],
            [
                'fecha_hora_cierre_inicio' => Carbon::create(2024, 12, 25, 10, 0, 0), // 25 de diciembre 2024, 10 AM
                'fecha_hora_cierre_fin' => Carbon::create(2024, 12, 25, 18, 0, 0), // 25 de diciembre 2024, 6 PM
                'hora_fin' => '18:00:00',
                'motivo' => 'Navidad',
            ],
            [
                'fecha_hora_cierre_inicio' => Carbon::create(2024, 1, 1, 10, 0, 0), // 1 de enero 2024, 10 AM
                'fecha_hora_cierre_fin' => Carbon::create(2024, 1, 1, 18, 0, 0), // 1 de enero 2024, 6 PM
                'hora_fin' => '18:00:00',
                'motivo' => 'Año Nuevo',
            ],
        ];

        // Insertar los registros
        foreach ($cierres as $cierre) {
            HorarioSalonCerrado::create([
                'fecha_hora_cierre_inicio' => $cierre['fecha_hora_cierre_inicio'],
                'fecha_hora_cierre_fin' => $cierre['fecha_hora_cierre_fin'],
                'hora_fin' => $cierre['hora_fin'],
                'motivo' => $cierre['motivo'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
