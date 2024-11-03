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
    ];

    public function curso() : BelongsTo
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }
}
