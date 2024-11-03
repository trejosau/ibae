<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuloCurso extends Model
{
    use HasFactory;

    protected $table = 'modulo_curso';
    public $timestamps = false;

    protected $fillable = [
        'id_modulo',
        'id_curso',
        'orden',
        'id_profesor',
    ];


    public function modulo()
    {
        return $this->belongsTo(Modulos::class, 'id_modulo');
    }

    public function cursoApertura()
    {
        return $this->belongsTo(CursoApertura::class, 'id_curso_apertura');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'id_profesor');
    }
}
