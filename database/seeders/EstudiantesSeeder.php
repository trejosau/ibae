<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstudiantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estudiantes')->insert([
            [
                'id' => 18,  // Id del estudiante
                'matricula' => '240118',  // Formato de matrícula (últimos dos dígitos del año + mes)
                'estado' => 'activo',
                'id_persona' => 18,  // Relación con la persona con id 18
                'id_inscripcion' => 1,  // Id de inscripción (debes tener inscripciones ya creadas)
                'fecha_inscripcion' => Carbon::now(),
                'grado_estudio' => 'Tercer cuatrimestre de Desarrollo de Software',
                'zipcode' => '22000',
                'ciudad' => 'Tijuana',
                'colonia' => 'Zona Río',
                'calle' => 'Avenida Revolución',
                'num_ext' => '1234',
                'num_int' => '56',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,  // Id del estudiante
                'matricula' => '240219',  // Formato de matrícula
                'estado' => 'activo',
                'id_persona' => 19,  // Relación con la persona con id 19
                'id_inscripcion' => 2,  // Id de inscripción
                'fecha_inscripcion' => Carbon::now(),
                'grado_estudio' => 'Segundo cuatrimestre de Diseño Gráfico',
                'zipcode' => '22010',
                'ciudad' => 'Tijuana',
                'colonia' => 'Chapultepec',
                'calle' => 'Callejón del Carmen',
                'num_ext' => '567',
                'num_int' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,  // Id del estudiante
                'matricula' => '240320',  // Formato de matrícula
                'estado' => 'activo',
                'id_persona' => 20,  // Relación con la persona con id 20
                'id_inscripcion' => 3,  // Id de inscripción
                'fecha_inscripcion' => Carbon::now(),
                'grado_estudio' => 'Primer cuatrimestre de Estilismo Profesional',
                'zipcode' => '22020',
                'ciudad' => 'Tijuana',
                'colonia' => 'Playas de Tijuana',
                'calle' => 'Avenida Playas',
                'num_ext' => '4321',
                'num_int' => '78',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
