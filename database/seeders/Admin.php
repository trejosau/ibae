<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Comprador;
use App\Models\Estilista;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\Persona;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('1234'),
            'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $persona = Persona::create([
            'nombre' => 'Admin',
            'ap_paterno' => 'Admin',
            'ap_materno' => 'Admin',
            'telefono' => '+528712345678',
            'usuario' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $comprador = Comprador::create([
            'id_persona' => $persona->id,
            'razon_social' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $estudiante = Estudiante::create([
            'id_persona' => $persona->id,
            'id_inscripcion' => 1,
            'fecha_inscripcion' => now(),
            'grado_estudio' => 'cursando universidad',
            'zipcode' => '270' . random_int(1, 8),
            'ciudad' => 'Torreon',
            'colonia' => 'UTT',
            'calle' => 'Utt',
            'num_ext' => 'Ext. ' . random_int(123, 600),
            'num_int' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $estilista = Estilista::create([
            'id_persona' => $persona->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $profesor = Profesor::create([
            'id_persona' => $persona->id,
            'especialidad' => 'barberia',
            'fecha_contratacion' => now(),
            'RFC' => '123456789',
            'CURP' => '123456789',
            'zipcode' => '270' . random_int(1, 8),
            'ciudad' => 'Torreon',
            'colonia' => 'UTT',
            'calle' => 'Utt',
            'n_ext' => 'Ext. ' . random_int(123, 600),
            'n_int' => null,
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        $administrador = Administrador::create([
            'id_persona' => $persona->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $user->assignRole('cliente');
        $user->assignRole('estudiante');
        $user->assignRole('profesor');
        $user->assignRole('estilista');
        $user->assignRole('admin');
    }
}


