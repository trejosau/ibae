<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioSalon extends Model
{

    protected $table = 'horario_salon';

    protected $fillable = [
        'dia',
        'hora_apertura',
        'hora_cierre',
    ];

}
