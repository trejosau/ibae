<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificados extends Model
{

    protected $table = 'certificados';

    protected $fillable = [
        'nombre',
        'descripcion',
        'horas',
        'institucion',
    ];

    public function cursos()
    {
        return $this->hasMany(Cursos::class, 'id_certificacion'); // Inverse relationship
    }

}
