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
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Cuidado%20Capilar.webp',
                'subcategorias' => [
                    'Champús y Acondicionadores',
                    'Tratamientos Capilares',
                    'Aceites y Sérums',
                ]
            ],
            [
                'nombre' => 'Cuidado Facial',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Cuidado%20Facial.webp',
                'subcategorias' => [
                    'Limpiadores',
                    'Hidratantes y Cremas',
                    'Exfoliantes y Mascarillas',
                ]
            ],
            [
                'nombre' => 'Cuidado Corporal',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Cuidado%20Corporal.webp',
                'subcategorias' => [
                    'Hidratación Corporal',
                    'Scrubs y Exfoliantes',
                    'Protectores Solares',
                ]
            ],
            [
                'nombre' => 'Uñas',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/U%C3%B1as.webp',
                'subcategorias' => [
                    'Esmaltes',
                    'Herramientas',
                    'Tratamientos',
                ]
            ],
            [
                'nombre' => 'Barberia',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Barberia.webp',
                'subcategorias' => [
                    'Afeitado y Cejas',
                    'Aceites y Bálsamos para Barba',
                    'Cortadoras y Maquinillas',
                ]
            ],
            [
                'nombre' => 'Maquillaje',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Maquillaje.webp',
                'subcategorias' => [
                    'Bases y Correctores',
                    'Sombras y Rubores',
                    'Labiales y Brillos',
                ]
            ],
            [
                'nombre' => 'Herramientas y equipos',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Herramientas%20y%20equipos.webp',
                'subcategorias' => [
                    'Secadores y Plancha',
                    'Cortadoras y Tijeras',
                    'Cepillos y Peines Profesionales',
                ]
            ],
            [
                'nombre' => 'Kits',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Kits.webp',
                'subcategorias' => [
                    'Manicura y Pedicura',
                    'Maquillaje',
                    'Cuidado Capilar',
                ]
            ],
            [
                'nombre' => 'Accesorios',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Accesorios.webp',
                'subcategorias' => [
                    'Pinzas y Brochas',
                    'Decoración de uñas',
                ]
            ],
            [
                'nombre' => 'Productos',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Productos.webp',
                'subcategorias' => [
                    'Champús',
                    'Cremas y Sprays',
                    'Mascarillas',
                ]
            ],
            [
                'nombre' => 'Tintes y Coloracion',
                'photo' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/categorias/Tintes%20y%20Coloracion.webp',
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
                'photo' => $categoria['photo'],
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
