<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CursoAperturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curso_apertura')->insert([
            [
                'id' => 1,  // ID del curso de apertura
                'id_curso' => 1,  // Relación con la tabla cursos
                'nombre' => 'Curso Básico de Estilismo',
                'fecha_inicio' => Carbon::parse('2024-01-15'),
                'monto_colegiatura' => 1500.00,
                'dia_clase' => 'Lunes',
                'hora_clase' => '10:00:00',
                'estado' => 'programado',
            ],
            [
                'id' => 2,  // ID del curso de apertura
                'id_curso' => 2,  // Relación con la tabla cursos
                'nombre' => 'Taller Intensivo de Barbería',
                'fecha_inicio' => Carbon::parse('2024-02-01'),
                'monto_colegiatura' => 1800.00,
                'dia_clase' => 'Miércoles',
                'hora_clase' => '15:00:00',
                'estado' => 'en curso',
            ],
            [
                'id' => 3,  // ID del curso de apertura
                'id_curso' => 3,  // Relación con la tabla cursos
                'nombre' => 'Curso Avanzado de Maquillaje',
                'fecha_inicio' => Carbon::parse('2024-03-10'),
                'monto_colegiatura' => 2000.00,
                'dia_clase' => 'Sábado',
                'hora_clase' => '09:00:00',
                'estado' => 'finalizado',
            ],
        ]);
    }
}
