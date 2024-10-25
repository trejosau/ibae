<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulos;
use App\Models\Temas;
use App\Models\ModuloTemas;

class ModuloTemasSeeder extends Seeder
{
    public function run()
    {
        // Obtén todos los IDs de módulos y temas
        $moduloIds = Modulos::pluck('id')->toArray();
        $temaIds = Temas::pluck('id')->toArray();

        foreach ($moduloIds as $moduloId) {
            // Asigna de 1 a 3 temas aleatorios a cada módulo
            $temasAsignados = array_rand($temaIds, rand(1, 3));

            foreach ((array) $temasAsignados as $temaId) {
                ModuloTemas::create([
                    'id_modulo' => $moduloId,
                    'id_tema' => $temaIds[$temaId],
                ]);
            }
        }
    }
}