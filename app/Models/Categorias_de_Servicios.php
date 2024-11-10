<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias_de_Servicios extends Model
{
    protected $table = 'categorias_servicios';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];
    public function servicios()
    {
        return $this->hasMany(Servicios::class, 'categoria');
    }
}
