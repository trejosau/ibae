<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Persona;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Hash;

class EstudianteSeeder extends Seeder
{
    public function run()
    {
        // Arrays de datos posibles
        $nombres = [
            'Carlos', 'María', 'Luis', 'Ana', 'Roberto', 'José', 'Sofía', 'Juan', 'Luis Ángel', 'Karla',
            'Pedro', 'Isabela', 'Miguel', 'Gabriela', 'Jorge', 'Patricia', 'David', 'Laura', 'Francisco',
            'Fernanda', 'Diego', 'Carmen', 'Raúl', 'Verónica', 'Eduardo', 'Mónica', 'Ricardo', 'Elena',
            'Andrés', 'Leticia', 'Ricardo', 'Mariana', 'Oscar', 'Alejandra', 'Raquel', 'Iván', 'Berenice',
            'Victor', 'Susana', 'Armando', 'Claudia', 'Manuel', 'César', 'Lupita', 'Tomás', 'Lilia',
            'Tania', 'Héctor', 'Paola', 'Ernesto', 'Diana', 'Felipe', 'Jessica', 'César', 'Martín'
        ];

        $ap_paternos = [
            'Ramírez', 'Hernández', 'Pérez', 'López', 'Gómez', 'Martínez', 'Vázquez', 'Gutiérrez', 'Mendoza',
            'González', 'Sánchez', 'Rodríguez', 'Torres', 'Flores', 'Díaz', 'Cáceres', 'Ortiz', 'Álvarez',
            'Morales', 'Jiménez', 'Ruiz', 'Castro', 'Ríos', 'Benítez', 'Cordero', 'Salazar', 'Ramírez', 'Cruz'
        ];

        $ap_maternos = [
            'Vázquez', 'Gutiérrez', 'Mendoza', 'González', 'Sánchez', 'Castillo', 'Vega', 'Ávila', 'Moreno',
            'Martínez', 'Luna', 'Ríos', 'Pérez', 'Jiménez', 'Torres', 'Flores', 'Castañeda', 'Alvarado', 'Molina',
            'Domínguez', 'Suárez', 'Rosales', 'González', 'Navarro', 'Estrada', 'Márquez', 'Silva', 'Ramírez'
        ];

        $grados = [
            'Secundaria terminada',
            'Secundaria en curso',
            'Preparatoria terminada',
            'Preparatoria en curso',
            'Universidad terminada',
            'Universidad en curso',
            'Licenciatura terminada',
            'Licenciatura en curso',
            'Maestría terminada',
            'Maestría en curso',
            'Doctorado terminado',
            'Doctorado en curso'
        ];

        $ciudades = ['Torreón', 'Matamoros'];
        $colonias = [
            'Centro', 'San Antonio', 'Los Angeles', 'El Faro', 'Santa Fe',
            'La Joya', 'La Esperanza', 'El Nazareno', 'Torreón 2000',
            'Nueva California', 'San Isidro', 'Los Pinos', 'El Campestre',
            'Hacienda del Sol', 'Los Nogales', 'Las Flores', 'El Mirador',
            'Fovissste', 'Héroe de Nacozari', 'San Felipe', 'Valle Oriente',
            'La Perla', 'San José', 'Los Álamos', 'Unidad Morelos', 'Las Torres',
            'La Loma', 'El Refugio', 'Villas de las Fuentes', 'Rincón del Bosque'
        ];

        $calles = [
            'Calle Juárez', 'Avenida Independencia', 'Calle Del Sol', 'Calle Libertad', 'Calle Morelos',
            'Avenida Revolución', 'Calle Hidalgo', 'Avenida 16 de Septiembre', 'Calle Zaragoza',
            'Calle 5 de Febrero', 'Avenida Ocampo', 'Calle Madero', 'Avenida Juárez', 'Calle Venustiano Carranza',
            'Calle Reforma', 'Avenida Constitución', 'Calle Las Palmas', 'Avenida Francisco I. Madero',
            'Calle Abasolo', 'Avenida del Parque', 'Calle Progreso', 'Calle Monterrey', 'Calle Durango',
            'Avenida Las Torres', 'Calle Guerrero', 'Calle Lázaro Cárdenas', 'Avenida Matamoros',
            'Calle del Valle', 'Avenida México', 'Calle 16 de Septiembre', 'Calle Coahuila'
        ];

        // Generar teléfono aleatorio con prefijo +52871
        $telefono = '+52871' . rand(1000000, 9999999);

        // Generar código postal aleatorio con prefijo 27
        $zipcode = '27' . rand(100, 999);

        // Crear 20 registros de ejemplo
        for ($i = 0; $i < 20; $i++) {
            // Selección aleatoria de valores
            $nombre = $nombres[array_rand($nombres)];
            $ap_paterno = $ap_paternos[array_rand($ap_paternos)];
            $ap_materno = $ap_maternos[array_rand($ap_maternos)];
            $grado_estudio = $grados[array_rand($grados)];
            $ciudad = $ciudades[array_rand($ciudades)];
            $colonia = $colonias[array_rand($colonias)];
            $calle = $calles[array_rand($calles)];
            $num_ext = rand(100, 999);
            $num_int = rand(1, 5);
            $username = strtolower($nombre) . rand(10, 99);

            // Generar teléfono aleatorio
            $telefono = '+52871' . rand(1000000, 9999999);

            // Crear persona


            // Crear usuario (User)
            $user = User::create([
                'username' => $username,
                'email' => "{$username}@example.com",
                'password' => Hash::make('1234'),
                'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
                'estado' => 'activo',
                'provider' => 'manual',
            ]);
            $persona = Persona::create([
                'nombre' => $nombre,
                'ap_paterno' => $ap_paterno,
                'ap_materno' => $ap_materno,
                'telefono' => $telefono,
                'usuario' =>$user->id,
            ]);

            // Asignar el rol 'estudiante'
            $user->assignRole('estudiante');

            // Crear estudiante
            Estudiante::create([
                'id_persona' => $persona->id,
                'id_inscripcion' => rand(1, 5),
                'fecha_inscripcion' => now(),
                'grado_estudio' => $grado_estudio,
                'zipcode' => $zipcode,
                'ciudad' => $ciudad,
                'colonia' => $colonia,
                'calle' => $calle,
                'num_ext' => $num_ext,
                'num_int' => $num_int,
            ]);
        }
    }

}
