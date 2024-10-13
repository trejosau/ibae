<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cursos extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion_semanas',
        'id_certificacion',
    ];

    public function certificado() : BelongsTo
    {
        return $this->belongsTo(Certificados::class, 'id_certificacion');
    }

    public function cursoApertura() : HasMany
    {
        return $this->hasMany(CursoApertura::class, 'id_curso');
    }
}
