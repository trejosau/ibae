<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Seeder;
use App\Models\Ventas;

use App\Models\Proveedores;
use Illuminate\Support\Facades\DB;

class VentasSeeder extends Seeder
{
    public function run()
    {
        // Obtenemos todos los IDs de Admin y Proveedor
        $adminIds = Administrador::pluck('id')->toArray();
        $compradorIds = Proveedores::pluck('id')->toArray();

        // Creamos registros aleatorios para Ventas
        for ($i = 0; $i < 10; $i++) {
            Ventas::create([
                'id_comprador' => $compradorIds[array_rand($compradorIds)],
                'fecha_compra' => now()->subDays(rand(1, 365)),
                'total' => rand(100, 5000) / 1.15, // Valor aleatorio entre 100 y 5000
                'id_admin' => $adminIds[array_rand($adminIds)],
                'es_estudiante' => ['si', 'no'][array_rand(['si', 'no'])], // Aleatorio entre 'si' y 'no'
            ]);
        }
    }
}
