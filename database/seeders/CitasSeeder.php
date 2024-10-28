<?php

namespace Database\Seeders;

use App\Models\Citas; // Asegúrate de que este modelo esté creado
use App\Models\Estilista;
use App\Models\Comprador;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CitasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $estilistas = Estilista::all();
        $compradores = Comprador::all();

        for ($i = 0; $i < 10; $i++) {
            $total = $faker->randomFloat(2, 50, 500);
            $anticipo = $total * 0.25;
            $estadoCita = $faker->randomElement(['programada', 'reprogramada', 'cancelada', 'completada']);
            $estadoPago = $faker->randomElement(['concluido', 'anticipo']);

            $pagoRestante = ($estadoPago === 'concluido') ? 0 : $total - $anticipo;

            $nuevaFechaHora = null;
            $motivo = null;

            if ($estadoCita === 'reprogramada') {
                $nuevaFechaHora = $faker->dateTimeBetween('+1 week', '+2 weeks');
                $motivo = $faker->sentence; // Genera un motivo aleatorio
            }

            Citas::create([
                'id_estilista' => $estilistas->random()->id,
                'id_comprador' => $compradores->random()->id,
                'fecha_hora_creacion' => now(),
                'fecha_hora_inicio_cita' => $faker->dateTimeBetween('now', '+1 week'),
                'fecha_hora_fin_cita' => $faker->dateTimeBetween('+1 week', '+2 weeks'),
                'total' => $total,
                'anticipo' => $anticipo,
                'pago_restante' => $pagoRestante,
                'estado_pago' => $estadoPago,
                'estado_cita' => $estadoCita,
                'nueva_fecha_hora_inicio_cita' => $nuevaFechaHora,
                'motivo_reprogramacion' => $motivo,
            ]);
        }
    }
}
