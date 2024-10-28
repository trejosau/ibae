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

        // Iterar sobre cada mes de 2024
        for ($mes = 1; $mes <= 12; $mes++) {
            // Generar un número de citas aleatorio entre 5 y 15 para cada mes
            $numCitas = $faker->numberBetween(5, 15);

            for ($i = 0; $i < $numCitas; $i++) {
                // Generar una fecha aleatoria dentro del mes actual para la hora de creación
                $fechaHoraCreacion = $faker->dateTimeBetween("2024-$mes-01", "2024-$mes-" . cal_days_in_month(CAL_GREGORIAN, $mes, 2024));

                // Establecer la hora de inicio un poco después de la hora de creación
                $fechaHoraInicioCita = (clone $fechaHoraCreacion)->modify('+15 minutes'); // 15 minutos después

                // Establecer la hora de fin unas horas después de la hora de inicio
                $fechaHoraFinCita = (clone $fechaHoraInicioCita)->modify('+1 hour'); // 1 hora después

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
                    'fecha_hora_creacion' => $fechaHoraCreacion,
                    'fecha_hora_inicio_cita' => $fechaHoraInicioCita,
                    'fecha_hora_fin_cita' => $fechaHoraFinCita,
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
}
