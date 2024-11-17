<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{

    protected $table = 'categorias';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'photo',
    ];

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class, 'categoria_id');
    }

}
