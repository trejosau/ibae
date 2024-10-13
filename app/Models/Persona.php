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

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario');
    }
}
