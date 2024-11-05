<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id_persona', 'id');
    }
    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'id_persona');
    }

}
