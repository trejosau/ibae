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

        for ($i = 1; $i <= 50; $i++) {
            $precio_proveedor = $faker->randomFloat(2, 30, 150); // Precio entre 30 y 150
            $precio_lista = $faker->randomFloat(2, $precio_proveedor + 1, 300); // Mayor que precio_proveedor, hasta 300
            $precio_venta = $faker->randomFloat(2, $precio_lista + 1, 600); // Mayor que precio_lista, hasta 600

            Productos::create([
                'nombre' => 'Producto ' . $i,
                'descripcion' => $faker->paragraph,
                'marca' => $faker->company,
                'precio_proveedor' => $precio_proveedor,
                'precio_lista' => $precio_lista,
                'precio_venta' => $precio_venta,
                'cantidad' => $faker->numberBetween(1, 100),
                'medida' => $faker->randomElement(['pzas', 'ml', 'lt', 'gr', 'cm']),
                'id_proveedor' => $proveedores->random()->id,
                'main_photo' => 'https://picsum.photos/640/480?random=' . rand(1, 1000),
                'stock' => $faker->numberBetween(0, 200),
                'estado' => $faker->randomElement(['activo', 'inactivo', 'agotado']),
                'fecha_agregado' => $faker->date(),
                'id_categoria' => $categorias->random()->id,
            ]);
        }
    }
}
