<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosTemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos_temas')->insert([
            [
                'id' => 1,
                'id_modulo' => 1,  // Relación con un modulo existente
                'id_tema' => 1,     // Relación con un tema existente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'id_modulo' => 1,  // Relación con un modulo existente
                'id_tema' => 2,     // Relación con un tema existente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'id_modulo' => 2,  // Relación con un modulo existente
                'id_tema' => 3,     // Relación con un tema existente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'id_modulo' => 2,  // Relación con un modulo existente
                'id_tema' => 4,     // Relación con un tema existente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'id_modulo' => 3,  // Relación con un modulo existente
                'id_tema' => 5,     // Relación con un tema existente
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
