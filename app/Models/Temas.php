<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Temas extends Model
{
    protected $table = 'temas';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function moduloTemas() : HasMany
    {
        return $this->hasMany(ModuloTemas::class, 'id_tema');
    }
}

