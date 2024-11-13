<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Crear roles
        Role::create(['name' => 'cliente']);
        Role::create(['name' => 'estudiante']);
        Role::create(['name' => 'profesor']);
        Role::create(['name' => 'estilista']);
        Role::create(['name' => 'admin']);
    }
}
