<?php

namespace App\Http\Controllers;

use App\Models\Comprador;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

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

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $username = $this->generateUniqueUsername($googleUser->email);

                $user = User::create([
                    'username' => $username,
                    'email' => $googleUser->email,
                    'email_verified_at' => now(),
                    'password' => Hash::make(uniqid()),
                    'provider' => 'google',
                    'profile_photo_url' => $googleUser->avatar,
                    'created_at' => now(),
                ]);

                $persona = Persona::create([
                    'nombre' => $googleUser->name,
                    'ap_paterno' => $googleUser->user['family_name'] ?? '',
                    'ap_materno' => $googleUser->user['given_name'] ?? '',
                    'telefono' => null,
                    'usuario' => $user->id,
                ]);

                Comprador::create([
                    'id_persona' => $persona->id,
                    'razon_social' => null,
                    'created_at' => now(),
                ]);

                $user->assignRole('cliente'); // Asigna el rol predeterminado a nuevos usuarios
            }
            if ($user->estado === 'inactivo') {
                return redirect()->route('login')->with('error', 'Tu cuenta esta bloqueada.');
            }
            Auth::login($user, true);


            // Redirección predeterminada si no se cumple ningún rol
            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Algo salió mal al iniciar sesión con Google.');
        }
    }

    private function generateUniqueUsername($email)
    {
        $username = explode('@', $email)[0];
        while (User::where('username', $username)->exists()) {
            $username = substr($username, 0, 9) . rand(100, 999);
        }
        return $username;
    }
}
