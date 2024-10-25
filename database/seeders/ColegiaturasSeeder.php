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

                Colegiaturas::create([
                    'id_estudiante_curso' => $estudiante_curso->id, // Asegúrate de que 'id' se refiera correctamente
                    'semana' => $i,
                    'Asistio' => $faker->boolean, // Asistencia aleatoria
                    'Fecha_de_Pago' => $faker->optional()->date(), // Fecha de pago opcional
                    'estado' => $estado, // Estado con 80% "pagado"
                    'Monto' => $faker->randomFloat(2, 500, 2000), // Monto entre $500 y $2000
                ]);
            }
        }
    }
}
