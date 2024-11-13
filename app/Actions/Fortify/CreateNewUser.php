<?php

namespace App\Actions\Fortify;

use App\Models\Comprador;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        $this->validator($input)->validate();

        $user = User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'provider' => 'default',
            'profile_photo_url' => 'https://imagenes-ibae.s3.us-east-2.amazonaws.com/images/profiles/default_profile.jpg',
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

        return $user;
    }

    protected function validator(array $data, $userId = null)
    {
        return Validator::make($data, [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => $this->passwordRules(),
        ]);
    }

}
