<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedores;
use Faker\Factory as Faker;

class ProveedoresSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Proveedores::create([
                'nombre_persona' => $faker->name,
                'nombre_empresa' => $faker->company,
                'contacto_telefono' => $faker->numerify(str_repeat('#', 15)),
                'contacto_correo' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
