<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstudianteCurso extends Model
{
    use HasFactory;

    protected $table = 'estudiante_curso';

    protected $fillable = [
        'id_estudiante',
        'id_curso_apertura',
        'fecha_inscripcion',
        'asistencia',
    ];

    public function estudiante() : BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'matricula');
    }

    public function cursoApertura() : BelongsTo
    {
        return $this->belongsTo(CursoApertura::class, 'id_curso_apertura');
    }
}
