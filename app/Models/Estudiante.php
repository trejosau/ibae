<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Estudiante extends Model
{
    use HasFactory;


    protected $table = 'estudiantes';


    protected $fillable = [
        'id_persona',
        'id_inscripcion',
        'fecha_inscripcion',
        'grado_estudio',
        'zipcode',
        'colonia',
        'calle',
        'num_ext',
        'num_int',
    ];

    public function persona() : BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function inscripcion() : BelongsTo
    {
        return $this->belongsTo(Inscripcion::class, 'id_inscripcion');
    }
}
