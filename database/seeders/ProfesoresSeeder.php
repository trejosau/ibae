<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profesores')->insert([
            [
                'id' => 1,
                'especialidad' => 'estilismo',
                'fecha_contratacion' => '2022-01-15',
                'RFC' => 'ABC123456789',
                'CURP' => 'ABC123456789012345',
                'estado' => 'activo',
                'id_persona' => 15,  // Relacionado con la persona con id 1
                'zipcode' => '22000',
                'ciudad' => 'Tijuana',
                'colonia' => 'Zona Centro',
                'calle' => 'Av. Revolución',
                'n_ext' => '123',
                'n_int' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'especialidad' => 'barbería',
                'fecha_contratacion' => '2023-03-12',
                'RFC' => 'DEF987654321',
                'CURP' => 'DEF987654321987654',
                'estado' => 'vacaciones',
                'id_persona' => 16,  // Relacionado con la persona con id 2
                'zipcode' => '22100',
                'ciudad' => 'Tijuana',
                'colonia' => 'Playas de Tijuana',
                'calle' => 'Calle del Mar',
                'n_ext' => '456',
                'n_int' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'especialidad' => 'maquillaje',
                'fecha_contratacion' => '2021-11-23',
                'RFC' => 'GHI112233445',
                'CURP' => 'GHI112233445678901',
                'estado' => 'inactivo',
                'id_persona' => 17,  // Relacionado con la persona con id 3
                'zipcode' => '22200',
                'ciudad' => 'Tijuana',
                'colonia' => 'San Pedro',
                'calle' => 'Calle San Pedro',
                'n_ext' => '789',
                'n_int' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
