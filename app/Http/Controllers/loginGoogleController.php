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
                $username = explode('@', $googleUser->email)[0];
                while (User::where('username', $username)->exists()) {
                    $username = substr($username, 0, 9) . rand(100, 999);
                }

                $user = User::create([
                    'username' => $username,
                    'email' => $googleUser->email,
                    'password' => Hash::make(uniqid()),
                    'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
                    'created_at' => now(),
                    'updated_at' => null,
                ]);

                $persona = Persona::create([
                    'nombre' => null,
                    'ap_paterno' => null,
                    'ap_materno' => null,
                    'telefono' => null,
                    'usuario' => $user->id,
                ]);

                Comprador::create([
                    'id_persona' => $persona->id,
                    'razon_social' => null,
                    'created_at' => now(),
                    'updated_at' => null,
                ]);

                $user->assignRole('cliente');
                $user->assignRole('estudiante');
                $user->assignRole('profesor');
                $user->assignRole('estilista');
                $user->assignRole('admin');
            }

            Auth::login($user, true);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Algo salió mal al iniciar sesión con Google.');
        }
    }
}
