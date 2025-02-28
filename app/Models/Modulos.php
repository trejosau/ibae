<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modulos extends Model
{
    protected $table = 'modulos';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'categoria',
        'duracion',
    ];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }
    public function temas()
    {
        return $this->belongsToMany(Temas::class, 'modulo_temas', 'id_modulo', 'id_tema');
    }
}
