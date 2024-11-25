<?php

namespace Database\Seeders;

use App\Models\Comprador;
use App\Models\Estilista;
use App\Models\Estudiante;
use App\Models\Persona;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    
    {
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

        $usernames = [
            'juanito', 'jesus', 'abraham', 'jose', 'carlos', 'pedro', 'luis', 'miguel', 'daniel',
            'juan', 'alberto', 'ricardo', 'manuel', 'oscar', 'daniela', 'carmen', 'maria', 'ana',
            'luis', 'miguel', 'daniel', 'juan', 'alberto', 'ricardo', 'manuel', 'oscar', 'daniela',

        ];

        $especialidades = ['estilismo', 'barbería', 'maquillaje', 'uñas'];

        $salonesYBarberias = [
            'Elegance Salon & Spa',
            'Barbería Clásica',
            'Glamour Beauty Lounge',
            'La Barbería Vintage',
            'Studio Belleza Total',
            'El Rincón del Estilo',
            'Urban Look Barber Shop',
            'Luxe Beauty Studio',
            'Corte Fino Barbería',
            'Espejo Mágico Salón',
            'Hair & Care Studio',
            'Barbería King Style',
            'Glow Up Beauty Center',
            'Barbería Moderna',
            'Chic & Shine Salón',
            'Hombres de Estilo Barbería',
            'Diva Beauty Spa',
            'Elite Barber Shop',
            'Tendencias Hair Studio',
            'La Esquina del Look',
        ];

        $cursos = [
            'Estilismo',
            'Barbería',
            'Maquillaje',
            'Uñas',
            'Coloración de Cabello'
        ];

        $descripciones = [
            'Curso básico para aprender las bases del estilismo.',
            'Curso avanzado enfocado en técnicas modernas de barbería.',
            'Aprende técnicas de aplicación y diseño de uñas.',
            'Curso de maquillaje para eventos sociales y profesionales.',
            'Curso especializado en técnicas avanzadas de coloración.'
        ];

        for ($i = 1; $i <= 5; $i++) {
            $inscripcion = DB::table('inscripciones')->insertGetId([
                'nombre' => $cursos[array_rand($cursos)],  // Selección aleatoria del nombre
                'precio' => rand(3000, 7000) + rand(0, 99) / 100,  // Precio aleatorio entre 3000 y 7000
                'descripcion' => $descripciones[array_rand($descripciones)],  // Descripción aleatoria
                'material_incluido' => rand(0, 1),  // Aleatorio entre 0 y 1 para material incluido
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $inscripciones[] = $inscripcion; // Almacenar el ID de la inscripción creada
        }

        $photo = 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg';
        
        $estudiantesMatriculas = []; // Array para almacenar matrículas

        for ($i = 1; $i <= 20; $i++) {
            $username = $usernames[array_rand($usernames)];
            $existeUsuario = DB::table('users')->where('username', $username)->count();
            if ($existeUsuario > 0) {
                $username = $username . rand(1, 9999);
            }
            $usuarioCreado = User::create([
                'username' => $username,
                'email' =>  $username . '@example.com',
                'password' => bcrypt('1234'),
                'profile_photo_url' => $photo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
            $nombre = $nombres[array_rand($nombres)];
            $ap_paterno = $ap_paternos[array_rand($ap_paternos)];
            $ap_materno = $ap_maternos[array_rand($ap_maternos)];
            $telefono = '+52871' . rand(1000000, 9999999);
            $zipcode = '27' . rand(100, 999);
            $personaCreada = Persona::create([
                'nombre' => $nombre,
                'ap_paterno' => $ap_paterno,
                'ap_materno' => $ap_materno,
                'telefono' => $telefono,
                'usuario' => $usuarioCreado->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
            $prefix = date('y') . date('m');
            $matricula = $prefix . $usuarioCreado->id; // Matricula única
            $gradoEstudio = $grados[array_rand($grados)];
        
            // Asignar inscripción aleatoria
            $inscripcionAleatoria = $inscripciones[array_rand($inscripciones)];
        
            $estudianteCreado = Estudiante::create([
                'matricula' => $matricula,
                'id_persona' => $personaCreada->id,
                'id_inscripcion' => $inscripcionAleatoria,
                'fecha_inscripcion' => now(),
                'grado_estudio' => $gradoEstudio,
                'zipcode' => $zipcode,
                'ciudad' => $ciudades[array_rand($ciudades)],
                'colonia' => $colonias[array_rand($colonias)],
                'calle' => $calles[array_rand($calles)],
                'num_ext' => rand(100, 999),
                'num_int' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
            // Agregar la matrícula al array global
            $estudiantesMatriculas[] = $estudianteCreado->matricula;
        }
        

        for ($i = 1; $i <= 20; $i++) {
            $username = $usernames[array_rand($usernames)];
            $existeUsuario = DB::table('users')->where('username', $username)->count();
            if ($existeUsuario > 0)
            {
                $username = $username . rand(1, 9999);
            }
            $usuarioCreado = User::create([
                'username' => $username,
                'email' =>  $username . '@example.com',
                'password' => bcrypt('1234'),
                'profile_photo_url' => $photo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $nombre = $nombres[array_rand($nombres)];
            $ap_paterno = $ap_paternos[array_rand($ap_paternos)];
            $ap_materno = $ap_maternos[array_rand($ap_maternos)];
            $telefono = '+52871' . rand(1000000, 9999999);
            $zipcode = '27' . rand(100, 999);
            $personaCreada = Persona::create([
                'nombre' => $nombre,
                'ap_paterno' => $ap_paterno,
                'ap_materno' => $ap_materno,
                'telefono' => $telefono,
                'usuario' => $usuarioCreado->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $randomSpecialidad = $especialidades[array_rand($especialidades)];

            Profesor::create([
                'especialidad' => $randomSpecialidad,
                'fecha_contratacion' => now(),
                'RFC' => rand(100, 999),
                'CURP' => strval(rand(100, 999)),
                'estado' => 'activo',
                'id_persona' => $personaCreada->id,
                'zipcode' => $zipcode,
                'ciudad' => $ciudades[array_rand($ciudades)],
                'colonia' => $colonias[array_rand($colonias)],
                'calle' => $calles[array_rand($calles)],
                'n_ext' => rand(100, 999),
                'n_int' => rand(1, 5),
                'created_at' => now(),
                'updated_at' => now(),

            ]);

        }

        for ($i = 1; $i <= 20; $i++) {
            $username = $usernames[array_rand($usernames)];
            $existeUsuario = DB::table('users')->where('username', $username)->count();
            if ($existeUsuario > 0)
            {
                $username = $username . rand(1, 9999);
            }
            $usuarioCreado = User::create([
                'username' => $username,
                'email' =>  $username . '@example.com',
                'password' => bcrypt('1234'),
                'profile_photo_url' => $photo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $nombre = $nombres[array_rand($nombres)];
            $ap_paterno = $ap_paternos[array_rand($ap_paternos)];
            $ap_materno = $ap_maternos[array_rand($ap_maternos)];
            $telefono = '+52871' . rand(1000000, 9999999);
            $zipcode = '27' . rand(100, 999);
            $personaCreada = Persona::create([
                'nombre' => $nombre,
                'ap_paterno' => $ap_paterno,
                'ap_materno' => $ap_materno,
                'telefono' => $telefono,
                'usuario' => $usuarioCreado->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Estilista::create([
                'estado' => 'activo',
                'id_persona' => $personaCreada->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 1; $i <= 20; $i++) {
            $username = $usernames[array_rand($usernames)];
            $existeUsuario = DB::table('users')->where('username', $username)->count();
            if ($existeUsuario > 0)
            {
                $username = $username . rand(1, 9999);
            }
            $usuarioCreado = User::create([
                'username' => $username,
                'email' =>  $username . '@example.com',
                'password' => bcrypt('1234'),
                'profile_photo_url' => $photo,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $nombre = $nombres[array_rand($nombres)];
            $ap_paterno = $ap_paternos[array_rand($ap_paternos)];
            $ap_materno = $ap_maternos[array_rand($ap_maternos)];
            $telefono = '+52871' . rand(1000000, 9999999);
            $zipcode = '27' . rand(100, 999);
            $personaCreada = Persona::create([
                'nombre' => $nombre,
                'ap_paterno' => $ap_paterno,
                'ap_materno' => $ap_materno,
                'telefono' => $telefono,
                'usuario' => $usuarioCreado->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Comprador::create([
                'id_persona' => $personaCreada->id,
                'razon_social' => $salonesYBarberias[array_rand($salonesYBarberias)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
