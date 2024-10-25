<?php

namespace Database\Seeders;

use App\Models\HorarioSalon;
use Illuminate\Database\Seeder;

class HorarioSalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir los días de la semana
        $dias = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];

        foreach ($dias as $dia) {
            HorarioSalon::create([
                'dia' => $dia,
                'hora_apertura' => '10:00:00', // 10 AM
                'hora_cierre' => '18:00:00', // 6 PM
            ]);
        }
    }
}
