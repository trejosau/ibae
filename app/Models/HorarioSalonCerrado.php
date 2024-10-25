<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioSalonCerrado extends Model
{

    protected $table = 'horario_salon_cerrado';

    protected $fillable = [
        'fecha_hora_cierre_inicio',
        'fecha_hora_cierre_fin',
        'hora_fin',
        'motivo',
    ];
}
