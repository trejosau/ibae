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

                // Generar una fecha de pago en 2024 si el estado es "pagado"
                $fechaPago = $estado === 'pagado' ? $faker->date('Y-m-d', '2024-12-31') : null;

                Colegiaturas::create([
                    'id_estudiante_curso' => $estudiante_curso->id, // Asegúrate de que 'id' se refiera correctamente
                    'semana' => $i,
                    'Asistio' => $faker->boolean, // Asistencia aleatoria
                    'Fecha_de_Pago' => $fechaPago, // Fecha de pago opcional
                    'estado' => $estado, // Estado con 80% "pagado"
                ]);
            }
        }
    }
}
