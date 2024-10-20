<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class loginGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Verificar si el usuario ya existe en la base de datos
            $user = User::where('email', $googleUser->email)->first();

            // Si no existe, lo creamos y asignamos el rol "Comprador"
            if (!$user) {
                // Extraer la parte del correo antes del '@' para el username
                $username = explode('@', $googleUser->email)[0];

                // Asegurarse de que el username sea único en la base de datos
                while (User::where('username', $username)->exists()) {
                    // Si el username ya existe, le añadimos un número aleatorio para hacerlo único
                    $username = substr($username, 0, 9) . rand(100, 999);
                }

                // Crear el usuario
                $user = User::create([
                    'username' => $username, // Usar la parte del correo antes del '@'
                    'email' => $googleUser->email,
                    'password' => Hash::make(uniqid()), // Generar una contraseña aleatoria
                ]);

                // Asignar el rol de "Comprador" al nuevo usuario
                $user->assignRole('Comprador');
            }
            // Autenticar al usuario
            Auth::login($user);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Algo salió mal al iniciar sesión con Google.');
        }
    }
}
