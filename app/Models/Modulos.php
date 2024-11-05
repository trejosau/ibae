<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modulos extends Model
{
    protected $table = 'modulos';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'categoria',
        'duracion',
    ];



}
