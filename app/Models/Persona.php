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

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id_persona', 'id');
    }


    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'id_persona');
    }
}

