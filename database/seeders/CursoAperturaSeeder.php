<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CursoApertura;
use App\Models\Cursos;
use Carbon\Carbon;

class CursoAperturaSeeder extends Seeder
{
    public function run()
    {
        $cursos = Cursos::all();

        foreach ($cursos as $curso) {
            // Suponiendo que la duración de semanas está definida en el modelo Curso
            $duracion_semanas = $curso->duracion_semanas;

            // Generar una fecha de inicio aleatoria dentro de un rango específico
            $fecha_inicio = Carbon::now()->addDays(rand(1, 30))->startOfDay();
            $mes_inicio = $fecha_inicio->translatedFormat('F'); // Mes en español
            $dia_semana = $fecha_inicio->translatedFormat('l'); // Día en español

            // Generar una hora de clase aleatoria
            $hora_clase = $fecha_inicio->copy()->setTime(rand(8, 17), rand(0, 59)); // Horario entre 08:00 y 17:59

            // Crear el nombre del curso de apertura
            $nombreCursoApertura = "{$curso->nombre} - {$mes_inicio} - " . $fecha_inicio->year . " - {$duracion_semanas} semanas";

            // Crear el registro de apertura de curso
            CursoApertura::create([
                'id_curso' => $curso->id,
                'nombre' => $nombreCursoApertura,
                'fecha_inicio' => $fecha_inicio,
                'monto_colegiatura' => rand(1000, 5000), // Monto aleatorio entre 1000 y 5000
                'dia_clase' => $dia_semana,
                'hora_clase' => $hora_clase->format('H:i'), // Formato de hora
            ]);
        }
    }
}
