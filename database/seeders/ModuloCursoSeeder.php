<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulos;
use App\Models\Cursos;
use App\Models\Profesor;
use App\Models\ModuloCurso;

class ModuloCursoSeeder extends Seeder
{
    public function run()
    {
        // Obtiene todos los IDs de módulos, cursos y profesores
        $moduloIds = Modulos::pluck('id')->toArray();
        $cursoIds = Cursos::pluck('id')->toArray();
        $profesorIds = Profesor::pluck('id')->toArray();

        // Verifica que haya módulos, cursos y profesores disponibles
        if (empty($moduloIds) || empty($cursoIds) || empty($profesorIds)) {
            $this->command->info('No hay módulos, cursos o profesores para asignar.');
            return;
        }

        foreach ($cursoIds as $cursoId) {
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
                    'id_curso' => $cursoId,
                    'orden' => $orden++,
                    'id_profesor' => $profesorIds[array_rand($profesorIds)],
                ]);
            }
        }
    }
}
