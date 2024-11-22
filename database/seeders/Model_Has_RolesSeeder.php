<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles para profesores
        DB::table('model_has_roles')->insert([
            [
                'role_id' => 3, // Rol de profesor
                'model_type' => 'App\\Models\\Profesor',
                'model_id' => 15, // ID del primer profesor
            ],
            [
                'role_id' => 3,
                'model_type' => 'App\\Models\\Profesor',
                'model_id' => 16, // ID del segundo profesor
            ],
            [
                'role_id' => 3,
                'model_type' => 'App\\Models\\Profesor',
                'model_id' => 17, // ID del tercer profesor
            ],
        ]);

        // Roles para estudiantes
        DB::table('model_has_roles')->insert([
            [
                'role_id' => 2, // Rol de estudiante
                'model_type' => 'App\\Models\\Estudiante',
                'model_id' => 18, // ID del primer estudiante
            ],
            [
                'role_id' => 2,
                'model_type' => 'App\\Models\\Estudiante',
                'model_id' => 19, // ID del segundo estudiante
            ],
            [
                'role_id' => 2,
                'model_type' => 'App\\Models\\Estudiante',
                'model_id' => 20, // ID del tercer estudiante
            ],
        ]);
    }
}
