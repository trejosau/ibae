<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profesor extends Model
{
    protected $table = 'profesores';

    protected $fillable = [
        'especialidad',
        'fecha_contratacion',
        'CURP',
        'estado',
        'id_persona',
        'zipcode',
        'ciudad',
        'colonia',
        'calle',
        'n_ext',
        'n_int',
    ];

    protected $hidden = [
        'RFC',
        ];
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
