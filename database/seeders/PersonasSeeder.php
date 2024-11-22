<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert([
            [
                'id' => 1,
                'nombre' => 'Juan',
                'ap_paterno' => 'Pérez',
                'ap_materno' => 'González',
                'telefono' => '1234567890',
                'usuario' => 15,  // Relacionado con el usuario con id 15
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nombre' => 'María',
                'ap_paterno' => 'González',
                'ap_materno' => 'López',
                'telefono' => '0987654321',
                'usuario' => 16,  // Relacionado con el usuario con id 16
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nombre' => 'Luis',
                'ap_paterno' => 'Rodríguez',
                'ap_materno' => 'Hernández',
                'telefono' => '1122334455',
                'usuario' => 17,  // Relacionado con el usuario con id 17
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,  // Id de la persona
                'nombre' => 'Carlos',
                'ap_paterno' => 'González',
                'ap_materno' => 'Ramírez',
                'telefono' => '1234567890',
                'usuario' => 18,  // Relación con el usuario
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,  // Id de la persona
                'nombre' => 'Ana',
                'ap_paterno' => 'Martínez',
                'ap_materno' => 'López',
                'telefono' => '0987654321',
                'usuario' => 19,  // Relación con el usuario
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,  // Id de la persona
                'nombre' => 'Luis',
                'ap_paterno' => 'Pérez',
                'ap_materno' => 'Sánchez',
                'telefono' => '1122334455',
                'usuario' => 20,  // Relación con el usuario
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
