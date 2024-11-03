<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulos;
use App\Models\CursoApertura; // Asegúrate de que este modelo esté importado
use App\Models\Profesor;
use App\Models\ModuloCurso;

class ModuloCursoSeeder extends Seeder
{
    public function run()
    {
        // Obtiene todos los IDs de módulos, curso apertura y profesores
        $moduloIds = Modulos::pluck('id')->toArray();
        $cursoAperturaIds = CursoApertura::pluck('id')->toArray(); // Cambia 'curso_apertura' a 'id'
        $profesorIds = Profesor::pluck('id')->toArray();

        // Verifica que haya módulos, curso apertura y profesores disponibles
        if (empty($moduloIds) || empty($cursoAperturaIds) || empty($profesorIds)) {
            $this->command->info('No hay módulos, cursos de apertura o profesores para asignar.');
            return;
        }

        foreach ($cursoAperturaIds as $cursoAperturaId) {
            // Orden inicial para cada módulo en el curso
            $orden = 1;

            // Selecciona de 1 a 4 módulos aleatoriamente para cada curso
            $modulosAsignados = array_rand($moduloIds, min(4, count($moduloIds)));

            // Si solo un módulo es seleccionado, asegúrate de que sea un array
            if (!is_array($modulosAsignados)) {
                $modulosAsignados = [$modulosAsignados];
            }

            foreach ($modulosAsignados as $moduloIndex) {
                ModuloCurso::create([
                    'id_modulo' => $moduloIds[$moduloIndex],
                    'id_curso_apertura' => $cursoAperturaId, // Asegúrate de usar 'id_curso_apertura'
                    'orden' => $orden++,
                    'id_profesor' => $profesorIds[array_rand($profesorIds)],
                ]);
            }
        }
    }
}
