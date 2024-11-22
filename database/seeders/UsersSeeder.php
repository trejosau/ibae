<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 15,
                'username' => 'juanperez',
                'email' => 'juanperez@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Cambia123'),  // Contraseña encriptada
                'two_factor_secret' => Str::random(64),
                'two_factor_recovery_codes' => Str::random(64),
                'two_factor_confirmed_at' => now(),
                'remember_token' => Str::random(100),
                'estado' => 'activo',
                'profile_photo_url' => 'https://www.example.com/juanperez.jpg',
            ],
            [
                'id' => 16,
                'username' => 'mariagonzalez',
                'email' => 'mariagonzalez@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Cambia123'),  // Contraseña encriptada
                'two_factor_secret' => Str::random(64),
                'two_factor_recovery_codes' => Str::random(64),
                'two_factor_confirmed_at' => now(),
                'remember_token' => Str::random(100),
                'estado' => 'activo',
                'profile_photo_url' => 'https://www.example.com/mariagonzalez.jpg',
            ],
            [
                'id' => 17,
                'username' => 'luisrodriguez',
                'email' => 'luisrodriguez@email.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Cambia123'),  // Contraseña encriptada
                'two_factor_secret' => Str::random(64),
                'two_factor_recovery_codes' => Str::random(64),
                'two_factor_confirmed_at' => now(),
                'remember_token' => Str::random(100),
                'estado' => 'inactivo',
                'profile_photo_url' => 'https://www.example.com/luisrodriguez.jpg',
            ],[
                'id' => 18,  // Id del usuario
                'username' => 'usuario18',
                'email' => 'usuario18@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Cambia123'),  // Contraseña predeterminada
                'two_factor_secret' => 'secret_key_18',
                'two_factor_recovery_codes' => 'recovery_codes_18',
                'two_factor_confirmed_at' => now(),
                'remember_token' => 'remember_token_18',
                'estado' => 'activo',
                'profile_photo_url' => 'https://example.com/profile-photo-18.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 19,  // Id del usuario
                'username' => 'usuario19',
                'email' => 'usuario19@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Cambia123'),  // Contraseña predeterminada
                'two_factor_secret' => 'secret_key_19',
                'two_factor_recovery_codes' => 'recovery_codes_19',
                'two_factor_confirmed_at' => now(),
                'remember_token' => 'remember_token_19',
                'estado' => 'activo',
                'profile_photo_url' => 'https://example.com/profile-photo-19.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 20,  // Id del usuario
                'username' => 'usuario20',
                'email' => 'usuario20@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('Cambia123'),  // Contraseña predeterminada
                'two_factor_secret' => 'secret_key_20',
                'two_factor_recovery_codes' => 'recovery_codes_20',
                'two_factor_confirmed_at' => now(),
                'remember_token' => 'remember_token_20',
                'estado' => 'activo',
                'profile_photo_url' => 'https://example.com/profile-photo-20.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
