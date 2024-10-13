<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioCerrado extends Model
{
    use HasFactory;

    protected $table = 'horario_cerrado'; // Especifica el nombre de la tabla si no sigue la convención de plural

    protected $fillable = [
        'fecha_hora_cierre_inicio',
        'fecha_hora_cierre_fin',
        'hora_fin',
        'motivo',
    ];


}
