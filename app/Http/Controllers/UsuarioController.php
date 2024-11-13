<?php

namespace App\Http\Controllers;

use App\Mail\EnvioCredenciales;
use App\Models\Administrador;
use App\Models\Persona;
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
        // Validación de datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ap_paterno' => 'required|string|max:255',
            'ap_materno' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', // Asegura email único
        ]);



        // Generar contraseña aleatoria
        $password = $this->generarContrasenaAleatoria();


        // Iniciar una transacción
        \DB::beginTransaction();

        try {
            // Crear el usuario
            $usuario = User::create([
                'username' => $request->username,
                'email' => random_int(1, 1000) . '@example.com',
                'password' => Hash::make($password),
                'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
            ]);

            // Crear la persona
            $persona = Persona::create([
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'telefono' => $request->telefono,
                'usuario' => $usuario->id,
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
                dd('Enviado');
            }



        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            \DB::rollback();
            return redirect()->back()->with('error', 'Error al crear usuario.');
        }
    }

}
