<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Tintes',
            'Cabello',
            'Barbería',
            'Maquillaje',
            'Accesorios',
            'Uñas',
            'Herramientas'
        ];

        foreach ($categorias as $categoria) {
            Categorias::create([
                'nombre' => $categoria,
                'descripcion' => "Descripción para la categoría $categoria",
            ]);
        }
    }
}
