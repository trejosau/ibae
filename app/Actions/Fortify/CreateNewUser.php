<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        // Primero validamos los datos de entrada
        $this->validator($input)->validate(); // Llama al validador

        try {
            $user = User::create([
                'username' => $input['username'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            $user->assignRole('Comprador');

            return $user;
        } catch (QueryException $e) {
            // Manejo de errores para el nombre de usuario
            if ($e->errorInfo[1] == 1062) {
                throw ValidationException::withMessages([
                    'username' => 'Este nombre de usuario ya está en uso.',
                    'email' => 'Este correo ya está en uso.',
                ]);
            }

            throw $e;
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users,username'], // Referencia a la tabla y columna
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Referencia a la tabla y columna
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

}
