<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificados extends Model
{
    use HasFactory;

    protected $table = 'certificados';

    protected $fillable = [
        'nombre',
        'descripcion',
        'horas',
        'institucion',
    ];


}
