<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $categorias = Categorias::all();
        $proveedores = Proveedores::all();

        if ($categorias->isEmpty() || $proveedores->isEmpty()) {
            return;
        }

        $productos = [];
        for ($i = 1; $i <= 50; $i++) {
            $productos[] = [
                'nombre' => 'Producto ' . $i,
                'descripcion' => $faker->paragraph,
                'marca' => $faker->company,
                'precio_lista' => $faker->randomFloat(2, 50, 500),
                'precio_venta' => $faker->randomFloat(2, 40, 450),
                'cantidad' => $faker->numberBetween(1, 100),
                'medida' => $faker->randomElement(['pzas', 'ml', 'lt', 'gr', 'cm']),
                'id_proveedor' => $proveedores->random()->id,
                'main_photo' => 'https://picsum.photos/640/480?random=' . rand(1, 1000),
                'stock' => $faker->numberBetween(0, 200),
                'estado' => $faker->randomElement(['activo', 'inactivo', 'agotado']),
                'fecha_agregado' => now(),
                'id_categoria' => $categorias->random()->id,
            ];
        }

        Productos::insert($productos);
    }
}
