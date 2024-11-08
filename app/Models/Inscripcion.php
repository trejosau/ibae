<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'material_incluido',
    ];
   public function estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'id_inscripcion', 'id');
    }



}
