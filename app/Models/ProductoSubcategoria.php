<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoSubcategoria extends Model
{
    protected $table = 'producto_subcategorias';

    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'id_subcategoria',
    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'id_subcategoria');
    }
}
