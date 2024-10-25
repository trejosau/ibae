<?php

namespace Database\Seeders;

use App\Models\Compras;
use App\Models\DetalleCompra;
use App\Models\Productos;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DetalleCompraSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $compras = Compras::all(); // Obtener todas las compras
        $productos = Productos::all(); // Obtener todos los productos

        foreach ($compras as $compra) {
            // Simular varios detalles por compra
            for ($i = 1; $i <= random_int(1, 3); $i++) {
                DetalleCompra::create([
                    'id_compra' => $compra->id,
                    'id_producto' => $productos->random()->id, // Asignar un producto aleatorio
                    'cantidad' => random_int(1, 10), // Cantidad entre 1 y 10
                ]);
            }
        }
    }
}
