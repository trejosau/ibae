<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuloCurso extends Model
{
    use HasFactory;

    protected $table = 'modulo_curso';

    protected $fillable = [
        'id_modulo',
        'id_curso',
        'orden',
        'id_profesor',
    ];

    public function modulo(): BelongsTo
    {
        return $this->belongsTo(Modulos::class, 'id_modulo');
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Cursos::class, 'id_curso');
    }

    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Profesor::class, 'id_profesor');
    }
}
