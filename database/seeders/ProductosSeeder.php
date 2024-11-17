<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Cargar el archivo JSON
        $json = File::get(database_path('seeders/data/todosLosProductos.json'));
        $productos = json_decode($json, true);

        // Insertar los datos en la base de datos
        foreach ($productos as $producto) {
            DB::table('productos')->insert([
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'precio_proveedor' => $producto['precio_proveedor'],
                'precio_lista' => $producto['precio_lista'],
                'precio_venta' => $producto['precio_venta'],
                'cantidad' => $producto['cantidad'],
                'medida' => $producto['medida'],
                'id_proveedor' => $producto['id_proveedor'],
                'main_photo' => $producto['main_photo'],
                'stock' => $producto['stock'],
                'estado' => $producto['estado'],
                'fecha_agregado' => $producto['fecha_agregado'],
                'id_categoria' => $producto['id_categoria'],
                'created_at' => Carbon::parse($producto['created_at'])->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($producto['updated_at'])->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
