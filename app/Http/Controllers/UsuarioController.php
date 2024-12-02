<?php

namespace App\Http\Controllers;

use App\Mail\EnvioCredenciales;
use App\Models\Administrador;
use App\Models\Comprador;
use App\Models\Estilista;
use App\Models\Persona;
use App\Models\Profesor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
    function generarContrasenaAleatoria($longitud = 8) {
        // Caracteres permitidos en cada categoría
        $minusculas = 'abcdefghijklmnopqrstuvwxyz';
        $mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numeros = '0123456789';
        $simbolos = '!@#$()_+-={}:?';

        // Aseguramos que cada tipo de carácter esté presente al menos una vez
        $contrasena = $minusculas[random_int(0, strlen($minusculas) - 1)] .
            $mayusculas[random_int(0, strlen($mayusculas) - 1)] .
            $numeros[random_int(0, strlen($numeros) - 1)] .
            $simbolos[random_int(0, strlen($simbolos) - 1)];

        // Llenamos el resto de la contraseña hasta la longitud deseada
        $todos = $minusculas . $mayusculas . $numeros . $simbolos;
        for ($i = strlen($contrasena); $i < $longitud; $i++) {
            $contrasena .= $todos[random_int(0, strlen($todos) - 1)];
        }

        // Mezclamos los caracteres para mayor aleatoriedad
        return str_shuffle($contrasena);
    }

    public function agregarAdmin(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'ap_paterno' => 'required|string|max:255',
            'ap_materno' => 'required|string|max:255',
            'phone' => ['required', 'string', 'min:13', 'max:13', 'regex:/^\+52\d{10}$/'],
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
        ]);


        // Generar contraseña aleatoria
        $password = $this->generarContrasenaAleatoria();

        // Iniciar una transacción
        \DB::beginTransaction();

        try {
            // Crear el usuario
            $usuario = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($password),
                'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
            ]);

            // Crear la persona
            $persona = Persona::create([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->phone,
                'usuario' => $usuario->id,
            ]);

            // Crear el comprador
            $cliente = Comprador::create([
                'id_persona' => $persona->id,
                'razon_social' => null,
                'created_at' => now(),
                'updated_at' => null,
            ]);

            // Crear el administrador
            $admin = Administrador::create([
                'id_persona' => $persona->id,
            ]);

            // Asignar roles
            $usuario->assignRole('cliente');
            $usuario->assignRole('admin');

            \DB::commit();

            if ($admin) {
                Mail::to($request->email)->send(new EnvioCredenciales($usuario, $password));
            }


            return redirect()->route('dashboard.usuarios')->with('success', 'Usuario creado con éxito. Se ha enviado un correo con las credenciales.');

        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            \DB::rollback();

            // Pasar el mensaje de error detallado a la sesión
            return redirect()->route('dashboard.usuarios')->with('error', 'Error al crear usuario: ' . $e->getMessage());
        }
    }


    public function agregarEstilista(Request $request)
    {
        // Validación de datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ap_paterno' => 'required|string|max:255',
            'ap_materno' => 'required|string|max:255',
            'phone' => ['required', 'string','min:15', 'max:15', 'regex:/^\+52\d{10}$/'],
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ]);




        // Generar contraseña aleatoria
        $password = $this->generarContrasenaAleatoria();


        // Iniciar una transacción
        \DB::beginTransaction();

        try {
            // Crear el usuario
            $usuario = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($password),
                'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
            ]);

            // Crear la persona
            $persona = Persona::create([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->phone,
                'usuario' => $usuario->id,
            ]);

            $cliente = Comprador::create([
                'id_persona' => $persona->id,
                'razon_social' => null,
                'created_at' => now(),
                'updated_at' => null,
            ]);

            // Crear el estilista
            $estilista = Estilista::create([
                'estado' => 'activo',
                'id_persona' => $persona->id,
                'created_at' => now(),
                'updated_at' => null,
            ]);


            // Asignar roles
            $usuario->assignRole('cliente');
            $usuario->assignRole('estilista');

            \DB::commit();

            if ($estilista) {
                Mail::to($request->email)->send(new EnvioCredenciales($usuario, $password));
            }

            return redirect()->route('dashboard.usuarios')->with('success', 'Usuario creado con éxito. Se ha enviado un correo con las credenciales.');

        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            \DB::rollback();
            return redirect()->route('dashboard.usuarios')->with('error', 'Error al crear usuario.');
        }
    }


        public function agregarProfesor(Request $request)
    {
        // Validation rules
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ap_paterno' => 'required|string|max:255',
            'ap_materno' => 'required|string|max:255',
            'phone' => ['required', 'string', 'max:13','min:13', 'regex:/^\+52\d{10}$/'],
            'RFC' => 'nullable|string|max:20',
            'CURP' => 'nullable|string|max:20',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'especialidad' => 'required|string|in:estilismo,barbería,maquillaje,uñas',
            'zipcode' => 'required|string|size:5',
            'ciudad' => 'required|string|max:100',
            'colonia' => 'required|string|max:100',
            'calle' => 'required|string|max:100',
            'n_ext' => 'required|string|max:10',
            'n_int' => 'nullable|string|max:10',
        ]);





        // Generate a random password
        $password = $this->generarContrasenaAleatoria();

        \DB::beginTransaction();

        try {
            // Crear el usuario
            $usuario = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($password),
                'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
            ]);

            // Crear la persona
            $persona = Persona::create([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->phone,
                'usuario' => $usuario->id,
            ]);

            // Crear el comprador
            $cliente = Comprador::create([
                'id_persona' => $persona->id,
                'razon_social' => null,
                'created_at' => now(),
                'updated_at' => null,
            ]);



        // Create the professor
        $profesor = Profesor::create([
            'especialidad' => $request->especialidad,
            'fecha_contratacion' => now(),
            'RFC' => $request->RFC,
            'CURP' => $request->CURP,
            'estado' => 'activo',
            'id_persona' => $persona->id,
            'zipcode' => $request->zipcode,
            'ciudad' => $request->ciudad,
            'colonia' => $request->colonia,
            'calle' => $request->calle,
            'n_ext' => $request->n_ext,
            'n_int' => $request->n_int,
            'created_at' => now(),
            'updated_at' => null,
        ]);



            // Asignar roles
            $usuario->assignRole('cliente');
            $usuario->assignRole('profesor');

            \DB::commit();

            if ($profesor) {
                Mail::to($request->email)->send(new EnvioCredenciales($usuario, $password));
            }

            return redirect()->route('dashboard.usuarios')->with('success', 'Usuario creado con éxito. Se ha enviado un correo con las credenciales.');

        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            \DB::rollback();

            // Pasar el mensaje de error detallado a la sesión
            return redirect()->route('dashboard.usuarios')->with('error', 'Error al crear usuario: ' . $e->getMessage());
        }
    }
}
