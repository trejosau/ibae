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
            Productos::create([
                'nombre' => 'Producto ' . $i,
                'descripcion' => $faker->paragraph,
                'marca' => $faker->company,
                'precio_lista' => $faker->randomFloat(2, 50, 500), // Genera precios entre 50 y 500
                'precio_venta' => $faker->randomFloat(2, 40, 450), // Precio de venta menor al precio de lista
                'cantidad' => $faker->numberBetween(1, 100),
                'medida' => $faker->randomElement(['pzas', 'ml', 'lt', 'gr', 'cm']),
                'id_proveedor' => $proveedores->random()->id,
                'main_photo' => $faker->imageUrl(640, 480, 'products', true), // Foto de producto ficticia
                'stock' => $faker->numberBetween(0, 200),
                'estado' => $faker->randomElement(['activo', 'inactivo', 'agotado']),
                'fecha_agregado' => $faker->date(),
                'id_categoria' => $categorias->random()->id,
            ]);
        }
    }
}
