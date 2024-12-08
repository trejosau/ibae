<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Seeder;
use App\Models\Subcategoria;

class CategoriaSubcategoriaSeeder extends Seeder
{
    public function run()
    {
        // Crear las categorías
        $categorias = [
            [
                'nombre' => 'Cuidado Capilar',
                'subcategorias' => [
                    'Champús y Acondicionadores',
                    'Tratamientos Capilares',
                    'Aceites y Sérums',
                ]
            ],
            [
                'nombre' => 'Cuidado Facial',
                'subcategorias' => [
                    'Limpiadores',
                    'Hidratantes y Cremas',
                    'Exfoliantes y Mascarillas',
                ]
            ],
            [
                'nombre' => 'Cuidado Corporal',
                'subcategorias' => [
                    'Hidratación Corporal',
                    'Scrubs y Exfoliantes',
                    'Protectores Solares',
                ]
            ],
            [
                'nombre' => 'Uñas',
                'subcategorias' => [
                    'Esmaltes',
                    'Herramientas',
                    'Tratamientos',
                ]
            ],
            [
                'nombre' => 'Barberia',
                'subcategorias' => [
                    'Afeitado y Cejas',
                    'Aceites y Bálsamos para Barba',
                    'Cortadoras y Maquinillas',
                ]
            ],
            [
                'nombre' => 'Maquillaje',
                'subcategorias' => [
                    'Bases y Correctores',
                    'Sombras y Rubores',
                    'Labiales y Brillos',
                ]
            ],
            [
                'nombre' => 'Herramientas y equipos',
                'subcategorias' => [
                    'Secadores y Plancha',
                    'Cortadoras y Tijeras',
                    'Cepillos y Peines Profesionales',
                ]
            ],
            [
                'nombre' => 'Kits',
                'subcategorias' => [
                    'Manicura y Pedicura',
                    'Maquillaje',
                    'Cuidado Capilar',
                ]
            ],
            [
                'nombre' => 'Accesorios',
                'subcategorias' => [
                    'Pinzas y Brochas',
                    'Decoración de uñas',
                ]
            ],
            [
                'nombre' => 'Productos',
                'subcategorias' => [
                    'Champús',
                    'Cremas y Sprays',
                    'Mascarillas',
                ]
            ],
            [
                'nombre' => 'Tintes y Coloracion',
                'subcategorias' => [
                    'Tintes',
                    'Decoloración',
                    'Material y Accesorios',
                ]
            ],
        ];

        // Insertar las categorías y subcategorías
        foreach ($categorias as $categoria) {
            // Crear la categoría
            $cat = Categorias::create([
                'nombre' => $categoria['nombre'],
            ]);

            // Crear las subcategorías asociadas a la categoría
            foreach ($categoria['subcategorias'] as $subcategoria) {
                Subcategoria::create([
                    'nombre' => $subcategoria,
                    'categoria_id' => $cat->id,
                ]);
            }
        }
    }
}
