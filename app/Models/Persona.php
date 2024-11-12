<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'nombre',
        'ap_paterno',
        'ap_materno',
        'telefono',
        'usuario',
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario', 'id');
    }

    public function Estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id_persona', 'id');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'id_persona', 'id');
    }

    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'id_persona', 'id');
    }
    public function estilista()
    {
        return $this->hasOne(Estilista::class, 'id_persona');
    }

    public function comprador()
    {
        return $this->hasOne(Comprador::class, 'id_persona');
    }
}

