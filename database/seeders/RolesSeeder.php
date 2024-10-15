<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Profesor']);
        Role::create(['name' => 'Estilista']);
        Role::create(['name' => 'Cliente']);
        Role::create(['name' => 'Comprador']);
    }
}
