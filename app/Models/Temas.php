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

    public function modulos()
    {
        return $this->belongsToMany(Modulos::class, 'modulos_temas');
    }
}

