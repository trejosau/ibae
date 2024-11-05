<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CursoApertura extends Model
{

    public $timestamps = false;

    protected $table = 'curso_apertura';

    protected $fillable = [
        'id_curso',
        'nombre', // Asegúrate de que esto esté aquí
        'fecha_inicio',
        'monto_colegiatura',
        'dia_clase',
        'hora_clase',
        'estado',
    ];

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'estudiante_curso', 'id_curso_apertura', 'id_estudiante');
    }
    // Relación con la tabla curso (si hay un modelo Curso)
    public function curso()
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }

    public function moduloCursos()
    {
        return $this->hasMany(ModuloCurso::class, 'id_curso_apertura'); // 'id_curso_apertura' es la clave foránea
    }
}
