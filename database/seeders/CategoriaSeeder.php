<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Categorias;
use App\Models\Subcategoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Barbería',
            'Tintes',
            'Cabello',
            'Maquillaje',
            'Accesorios',
            'Uñas',
            'Herramientas',
        ];

        foreach ($categorias as $nombreCategoria) {
            Categorias::create(['nombre' => $nombreCategoria]);
        }

        $subcategorias = [
            'Barbería' => ['Máquinas', 'Cremas', 'Afeitación'],
            'Tintes' => ['Tintes Naturales', 'Tintes Temporales'],
            'Cabello' => ['Shampoo', 'Acondicionador', 'Tratamientos'],
            'Maquillaje' => ['Base', 'Sombras', 'Labiales'],
            'Accesorios' => ['Cepillos', 'Peines', 'Gomas'],
            'Uñas' => ['Esmaltes', 'Herramientas', 'Decoraciones'],
            'Herramientas' => ['Tijeras', 'Cortadoras', 'Secadores'],
        ];

        foreach ($subcategorias as $categoriaNombre => $subcategoriaNombres) {
            $categoria = Categorias::where('nombre', $categoriaNombre)->first();

            foreach ($subcategoriaNombres as $nombreSubcategoria) {
                Subcategoria::create([
                    'nombre' => $nombreSubcategoria,
                    'categoria_id' => $categoria->id,
                ]);
            }
        }
    }
}
