<?php

namespace Database\Seeders;


use App\Models\Compras;
use App\Models\Proveedores;
use App\Models\Productos;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ComprasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $proveedores = Proveedores::all(); // Obtener todos los proveedores
        $productos = Productos::all(); // Obtener todos los productos

        foreach ($proveedores as $proveedor) {
            // Simular varias compras por proveedor
            for ($i = 1; $i <= random_int(1, 5); $i++) {
                $fecha_compra = $faker->date();
                $fecha_entrega = $faker->date(); // Asegúrate de que sea posterior a la fecha de compra

                Compras::create([
                    'id_proveedor' => $proveedor->id,
                    'fecha_compra' => $fecha_compra,
                    'fecha_entrega' => $fecha_entrega,
                    'estado' => $faker->randomElement(['entregado', 'pendiente', 'cancelado']),
                    'motivo' => $faker->optional()->text(),
                    'total' => $faker->randomFloat(2, 100, 1000), // Total entre $100 y $1000
                ]);
            }
        }
    }
}
