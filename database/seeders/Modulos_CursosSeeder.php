<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosCursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos_cursos')->insert([
            [
                'id' => 1,
                'id_modulo' => 1,  // Relación con un modulo existente
                'id_curso_apertura' => 1,  // Relación con un curso de apertura existente
                'orden' => 1,
                'id_profesor' => 15,  // Relacionado con el profesor con id 15
            ],
            [
                'id' => 2,
                'id_modulo' => 2,  // Relación con un modulo existente
                'id_curso_apertura' => 2,  // Relación con un curso de apertura existente
                'orden' => 2,
                'id_profesor' => 16,  // Relacionado con el profesor con id 16
            ],
            [
                'id' => 3,
                'id_modulo' => 3,  // Relación con un modulo existente
                'id_curso_apertura' => 3,  // Relación con un curso de apertura existente
                'orden' => 3,
                'id_profesor' => 17,  // Relacionado con el profesor con id 17
            ],
        ]);
    }
}
