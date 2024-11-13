<?php

namespace Database\Seeders;

use App\Models\Administrador;
use App\Models\Persona;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Profesor;
use App\Models\Estilista;
use App\Models\Comprador;
use App\Models\Inscripcion;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ProcesoUsuariosSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'cliente']);
        Role::create(['name' => 'estudiante']);
        Role::create(['name' => 'profesor']);
        Role::create(['name' => 'estilista']);
        Role::create(['name' => 'admin']);

        // IDs de inscripciones de ejemplo (ajusta según tus datos)
        $inscripcionIds = Inscripcion::pluck('id')->toArray(); // Obtiene todos los IDs de inscripciones

        // Crear un array para las matrículas de los estudiantes
        $matriculas = range(1, 10);  // Asumiendo que hay 10 estudiantes para asignar matrícula

        // Crear 10 usuarios
        for ($i = 1; $i <= 10; $i++) {
            // Crear un usuario
            $usuario = User::create([
                'username' => "usuario$i",
                'email' => "usuario$i@example.com",
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'estado' => 'activo',
                'profile_photo_url' => "https://example.com/profile_photos/user$i.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Crear una Persona única para cada usuario
            $persona = Persona::create([
                'nombre' => "Nombre " . $usuario->username,
                'ap_paterno' => "Paterno " . $usuario->username,
                'ap_materno' => "Materno " . $usuario->username,
                'telefono' => "555-010$i",
                'usuario' => $usuario->id, // Asignar el ID del usuario
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Crear un registro en la tabla de Compradores (todos son clientes)
            Comprador::create([
                'id_persona' => $persona->id,
                'razon_social' => "Razón Social " . $usuario->username,
            ]);

            // Asignar el rol 'cliente' a todos los usuarios
            $usuario->assignRole('cliente');

            // Evitar duplicar personas en las tablas de roles

            if ($i === 1 || $i === 2) {
                // Primeros 2 usuarios como Administradores
                $usuario->assignRole('admin');
                // Evitar duplicación al crear Administrador
                if (!Administrador::where('id_persona', $persona->id)->exists()) {
                    Administrador::create([
                        'id_persona' => $persona->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if ($i === 3 || $i === 4) {
                // Usuarios 3 y 4 como Profesores
                $usuario->assignRole('profesor');
                // Evitar duplicación al crear Profesor
                if (!Profesor::where('id_persona', $persona->id)->exists()) {
                    Profesor::create([
                        'especialidad' => $i === 3 ? 'estilismo' : 'maquillaje',
                        'fecha_contratacion' => now(),
                        'RFC' => 'RFC' . $i,
                        'CURP' => 'CURP' . $i,
                        'estado' => 'activo',
                        'id_persona' => $persona->id,
                        'zipcode' => '270' . random_int(1, 8) . $i + 1,
                        'colonia' => 'Colonia ' . $i,
                        'ciudad' => 'Ciudad ' . $i,
                        'calle' => 'Calle ' . $i,
                        'n_ext' => random_int(128, 900),
                        'n_int' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if ($i === 5 || $i === 6) {
                // Usuarios 5 y 6 como Estilistas
                $usuario->assignRole('estilista');
                // Evitar duplicación al crear Estilista
                if (!Estilista::where('id_persona', $persona->id)->exists()) {
                    Estilista::create([
                        'estado' => 'activo',
                        'id_persona' => $persona->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            if ($i >= 7) {
                // El resto como Estudiantes (sin importar si ya tienen otro rol)
                $usuario->assignRole('estudiante');
                // Evitar duplicación al crear Estudiante
                if (!Estudiante::where('id_persona', $persona->id)->exists()) {
                    $matricula = array_shift($matriculas);  // Asignar una matrícula única

                    $estudiante = Estudiante::create([
                        'id_persona' => $persona->id,
                        'id_inscripcion' => $inscripcionIds[array_rand($inscripcionIds)], // Elige aleatoriamente un ID de inscripción
                        'fecha_inscripcion' => now(),
                        'grado_estudio' => 'Preparatoria ' . ($i - 6),
                        'matricula' => $matricula,  // Asignar la matrícula única
                        'zipcode' => '270' . random_int(1, 8) . $i,
                        'ciudad' => 'Ciudad ' . $i,
                        'colonia' => 'Colonia ' . $i,
                        'calle' => 'Calle ' . $i,
                        'num_ext' => random_int(120, 600),
                        'num_int' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $prefix = date('y') . date('m');
                    $matricula_username = $prefix . $usuario->id;

                    $estudiante->matricula = $matricula_username;
                }
            }
        }
    }
}
