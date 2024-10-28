<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Entregas;
use App\Models\DetallePedido;
use App\Models\Comprador;
use App\Models\Pedidos;
use App\Models\Productos;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PedidoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $compradores = Comprador::all();
        $productos = Productos::all();
        $admins = Administrador::all();

        if ($compradores->isEmpty() || $productos->isEmpty() || $admins->isEmpty()) {
            return; // Verifica que existan datos básicos en compradores, productos y admins
        }

        foreach ($compradores as $comprador) {
            // Crear un pedido para cada comprador
            $pedido = Pedidos::create([
                'total' => 0, // Inicialmente en 0; luego se actualizará con el total de los detalles
                'fecha_pedido' => $faker->date(),
                'estado' => $faker->randomElement(['entregado', 'listo para entrega', 'preparando para entrega']),
                'clave_entrega' => $faker->bothify('##??##??'),
                'id_comprador' => $comprador->id,
                'es_estudiante' => $faker->boolean ? 1 : 0, // 1 = Si, 0 = No
            ]);

            // Crear detalles para el pedido
            $numProductos = rand(1, 5);
            $detalleTotal = 0;

            for ($i = 0; $i < $numProductos; $i++) {
                $producto = $productos->random();
                $cantidad = rand(1, 3);

                // Determinar el precio aplicado según si es estudiante
                if ($pedido->es_estudiante) {
                    $precioAplicado = $producto->precio_lista; // Para estudiantes
                } else {
                    $precioAplicado = $producto->precio_venta; // Para no estudiantes
                }

                $descuento = $faker->randomFloat(2, 0, 10);

                $detallePedido = DetallePedido::create([
                    'id_pedido' => $pedido->id,
                    'id_producto' => $producto->id,
                    'cantidad' => $cantidad,
                    'precio_aplicado' => $precioAplicado,
                    'descuento' => $descuento,
                ]);

                $detalleTotal += ($precioAplicado * $cantidad) - $descuento;
            }

            // Actualizar el total del pedido
            $pedido->update(['total' => $detalleTotal]);

            // Crear entrega para el pedido (solo si el pedido está "listo para entrega" o "entregado")
            if (in_array($pedido->estado, ['listo para entrega', 'entregado'])) {
                Entregas::create([
                    'id_pedido' => $pedido->id,
                    'id_admin' => $admins->random()->id,
                    'fecha_hora_entregado' => $pedido->estado === 'entregado' ? $faker->dateTime : null,
                    'fecha_hora_listo_entregar' => $pedido->estado !== 'preparando para entrega' ? $faker->dateTime : null,
                    'estado' => $pedido->estado === 'entregado' ? 'entregado' : 'listo entregar',
                    'nombre_recolector' => $faker->name,
                ]);
            }
        }
    }
}
