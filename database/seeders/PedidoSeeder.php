<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Entregas;
use App\Models\DetallePedido;
use App\Models\Comprador;
use App\Models\Estudiante;
use App\Models\Pedidos;
use App\Models\Productos;
use Carbon\Carbon;
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
        $estudiantes = Estudiante::all();

        if ($compradores->isEmpty() || $productos->isEmpty() || $admins->isEmpty() || $estudiantes->isEmpty()) {
            return; // Verifica que existan datos básicos en compradores, productos, admins y estudiantes
        }

        // Iterar sobre cada mes del año 2024
        foreach (range(1, 12) as $month) {
            foreach ($compradores as $comprador) {
                // Determina si el pedido es para un estudiante
                $esEstudiante = $faker->boolean ? 1 : 0;
                $idEstudiante = $esEstudiante ? $estudiantes->random()->id : null;

                // Crear un pedido para cada comprador en el mes correspondiente
                $pedido = Pedidos::create([
                    'total' => 0, // Inicialmente en 0; luego se actualizará con el total de los detalles
                    'fecha_pedido' => Carbon::create(2024, $month, rand(1, 28)), // Fecha aleatoria en el mes actual
                    'estado' => $faker->randomElement(['entregado', 'listo para entrega', 'preparando para entrega']),
                    'clave_entrega' => $faker->bothify('##??##??'),
                    'id_comprador' => $comprador->id,
                    'id_estudiante' => $idEstudiante, // Asigna el id del estudiante o null
                    'es_estudiante' => $esEstudiante, // 1 = Si, 0 = No
                ]);

                // Crear detalles para el pedido
                $numProductos = rand(1, 5);
                $detalleTotal = 0;

                for ($i = 0; $i < $numProductos; $i++) {
                    $producto = $productos->random();
                    $cantidad = rand(1, 3);

                    // Determinar el precio aplicado según si es estudiante
                    $precioAplicado = $esEstudiante ? $producto->precio_lista : $producto->precio_venta;
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

}
