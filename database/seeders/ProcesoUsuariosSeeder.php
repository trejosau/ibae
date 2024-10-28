<?php

namespace Database\Seeders;

use App\Models\Persona;
use App\Models\User;
use App\Models\Administrador;
use App\Models\Estilista;
use App\Models\Estudiante;
use App\Models\Profesor;
use App\Models\Comprador;
use App\Models\Inscripcion; // Asegúrate de que esta importación sea correcta
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

        // Crear 10 usuarios
        for ($i = 1; $i <= 10; $i++) {
            $usuario = User::create([
                'username' => "usuario$i",
                'email' => "usuario$i@example.com",
                'password' => bcrypt('password'), // Cambia esto por una contraseña encriptada
                'email_verified_at' => now(), // Asignar fecha de verificación
                'estado' => 'activo', // Estado activo por defecto
                'profile_photo_url' => "https://example.com/profile_photos/user$i.jpg", // URL de foto de perfil
                'created_at' => now(), // Fecha de creación
                'updated_at' => now(), // Fecha de actualización
            ]);

            // Crear una Persona para cada usuario
            $persona = Persona::create([
                'nombre' => "Nombre " . $usuario->username,
                'ap_paterno' => "Paterno " . $usuario->username,
                'ap_materno' => "Materno " . $usuario->username,
                'telefono' => "555-010$i", // Teléfonos ficticios
                'usuario' => $usuario->id, // Asignar el ID del usuario
                'created_at' => now(), // Fecha de creación
                'updated_at' => now(), // Fecha de actualización
            ]);

            // Crear registro en la tabla compradores
            Comprador::create([
                'id_persona' => $persona->id,
                'preferencia' => $i % 2 === 0 ? 'barber' : 'belleza', // Alternar preferencias
                'razon_social' => "Razón Social " . $usuario->username,
            ]);

            // Asignar roles a los usuarios
            if ($i === 1 || $i === 2) {
                // Primeros 2 usuarios como Administradores
                $usuario->assignRole('admin');

                // Crear registros de Administradores
                Administrador::create([
                    'id_persona' => $persona->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } elseif ($i === 3 || $i === 4) {
                // Usuarios 3 y 4 como Profesores
                $usuario->assignRole('profesor');

                // Crear registros de Profesores
                Profesor::create([
                    'especialidad' => $i === 3 ? 'estilismo' : 'maquillaje', // Especialidad alternada
                    'fecha_contratacion' => now(),
                    'RFC' => 'RFC' . $i,
                    'CURP' => 'CURP' . $i,
                    'estado' => 'activo',
                    'id_persona' => $persona->id,
                    'zipcode' => '270' . random_int(1,8) . $i + 1,
                    'colonia' => 'Colonia ' . $i,
                    'calle' => 'Calle ' . $i,
                    'n_ext' => random_int(128,900),
                    'n_int' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } elseif ($i === 5 || $i === 6) {
                // Usuarios 5 y 6 como Estilistas
                $usuario->assignRole('estilista');

                // Crear registros de Estilistas
                Estilista::create([
                    'estado' => 'activo',
                    'id_persona' => $persona->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Resto como Estudiantes
                $usuario->assignRole('estudiante');

                // Crear registros de Estudiantes en diferentes meses
                for ($month = 1; $month <= 12; $month++) {
                    Estudiante::create([
                        'id_persona' => $persona->id,
                        'id_inscripcion' => $inscripcionIds[array_rand($inscripcionIds)], // Elige aleatoriamente un ID de inscripción
                        'fecha_inscripcion' => now()->setDate(now()->year, $month, 1), // Establece la fecha de inscripción
                        'grado_estudio' => 'Preparatoria ' . ($i - 6),
                        'zipcode' => '270' . random_int(1, 8) . $i,
                        'colonia' => 'Colonia ' . $i,
                        'calle' => 'Calle ' . $i,
                        'num_ext' => random_int(120, 600),
                        'num_int' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Asignar rol de Comprador a todos
            $usuario->assignRole('cliente'); // Asegúrate de que "cliente" sea el nombre correcto del rol
        }
    }
}
