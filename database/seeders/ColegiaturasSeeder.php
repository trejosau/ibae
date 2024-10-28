<?php

namespace Database\Seeders;

use App\Models\Colegiaturas;
use Illuminate\Database\Seeder;
use App\Models\EstudianteCurso; // Asegúrate de que esta importación sea correcta
use Faker\Factory as Faker;

class ColegiaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $estudiante_cursos = EstudianteCurso::all();

        foreach ($estudiante_cursos as $estudiante_curso) {
            for ($i = 1; $i <= 10; $i++) { // Colegiatura para 10 semanas
                // Asignar estado con 80% "pagado" y 20% "pendiente"
                $estado = random_int(1, 10) <= 8 ? 'pagado' : 'pendiente';

                // Generar un mes aleatorio entre 1 y 12
                $mes = random_int(1, 12);
                // Generar una fecha de pago en 2024 si el estado es "pagado"
                $fechaPago = $estado === 'pagado' ? $this->generateRandomDateIn2024($mes) : null;

                Colegiaturas::create([
                    'id_estudiante_curso' => $estudiante_curso->id, // Asegúrate de que 'id' se refiera correctamente
                    'semana' => $i,
                    'Asistio' => $faker->boolean, // Asistencia aleatoria
                    'Fecha_de_Pago' => $fechaPago, // Fecha de pago opcional
                    'estado' => $estado, // Estado con 80% "pagado"
                    'Monto' => $faker->randomFloat(2, 500, 2000), // Monto entre $500 y $2000
                ]);
            }
        }
    }

    /**
     * Genera una fecha aleatoria en 2024 para un mes específico.
     *
     * @param int $mes
     * @return string
     */
    private function generateRandomDateIn2024(int $mes)
    {
        // Generar un día aleatorio entre 1 y el número de días del mes
        $díasEnMes = cal_days_in_month(CAL_GREGORIAN, $mes, 2024);
        $día = random_int(1, $díasEnMes);

        // Retornar la fecha en formato YYYY-MM-DD
        return "2024-$mes-$día";
    }
}
