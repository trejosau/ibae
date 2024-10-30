<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';

    public $timestamps = false;

    protected $fillable = [
        'id_comprador',
        'fecha_compra',
        'total',
        'id_admin',
        'es_estudiante',
        'matricula',
    ];


}

