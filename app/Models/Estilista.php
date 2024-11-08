<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estilista extends Model
{

    protected $table = 'estilistas';

    protected $fillable = [
        'estado',
        'id_persona',
    ];

    public function persona() : BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function citas() : HasMany
    {
        return $this->hasMany(Citas::class, 'id_estilista');
    }
}
