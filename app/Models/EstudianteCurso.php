<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstudianteCurso extends Model
{

    protected $table = 'estudiante_curso';

    protected $fillable = [
        'id_estudiante',
        'id_curso_apertura',
        'fecha_inscripcion',
        'asistencia',
    ];

    public $timestamps = false; // Desactiva los timestamps

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }

    public function cursoApertura()
    {
        return $this->belongsTo(CursoApertura::class, 'id_curso_apertura');
    }
}
