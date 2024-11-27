<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compras as Compra;
use App\Models\DetalleCompra;
use App\Models\Proveedores; // Usar el modelo en plural
use App\Models\Productos as Producto;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ComprasSeeder extends Seeder
{
    public function run()
    {
        // Crear instancia de Faker
        $faker = Faker::create();

        // Obtener los ids de los proveedores existentes
        $proveedores_ids = Proveedores::pluck('id')->toArray();

        // Verificar si hay suficientes proveedores
        if (count($proveedores_ids) < 2) {
            $this->command->info('No hay suficientes proveedores en la base de datos.');
            return;
        }

        // Obtener los ids de los productos existentes
        $productos_ids = Producto::pluck('id')->toArray();

        // Verificar si hay suficientes productos
        if (count($productos_ids) < 4) {
            $this->command->info('No hay suficientes productos en la base de datos.');
            return;
        }

        // Generar un número de compras aleatorias (puedes cambiar el valor aquí)
        $num_compras = 10;  // Cambia este valor por el número de compras que quieras generar

        for ($i = 0; $i < $num_compras; $i++) {
            // Seleccionar un proveedor aleatorio
            $proveedor_id = $faker->randomElement($proveedores_ids); // Seleccionar un proveedor aleatorio

            // Crear la compra
            $compra = Compra::create([
                'id_proveedor' => $proveedor_id,
                'fecha_compra' => $faker->dateTimeBetween('-2 weeks', 'now'),
                'fecha_entrega' => $faker->dateTimeBetween('now', '+2 weeks'),
                'estado' => $faker->randomElement(['entregado', 'pendiente de detalle', 'cancelado', 'pendiente de entrega']),
                'motivo' => $faker->sentence,
                'total' => $faker->randomFloat(2, 50, 2000),  // Total aleatorio entre 50 y 2000
            ]);

            // Filtrar productos que pertenecen al mismo proveedor que la compra
            $productos_proveedor = Producto::where('id_proveedor', $proveedor_id)->pluck('id')->toArray();

            // Generar entre 1 y 5 productos aleatorios para esta compra de los productos del proveedor específico
            $num_detalles = rand(1, 5);
            for ($j = 0; $j < $num_detalles; $j++) {
                // Seleccionar un producto aleatorio del proveedor
                $producto_id = $faker->randomElement($productos_proveedor);

                // Crear detalle de la compra
                DetalleCompra::create([
                    'id_compra' => $compra->id,
                    'id_producto' => $producto_id,
                    'cantidad' => rand(1, 100),  // Cantidad aleatoria entre 1 y 100
                ]);
            }
        }

        // Información adicional si se agrega más
        $this->command->info('Compras y detalles creados aleatoriamente.');
    }
}
