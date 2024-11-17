<?php

namespace Database\Seeders;

use App\Models\Proveedores;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresSeeder extends Seeder
{
    public function run()
    {
        // Datos de ejemplo para proveedores con los nombres de empresa y números de teléfono actualizados
        $proveedores = [
            [
                'nombre_persona' => 'Juan Pérez',
                'nombre_empresa' => 'Mc Avina',
                'contacto_telefono' => '+5215551234567',
                'contacto_correo' => 'contacto@mavina.com',
            ],
            [
                'nombre_persona' => 'Carlos González',
                'nombre_empresa' => 'Oister',
                'contacto_telefono' => '+5215559876543',
                'contacto_correo' => 'ventas@oister.com',
            ],
            [
                'nombre_persona' => 'Ana López',
                'nombre_empresa' => 'Lendan',
                'contacto_telefono' => '+5215533334444',
                'contacto_correo' => 'info@lendan.com',
            ],
            [
                'nombre_persona' => 'Luis Hernández',
                'nombre_empresa' => 'Salerm',
                'contacto_telefono' => '+5215555556666',
                'contacto_correo' => 'soporte@salerm.com',
            ],
            [
                'nombre_persona' => 'Marta Rodríguez',
                'nombre_empresa' => 'Tresa',
                'contacto_telefono' => '+52155522228888',
                'contacto_correo' => 'contacto@tresa.com',
            ],
            [
                'nombre_persona' => 'Ricardo Morales',
                'nombre_empresa' => 'Iridium',
                'contacto_telefono' => '+52155544447777',
                'contacto_correo' => 'atencion@iridium.com',
            ],
        ];

        // Insertar los datos de los proveedores en la tabla 'proveedores'
        Proveedores::insert($proveedores);
    }
}
