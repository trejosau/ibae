<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetalleVenta;
use App\Models\Ventas;
use App\Models\Productos;

class DetalleVentasSeeder extends Seeder
{
    public function run()
    {
        $ventaIds = Ventas::pluck('id')->toArray();
        $productoIds = Productos::pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            DetalleVenta::create([
                'id_venta' => $ventaIds[array_rand($ventaIds)],
                'id_producto' => $productoIds[array_rand($productoIds)],
                'precio_aplicado' => rand(100, 1000) / 1.1,
                'descuento' => rand(0, 100) / 10,
            ]);
        }
    }
}
