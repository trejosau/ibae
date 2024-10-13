<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cambios extends Model
{
    protected $table = 'Cambios';

    protected $fillable = [
        'tabla_modificada',
        'registro_id',
        'tipo_cambio',
        'campo_modificado',
        'valor_anterior',
        'valor_nuevo',
        'fecha_hora_cambio',
        'usuario_responsable',
    ];
}
