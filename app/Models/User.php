<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Especifica el nombre de la tabla
    protected $table = 'usuarios';

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',                 // Nombre del usuario
        'email',                // Correo electrónico del usuario
        'password',             // Contraseña del usuario
        'email_verified_at',    // Marca de tiempo de verificación del correo
        'remember_token',       // Token para recordar sesión
        'estado',               // Estado del usuario (activo/inactivo)
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos específicos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Convierte a un objeto de fecha y hora
            'estado' => 'string',                // Convierte el estado a cadena
            'password' => 'hashed',              // Asegura que la contraseña esté hasheada
        ];
    }
}
