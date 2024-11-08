<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cursos extends Model
{

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion_semanas',
        'estado',
        'id_certificacion',
    ];

    public function certificado()
    {
        return $this->belongsTo(Certificados::class, 'id_certificacion');  // Relación con el modelo Certificados
    }


    public function curso_aperturas()
    {
        return $this->hasMany(CursoApertura::class, 'id_curso');
    }
}
