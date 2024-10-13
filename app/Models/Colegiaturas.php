<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Colegiaturas extends Model
{
    use HasFactory;

    protected $table = 'colegiaturas';

    protected $fillable = [
        'id_estudiante_curso',
        'semana',
        'Asistio',
        'Fecha_de_Pago',
        'estado',
        'Monto',
    ];

    public function estudianteCurso() : BelongsTo
    {
        return $this->belongsTo(EstudianteCurso::class, 'id_estudiante_curso');
    }
}
