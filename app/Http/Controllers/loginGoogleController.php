<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class LoginGoogleController extends Controller
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
                ]);

                $user->assignRole('cliente');
            }

            Auth::login($user);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Algo salió mal al iniciar sesión con Google.');
        }
    }
}
