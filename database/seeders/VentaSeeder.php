<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\DetalleVenta;
use App\Models\Estudiante;
use App\Models\Productos;
use App\Models\Ventas;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener algunos administradores y estudiantes existentes
        $admins = Administrador::pluck('id');
        $estudiantes = Estudiante::pluck('matricula');

        for ($i = 0; $i < 10; $i++) {
            // Obtener un comprador aleatorio (estudiante)
            $estudianteId = $estudiantes->random();

            // Asignar aleatoriamente 'si' o 'no' a es_estudiante
            $esEstudiante = (rand(0, 1) == 0) ? 'si' : 'no';

            $matricula = Estudiante::find($estudianteId)->matricula;

            // Obtener un administrador aleatorio
            $adminId = $admins->random();

            // Crear la venta
            $venta = Ventas::create([
                'nombre_comprador' => 'Comprador ' . $i,
                'fecha_compra' => Carbon::now(),
                'total' => rand(1000, 5000) / 100, // Total aleatorio para la venta
                'id_admin' => $adminId,
                'es_estudiante' => $esEstudiante,
                'matricula' => $matricula,
            ]);

            // Obtener productos aleatorios de la tabla Productos
            $productos = Productos::inRandomOrder()->take(rand(1, 5))->get();

            // Crear los detalles de venta
            foreach ($productos as $producto) {
                // Lógica de precio y descuento dependiendo si es estudiante o no
                if ($esEstudiante == 'si') {
                    $precioAplicado = $producto->precio_lista;  // El precio aplicado es el precio lista
                    $descuento = $producto->precio_venta - $producto->precio_lista;  // Descuento es la diferencia
                } else {
                    $precioAplicado = $producto->precio_venta;  // Si no es estudiante, se aplica el precio de venta
                    $descuento = 0;  // No hay descuento
                }

                // Crear el detalle de venta con el precio aplicado y descuento
                DetalleVenta::create([
                    'id_venta' => $venta->id,
                    'id_producto' => $producto->id,
                    'cantidad' => rand(1, 3), // Cantidad aleatoria de productos
                    'precio_aplicado' => $precioAplicado, // Precio del producto (según si es estudiante o no)
                    'descuento' => $descuento, // Descuento basado en si es estudiante o no
                ]);
            }
        }
    }
}
