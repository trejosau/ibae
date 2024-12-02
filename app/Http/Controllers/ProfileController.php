<?php

namespace App\Http\Controllers;

use App\Mail\EnvioCredenciales;
use App\Models\Comprador;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ProfileController extends Controller
{



    public function edit()
    {
        $user = Auth::user()->load([
            'persona',
            'persona.estudiante',
            'persona.profesor',
            'persona.estilista',
            'persona.administrador',
            'persona.comprador',
        ]);

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $persona = Persona::where('usuario', $user->id)->first();

        $comprador = Comprador::where('id_persona', $persona->id)->first();
        // Validación de los campos



        $validatedData = $request->validate([
            'nombre' => 'nullable|string|max:255',
            'ap_materno' => 'nullable|string|max:255',
            'ap_paterno' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'razon_social' => 'nullable|string|max:255',
            'username' => 'required|string|max:255',
        ]);


        $username = $validatedData['username'];



            $persona->nombre = $validatedData['nombre'];
            $persona->ap_paterno = $validatedData['ap_paterno'];
            $persona->ap_materno = $validatedData['ap_materno'];
            $persona->telefono = $validatedData['telefono'];

            $comprador->razon_social = $validatedData['razon_social'];




        // Verificar si el username o el email han cambiado y no están duplicados
        if ($user->username !== $username && !User::where('username', $username)->exists()) {
            $user->username = $username;
        }




        $persona->save();
        $comprador->save();
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Perfil actualizado correctamente.');
    }

    public function changePassword(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'current_password' => 'required|string|min:3',
            'password' => 'required|string|min:3|confirmed',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si la contraseña actual es correcta
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return redirect()->route('profile.edit')->with('error', 'La contraseña actual no es correcta.');
        }

        // Cambiar la contraseña del usuario
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('profile.edit')->with('success', 'Contraseña cambiada correctamente.');
    }




    public function imageUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'crop_x' => 'required|numeric',
            'crop_y' => 'required|numeric',
            'crop_width' => 'required|numeric',
            'crop_height' => 'required|numeric',
            'main_photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);


        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('main_photo')->getContent());

        if ($request->has('crop_x') && $request->has('crop_y') && $request->has('crop_width') && $request->has('crop_height')) {
            $image->crop(
                $request->input('crop_width'),
                $request->input('crop_height'),
                $request->input('crop_x'),
                $request->input('crop_y')
            );
        }

        $user = Auth::user();

        if ($user->profile_photo_url) {
            $user->profile_photo_url = null;
        }

        $image = $image->toWebp(90);
        $fileName = "{$user->username}_{$user->id}.webp";
        Storage::disk('s3')->put("images/profiles/{$fileName}", $image);

        $url = Storage::disk('s3')->url("images/profiles/{$fileName}");

        $user->profile_photo_url = $url;
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Foto de perfil actualizada correctamente.');
    }


    public function sendResetPasswordEmail(Request $request)
    {
        // Validar que el campo email sea obligatorio y tenga un formato válido
        $request->validate([
            'email' => 'required|email',
        ]);

        // Buscar el usuario por su email
        $user = User::where('email', $request->email)->first();

        // Si no se encuentra el usuario, redirigir con un mensaje de error
        if (!$user) {
            return redirect()->route('login')->with('error', 'No se encontró ningún usuario con ese correo.');
        }

        // Generar una contraseña aleatoria para el usuario
        $password = $this->generarContrasenaAleatoria();

        // Actualizar la contraseña del usuario con la nueva (encriptada)
        $user->password = Hash::make($password);
        $user->save();

        // Enviar el correo con las nuevas credenciales
        Mail::to($request->email)->send(new EnvioCredenciales($user, $password));

        // Redirigir con un mensaje de éxito
        return redirect()->route('login')->with('success', 'Se ha enviado un correo con las instrucciones para restablecer la contraseña.');
    }

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
}
