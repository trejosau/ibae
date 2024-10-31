<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ventas;
use App\Models\Administrador;
use App\Models\Estudiante;
use Carbon\Carbon;

class VentasSeeder extends Seeder
{
    public function run()
    {
        // Obtener IDs de Administradores y Matrículas de Estudiantes
        $adminIds = Administrador::pluck('id')->toArray();
        $estudianteIds = Estudiante::pluck('matricula')->toArray();

        // Generar registros de ventas para cada mes del año
        foreach (range(1, 12) as $month) {
            for ($i = 0; $i < 10; $i++) {
                // Determinar si la venta es para un estudiante y asignar matrícula en ese caso
                $esEstudiante = random_int(0, 1) ? 'si' : 'no';

                Ventas::create([
                    'nombre_comprador' => $esEstudiante === 'si' ? 'Estudiante ' . $i : 'Comprador ' . $i,
                    'fecha_compra' => Carbon::now()->setMonth($month)->day(rand(1, 28)),
                    'total' => round(rand(100, 5000) / 1.15, 2),
                    'id_admin' => $adminIds[array_rand($adminIds)],
                    'es_estudiante' => $esEstudiante,
                    'matricula' => $esEstudiante === 'si' ? $estudianteIds[array_rand($estudianteIds)] : null,
                ]);
            }
        }
    }
}
